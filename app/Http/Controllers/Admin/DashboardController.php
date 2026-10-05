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
        // Mock / Dummy metrics for dashboard
        $metrics = [
            'total_revenue' => '₹42,85,500',
            'revenue_growth' => '+18.4%',
            'tickets_sold_today' => 1480,
            'tickets_target' => 2000,
            'active_draws' => 4,
            'pending_verifications' => 7,
            'total_customers' => 3840,
            'prizes_distributed' => '₹1.5 Crore',
        ];

        // Recent Booking & Payment Submissions
        $recentBookings = [
            [
                'id' => 'ML-849204',
                'customer_name' => 'Rahul Sharma',
                'customer_mobile' => '+91 98765 43210',
                'customer_city' => 'Ernakulam, Kerala',
                'draw_name' => 'Samrudhi - Every Sunday',
                'tickets' => ['SM100006', 'SM100007', 'SM100018'],
                'amount' => 150,
                'utr' => '427819283741',
                'payment_method' => 'UPI (PhonePe)',
                'status' => 'pending',
                'created_at' => '5 mins ago',
            ],
            [
                'id' => 'ML-849198',
                'customer_name' => 'Ananya Nair',
                'customer_mobile' => '+91 94471 28912',
                'customer_city' => 'Kochi, Kerala',
                'draw_name' => 'Samrudhi - Every Sunday',
                'tickets' => ['SM100021', 'SM100022', 'SM100023', 'SM100024', 'SM100025'],
                'amount' => 250,
                'utr' => '427819118920',
                'payment_method' => 'UPI (Google Pay)',
                'status' => 'verified',
                'created_at' => '22 mins ago',
            ],
            [
                'id' => 'ML-849182',
                'customer_name' => 'Mohammed Farooq',
                'customer_mobile' => '+91 88481 90231',
                'customer_city' => 'Kozhikode, Kerala',
                'draw_name' => 'Samrudhi - Every Sunday',
                'tickets' => ['SM100045', 'SM100046'],
                'amount' => 100,
                'utr' => '427818902144',
                'payment_method' => 'UPI (Paytm)',
                'status' => 'verified',
                'created_at' => '1 hour ago',
            ],
            [
                'id' => 'ML-849170',
                'customer_name' => 'Vijay Kumar',
                'customer_mobile' => '+91 97451 34567',
                'customer_city' => 'Thiruvananthapuram, Kerala',
                'draw_name' => 'Samrudhi - Every Sunday',
                'tickets' => ['SM100088', 'SM100089', 'SM100090', 'SM100091'],
                'amount' => 200,
                'utr' => '427817449012',
                'payment_method' => 'UPI (PhonePe)',
                'status' => 'pending',
                'created_at' => '2 hours ago',
            ],
            [
                'id' => 'ML-849155',
                'customer_name' => 'Suresh Pillai',
                'customer_mobile' => '+91 98460 77123',
                'customer_city' => 'Thrissur, Kerala',
                'draw_name' => 'Samrudhi - Every Sunday',
                'tickets' => ['SM100102'],
                'amount' => 50,
                'utr' => '427815998124',
                'payment_method' => 'UPI (Google Pay)',
                'status' => 'verified',
                'created_at' => '3 hours ago',
            ],
            [
                'id' => 'ML-849142',
                'customer_name' => 'Kavitha Menon',
                'customer_mobile' => '+91 99951 88201',
                'customer_city' => 'Palakkad, Kerala',
                'draw_name' => 'Samrudhi - Every Sunday',
                'tickets' => ['SM100115', 'SM100116', 'SM100117'],
                'amount' => 150,
                'utr' => '427814881290',
                'payment_method' => 'UPI (PhonePe)',
                'status' => 'verified',
                'created_at' => '4 hours ago',
            ],
        ];

        // Upcoming Draw Schedules
        $drawSchedules = [
            [
                'name' => 'Samrudhi - Every Sunday',
                'code' => 'SM-104',
                'draw_date' => 'Next Sunday, 3:00 PM',
                'jackpot' => '₹1 Crore',
                'ticket_price' => '₹50',
                'status' => 'Open',
                'booked_count' => 1480,
                'total_pool' => 5000,
            ],
            [
                'name' => 'Win-Win Weekly',
                'code' => 'W-780',
                'draw_date' => 'Monday, 3:00 PM',
                'jackpot' => '₹75 Lakh',
                'ticket_price' => '₹40',
                'status' => 'Upcoming',
                'booked_count' => 620,
                'total_pool' => 4000,
            ],
            [
                'name' => 'Fifty-Fifty Special',
                'code' => 'FF-92',
                'draw_date' => 'Wednesday, 3:00 PM',
                'jackpot' => '₹1 Crore',
                'ticket_price' => '₹50',
                'status' => 'Upcoming',
                'booked_count' => 410,
                'total_pool' => 5000,
            ],
            [
                'name' => 'Karunya Plus',
                'code' => 'KN-450',
                'draw_date' => 'Thursday, 3:00 PM',
                'jackpot' => '₹80 Lakh',
                'ticket_price' => '₹40',
                'status' => 'Upcoming',
                'booked_count' => 280,
                'total_pool' => 4000,
            ],
        ];

        return view('admin.dashboard.index', compact('metrics', 'recentBookings', 'drawSchedules'));
    }
}
