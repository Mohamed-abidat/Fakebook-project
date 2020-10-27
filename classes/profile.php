<?php 

class Profile
{

	public function get_profile($id)
	{
		// variable escaping to avoid sql injection
		$id = addslashes($id);
		$DB = new Database();
		$query = "select * from users where userid = '$id' limit 1";
		return $DB->read($query);
	}
}