<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TdsPayment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TdsManagementController extends Controller
{
    /**
     * Display all TDS payment records with filters & metrics.
     */
    public function index(Request $request): View
    {
        $statusFilter = $request->input('status', 'all');
        $search = trim($request->input('q', ''));

        $query = TdsPayment::query()->orderBy('created_at', 'desc');

        if ($statusFilter !== 'all') {
            $query->where('status', ucfirst($statusFilter));
        }

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhere('booking_ref', 'like', "%{$search}%")
                    ->orWhere('account_number', 'like', "%{$search}%")
                    ->orWhere('ifsc_code', 'like', "%{$search}%")
                    ->orWhere('utr_number', 'like', "%{$search}%");
            });
        }

        $records = $query->paginate(20)->withQueryString();

        // Calculate Overview Statistics
        $totalCount = TdsPayment::count();
        $pendingCount = TdsPayment::where('status', 'Pending')->count();
        $approvedCount = TdsPayment::where('status', 'Approved')->count();
        $rejectedCount = TdsPayment::where('status', 'Rejected')->count();
        $totalTdsAmount = TdsPayment::sum('tds_amount');
        $totalWinningAmount = TdsPayment::sum('winning_amount');
        $approvedTdsAmount = TdsPayment::where('status', 'Approved')->sum('tds_amount');

        $stats = [
            'total' => $totalCount,
            'pending' => $pendingCount,
            'approved' => $approvedCount,
            'rejected' => $rejectedCount,
            'total_tds' => $totalTdsAmount,
            'approved_tds' => $approvedTdsAmount,
            'total_winning' => $totalWinningAmount,
        ];

        return view('admin.tds.index', compact('records', 'stats', 'statusFilter', 'search'));
    }

    /**
     * Approve a TDS payment & mark withdrawal as cleared.
     */
    public function approve(Request $request, $id)
    {
        $record = TdsPayment::findOrFail($id);
        $record->status = 'Approved';
        if ($request->filled('admin_notes')) {
            $record->admin_notes = $request->input('admin_notes');
        } else {
            $record->admin_notes = 'TDS verified and payment cleared for bank disbursement.';
        }
        $record->save();

        return redirect()->back()->with('success', "TDS request #{$record->id} for {$record->customer_name} has been Approved successfully.");
    }

    /**
     * Reject a TDS payment.
     */
    public function reject(Request $request, $id)
    {
        $record = TdsPayment::findOrFail($id);
        $record->status = 'Rejected';
        if ($request->filled('admin_notes')) {
            $record->admin_notes = $request->input('admin_notes');
        } else {
            $record->admin_notes = 'TDS verification failed or payment screenshot invalid.';
        }
        $record->save();

        return redirect()->back()->with('success', "TDS request #{$record->id} for {$record->customer_name} marked as Rejected.");
    }

    /**
     * Delete a TDS payment record.
     */
    public function destroy($id)
    {
        $record = TdsPayment::findOrFail($id);
        $record->delete();

        return redirect()->back()->with('success', "TDS payment record deleted.");
    }
}
