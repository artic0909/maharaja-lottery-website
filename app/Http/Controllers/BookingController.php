<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\TicketPriceChartController;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BookingController extends Controller
{
    /**
     * Path to persistent JSON storage for booked / acquired tickets.
     */
    protected function getBookingsStoragePath(): string
    {
        return storage_path('app/booked_tickets.json');
    }

    /**
     * Retrieve all acquired / booked ticket numbers.
     */
    public function getBookedTicketNumbers(): array
    {
        $path = $this->getBookingsStoragePath();
        if (File::exists($path)) {
            $data = json_decode(File::get($path), true);
            if (is_array($data)) {
                $allTickets = [];
                foreach ($data as $item) {
                    if (is_string($item)) {
                        $allTickets[] = strtoupper(trim($item));
                    } elseif (is_array($item) && isset($item['tickets'])) {
                        foreach ((array)$item['tickets'] as $t) {
                            $allTickets[] = strtoupper(trim($t));
                        }
                    }
                }
                return array_values(array_unique($allTickets));
            }
        }
        return [];
    }

    /**
     * Generate a guaranteed unique Booking Reference ID across all storage records.
     * Format: BK + YmdHis + 4 random uppercase alphanumeric characters (e.g. BK202610072125019A4B)
     */
    public function generateUniqueBookingRef(): string
    {
        $path = $this->getBookingsStoragePath();
        $existingRefs = [];
        if (File::exists($path)) {
            $data = json_decode(File::get($path), true);
            if (is_array($data)) {
                foreach ($data as $item) {
                    if (is_array($item) && !empty($item['booking_ref'])) {
                        $existingRefs[strtoupper(trim($item['booking_ref']))] = true;
                    }
                }
            }
        }

        do {
            $timestamp = date('YmdHis');
            $randomBytes = strtoupper(bin2hex(random_bytes(2)));
            $ref = 'BK' . $timestamp . $randomBytes;
        } while (isset($existingRefs[$ref]));

        return $ref;
    }

    /**
     * Save newly acquired tickets to persistent storage.
     */
    public function recordAcquiredTickets(array $tickets, array $meta = []): void
    {
        $path = $this->getBookingsStoragePath();
        $dir = dirname($path);
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $existing = [];
        if (File::exists($path)) {
            $existing = json_decode(File::get($path), true) ?: [];
        }

        $cleanTickets = array_values(array_unique(array_map('strtoupper', array_map('trim', $tickets))));

        $record = [
            'booking_ref' => !empty($meta['booking_ref']) ? $meta['booking_ref'] : $this->generateUniqueBookingRef(),
            'customer_name' => $meta['customer_name'] ?? 'Customer',
            'customer_mobile' => $meta['customer_mobile'] ?? '',
            'customer_email' => $meta['customer_email'] ?? '',
            'customer_state' => $meta['customer_state'] ?? '',
            'customer_city' => $meta['customer_city'] ?? '',
            'tickets' => $cleanTickets,
            'ticket_count' => count($cleanTickets),
            'total_amount' => (int)($meta['total_amount'] ?? (count($cleanTickets) * 40)),
            'booked_at' => date('Y-m-d H:i:s'),
            'utr_number' => $meta['utr_number'] ?? null,
            'payment_method' => $meta['payment_method'] ?? 'UPI / QR',
            'receipt_image' => $meta['receipt_image'] ?? '',
            'status' => 'Pending', // Pending admin payment approval
            'payment_status' => !empty($meta['utr_number']) ? 'Submitted' : 'Pending',
            'result_status' => 'Pending Approval',
            'prize_amount' => '',
            'admin_notes' => 'Awaiting payment verification by admin.',
            'approved_at' => null,
        ];

        $existing[] = $record;
        File::put($path, json_encode($existing, JSON_PRETTY_PRINT));
    }

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
        $bookedTickets = $this->getBookedTicketNumbers();

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
                $isSampleReserved = in_array(strtoupper($sampleCode), $bookedTickets);
                $tickets[] = [
                    'number' => $sampleCode,
                    'status' => $isSampleReserved ? 'reserved' : 'available',
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
                        $isTicketReserved = in_array(strtoupper($ticketCode), $bookedTickets);
                        $tickets[] = [
                            'number' => $ticketCode,
                            'status' => $isTicketReserved ? 'reserved' : 'available',
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

        // Filter out any already acquired tickets from current selection
        $selectedTickets = array_values(array_filter($selectedTickets, fn($t) => !in_array(strtoupper($t), $bookedTickets)));

        return view('frontend.pages.ticket_booking', compact('categoriesWithTickets', 'selectedTickets'));
    }

    /**
     * Display the customer details and booking summary form.
     */
    public function paymentForm(Request $request)
    {
        $categories = $this->getActiveCategories();
        $rawTickets = $request->input('tickets', session('selected_tickets', []));
        $bookedTickets = $this->getBookedTicketNumbers();
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        // Exclude any already reserved tickets
        $selectedTickets = array_values(array_filter($selectedTickets, fn($t) => !in_array(strtoupper($t), $bookedTickets)));

        if (empty($selectedTickets)) {
            return redirect()->route('ticket.booking')->with('error', 'Please click and choose at least one available ticket to proceed.');
        }

        // Enforce single ticket pack / category constraint
        $firstTicket = $selectedTickets[0];
        $firstCatSlug = '';
        foreach ($categories as $cat) {
            $series = strtoupper($cat['series'] ?? '');
            $code = strtoupper($cat['code'] ?? '');
            if ((!empty($series) && str_starts_with(strtoupper($firstTicket), $series)) || $firstTicket === $code) {
                $firstCatSlug = $cat['slug'] ?? $cat['name'];
                break;
            }
        }

        if (!empty($firstCatSlug)) {
            $selectedTickets = array_values(array_filter($selectedTickets, function($t) use ($categories, $firstCatSlug) {
                foreach ($categories as $cat) {
                    $series = strtoupper($cat['series'] ?? '');
                    $code = strtoupper($cat['code'] ?? '');
                    if ((!empty($series) && str_starts_with(strtoupper($t), $series)) || $t === $code) {
                        return ($cat['slug'] ?? $cat['name']) === $firstCatSlug;
                    }
                }
                return true;
            }));
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
        $bookedTickets = $this->getBookedTicketNumbers();
        
        if (is_array($rawTickets)) {
            $selectedTickets = array_values(array_filter($rawTickets));
        } else {
            $selectedTickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        // Exclude any already reserved tickets
        $selectedTickets = array_values(array_filter($selectedTickets, fn($t) => !in_array(strtoupper($t), $bookedTickets)));

        if (empty($selectedTickets)) {
            return redirect()->route('ticket.booking')->with('error', 'Please choose at least one available ticket to proceed.');
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

        // Auto-generate fresh guaranteed unique booking reference for every checkout attempt
        $bookingRef = $this->generateUniqueBookingRef();
        
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
            'total_amount' => $totalAmount,
        ]);

        $activeDraw = 'Maharaja Lottery Schemes';
        $upiId = Setting::get('upi_id', '9288309113@mairtel');
        $payeeName = Setting::get('payee_name', 'Maharaja Lottery');
        $upiQrImage = Setting::get('upi_qr_image', '');
        $upiNote = 'Booking ' . $bookingRef;
        $upiUrl = "upi://pay?pa={$upiId}&pn=" . urlencode($payeeName) . "&am={$totalAmount}&cu=INR&tn=" . urlencode($upiNote);

        $matchedCategory = !empty($categories) ? $categories[0] : [
            'name' => 'Maharaja 500',
            'price' => 'Rs. 40',
            'prizes' => [
                ['label' => '1st', 'amount' => 'INR 50 Lakhs'],
                ['label' => '2nd', 'amount' => 'INR 25 Lakhs'],
                ['label' => '3rd', 'amount' => 'INR 15 Lakhs'],
            ]
        ];

        if (!empty($selectedTickets)) {
            $firstTicket = $selectedTickets[0];
            foreach ($categories as $cat) {
                $series = strtoupper($cat['series'] ?? '');
                $code = strtoupper($cat['code'] ?? '');
                if ((!empty($series) && str_starts_with(strtoupper($firstTicket), $series)) || $firstTicket === $code) {
                    $matchedCategory = $cat;
                    break;
                }
            }
        }

        return view('frontend.pages.qrshow', compact('bookingRef', 'selectedTickets', 'totalTickets', 'totalAmount', 'customer', 'activeDraw', 'upiId', 'payeeName', 'upiUrl', 'upiQrImage', 'matchedCategory'));
    }

    /**
     * Confirm a booking and reserve acquired tickets permanently.
     */
    public function confirmBooking(Request $request)
    {
        $rawTickets = $request->input('tickets', session('selected_tickets', []));
        if (is_array($rawTickets)) {
            $tickets = array_values(array_filter($rawTickets));
        } else {
            $tickets = array_values(array_filter(explode(',', (string)$rawTickets)));
        }

        $bookingRef = $request->input('booking_ref', session('booking_ref')) ?: $this->generateUniqueBookingRef();
        $customerName = $request->input('customer_name', session('customer_name', 'Customer'));
        $customerMobile = $request->input('customer_mobile', session('customer_mobile', ''));
        $utrNumber = $request->input('utr_number', '');
        $totalAmount = (int)$request->input('total_amount', session('total_amount', 0));

        $receiptImage = $request->input('receipt_image', '');
        $dir = public_path('uploads/receipts');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        if ($request->hasFile('receipt_file')) {
            $file = $request->file('receipt_file');
            $fileName = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $fileName);
            $receiptImage = 'uploads/receipts/' . $fileName;
        } elseif ($request->hasFile('receipt_image')) {
            $file = $request->file('receipt_image');
            $fileName = 'receipt_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $fileName);
            $receiptImage = 'uploads/receipts/' . $fileName;
        } elseif ($request->input('certificate_image') && str_starts_with($request->input('certificate_image'), 'data:image')) {
            $certData = $request->input('certificate_image');
            $parts = explode(',', $certData);
            $decoded = base64_decode($parts[1] ?? $parts[0]);
            $fileName = 'ticket_' . $bookingRef . '.png';
            file_put_contents($dir . '/' . $fileName, $decoded);
            $receiptImage = 'uploads/receipts/' . $fileName;
        }

        if (!empty($tickets)) {
            $this->recordAcquiredTickets($tickets, [
                'booking_ref' => $bookingRef,
                'customer_name' => $customerName,
                'customer_mobile' => $customerMobile,
                'customer_email' => session('customer_email', ''),
                'customer_state' => session('customer_state', ''),
                'customer_city' => session('customer_city', ''),
                'utr_number' => $utrNumber,
                'total_amount' => $totalAmount,
                'receipt_image' => $receiptImage,
            ]);

            session()->forget('selected_tickets');
        }

        return response()->json([
            'success' => true,
            'message' => 'Tickets acquired and permanently reserved successfully.',
            'booking_ref' => $bookingRef,
            'reserved_tickets' => $tickets,
        ]);
    }

    /**
     * Frontend Winner List & Ticket Result Verification.
     */
    public function winnerList(Request $request)
    {
        $searchQuery = trim($request->input('ticket_number', $request->input('q', '')));
        $searchResult = null;
        $searchState = null; // 'approved', 'pending', 'rejected', 'not_found'

        $path = $this->getBookingsStoragePath();
        $allBookings = [];
        if (File::exists($path)) {
            $allBookings = json_decode(File::get($path), true) ?: [];
        }

        if (!empty($searchQuery)) {
            $queryClean = strtoupper(trim($searchQuery));
            $foundBooking = null;

            foreach ($allBookings as $b) {
                $refMatch = strtoupper($b['booking_ref'] ?? '') === $queryClean;
                $mobileMatch = ($b['customer_mobile'] ?? '') === $searchQuery;
                $ticketMatch = false;

                $tickets = $b['tickets'] ?? [];
                if (is_array($tickets)) {
                    foreach ($tickets as $t) {
                        if (strtoupper(trim($t)) === $queryClean) {
                            $ticketMatch = true;
                            break;
                        }
                    }
                }

                if ($refMatch || $mobileMatch || $ticketMatch) {
                    $foundBooking = $b;
                    break;
                }
            }

            if ($foundBooking) {
                $status = $foundBooking['status'] ?? 'Pending';
                if ($status === 'Approved') {
                    $searchState = 'approved';
                } elseif ($status === 'Rejected') {
                    $searchState = 'rejected';
                } else {
                    $searchState = 'pending';
                }
                $searchResult = $foundBooking;
            } else {
                $searchState = 'not_found';
            }
        }

        // Filter all approved records for the verified archive
        $approvedWinners = array_values(array_filter($allBookings, fn($b) => ($b['status'] ?? '') === 'Approved'));
        $totalPublished = count($approvedWinners);

        return view('frontend.pages.winnerlist', compact('searchQuery', 'searchResult', 'searchState', 'approvedWinners', 'totalPublished'));
    }
}
