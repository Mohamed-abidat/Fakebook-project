<?php 
	
	include("classes/classes.php");

	
	$login = new Login();
	$user_data = $login->check_login($_SESSION ['fakebook_userid']);
	// used for header
	$USER = $user_data;	
	$results = "";

	if (isset($_GET['find']) && isset($_GET['search_type'])) {
		
		$find = addslashes($_GET['find']);
		$type = addslashes($_GET['search_type']);

		//getting search results: 
		$post = new Post();
		$results = $post->search($find, $type);

	}
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
			<div style="min-height: 100px;flex: 4; padding: 20px;">

				<!-- results-->
				<div id="post_bar" style="min-height: 50px;">
					<?php

						if ($results) 
						{
							if (is_array($results)) 
							{
								foreach ($results as $ROW) {
									$user = new User();

									$ROW_USER = $user->get_user($ROW['userid']);
									include("post.php");		
								}
							}
							if (is_numeric($results)) {

								echo "<div style='height: 30px; text-align: center; background-color: white; font-size: 20px;'>" . "Relevence of '" . $find . "' is " . $results . "</div>";
							}

						}else
						{
							echo "<div style='height: 30px; text-align: center; background-color: white; font-size: 20px;'> NO RESULTS WERE FOUND </div>";
						}	 

					?>
				</div>
			</div>
		</div>	
	</div>
</body>
</html>