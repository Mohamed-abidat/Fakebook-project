<?php 

class Signup
{
	private $error ="";

	public function evaluate($data)
	{
		$error = "";
		foreach ($data as $key => $value) 
		{
			
			if (empty($value)) 
			{
				$error = $error . $key ." is empty! <br>";
			}
		}

		if ($error == "") 
		{

			$this->create_user($data);

			header("Location: login.php");
			die;

		}else
		{
			echo "somethig went wrong";
		}
	}

	public function create_user($data)
	{
		$firstname = $data["firstname"];
		$lastname = $data["lastname"];
		$username = $data["username"];
		$gender = $data["gender"];
		$email = $data["email"];
		$password = $data["password"];
		$url_address = strtolower($firstname) . "." . strtolower($lastname);
		$userid = $this->create_userid();

		$query = "INSERT INTO users (userid, firstname, lastname, username, gender, email, password, url_address) 
		VALUES ('$userid', '$firstname', '$lastname', '$username', '$gender',  '$email', '$password', '$url_address')";

		$DB = new Database(); 
		$DB->save($query);
	}
	private function create_userid()
	{
		$length = rand(4,19);
		$number = "";
		
		for ($i=0; $i <$length ; $i++) { 
			$new_rand = rand(0,9);
			$number = $number . $new_rand;
		}
		return $number;
	}

}