<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Retrieve all customers uniquely grouped by email address.
     */
    public static function getUniqueCustomers(): array
    {
        $bookings = BookingManagementController::getAllBookings();
        $grouped = [];

        foreach ($bookings as $b) {
            $email = strtolower(trim($b['customer_email'] ?? ''));
            $mobile = trim($b['customer_mobile'] ?? '');
            
            // Unique key by email or fallback to mobile/ref
            $key = !empty($email) ? $email : (!empty($mobile) ? $mobile : ('cust_' . md5($b['booking_ref'] ?? uniqid())));

            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'key' => $key,
                    'customer_name' => $b['customer_name'] ?? 'Customer',
                    'customer_email' => !empty($email) ? $email : 'No email provided',
                    'customer_mobile' => !empty($mobile) ? $mobile : 'N/A',
                    'customer_state' => $b['customer_state'] ?? '',
                    'customer_city' => $b['customer_city'] ?? '',
                    'total_bookings' => 0,
                    'approved_bookings' => 0,
                    'total_spent' => 0,
                    'total_tickets' => 0,
                    'all_tickets' => [],
                    'bookings' => [],
                    'first_booked_at' => $b['booked_at'] ?? date('Y-m-d H:i:s'),
                    'last_booked_at' => $b['booked_at'] ?? date('Y-m-d H:i:s'),
                    'latest_booking_ref' => $b['booking_ref'] ?? '',
                ];
            }

            // Update latest contact info if available
            if (!empty($b['customer_name'])) {
                $grouped[$key]['customer_name'] = $b['customer_name'];
            }
            if (!empty($mobile) && $grouped[$key]['customer_mobile'] === 'N/A') {
                $grouped[$key]['customer_mobile'] = $mobile;
            }
            if (!empty($b['customer_state'])) {
                $grouped[$key]['customer_state'] = $b['customer_state'];
            }
            if (!empty($b['customer_city'])) {
                $grouped[$key]['customer_city'] = $b['customer_city'];
            }

            $grouped[$key]['total_bookings']++;
            if (($b['status'] ?? '') === 'Approved') {
                $grouped[$key]['approved_bookings']++;
            }
            $grouped[$key]['total_spent'] += (int)($b['total_amount'] ?? 0);
            $grouped[$key]['total_tickets'] += (int)($b['ticket_count'] ?? count($b['tickets'] ?? []));

            foreach ($b['tickets'] ?? [] as $t) {
                if (!in_array($t, $grouped[$key]['all_tickets'])) {
                    $grouped[$key]['all_tickets'][] = $t;
                }
            }

            $grouped[$key]['bookings'][] = [
                'booking_ref' => $b['booking_ref'] ?? '',
                'amount' => $b['total_amount'] ?? 0,
                'tickets' => $b['tickets'] ?? [],
                'status' => $b['status'] ?? 'Pending',
                'result_status' => $b['result_status'] ?? '',
                'prize_amount' => $b['prize_amount'] ?? '',
                'booked_at' => $b['booked_at'] ?? '',
            ];

            // Compare dates for last activity
            $currentLast = strtotime($grouped[$key]['last_booked_at']);
            $bookingTime = strtotime($b['booked_at'] ?? '');
            if ($bookingTime > $currentLast) {
                $grouped[$key]['last_booked_at'] = $b['booked_at'];
                $grouped[$key]['latest_booking_ref'] = $b['booking_ref'] ?? '';
            }
        }

        $customers = array_values($grouped);

        // Sort latest active first
        usort($customers, function ($a, $b) {
            return strtotime($b['last_booked_at']) <=> strtotime($a['last_booked_at']);
        });

        return $customers;
    }

    /**
     * Display unique customers listing.
     */
    public function index(Request $request): View
    {
        $allCustomers = self::getUniqueCustomers();
        $search = trim($request->input('q', ''));

        $customers = $allCustomers;
        if (!empty($search)) {
            $q = strtolower($search);
            $customers = array_values(array_filter($allCustomers, function ($c) use ($q) {
                return str_contains(strtolower($c['customer_name']), $q)
                    || str_contains(strtolower($c['customer_email']), $q)
                    || str_contains(strtolower($c['customer_mobile']), $q)
                    || str_contains(strtolower($c['customer_state']), $q)
                    || str_contains(strtolower($c['customer_city']), $q);
            }));
        }

        $stats = [
            'total_customers' => count($allCustomers),
            'total_bookings' => array_sum(array_column($allCustomers, 'total_bookings')),
            'total_spent' => array_sum(array_column($allCustomers, 'total_spent')),
            'total_tickets' => array_sum(array_column($allCustomers, 'total_tickets')),
        ];

        return view('admin.customers.index', compact('customers', 'stats', 'search'));
    }
}
