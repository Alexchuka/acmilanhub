<?php
include 'core/init.php';
protect_page();

if (empty($_POST) === false){
	$required_fields = array('current_password', 'password', 'password_again');
	foreach($_POST as $key => $value){
		//iterating through the post values
		if (empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisks are required';
			break 1;
			}
		}
		
		if (md5($_POST['current_password']) === $user_data['password']){
			if (trim($_POST['password']) !== trim($_POST['password_again'])){
				$errors[] = 'Your New Passwords do not match';
			}else if (strlen($_POST['password']) < 6){
				$errors[] = 'Your password must be at least 6 characters';
			}
				
			
		} else {
			$errors[] = '<p>Your Current Password is incorrect</p>';
		}
		
	}
include 'includes/head.php';
?>
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
				<h1>Change Password!</h1><br>
		<?php
		if (isset($_GET['success']) && empty($_GET['success'])){
			echo 'Your Password have been Changed Successfully';
		} else {
			if (empty($_POST) === false && empty($errors) === true) {
				//posted the form and returned no errors, do something
				change_password($session_user_id, $_POST['password']);
				header('Location: change_password.php?success');
			} else if (empty($errors) === false) {
				// output errors
				echo output_errors($errors);
			}
			
		?>
					<form action="" method="POST">
						<ul>
							<li>
								Current Password*:<br>
								<input type="password" name="current_password"><br><br>
							</li>
							<li>
								New Password*:<br>
								<input type="password" name="password"><br><br>
							</li>
							<li>
								New Password*:<br>
								<input type="password" name="password_again"><br><br>
							</li>
							<li>
								<input type="submit" value="Change Password">
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

