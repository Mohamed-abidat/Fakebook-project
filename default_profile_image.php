<?php
  error_reporting(-1);
  ini_set('display_errors', 'On');
  header("Content-type: image/png");
  $string = $_GET['text'];
  $im     = imagecreatefrompng("img/background.png");
  $color = imagecolorallocate($im, 255,255,255);
  $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
  imagestring($im, 5, $px, 20, $string, $color);
  imagepng($im);
  imagedestroy($im);
?>
