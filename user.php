<div id="friends">
			<?php 
						error_reporting(-1);
					    ini_set('display_errors', 'On');

						$userid 	= $SUGGESTION_ROW['profile_image'];
						$pro_pic 	= $SUGGESTION_ROW['profile_image'];;
						$first 		= $SUGGESTION_ROW['firstname'][0];
						$last 		= $SUGGESTION_ROW['lastname'][0];
						$dot = '.';
						if (empty($pro_pic)) {
							echo"<img id= 'friends_img' src='default_profile_image.php?text=$first$dot$last' style= 'width: 70px; margin-right: 5px;'>";
							echo "<br>";
							echo $SUGGESTION_ROW['firstname'] . " " . $SUGGESTION_ROW['lastname'] ;
						}else
						{
							echo'<img id= "friends_img"src="data:image/jpeg;base64,' . base64_encode($pro_pic) . '" style="width: 70px; margin-right: 5px;"/>';
							echo "<br>";
							echo $SUGGESTION_ROW['firstname'] . " " . $SUGGESTION_ROW['lastname'];
						}						
					?>
			
</div>