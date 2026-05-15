<?php
// Create a simple default image
$width = 300;
$height = 300;
$image = imagecreatetruecolor($width, $height);

// Background color (gray)
$bgColor = imagecolorallocate($image, 200, 200, 200);
imagefill($image, 0, 0, $bgColor);

// Text color (dark gray)
$textColor = imagecolorallocate($image, 100, 100, 100);

// Add text
$text = "No Image";
$fontSize = 5; // Built-in font size
$textWidth = imagefontwidth($fontSize) * strlen($text);
$textHeight = imagefontheight($fontSize);
$x = ($width - $textWidth) / 2;
$y = ($height - $textHeight) / 2;

imagestring($image, $fontSize, $x, $y, $text, $textColor);

// Save image
imagejpeg($image, 'public/images/default.jpg', 90);
imagedestroy($image);

echo "Default image created successfully at public/images/default.jpg\n";
?>