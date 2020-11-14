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
		


	

	// friends suggestions
	$user = new User();
	$id = $_SESSION['fakebook_userid'];

	$suggestions = $user->get_friends($id)


?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Friends | Fakebook
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
			<div id="menu_button">
				<a style="text-decoration: none; color: #405d9b;" href="">About</a>
			</div>
			<div id="menu_button">
				<a style="text-decoration: none; color: #405d9b;" href="friends.php">Friends</a>
			</div>
			<div id="menu_button">
				<a style="text-decoration: none; color: #405d9b;" href=".php">Photos</a>
			</div>
			<div id="menu_button">
				<a style="text-decoration: none; color: #405d9b;" href=".php">Setting</a>
			</div>
		</div>

		<!--below cover box -->
		<div style="    
			background-color: white;
		    margin-top: 50px;
		    margin-bottom: : 100px;
		    padding: 20px;
		    display: flex;
		    justify-content: space-between;
		    align-items: center;
		    ">

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
</body>
</html>