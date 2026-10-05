<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\TicketPriceChartController;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Get active categories from ticket charts controller.
     */
    public function getActiveCategories(): array
    {
        $controller = new TicketPriceChartController();
        $charts = $controller->getCharts();
        $active = array_filter($charts, fn($c) => ($c['status'] ?? '') === 'Active');
        return !empty($active) ? array_values($active) : $charts;
    }

    /**
     * Display the ticket booking view with all categories rendered next by next.
     */
    public function ticketBooking(Request $request)
    {
        $categories = $this->getActiveCategories();
        $categoriesWithTickets = [];

        foreach ($categories as $cat) {
            $ticketPrice = $cat['price_num'] ?? 40;
            $series = strtoupper($cat['series'] ?? 'MH');
            $sampleCode = $cat['code'] ?? ($series . '784563');

            $reservedNumbers = [$series . '100004', $series . '100005', $series . '100012', $series . '100021'];

            $tickets = [];
            // Sample main ticket code
            $tickets[] = [
                'number' => $sampleCode,
                'status' => 'available',
                'price' => $ticketPrice,
                'series' => $series,
            ];

            // Series ticket numbers
            for ($i = 100001; $i <= 100055; $i++) {
                $numStr = $series . $i;
                if ($numStr !== $sampleCode) {
                    $tickets[] = [
                        'number' => $numStr,
                        'status' => in_array($numStr, $reservedNumbers) ? 'reserved' : 'available',
                        'price' => $ticketPrice,
                        'series' => $series,
                    ];
                }
            }

            $cat['tickets'] = $tickets;
            $cat['sample_code'] = $sampleCode;
            $categoriesWithTickets[] = $cat;
        }

        $selectedTickets = $request->input('selected', session('selected_tickets', ['MH784563', 'MH100006', 'MH100007']));
        if (is_string($selectedTickets)) {
            $selectedTickets = array_filter(explode(',', $selectedTickets));
        }

        return view('frontend.pages.ticket_booking', compact('categoriesWithTickets', 'selectedTickets'));
    }

    /**
     * Display the customer details and booking summary form.
     */
    public function paymentForm(Request $request)
    {
        $categories = $this->getActiveCategories();
        $rawTickets = $request->input('tickets', session('selected_tickets', 'MH784563,MH100006,MH100007'));
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        if (empty($selectedTickets)) {
            $selectedTickets = ['MH784563', 'MH100006', 'MH100007'];
        }

        session(['selected_tickets' => $selectedTickets]);

        // Calculate total amount based on ticket prefixes and category prices
        $totalAmount = 0;
        $ticketBreakdown = [];

        foreach ($selectedTickets as $t) {
            $matchedPrice = 40;
            $matchedCategory = 'Maharaja 500';

            foreach ($categories as $cat) {
                $series = strtoupper($cat['series'] ?? '');
                $code = strtoupper($cat['code'] ?? '');
                if ((!empty($series) && str_starts_with(strtoupper($t), $series)) || $t === $code) {
                    $matchedPrice = $cat['price_num'] ?? 40;
                    $matchedCategory = $cat['name'];
                    break;
                }
            }

            $totalAmount += $matchedPrice;
            $ticketBreakdown[] = [
                'number' => $t,
                'category' => $matchedCategory,
                'price' => $matchedPrice,
            ];
        }

        $totalTickets = count($selectedTickets);

        $draw = [
            'name' => $ticketBreakdown[0]['category'] ?? 'Maharaja Lottery',
            'price_per_ticket' => count($ticketBreakdown) > 0 ? $ticketBreakdown[0]['price'] : 40,
            'total_tickets' => $totalTickets,
            'total_amount' => $totalAmount,
            'breakdown' => $ticketBreakdown,
        ];

        $indianStates = [
            'Kerala', 'Tamil Nadu', 'Karnataka', 'Andhra Pradesh', 'Telangana',
            'Maharashtra', 'West Bengal', 'Gujarat', 'Rajasthan', 'Uttar Pradesh',
            'Madhya Pradesh', 'Punjab', 'Haryana', 'Bihar', 'Odisha', 'Assam',
            'Delhi', 'Goa', 'Himachal Pradesh', 'Jharkhand', 'Chhattisgarh',
            'Uttarakhand', 'Puducherry', 'Chandigarh'
        ];

        return view('frontend.pages.payment_form', compact('selectedTickets', 'draw', 'indianStates'));
    }

    /**
     * Display the QR Code & UPI Payment page.
     */
    public function qrShow(Request $request)
    {
        $categories = $this->getActiveCategories();
        $rawTickets = $request->input('tickets', session('selected_tickets', 'MH784563,MH100006,MH100007'));
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        if (empty($selectedTickets)) {
            $selectedTickets = ['MH784563', 'MH100006', 'MH100007'];
        }

        session(['selected_tickets' => $selectedTickets]);

        $totalAmount = 0;
        foreach ($selectedTickets as $t) {
            $matchedPrice = 40;
            foreach ($categories as $cat) {
                $series = strtoupper($cat['series'] ?? '');
                $code = strtoupper($cat['code'] ?? '');
                if ((!empty($series) && str_starts_with(strtoupper($t), $series)) || $t === $code) {
                    $matchedPrice = $cat['price_num'] ?? 40;
                    break;
                }
            }
            $totalAmount += $matchedPrice;
        }

        $totalTickets = count($selectedTickets);

        // Generate or retrieve booking reference
        $bookingRef = $request->input('booking_ref', session('booking_ref', 'BK' . date('YmdHis') . strtoupper(substr(md5(uniqid('', true)), 0, 6))));
        
        $customer = [
            'name' => $request->input('full_name', session('customer_name', 'Rajesh Kumar')),
            'email' => $request->input('email', session('customer_email', 'rajesh.kumar@example.com')),
            'mobile' => $request->input('mobile', session('customer_mobile', '9876543210')),
            'state' => $request->input('state', session('customer_state', 'Kerala')),
            'city' => $request->input('city', session('customer_city', 'Thiruvananthapuram')),
        ];

        session([
            'booking_ref' => $bookingRef,
            'customer_name' => $customer['name'],
            'customer_email' => $customer['email'],
            'customer_mobile' => $customer['mobile'],
            'customer_state' => $customer['state'],
            'customer_city' => $customer['city'],
        ]);

        $activeDraw = 'Maharaja Lottery Schemes';
        $upiId = '9288309113@mairtel';
        $payeeName = 'Maharaja Lottery';
        $upiNote = 'Booking ' . $bookingRef;
        $upiUrl = "upi://pay?pa={$upiId}&pn=" . urlencode($payeeName) . "&am={$totalAmount}&cu=INR&tn=" . urlencode($upiNote);

        return view('frontend.pages.qrshow', compact('bookingRef', 'selectedTickets', 'totalTickets', 'totalAmount', 'customer', 'activeDraw', 'upiId', 'payeeName', 'upiUrl'));
    }
}
