<?php
// Test Composite Generation with GD to verify exact coordinates and looks
$im = imagecreatefromjpeg('public/img/ticket_template_clean.jpg');
$w = imagesx($im); // 1024
$h = imagesy($im); // 682

$rightCenter = 830; // Center X of the right white card

// Let's create a test composite
// We can use built-in GD drawing and true-type or font rendering to check spacing
echo "Template size: {$w}x{$h}, Right card center: {$rightCenter}\n";
