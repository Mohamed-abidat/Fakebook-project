<?php  
session_start();

if (isset($_SESSION['fakebook_userid']))
{
	$_SESSION['fakebook_userid'] = NULL;
	unset($_SESSION['fakebook_userid']);	
}


header("Location: login.php");
die;