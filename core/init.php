<?php
session_start();
//error_reporting(0);

require 'database/connect.php';
require 'functions/general.php';
require 'functions/users.php';

//variable to hold all the data.
if (logged_in() === true ){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'password', 'first_name', 'last_name', 'email');
//check if the user's account is active	
	/*if (user_active($user_data['username']) === false) {
		session_destroy();
		header('Location: tem.php');
		exit();
	}*/
}
$errors = array();

?>