<?php 
	
	include("classes/classes.php");

	
	$login = new Login();
	$user_data = $login->check_login($_SESSION ['fakebook_userid']);
	// used for header
	$USER = $user_data;	
	$post 		= new Post();
	$ERROR = "";
	if (isset($_GET['id'])) {
		
		$ROW  		= $post->get_post($_GET['id']);
		if (!$ROW) {

			$ERROR 	= "No such post was found";
		}
	}else
	{
		$ERROR = "No such post was found";
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		//print_r($_POST['postid']);
		
		$post->delete_post($_POST['postid']);
		header("Location: profile.php");
		die;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>
		Fakebook | Delete
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

			<!--posts area -->
			<div style="min-height: 400px;flex: 4; padding: 20px; padding-right: 0px;">

				<div style="border: solid thin #aaa; padding: 10px; background-color: white;">

					<form method="post">
						
						<br>
						<input id="post_button" type="submit" name="delete" value="Delete">
						<input type="hidden" name="postid" value="<?php echo $ROW['postid'] ?>">


						<?php 
							if ($ERROR != "") {
								echo $ERROR;
							}

							if ($ROW) {
								# code...
							
								echo "Are you sure you want to delete this post?";

								$user 		= new User();
								$ROW_USER 	=$user->get_user($ROW['userid']);

								include("post_delete.php");
							}

						?>



					</form>
				</div>	
			</div>
		</div>	
</body>
</html>