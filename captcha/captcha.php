<?php
session_start();
$text1 = rand(1,99);
$text2 = rand(1,9);
$text3 = $text1+$text2;
$text = $text1."+".$text2."=?";
$_SESSION["vercode"] = $text3;
$height = 25;
$width = 80;
  
$image_p = imagecreate($width, $height);
$black = imagecolorallocate($image_p, 0, 0, 0);
$white = imagecolorallocate($image_p, 255, 255, 255);
$font_size = 14;
  
imagestring($image_p, $font_size, 5, 5, $text, $white);
imagejpeg($image_p, null, 80);
?>