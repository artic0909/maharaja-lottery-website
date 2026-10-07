<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class BookingManagementController extends Controller
{
    /**
     * Path to persistent JSON storage for booked tickets.
     */
    public static function getBookingsStoragePath(): string
    {
        return storage_path('app/booked_tickets.json');
    }

    /**
     * Retrieve all booking records with standardized fields.
     */
    public static function getAllBookings(): array
    {
        $path = self::getBookingsStoragePath();
        if (!File::exists($path)) {
            return [];
        }

        $data = json_decode(File::get($path), true);
        if (!is_array($data)) {
            return [];
        }

        $normalized = [];
        foreach ($data as $index => $item) {
            if (!is_array($item)) continue;

            $tickets = [];
            if (isset($item['tickets']) && is_array($item['tickets'])) {
                $tickets = array_values(array_unique(array_map('strtoupper', array_map('trim', $item['tickets']))));
            } elseif (isset($item['ticket_number'])) {
                $tickets = [strtoupper(trim($item['ticket_number']))];
            }

            $bookingRef = $item['booking_ref'] ?? ('BK' . (isset($item['booked_at']) ? date('YmdHis', strtotime($item['booked_at'])) : time()) . '_' . $index);
            $customerName = $item['customer_name'] ?? ($item['name'] ?? 'Customer');
            $customerMobile = $item['customer_mobile'] ?? ($item['mobile'] ?? 'N/A');
            $totalAmount = (int)($item['total_amount'] ?? ($item['amount'] ?? (count($tickets) * 40)));
            $utrNumber = $item['utr_number'] ?? ($item['utr'] ?? '');
            $status = $item['status'] ?? 'Pending'; // 'Pending', 'Approved', 'Rejected'
            $paymentStatus = $item['payment_status'] ?? ($status === 'Approved' ? 'Received' : ($utrNumber ? 'Submitted' : 'Pending'));
            $resultStatus = $item['result_status'] ?? ($status === 'Approved' ? 'Active in Live Draw' : 'Pending Approval');
            $prizeAmount = $item['prize_amount'] ?? '';
            $bookedAt = $item['booked_at'] ?? ($item['created_at'] ?? date('Y-m-d H:i:s'));

            $normalized[] = [
                'id' => $bookingRef,
                'booking_ref' => $bookingRef,
                'customer_name' => $customerName,
                'customer_mobile' => $customerMobile,
                'customer_email' => $item['customer_email'] ?? '',
                'customer_state' => $item['customer_state'] ?? '',
                'customer_city' => $item['customer_city'] ?? '',
                'tickets' => $tickets,
                'ticket_count' => count($tickets),
                'total_amount' => $totalAmount,
                'utr_number' => $utrNumber,
                'payment_method' => $item['payment_method'] ?? 'UPI / QR',
                'receipt_image' => $item['receipt_image'] ?? '',
                'status' => $status,
                'payment_status' => $paymentStatus,
                'result_status' => $resultStatus,
                'prize_amount' => $prizeAmount,
                'admin_notes' => $item['admin_notes'] ?? '',
                'booked_at' => $bookedAt,
                'approved_at' => $item['approved_at'] ?? null,
            ];
        }

        // Sort latest first
        usort($normalized, function ($a, $b) {
            return strtotime($b['booked_at'] ?? '') <=> strtotime($a['booked_at'] ?? '');
        });

        return $normalized;
    }

    /**
     * Save all bookings back to persistent storage.
     */
    public static function saveBookings(array $bookings): void
    {
        $path = self::getBookingsStoragePath();
        $dir = dirname($path);
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }
        File::put($path, json_encode(array_values($bookings), JSON_PRETTY_PRINT));
    }

    /**
     * Display all bookings with payment & verification records.
     */
    public function index(Request $request): View
    {
        $bookings = self::getAllBookings();

        $statusFilter = $request->input('status', 'all');
        if ($statusFilter !== 'all') {
            $bookings = array_values(array_filter($bookings, fn($b) => strtolower($b['status']) === strtolower($statusFilter)));
        }

        $search = trim($request->input('q', ''));
        if (!empty($search)) {
            $searchLower = strtolower($search);
            $bookings = array_values(array_filter($bookings, function ($b) use ($searchLower) {
                return str_contains(strtolower($b['booking_ref']), $searchLower)
                    || str_contains(strtolower($b['customer_name']), $searchLower)
                    || str_contains(strtolower($b['customer_mobile']), $searchLower)
                    || str_contains(strtolower($b['utr_number']), $searchLower)
                    || in_array(strtoupper($searchLower), array_map('strtolower', $b['tickets']));
            }));
        }

        $allRaw = self::getAllBookings();
        $stats = [
            'total' => count($allRaw),
            'pending' => count(array_filter($allRaw, fn($b) => $b['status'] === 'Pending')),
            'approved' => count(array_filter($allRaw, fn($b) => $b['status'] === 'Approved')),
            'rejected' => count(array_filter($allRaw, fn($b) => $b['status'] === 'Rejected')),
            'total_amount' => array_sum(array_column($allRaw, 'total_amount')),
            'approved_amount' => array_sum(array_column(array_filter($allRaw, fn($b) => $b['status'] === 'Approved'), 'total_amount')),
            'total_tickets' => array_sum(array_column($allRaw, 'ticket_count')),
        ];

        return view('admin.bookings.index', compact('bookings', 'stats', 'statusFilter', 'search'));
    }

    /**
     * Approve a booking & mark payment as received.
     */
    public function approve(Request $request, $ref)
    {
        $bookings = self::getAllBookings();
        $found = false;

        foreach ($bookings as &$b) {
            if ($b['booking_ref'] === $ref || $b['id'] === $ref) {
                $b['status'] = 'Approved';
                $b['payment_status'] = 'Received';
                $b['result_status'] = $request->input('result_status', 'Active in Live Draw');
                $b['prize_amount'] = $request->input('prize_amount', $b['prize_amount'] ?? '');
                $b['approved_at'] = date('Y-m-d H:i:s');
                $b['admin_notes'] = $request->input('admin_notes', 'Payment verified and approved by admin.');
                $found = true;
                break;
            }
        }

        if ($found) {
            self::saveBookings($bookings);
            return redirect()->back()->with('success', "Booking {$ref} has been Approved! Payment received confirmed. Result is now accessible to the customer.");
        }

        return redirect()->back()->with('error', "Booking reference {$ref} not found.");
    }

    /**
     * Reject a booking.
     */
    public function reject(Request $request, $ref)
    {
        $bookings = self::getAllBookings();
        $found = false;

        foreach ($bookings as &$b) {
            if ($b['booking_ref'] === $ref || $b['id'] === $ref) {
                $b['status'] = 'Rejected';
                $b['payment_status'] = 'Rejected';
                $b['result_status'] = 'Payment Rejected';
                $b['admin_notes'] = $request->input('admin_notes', 'Payment verification failed or rejected.');
                $found = true;
                break;
            }
        }

        if ($found) {
            self::saveBookings($bookings);
            return redirect()->back()->with('success', "Booking {$ref} has been marked as Rejected.");
        }

        return redirect()->back()->with('error', "Booking reference {$ref} not found.");
    }

    /**
     * Award 3rd prize directly with one click (no modal required).
     */
    public function awardThirdPrize(Request $request, $ref)
    {
        $bookings = self::getAllBookings();
        $found = false;
        $awarded = false;
        $prizeText = '';

        foreach ($bookings as &$b) {
            if ($b['booking_ref'] === $ref || $b['id'] === $ref) {
                // Determine 3rd prize amount based on ticket series
                $firstTicket = $b['tickets'][0] ?? '';
                $series = strtoupper(substr($firstTicket, 0, 2));
                $amount = 'INR 2 Lakhs';
                if ($series === 'RM') {
                    $amount = 'INR 1 Lakh';
                } elseif ($series === 'VM') {
                    $amount = 'INR 50,000';
                }

                if (($b['result_status'] ?? '') === '3rd Prize Winner') {
                    // Toggle back to Active in Live Draw if clicked again
                    $b['result_status'] = 'Active in Live Draw';
                    $b['prize_amount'] = '';
                    $awarded = false;
                } else {
                    $b['result_status'] = '3rd Prize Winner';
                    $b['prize_amount'] = $amount;
                    // Also ensure booking is approved so winner result is visible
                    if ($b['status'] !== 'Approved') {
                        $b['status'] = 'Approved';
                        $b['payment_status'] = 'Received';
                        $b['approved_at'] = date('Y-m-d H:i:s');
                    }
                    $awarded = true;
                    $prizeText = $amount;
                }
                $found = true;
                break;
            }
        }

        if ($found) {
            self::saveBookings($bookings);
            if ($awarded) {
                return redirect()->back()->with('success', "★ 3rd Prize ({$prizeText}) successfully awarded to booking {$ref}!");
            } else {
                return redirect()->back()->with('success', "Booking {$ref} result reset to Active in Live Draw.");
            }
        }

        return redirect()->back()->with('error', "Booking reference {$ref} not found.");
    }

    /**
     * Update lottery result / winning status for a specific booking.
     */
    public function updateResult(Request $request, $ref)
    {
        $bookings = self::getAllBookings();
        $found = false;

        foreach ($bookings as &$b) {
            if ($b['booking_ref'] === $ref || $b['id'] === $ref) {
                $b['result_status'] = $request->input('result_status', 'Active in Live Draw');
                $b['prize_amount'] = $request->input('prize_amount', '');
                $b['admin_notes'] = $request->input('admin_notes', $b['admin_notes'] ?? '');
                $found = true;
                break;
            }
        }

        if ($found) {
            self::saveBookings($bookings);
            return redirect()->back()->with('success', "Result status updated for {$ref}.");
        }

        return redirect()->back()->with('error', "Booking reference {$ref} not found.");
    }

    /**
     * Delete a booking record.
     */
    public function destroy($ref)
    {
        $bookings = self::getAllBookings();
        $filtered = array_values(array_filter($bookings, fn($b) => $b['booking_ref'] !== $ref && $b['id'] !== $ref));

        self::saveBookings($filtered);

        return redirect()->back()->with('success', "Booking record {$ref} deleted successfully.");
    }

    /**
     * Bulk Delete multiple selected bookings.
     */
    public function bulkDelete(Request $request)
    {
        $refs = $request->input('refs', []);
        if (is_string($refs)) {
            $refs = explode(',', $refs);
        }
        $refs = array_values(array_filter(array_map('trim', (array)$refs)));

        if (empty($refs)) {
            return redirect()->back()->with('error', 'No bookings selected for deletion.');
        }

        $bookings = self::getAllBookings();
        $initialCount = count($bookings);
        $filtered = array_values(array_filter($bookings, fn($b) => !in_array($b['booking_ref'], $refs) && !in_array($b['id'], $refs)));

        self::saveBookings($filtered);

        $deletedCount = $initialCount - count($filtered);
        return redirect()->back()->with('success', "Successfully deleted {$deletedCount} selected booking record(s).");
    }

    /**
     * Bulk Approve multiple selected bookings.
     */
    public function bulkApprove(Request $request)
    {
        $refs = $request->input('refs', []);
        if (is_string($refs)) {
            $refs = explode(',', $refs);
        }
        $refs = array_values(array_filter(array_map('trim', (array)$refs)));

        if (empty($refs)) {
            return redirect()->back()->with('error', 'No bookings selected for approval.');
        }

        $bookings = self::getAllBookings();
        $updatedCount = 0;

        foreach ($bookings as &$b) {
            if (in_array($b['booking_ref'], $refs) || in_array($b['id'], $refs)) {
                $b['status'] = 'Approved';
                $b['payment_status'] = 'Received';
                $b['result_status'] = 'Active in Live Draw';
                $b['approved_at'] = date('Y-m-d H:i:s');
                $updatedCount++;
            }
        }

        self::saveBookings($bookings);

        return redirect()->back()->with('success', "Successfully approved {$updatedCount} selected booking(s) and confirmed payment received.");
    }
}
