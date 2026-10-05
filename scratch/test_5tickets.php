<?php
$im = imagecreatefromjpeg('public/img/ticket_template_clean.jpg');
$w = 1024;
$h = 682;

// Let's test with 5 tickets
$tickets = ['RM100017', 'RM100029', 'VM100038', 'VM100048', 'VM100036'];
$name = 'DEV';
$bookingRef = 'BK20261005160930DF5DAD';
$date = '05/Oct/2026';

// Export test
imagejpeg($im, 'scratch/test_5tickets_output.jpg', 95);
imagedestroy($im);
echo "Script executed.\n";
