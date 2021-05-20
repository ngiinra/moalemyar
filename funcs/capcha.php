<?php
$image = imagecreate(150, 50);
$background_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 100, 0, 255);
$pixel_color = imagecolorallocate($image, 100, 100, 0);

imagefilledrectangle($image, 0, 0, 150, 50, $background_color);
for ($i = 0; $i < 5; $i++) {
    imageline($image, 0, rand(0, 50), 150, rand(0, 50), $line_color);
}
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($image, rand(0, 150), rand(0, 50), $pixel_color);
}
$letters = "abcd01234efghkl56789ABCD0mnopqEFGH";
$len = strlen($letters);
$word = "";

for ($i = 0; $i < 6; $i++) {
    $font = "../fonts/ITCKRIST.ttf";
    $letter = $letters[rand(0, $len - 1)];
    imagettftext($image, 15.00, 30.00, 30 + ($i * 15), 40, $text_color, $font, $letter);
    $word = $word . $letter;
}

$_SESSION['captcha'] = $word;
$time = time();
imagepng($image, "myimage" . $time . ".png");

?>