<?php 
	
	session_start();
	//print_r($_SESSION);

	include("classes/connect.php");
	include("classes/login.php");
	include("classes/users.php");
	include("classes/post.php");
	
	$login = new Login();
	$user_data = $login->check_login($_SESSION ['fakebook_userid']);


	// Posting starts here:
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$post = new Post();
		$id = $_SESSION['fakebook_userid'];
		$errors = $post->create_post($id, $_POST, $_FILES, 0, 0);

		if ($errors == "") 
		{
			header("Location: index.php");
			die;
			# code...
		}else
		{
			echo $errors;
		}
		//print_r($_POST);

	}

	//getting temline posts
	$post = new Post();
	$id = $_SESSION['fakebook_userid'];

	$posts = $post->timeline();
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Fakebook
	</title>
</head>
<link rel="stylesheet" type="text/css" href="css/styles.css">

<body style="font-family: tahoma; background-color: #d0d8e4">

	<!-- Top bar -->
	<?php include("header.php"); ?>

	<!-- Cover box -->
	<div id="" style="width: 1000px; min-height: 400px;  margin: auto;">
			
	

		<!--below cover box -->
		<div style="display: flex;">

			<!--my profile -->
			<div style="min-height: 400px; flex: 1">

				
				<div id="my_info" style="min-height: 400px; margin-top: 20px; color: #405d9b; padding: 8px; text-align: center; font-size: 20px;">
					<span>
						<?php 
							error_reporting(-1);
						    ini_set('display_errors', 'On');

							$userid 	= $_SESSION['fakebook_userid'];
							$pro_pic 	= $user_data['profile_image'];
							$first 		= $user_data['firstname'][0];
							$last 		= $user_data['lastname'][0];
							$dot = '.';
							if (empty($pro_pic)) {
								echo"<img id='profile_pic'style='margin-top: 0px;' src='default_profile_image.php?text=$first$dot$last'>";
							}else
							{
								echo'<img id="profile_pic" style= "margin-top: 0px;" src="data:image/jpeg;base64,' . base64_encode($pro_pic) . '"/>';
							}						
						?>					
					</span>
					<br>
					<a href="profile.php" style=" text-decoration: none;"><?php  echo $user_data['firstname'] . " <br>" . $user_data['lastname']?></a>
					
				</div>
			</div>

			<!--posts area -->
			<div style="min-height: 400px;flex: 4; padding: 20px; padding-right: 0px;">

				<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
					
					<form method="post" enctype="multipart/form-data">
						<textarea name="post" placeholder="What's on your mind?"></textarea>
						<input type="file" name="file">
						<input id="post_button" type="submit" name="" value="Post">
						<br>
					</form>
				</div>	

				<!-- posts-->
				<div id="post_bar" style="background-color: #d0d8e4">

					<?php

						if ($posts) 
						{
							foreach ($posts as $ROW) {
								$user = new User();

								$ROW_USER = $user->get_user($ROW['userid']);
								include("post.php");		
							}
						} 	 

					?>


				</div>
			</div>
		</div>	
</body>
</html>