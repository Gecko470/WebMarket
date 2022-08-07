<?php

function saveRandomImage(string $absolutePath, string $name, int $width = 640, int $height = 480): string
{
    // Create a blank image:
    $im = imagecreatetruecolor($width, $height);
    // Add light background color:
    $bgColor = imagecolorallocate($im, rand(100, 255), rand(100, 255), rand(100, 255));
    imagefill($im, 0, 0, $bgColor);

    // Save the image:
    $isGenerated = imagejpeg($im, $absolutePath);

    // Free up memory:
    imagedestroy($im);

    return $name;
}
