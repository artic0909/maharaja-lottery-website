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
        // Mock / Summary metrics matching dashboard layout
        $metrics = [
            'total_bookings' => 83,
            'pending_payment' => 24,
            'payment_submitted' => 6,
            'total_verified_amount' => 'INR 15,150',
            'today_verified_amount' => 'INR 0',
        ];

        // Recent Bookings static list matching reference screenshot
        $recentBookings = [
            [
                'id' => 'BK20261004175843C38823',
                'name' => 'IMRAN FARID',
                'tickets' => 'SM107002',
                'amount' => 'INR 50',
                'status' => 'Profile Submitted',
                'updated' => '2026-10-04 17:58:42',
            ],
            [
                'id' => 'BK20261002223045DE3FFF',
                'name' => 'Rahul',
                'tickets' => 'KR103007',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-04 16:29:18',
            ],
            [
                'id' => 'BK20261003194431A66EE6',
                'name' => 'nyhytnym',
                'tickets' => 'SM100006, SM100007, SM100018',
                'amount' => 'INR 150',
                'status' => 'Profile Submitted',
                'updated' => '2026-10-03 16:44:31',
            ],
            [
                'id' => 'BK2026100222015383367C',
                'name' => 'Rajin Raj',
                'tickets' => 'KN100013',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:40:51',
            ],
            [
                'id' => 'BK2026100222116356117BA',
                'name' => 'Ramkumar',
                'tickets' => 'SM100017',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:40:47',
            ],
            [
                'id' => 'BK202610022052064C598F',
                'name' => 'Fg',
                'tickets' => 'SM100001',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:40:34',
            ],
            [
                'id' => 'BK202610022109121B972E',
                'name' => 'Ramkumar',
                'tickets' => 'SM100006',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:40:19',
            ],
            [
                'id' => 'BK202610021904128F08FF',
                'name' => 'siva kumar',
                'tickets' => 'SS100100',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:39:12',
            ],
            [
                'id' => 'BK20261002222173803FE04',
                'name' => 'Pranav K P',
                'tickets' => 'KR103027',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:39:09',
            ],
            [
                'id' => 'BK202610021855023FC60CE',
                'name' => 'siva kumar',
                'tickets' => 'SB100024',
                'amount' => 'INR 50',
                'status' => 'Confirmed',
                'updated' => '2026-10-03 00:38:42',
            ],
        ];

        return view('admin.dashboard.index', compact('metrics', 'recentBookings'));
    }
}
