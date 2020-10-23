<?php 

	include("classes/connect.php");
	include("classes/signup.php");

	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
		$signup = new Signup();
		$result =  $signup-> evaluate($_POST);
		echo $result;
	}
?>



<!DOCTYPE html>
<html>
<head>
	<title>Fakebook | Sign up</title>
</head>

<link rel="stylesheet" type="text/css" href="css/styles.css">

<body style="font-family: tahoma;background-color: #e9ebee;">

	<div id="bar">
		<div style="font-size: 40px;">Fakebook</div>  
		<a href="login.php">
			<div style="color: white;" id="signup_button">Log in</div>
		</a>
	</div>

	<div id="login_card">
		Create an account<br><br>

		<form method="post">

			<input name="firstname" type="text" id="text" placeholder="First name" required><br><br>

			<input name="lastname"type="text" id="text" placeholder="Last name"required><br><br>

			<input name="username"type="text" id="text" placeholder="Username"required><br><br>

			<select name="gender" id="text">

				<option>Male</option>
				<option>Female</option>

			</select><br><br>

			<input name="email"type="email" id="text" placeholder="Email"required><br><br>

			<input name="password"type="password" id="text" placeholder="Password"required><br><br>

			<input type="submit" id="login_button" value="Sign up"><br><br>
		
		</form>
	</div>

</body>
</html>