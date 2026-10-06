<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$bookings = App\Http\Controllers\Admin\BookingManagementController::getAllBookings();
echo "Total Bookings Loaded: " . count($bookings) . "\n";
foreach (array_slice($bookings, 0, 3) as $b) {
    echo "Ref: " . $b['booking_ref'] . " | Name: " . $b['customer_name'] . " | Tickets: " . count($b['tickets']) . " | Amount: " . $b['total_amount'] . " | Status: " . $b['status'] . "\n";
}
