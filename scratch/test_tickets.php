<?php
// Test dynamic ticket layout without box border and without commas (one by one bold)
$im = imagecreatefromjpeg('public/img/ticket_template_clean.jpg');
$w = imagesx($im); // 1024
$h = imagesy($im); // 682

// Using GD to test coordinates
$tickets = ['RM100024', 'RM100036', 'RM100026'];
echo "Testing with tickets: " . implode(', ', $tickets) . "\n";
