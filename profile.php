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
		$errors = $post->create_post($id, $_POST, $_FILES);

		if ($errors == "") 
		{
			header("Location: profile.php");
			die;
			# code...

		}else
		{
			echo $errors;
		}
		//print_r($_POST);

	}

	//collecting posts:
	$post = new Post();
	$id = $_SESSION['fakebook_userid'];

	$posts = $post->get_posts($id);


	// friends suggestions
	$user = new User();
	$id = $_SESSION['fakebook_userid'];

	$suggestions = $user->get_suggestions($id)


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		MyProfile
	</title>
</head>
<link rel="stylesheet" type="text/css" href="css/styles.css">


<body style="font-family: tahoma; background-color: #d0d8e4">

		<!-- Top bar -->
		
		<?php include("header.php"); ?>
		
		<!-- Cover box -->
	<div id="" style="width: 1000px; min-height: 400px;  margin: auto;">
			
		<div style="background-color: white; text-align: center; color: #405d9b">
			<?php 
					$cover_pic = $user_data['cover_image'];
				if (empty($cover_pic)) {
						echo'<img src="img/mountain.jpg" style="width: 100%;">';
					}else
					{
						echo'<img src="data:image/jpeg;base64,' . base64_encode($cover_pic) . '" style="width: 100%;"/>';
						//echo"<img id=$id src='$pro_pic' style''>";
					}
			?>
			
			<span style="font-size: 12px;">
				<?php 
					$id = "profile_pic";
					$pro_pic = $user_data['profile_image'];
					$first = $user_data['firstname'][0];
					$last = $user_data['lastname'][0];
					$dot = '.';
					if (empty($pro_pic)) {
						echo"<img id=$id src='default_profile_image.php?text=$first$dot$last'>";
					}else
					{
						echo'<img id="profile_pic" src="data:image/jpeg;base64,' . base64_encode($pro_pic) . '"/>';
						//echo"<img id=$id src='$pro_pic' style''>";
					}
				?>
					<br>
				<a style="text-decoration: none; color: #a0f;" href="change_image.php?change=profile">
					Change P.Picture
				</a>|
				<a style="text-decoration: none; color: #a0f;" href="change_image.php?change=cover">
					Change Cover
				</a>
			</span>
			<div style="font-size: 20px;"> <?php  echo $user_data['firstname'] . " " . $user_data['lastname']?></div>
			<br>
			
			<div id="menu_button">
				<a href="index.php">Timeline</a>
			</div>
			<div id="menu_button">About</div>
			<div id="menu_button">Friends</div>  
			<div id="menu_button">Photos</div> 
			<div id="menu_button">Settings</div>
		</div>

		<!--below cover box -->
		<div style="display: flex;">

			<!--friends suggestion -->
				
				<div id="suggestions" style= "min-height: 100px; flex: 1">
				People you may know <br>
				<?php
					if ($suggestions) 
					{
						foreach ($suggestions as $SUGGESTION_ROW) 
						{
							
							include("user.php");		
						}
					} 	 
				?>
			</div>

			<!--posts area -->
			<div style="min-height: 400px;flex: 3; padding: 20px; padding-right: 0px;">

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