<?php
//A function that changes the password of a user
function change_password($user_id, $password){
	$user_id = (int)$user_id;
	$password = md5($password);
	
	mysql_query("UPDATE `users` SET `password` = '$password' WHERE `user_id` = $user_id");
}

function register_user($register_data){
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	
	mysql_query("INSERT INTO `users` ($fields) VALUES ($data)");
	email($register_data['email'], 'Activate your account',);
}

function user_count(){
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `active`= 1");
	return mysql_result($query, 0);
}

//Grab the user's data
function user_data($user_id){ 
	$data = array();
	$user_id = (int)$user_id;
	
	$func_num_args = func_num_args(); //the func_num_args function counts the number of arguement the user wants to return
	$func_get_args = func_get_args(); // the func_get_arg function returns the arguement the array the argument pass through to the function
	
	if ($func_num_args > 1){
		unset($func_get_args[0]);
		
		$fields = '`' . implode('` , `', $func_get_args) . '`';
		$data = mysql_fetch_assoc(mysql_query("SELECT $fields FROM `users` WHERE `user_id`= $user_id"));
		return $data;
	}
}
//get the user's session id
function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}
//Check if the user exists in the database
function user_exists($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username`='$username'");
	return (mysql_result($query, 0) == 1) ? true : false;	
}
//Check if the email exists in the database
function email_exists($email){
	$email = sanitize($email);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `email`='$email'");
	return (mysql_result($query, 0) == 1) ? true : false;	
}
//check if the user is active in the Database
function user_active($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username`='$username' AND `active` = 1");
	return (mysql_result($query, 0) == 1) ? true : false;	
}
//Grab the user's ID
function user_id_from_username($username){
	$username = sanitize($username);
	$query = mysql_query("SELECT `user_id` FROM `users` WHERE `username`='$username'");
	return mysql_result($query, 0, 'user_id');
}
//Log the user in if the user exists in the database.
function login($username, $password){
	$user_id = user_id_from_username($username);
	
	$username = sanitize($username);
	$password = md5($password);
	
	$query = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `username`='$username' AND `password`='$password'");
	return (mysql_result($query, 0) == 1) ? $user_id : false;
}

?>