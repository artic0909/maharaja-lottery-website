<?php
$src = imagecreatefromjpeg('public/img/ticket_template_bg.jpg');
$w = imagesx($src);
$h = imagesy($src);

// Inner parchment bounding box is roughly x: 670 to 988, y: 60 to 468
for ($y = 60; $y <= 468; $y++) {
    $ratio = ($y - 60) / (468 - 60);
    $r = (int)(252 - $ratio * 4);
    $g = (int)(245 - $ratio * 6);
    $b = (int)(232 - $ratio * 12);
    
    $color = imagecolorallocate($src, $r, $g, $b);
    
    for ($x = 670; $x <= 988; $x++) {
        // preserve the decorative top corners if needed or clean up cleanly
        if ($y < 75 && ($x < 685 || $x > 973)) {
            continue;
        }
        imagesetpixel($src, $x, $y, $color);
    }
}

imagejpeg($src, 'public/img/ticket_template_clean.jpg', 98);
imagedestroy($src);
echo "Perfect clean template created.\n";
