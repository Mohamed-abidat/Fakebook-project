<div id="blue_bar">
	<form method="get" action="search.php">

		<div style="width: 1000px; margin: auto; font-size: 30px;">

			<!-- Logo -->
			<a style="color: #d0d8e4;text-decoration: none;" href="index.php">Fakebook</a> 
			&nbsp &nbsp&nbsp &nbsp&nbsp


			<!-- Search box -->
			<input type="text" name="find" id="search_box" placeholder="Search">

			<!-- search type -->
			<select id="searchbox" name="search_type" style="height: 30px; width: 140px; border-radius: 4px; border: solid 1px #ccc;	padding: 4px; font-size: 14px; margin-right: 30px;">

				<option>By Sentence</option>
				<option>By Booleans</option>
				<option>By Relevance</option>
				<option>By counting</option>

			</select>


			<!-- user info -->
			<a href="profile.php">
				<?php
					error_reporting(-1);
				    ini_set('display_errors', 'On');

					$userid 	= $USER['userid'];
					$pro_pic 	= $USER['thumb'];;
					$first 		= $USER['firstname'][0];
					$last 		= $USER['lastname'][0];
					$dot = '.';
					if (empty($pro_pic)) {
						echo"<img src='default_profile_image.php?text=$first$dot$last' style='margin-top: 5px; width: 40px; float: right; '>";
					}else
					{
						echo'<img src="data:image/jpeg;base64,' . base64_encode($pro_pic) . '" style="margin-top: 5px; width: 40px; float: right;"/>';
					}						
				?>
			</a>

			<!-- Logout -->
			<a href="logout.php">
			<span style="font-size: 13px; float: right; margin-top: 15px; margin-right: 10px; color: white"> Logout </span>
			</a>
		</div>
	</form>
</div>