<?php
include 'core/init.php';
if (empty($_POST) === false){
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
	foreach($_POST as $key => $value){
		//iterating through the post values
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisks are required';
			break 1;
		}
	}
	
	if (empty($errors) === true){
		if (user_exists($_POST['username']) === true) {
			$errors[] = 'Sorry, the Username \''.$_POST['username'].'\' is already taken';
		
		if (preg_match("/\\s/", $_POST['username']) == true){
			$errors[] = 'Your Username must not contain any Spaces';
		}
		if (strlen($_POST['password']) < 6) {
				$errors[] = 'Your Password must be at least 6 characters';
		}
		if ($_POST['password'] !== $_POST['password_again']){
				$errors[] = 'Your Passwords do not match';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A Valid Email Address is required';
		}
		if (email_exists($_POST['email']) === true){
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}	
	}
  }
}

?>

<?php
include 'includes/head.php';
?>
<html>
<body>
		<div class="main_body">
	
		<header class="top_header">
		<h1>Welcome!!</h1><br>
		</header>
		<nav class="navigation">
			<ul>
				<a href="hub.php"><li>Home</li></a>
				<a href="downloads.php"><li>downloads</li></a>
				<a href="forum.php"><li>forum</li></a>
				<a href="contact.php"><li>contact us</li></a>
			</ul>
		</nav>
		<div class="clear"></div>
		
	
		<div class="sec_div">
		
		<section class="man_section">
			<article>



<h1>Register</h1><br>
<?php
if (isset($_GET['success']) && empty($_GET['success'])){
	echo '<p>Welcome, You have been Registered sucessfully!</p>';
} else {
			if (empty($_POST) === false && empty($errors) === true){
				$register_data = array(
					'username' 		 => $_POST['username'],
					'password'   	 => $_POST['password'],
					'first_name' 	 => $_POST['first_name'],
					'last_name'		 => $_POST['last_name'],
					'email'			 => $_POST['email'],
					'email_code'  	 => md5($_POST['username'] + microtime())
				);
				register_user($register_data);
				header('Location: register.php?success');
				exit();
				
			} else {
				echo output_errors($errors);
			}
		?>
		<br><br>
		<form action="register.php" method="POST">
			<ul>
				<li>
					Username*:<br>
					<input type="text" name="username"><br><br>
				</li>
				<li>
					Password*:<br>
					<input type="password" name="password"><br><br>
				</li>
				<li>
					Password Again*:<br>
					<input type="password" name="password_again"><br><br>
				</li>
				<li>
					First name*:<br>
					<input type="text" name="first_name"><br><br>
				</li>
				<li>
					Last name:<br>
					<input type="text" name="last_name"><br><br>
				</li>
				<li>
					Email*:<br>
					<input type="text" name="email"><br><br>
				</li>
				<li>
					<input type="submit" value="Register">
				</li>
			</ul>

		</form>
		<?php } ?>
					</article>
				</section>		
		<?php include 'includes/aside.php'; ?>
				
	</div>
	<?php include 'includes/footer.php'?>
	</div>
</body>		

</html>

