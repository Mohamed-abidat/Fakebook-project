<?php  

class Image
{

	public function crop_image($file, $max_width,$max_height)
	{

		if (file_exists($file)) {
			$original_image = imagecreatefromjpeg($file);

			//resolution
			$original_width = imagesx($original_image);
			$original_height = imagesy($original_image);


			if ($original_height>$original_width || $original_height == $original_width)  
			{
				
				$ratio = $max_width / $original_width;
				$new_width 	= $max_width;
				$new_height = $original_height * $ratio;
			

			}else 
			{
				
				$ratio = $max_height / $original_height;
				$new_height 	= $max_height;
				$new_width = $original_width * $ratio;
				
			}



			if ($original_image) {

				if ($max_height != $max_width) 
				{
					
					if ($max_height>$max_width) 
					{
						
						if ($max_height > $new_height) 
						{
							$adjustment = ($max_height / $new_height);	
						}else
						{
							$adjustment = ($new_height / $max_height);
						}

						$new_height = $new_height * $adjustment;
						$new_width = $new_width * $adjustment;
					}else
					{

						if ($max_width > $new_width) 
						{
							$adjustment = ($max_width / $new_width);	
						}else
						{
							$adjustment = ($new_width / $max_width);
						}

						$new_height = $new_height * $adjustment;
						$new_width = $new_width * $adjustment;
					
					}
				}
				
				
				$new_image = imagecreatetruecolor($new_width, $new_height);
				imagecopyresampled($new_image, $original_image, 0, 0,0, 0, $new_width, $new_height, $original_width, $original_height);

				
				if ($max_height != $max_width) 
				{

					if ($max_width > $max_height)  
					{
						
						$diff = $new_height - $max_height;
						
						if ($diff < 0 ) 
						{
							$diff = $diff * -1;
						}
						$x = 0;
						$y = round($diff / 2);

					}else 
					{
					
						$diff = $new_width - $max_width;
						
						if ($diff < 0 ) 
						{
							$diff = $diff * -1;
						}
						$y = 0;
						$x = round($diff / 2);
					}
				}else
				{	
					if ($new_height > $new_width)  
					{
						
						$diff = $new_height - $new_width;
						$x = 0;
						$y = round($diff / 2);

					}else 
					{
					
						$diff = $new_width - $new_height;
						$y = 0;
						$x = round($diff / 2);
					}
				}

				$new_crop_image = imagecreatetruecolor($max_width, $max_height);
				imagecopyresampled($new_crop_image, $new_image, 0, 0,$x, $y, $max_width, $max_height, $max_width, $max_height);

				imagejpeg($new_crop_image,$file,90);
			}


		}
		
	}
}