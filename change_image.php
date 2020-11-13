<?php 
	
	session_start();
	//print_r($_SESSION);

	include("classes/connect.php");
	include("classes/login.php");
	include("classes/users.php");
	include("classes/post.php");
	include("classes/image.php");
	
	$login = new Login();
	$user_data = $login->check_login($_SESSION ['fakebook_userid']);
	//used for the header
	$USER = $user_data;	




	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{

		$userid = $_SESSION['fakebook_userid'];

        if (!is_uploaded_file($_FILES["file"]["tmp_name"])) 
        {
          echo "transfert failed";
          header("Location: change_profile_image.php");
          
          return false;
        }else
        {	

            
            $file = $_FILES['file']['tmp_name'];
            $size = $_FILES['file']['size'];
            $type = $_FILES['file']['type'];
            
            // Limt profile picture size:
            $max = (1024 * 1024) * 4;
            if ($size < $max) 
            {
            	//checking if the user is uploading a real image and not any file
            	if ($type == "image/jpeg" || $type == "image/png") 
            	{
            		$change = "profile";
            		if (isset($_GET['change'])){$change = $_GET['change'];}

            		if ($change == "cover") 
            		{

			            $post = new Post();
						$post->create_post($userid, $_POST, $_FILES, 0, 1);

            			$image = new Image();
            			$image->resize_image($file,1366,488);
            			$image_blob = file_get_contents($file);
            			$query = "UPDATE users SET cover_image= '" . addslashes($image_blob). "' WHERE userid = '$userid'";	
            		}else
            		{

			            $post = new Post();
						$post->create_post($userid, $_POST, $_FILES, 1, 0);

            			$image = new Image();
            			$image->resize_image($file,800,800);	
            			$image_blob = file_get_contents($file);


            			$image->get_thumbnail($file);	
            			$thumb = file_get_contents($file);
            			$query = "UPDATE users SET profile_image= '" . addslashes($image_blob). "', thumb= '" . addslashes($thumb). "' WHERE userid = '$userid'";

            		}
            		           		
            		$DB = new Database();
            		$result = $DB->save($query);
            		

	            	header("Location: profile.php");
    	        	die;
            	}else
            	{
            		echo "image type is not supported";
            	}
            		
            }else
            {
            	echo "image is too big";
            }

		}
    }
            
?>




<!DOCTYPE html>
<html>
<head>
	<title>
		Change profile image
	</title>
</head>

<style type="text/css">



	#submit_button{

		float: center;
		background-color: #405d9b;
		border: none;
		color: white;
		padding: 4px;
		font-size: 14px;
		border-radius: 2px;
		width: 50px;

	}

	#delete_button{

		float: right;
		background-color: red;
		border: none;
		color: white;
		padding: 4px;
		font-size: 14px;
		border-radius: 2px;
	}
	#choose_img{

		background-color: green;
		border: none;
		color: white;
		padding: 4px;
		font-size: 14px;
		border-radius: 2px;
	}
</style>
<link rel="stylesheet" type="text/css" href="css/styles.css">

<body style="font-family: tahoma; background-color: #d0d8e4">

	<!-- Top bar -->
	<?php include("header.php"); ?>

	<!-- Cover box -->
	<div id="" style="width: 800px; min-height: 400px;  margin: auto;">
			
	

		<!--below cover box -->
		<div style="display: flex;">

			
			<!--posts area -->
			<div style="min-height: 400px;flex: 2.5; padding: 20px; padding-right: 0px;">

				<form method="post" enctype="multipart/form-data" >
					<div style="border: solid thin #aaa; padding: 10px; background-color: white;">
						<input id="choose_img" type="file" name="file">
						<input id= "delete_button" type="button" value="Delete current image">
						<input id="submit_button" type="submit" name="" value="Submit">
						<br>
					</div>
				</form>	

			</div>
		</div>
	</div>
</body>
</html>