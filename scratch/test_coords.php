<?php
$im = imagecreatefromjpeg('scratch/cert_preview.jpg');

// Let's check vertical bounds of the text rendered for Name around x=600
for ($y = 460; $y <= 505; $y++) {
    $rgb = imagecolorat($im, 600, $y);
    $r = ($rgb >> 16) & 0xFF; $g = ($rgb >> 8) & 0xFF; $b = $rgb & 0xFF;
    $brightness = ($r * 299 + $g * 587 + $b * 114) / 1000;
    if ($brightness < 160) {
        echo "Name text pixel at Y={$y} (bright={$brightness})\n";
    }
}
// Line 1 underline is at 494. If text goes from ~467 to 489, then 490-493 is clear space, and 494 is the line! That is PERFECT!






