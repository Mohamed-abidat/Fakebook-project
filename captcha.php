<?php  
  
  include("classes/image.php");

  $Image = new Image();
  $Image->captcha();

  $captcha = "img/captcha.png";
?>

<img style="width: 150px;" src="<?php echo $captcha  ?>">