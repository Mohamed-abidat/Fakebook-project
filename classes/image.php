<?php  

class Image
{

	public function crop_image($source, $target, $max_hieght, $max_width)
	{

		$source_image = imagecreatefromjpeg($source);

		$org_width = imagesx($source_image);
		$org_hieght = imagesy($source_image);

		if ($org_hieght > $org_width) {
			
			$ratio = $max_width / $org_width;

			$new_width 	= $max_width;
			$new_hieght = $org_hieght * $ratio;  
		}else
		{


			$ratio = $max_hieght / $org_hieght;

			$new_hieght 	= $max_hieght;
			$new_width = $org_width * $ratio;

		}

		$new_image = imagecreatetruecolor($new_width, $new_hieght);
		imagecopyresampled($new_image, $source_image, 0, 0, 0, 0, $new_width, $new_hieght, $org_width, $org_hieght);


		if ($new_hieght > $new_width) 
		{
			
			$diff = $new_hieght - $new_width;
			$y = round($diff / 2);
			$x = 0;	
		}else
		{
			$diff = $new_width - $new_hieght;
			$x = round($diff / 2);
			$y = 0;
		}

		$final_image = imagecreatetruecolor($max_width, $max_hieght);
		imagecopyresampled($final_image, $new_image, 0, 0, $x, $y, $max_width, $max_hieght, $max_width, $max_hieght);
		

		imagejpeg($final_image, $target, 90);
		
		return $final_image;
	}
}