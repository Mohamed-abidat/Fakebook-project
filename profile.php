<?php 
	
	include("classes/classes.php");
	
	$login = new Login();
	$user_data = $login->check_login($_SESSION ['fakebook_userid']);
	//used for the header
	$USER = $user_data;				
							// white listing to avoid sql injection
	if (isset($_GET['id']) && is_numeric($_GET['id'])) 
	{

		$profile = new Profile();
		$profile_data = $profile->get_profile($_GET['id']);
		
		if (is_array($profile_data)) 
		{

			$user_data = $profile_data[0];
		}
			

	}
		

	// Posting starts here:
	if ($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$post = new Post();
		$id = $_SESSION['fakebook_userid'];
		$errors = $post->create_post($id, $_POST, $_FILES, 0, 0);

		if ($errors == "") 
		{
			header("Location: profile.php");
			die;
		}else
		{
			echo $errors;
		}
		//print_r($_POST);

	}

	//collecting posts:
	$post = new Post();
	$id = $user_data['userid'];

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
					$pro_pic = $user_data['profile_image'];
					$first = $user_data['firstname'][0];
					$last = $user_data['lastname'][0];
					$dot = '.';
					if (empty($pro_pic)) {
						echo"<img id='profile_pic' src='default_profile_image.php?text=$first$dot$last'>";
					}else
					{
						echo'<img id="profile_pic" src="data:image/jpeg;base64,' . base64_encode($pro_pic) . '"/>';
					}
				?>
				<br>

				<?php  
					if ($USER['userid'] == $user_data['userid']) 
					{
						echo 	"<a style='text-decoration: none; color: #a0f;' 
									href='change_image.php?change=profile'>
								 	Change P.Picture 
								</a> |	
								<a 	style='text-decoration: none; color: #a0f;' 
									href='change_image.php?change=cover'>
									Change Cover 
								</a>";
					}
				?>
				

			</span>
			<div style="font-size: 20px;"> <?php  echo htmlspecialchars($user_data['firstname']) . " " .  htmlspecialchars($user_data['lastname']) ?></div>
			<br>
			
			<div id="menu_button">
				<a style="text-decoration: none; color: #405d9b;" href="index.php">Timeline</a>
			</div>
			<div id="menu_button">About</div>
			<a href="friends.php">
				<div id="menu_button">Friends</div>  
			</a>
			<div id="menu_button">Photos</div> 
			<div id="menu_button">Settings</div>
		</div>

		<!--below cover box -->
		<div style="display: flex; flex-direction: column;">

			<!--friends suggestion -->
			<div style="flex: 1;">	
				<div id="suggestions">
					FRIENDS <br><br>
					<?php
						if ($suggestions) 
						{
							foreach ($suggestions as $SUGGESTION_ROW) 
							{
								
								include("user.php");		
							}
						} 	 
					?>
					<br style="clear: both;">
				</div>
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