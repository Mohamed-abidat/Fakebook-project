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


	public function thumbnail($image, $width, $height, $type)
	{

		$thumbnail = exif_thumbnail($image, $width, $height, $type);

		if ($thumbnail!==false) 
		{
		    header('Content-type: ' .image_type_to_mime_type($type));
		    echo $thumbnail;
		}else
		{
		    // if no thumbnail is available return the image itself
		    header('Content-type: ' .image_type_to_mime_type($type));
		    echo $image;
		}
	}

	public function captcha()
	{

        $image = imagecreatetruecolor(200, 50);
        
        
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);
        
        // distortion
        $line_color = imagecolorallocate($image, 64,64,64);
        for($i=0;$i<6;$i++) 
        {
          imageline($image,0,rand()%50,200,rand()%50,$line_color);
        }
        
        // dot display
        $pixel_color = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<1000;$i++) 
        {
		    imagesetpixel($image,rand()%200,rand()%50,$pixel_color);
        }
        
        // characters
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        $len = strlen($letters);
        
        //~ $letter = $letters[rand(0, $len-1)];
        $text_color = imagecolorallocate($image, 255,0,0);

        $word = "";
        for ($i = 0; $i< 6;$i++)
        {						
            $letter = $letters[rand(0, $len-1)];
            imagestring($image, 5,  5+($i*30), 20, $letter, $text_color);
          $word= $word . $letter;
        }
        $_SESSION['captcha'] = $word;
        //display
        imagepng($image, "img/captcha.png");
	}
}