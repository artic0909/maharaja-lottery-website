<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display the ticket booking and selection view.
     */
    public function ticketBooking(Request $request)
    {
        $activeDraw = [
            'name' => 'Samrudhi - Every Sunday',
            'schedule' => 'Every Sunday 3:00 PM',
            'ticket_price' => 50,
            'currency' => 'INR',
            'prizes' => [
                [
                    'rank' => 1,
                    'title' => 'FIRST PRIZE',
                    'amount' => 'INR 1 Crore',
                    'winners' => '1 lucky ticket'
                ],
                [
                    'rank' => 2,
                    'title' => 'SECOND PRIZE',
                    'amount' => 'INR 75 Lakh',
                    'winners' => '1 winner'
                ],
                [
                    'rank' => 3,
                    'title' => 'THIRD PRIZE',
                    'amount' => 'INR 15 Lakh',
                    'winners' => '12 winners'
                ]
            ]
        ];

        // Generate sample available lottery ticket numbers (SM series)
        $tickets = [];
        $reservedNumbers = ['SM100004', 'SM100005', 'SM100012', 'SM100021', 'SM100045', 'SM100068', 'SM100085'];
        
        for ($i = 100000; $i <= 100119; $i++) {
            $numStr = 'SM' . $i;
            $tickets[] = [
                'number' => $numStr,
                'status' => in_array($numStr, $reservedNumbers) ? 'reserved' : 'available',
                'price' => 50,
            ];
        }

        $selectedTickets = $request->input('selected', session('selected_tickets', ['SM100006', 'SM100007', 'SM100018']));
        if (is_string($selectedTickets)) {
            $selectedTickets = array_filter(explode(',', $selectedTickets));
        }

        return view('frontend.pages.ticket_booking', compact('activeDraw', 'tickets', 'selectedTickets'));
    }

    /**
     * Display the customer details and booking summary form.
     */
    public function paymentForm(Request $request)
    {
        $rawTickets = $request->input('tickets', session('selected_tickets', 'SM100006,SM100007,SM100018'));
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        if (empty($selectedTickets)) {
            $selectedTickets = ['SM100006', 'SM100007', 'SM100018'];
        }

        session(['selected_tickets' => $selectedTickets]);

        $ticketPrice = 50;
        $totalTickets = count($selectedTickets);
        $totalAmount = $totalTickets * $ticketPrice;

        $draw = [
            'name' => 'Samrudhi - Every Sunday',
            'price_per_ticket' => $ticketPrice,
            'total_tickets' => $totalTickets,
            'total_amount' => $totalAmount,
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
        $rawTickets = $request->input('tickets', session('selected_tickets', 'SM100006,SM100007,SM100018'));
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        if (empty($selectedTickets)) {
            $selectedTickets = ['SM100006', 'SM100007', 'SM100018'];
        }

        session(['selected_tickets' => $selectedTickets]);

        $ticketPrice = 50;
        $totalTickets = count($selectedTickets);
        $totalAmount = $totalTickets * $ticketPrice;

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

        $activeDraw = 'Samrudhi - Every Sunday';
        $upiId = '9288309113@mairtel';
        $payeeName = 'Maharaja Lottery';
        $upiNote = 'Booking ' . $bookingRef;
        $upiUrl = "upi://pay?pa={$upiId}&pn=" . urlencode($payeeName) . "&am={$totalAmount}&cu=INR&tn=" . urlencode($upiNote);

        return view('frontend.pages.qrshow', compact('bookingRef', 'selectedTickets', 'totalTickets', 'totalAmount', 'customer', 'activeDraw', 'upiId', 'payeeName', 'upiUrl'));
    }
}
