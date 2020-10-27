<?php 

class Login
{


	public function evaluate($data)
	{
		$email = addslashes($data["email"]);
		$password = addslashes($data["password"]);
	
		$query = "select * from users where email  = '$email' limit 1";

		$DB = new Database(); 
		$result = $DB->read($query);

		if ($result) {
			

			$row = $result[0];

			if (sha1($password) == $row['password']) 
			{
				// creatwe session data
				$_SESSION['fakebook_userid'] = $row['userid'];


			}else{
				echo "wrong password";
			}
		} else{
			echo "no such email exists";
		}

	}

	public function check_login($id)
	{
		if ( is_numeric($id)) 
		{

			$query = "select * from users where userid = '$id' limit 1";

			$DB = new Database(); 
			$result = $DB->read($query);

			if ($result) 
			{
				$user_data = $result[0];
				return $user_data;	
			}else
			{

				header("Location: login.php");		
				die;
			}
		}else
		{
			header("Location: login.php");
			die;
			
		}
	}
}