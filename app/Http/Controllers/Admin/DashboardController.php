<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index(Request $request): View
    {
        $allBookings = BookingManagementController::getAllBookings();

        $totalBookings = count($allBookings);
        $pendingBookings = count(array_filter($allBookings, fn($b) => $b['status'] === 'Pending'));
        $paymentSubmitted = count(array_filter($allBookings, fn($b) => !empty($b['utr_number'])));
        $approvedBookings = array_filter($allBookings, fn($b) => $b['status'] === 'Approved');
        $totalVerifiedAmount = array_sum(array_column($approvedBookings, 'total_amount'));

        $todayDate = date('Y-m-d');
        $todayApproved = array_filter($approvedBookings, function ($b) use ($todayDate) {
            return str_starts_with($b['approved_at'] ?? ($b['booked_at'] ?? ''), $todayDate);
        });
        $todayVerifiedAmount = array_sum(array_column($todayApproved, 'total_amount'));

        $metrics = [
            'total_bookings' => $totalBookings,
            'pending_payment' => $pendingBookings,
            'payment_submitted' => $paymentSubmitted,
            'total_verified_amount' => 'INR ' . number_format($totalVerifiedAmount),
            'today_verified_amount' => 'INR ' . number_format($todayVerifiedAmount),
        ];

        // Format recent bookings for the dashboard table
        $recentBookings = array_slice($allBookings, 0, 10);

        return view('admin.dashboard.index', compact('metrics', 'recentBookings'));
    }
}
