<?php
$im = imagecreatefromjpeg('public/img/ticket_template_bg.jpg');
$w = imagesx($im);
$h = imagesy($im);
echo "Image Size: {$w}x{$h}\n";

// Sample colors from the parchment background
$colors = [];
for ($y = 100; $y <= 400; $y += 50) {
    for ($x = 700; $x <= 950; $x += 50) {
        $rgb = imagecolorat($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        $colors[] = sprintf("#%02x%02x%02x", $r, $g, $b);
    }
}
echo "Sample background colors: " . implode(', ', array_unique($colors)) . "\n";
