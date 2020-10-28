<?php 
session_start();

	include("classes/connect.php");
	include("classes/login.php");

	$email = "";
	$password = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$login = new Login();
		$result =  $login-> evaluate($_POST);

		if ($result != "") {
		}else{
			
			header("Location: index.php");
			die;
		}


		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fakebook | Log in</title>
</head>
<link rel="stylesheet" type="text/css" href="css/styles.css">

<body style="font-family: tahoma;background-color: #e9ebee;">
	<div id="bar">
		<div style="font-size: 40px;">Fakebook</div>  
		<a href="Signup.php">
			<div style="color: white;" id="signup_button">Signup</div>
		</a>
	</div>
	<div id="login_card">

		Login to your account<br><br>
		<form method="post">
			<input name="email" type="text" id="text" placeholder="email" required><br><br>
			<input name="password" type="password" id="text" placeholder="password" required><br><br>
			<div style="display: flex; margin-left: 246px;">
				<div>
					<input style="margin-right: 7px; text-align: center;" name="captcha" type="text" id="text" placeholder="type the text in the image" required>
				</div>
				<div>
					<?php include("captcha.php"); ?>
				</div>
			</div>
			<br><br>
			<input type="submit" id="login_button" value="Login">
			<br><br>
		</form>
		
	</div>

</body>
</html>