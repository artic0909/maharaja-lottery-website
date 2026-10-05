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
     * Display all lottery categories stacked one by one with no pagination and no auto-select.
     */
    public function ticketBooking(Request $request)
    {
        $categories = $this->getActiveCategories();
        $categoriesWithTickets = [];

        foreach ($categories as $cat) {
            $ticketPrice = $cat['price_num'] ?? 40;
            $seriesRaw = $cat['series'] ?? 'MH';
            $seriesList = array_values(array_filter(array_map('trim', explode(',', $seriesRaw))));
            if (empty($seriesList)) {
                $seriesList = ['MH'];
            }
            $primarySeries = strtoupper($seriesList[0]);
            $sampleCode = $cat['code'] ?? ($primarySeries . '784563');

            // Parse number range
            $startNum = 100000;
            $endNum = 999999;
            if (!empty($cat['number_range']) && str_contains($cat['number_range'], '-')) {
                $rangeParts = explode('-', $cat['number_range']);
                $startNum = (int)trim($rangeParts[0]) ?: 100000;
                $endNum = (int)trim($rangeParts[1]) ?: 999999;
            }

            // Display limit from category settings
            $displayLimit = isset($cat['display']) ? (int)$cat['display'] : 50;
            if ($displayLimit <= 0) {
                $displayLimit = 50;
            }

            $tickets = [];
            $seenTickets = [];

            // Add sample code as the first featured ticket
            if (!empty($sampleCode)) {
                $tickets[] = [
                    'number' => $sampleCode,
                    'status' => 'available', // By default reserved is OFF
                    'price' => $ticketPrice,
                    'series' => $primarySeries,
                ];
                $seenTickets[$sampleCode] = true;
            }

            // Generate all tickets dynamically across series up to display limit
            for ($num = $startNum; $num <= $endNum && count($tickets) < $displayLimit; $num++) {
                foreach ($seriesList as $s) {
                    $sUpper = strtoupper(trim($s));
                    if (empty($sUpper)) continue;
                    $ticketCode = $sUpper . str_pad((string)$num, 6, '0', STR_PAD_LEFT);
                    
                    if (!isset($seenTickets[$ticketCode])) {
                        $tickets[] = [
                            'number' => $ticketCode,
                            'status' => 'available', // By default reserved is OFF
                            'price' => $ticketPrice,
                            'series' => $sUpper,
                        ];
                        $seenTickets[$ticketCode] = true;

                        if (count($tickets) >= $displayLimit) {
                            break 2;
                        }
                    }
                }
            }

            $cat['tickets'] = $tickets;
            $cat['sample_code'] = $sampleCode;
            $categoriesWithTickets[] = $cat;
        }

        // Auto-choose is OFF: Default is empty array []
        $selectedTickets = $request->input('selected', session('selected_tickets', []));
        if (is_string($selectedTickets)) {
            $selectedTickets = array_values(array_filter(explode(',', $selectedTickets)));
        }

        return view('frontend.pages.ticket_booking', compact('categoriesWithTickets', 'selectedTickets'));
    }

    /**
     * Display the customer details and booking summary form.
     */
    public function paymentForm(Request $request)
    {
        $categories = $this->getActiveCategories();
        $rawTickets = $request->input('tickets', session('selected_tickets', []));
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        if (empty($selectedTickets)) {
            return redirect()->route('ticket.booking')->with('error', 'Please click and choose at least one ticket to proceed.');
        }

        session(['selected_tickets' => $selectedTickets]);

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
        $rawTickets = $request->input('tickets', session('selected_tickets', []));
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        if (empty($selectedTickets)) {
            return redirect()->route('ticket.booking')->with('error', 'Please choose at least one ticket to proceed.');
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
