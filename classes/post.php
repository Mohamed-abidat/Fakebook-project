<?php 

class Post
{

	public function create_post($userid, $data, $data2, $pp, $cp)
	{
		$error = "";

		// checking if the user has typed somthing or uploaded an image (at least had done one of the two things)
		if (!empty($data['post']) || !empty(is_uploaded_file($data2["file"]["tmp_name"])))
		{	
		
			$query = "";
			$postid = $this->create_postid();
			$post = addslashes($data['post']);
			$img_blob = file_get_contents($data2['file']['tmp_name']);
			$size = $data2['file']['size'];
			$image = addslashes($img_blob);
			
			//in case the user uploads an image
			if (!empty(is_uploaded_file($data2["file"]["tmp_name"]))) 
			{
				// checking the image size
				if ($size > (1024 * 1024) * 10) {
					$error .= "image is too big <br> ";
					return $error;
				}else{

					$query = "insert into posts (postid, userid, post, has_image, image) values('$postid', '$userid', '$post', '1', '$image')";

					if ($pp == '1') 
					{
						$query = "insert into posts (postid, userid, post, has_image, image, is_pp) values('$postid', '$userid', '$post', '1', '$image', '1')";
					}
					if ($cp == '1') 
					{
						$query = "insert into posts (postid, userid, post, has_image, image, is_cp) values('$postid', '$userid', '$post', '1', '$image', '1')";
					}	
				}
				
			}else
			{
				//in case the users doesn't upload an image
				$query = "insert into posts (postid, userid, post) values('$postid', '$userid', '$post')";
			}	

			$post = addslashes($data['post']);
			$postid = $this->create_postid();

			$DB = new database();
			$DB->save($query);			
		}else
		{
			$error .= "Please type something or upload an image <br> ";
		}


		return $error;
	}
	private function create_postid()
	{
		$length = rand(4,19);
		$number = "";
		
		for ($i=0; $i <$length ; $i++) { 
			$new_rand = rand(0,9);
			$number = $number . $new_rand;
		}
		return $number;
	}
	public function get_posts($id)
	{

		$query = "select * from posts where userid = '$id' order by id desc" ;

		$DB = new database();
		$result = $DB->read($query);

		if ($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}

	public function timeline()
	{

		$query = "select * from posts order by date desc" ;

		$DB = new database();
		$result = $DB->read($query);

		if ($result)
		{
			return $result;
		}else
		{
			return false;
		}
	}

	public function like_post($id, $type, $userid)
	{
	//	if ($tpe == "post") {
//
//			// increment the likes in the posts table
//			$query = "update posts set likes = likes + 1 where postid = '$id' limit 1";
//			$DB = new Database();
//			$DB->save($query);
//
//			// save like details
//			$query = "select likes from likes where type = 'post' && contentid = '$id' limit 1";
//			$result = $DB->read($query);
//
//			if (is_array($result)) {
//				
//			}else
//			{
//				$arr[] = $
//				$query = "insert into likes (type, contentid, likes) values ('$type', '$id', '$likes')";
//			}
//		}
		
	}

}