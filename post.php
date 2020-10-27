<div id="post" style="
		margin-left: -10px;
		padding: 25px;
		font-size: 16px;
		margin-bottom: 40px;
		display: flex;
		background-color: white;">
	<a href="profile.php?id=<?php echo $ROW_USER['userid']; ?>">
		<div style="height: 70px;margin-bottom: 20px;">
			<?php 
				error_reporting(-1);
				ini_set('display_errors', 'On');

				$pro_pic 	= $ROW_USER['profile_image'];
				$first 		= $ROW_USER['firstname'][0];
				$last 		= $ROW_USER['lastname'][0];
				$dot = '.';
				if (empty($pro_pic)) {
					echo"<img src='default_profile_image.php?text=$first$dot$last' style='width: 70px; margin-right: 5px;border-radius: 50%;'>";
				}else
				{
					echo"<img src='data:image/jpeg;base64," . base64_encode($pro_pic) . "' style='width: 70px; margin-right: 5px; border-radius: 50%;'/>";
				}						
			?>	
		</div>
	</a>

	<div style="width: 100%;">
			<div style="font-weight: bold; color: #405d9b; margin-top: 20px;margin-bottom: 20px;font-size: 19px">
				<?php


					echo "<a href='profile.php?id=$ROW_USER[userid]' style='text-decoration: none; color: #405d9b;'>" .
					$ROW_USER['firstname'] . " " . $ROW_USER['lastname'] . "</a>";

					$gender = " his";
					
					if ($ROW_USER['gender'] == "Female") {
						$gender = " her";
					}
					
					if ($ROW['is_pp']) 
					{
						echo '<span style = "font-weight: normal; color: #aaa ;font-size: 16px; "> updated' . $gender . ' profile picture</span>'; 
					}elseif ($ROW['is_cp']) 
					{
						echo '<span style = "font-weight: normal; color: #aaa; font-size: 16px; "> updated' . $gender . ' cover picture</span>'; 
					}
					
				?>
			</div>
		
		<?php
			if ($ROW['has_image'] == 0) {
				echo "<br>";
				echo'<span style="margin-left: -70px;margin-top: -20px;">' . htmlspecialchars($ROW['post']) . '</span>';
			}else
			{

				$image = $ROW['image'];
				if (!empty($ROW['post'])) 
				{
					echo "<br>";
					echo'<span style="margin-left: -70px;margin-top: 20px;">' . htmlspecialchars($ROW['post']) . '</span>';
					echo "<br><br>";
				}
				echo'<img src="data:image/jpeg;base64,' . base64_encode($image) . '" style="width: 700px; margin-left: -70px;"/>'; 
			} 
		?>
		<br><br>
		<span style="margin-left: -70px">
			<a 	href="like.php?type=post&id=<?php echo $ROW['postid'] ?>" 
				style="text-decoration: none; color: #405d9b;">
				Like</a> . 
			<a 	style="text-decoration: none; color: #405d9b;" 
				href="">
				Comment</a> . 
			<sapn style= "color: #999"> 
			<?php echo $ROW['date'] ?>
			</span>
			<?php  
				if ($USER['userid'] == $ROW_USER['userid']) 
				{
				//	<a href="" style="text-decoration: none; color: #405d9b;">
					echo   "<sapn style= 'color: #999; float: right;'> 
							<a href='' style='text-decoration: none; color: #405d9b;'> 
							Edit </a> . 
							<a href='' style='text-decoration: none; color: #405d9b;'>
							Delete </a>
							</span>";
				}

			?>
			
		</span>
	</div>
</div>