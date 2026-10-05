<?php
// Test Composite Generation with GD to verify exact coordinates and looks
$im = imagecreatefromjpeg('public/img/ticket_template_clean.jpg');
$w = imagesx($im); // 1024
$h = imagesy($im); // 682

$rightCenterX = 830;

// Colors
$gray = imagecolorallocate($im, 107, 114, 128);
$navy = imagecolorallocate($im, 7, 21, 51);
$darkNavy = imagecolorallocate($im, 11, 25, 62);
$black = imagecolorallocate($im, 17, 24, 39);
$crimson = imagecolorallocate($im, 190, 18, 60);
$green = imagecolorallocate($im, 4, 120, 87);
$greenBg = imagecolorallocate($im, 236, 253, 245);
$greenBorder = imagecolorallocate($im, 5, 150, 105);
$redBg = imagecolorallocate($im, 255, 245, 246);

// We can save a test preview image
imagejpeg($im, 'scratch/test_preview.jpg', 95);
imagedestroy($im);
echo "Preview initialized.\n";
