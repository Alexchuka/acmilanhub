<?php
include 'core/init.php';
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
							
<?php
if (empty($_POST) === false){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
		if (empty($username) === true || empty($password) === true){
			$errors[] = 'You need to enter a Username and a Password.';
		}else if(user_exists($username) === false){
			$errors[] = 'We can\'t find that username. Have you registered?';
		}else if (user_active($username) === false){
			$errors[] = 'You haven\'t activated your account!';
		}else {
			
			if (strlen($password) > 32){
				$errors[] = 'Password Too Long and should not be more than 32';
			}
			
			$login = login($username, $password);
			if ($login === false){
				$errors[] = 'Username/Password Combination Incorrect.';
			}else{
				$_SESSION['user_id'] = $login;
				header('Location: hub.php');
				exit();
			} 
		}
} else {
	$errors[] = 'No data received';
	
}
?>
	`	<h2>We Tried to Log you in But........</h2><br>
		<?php echo output_errors($errors); ?>
		</article>
		</section>	
		
		<?php include 'includes/aside.php'; ?>
				
	</div>
	<?php include 'includes/footer.php'?>
	</div>
</body>








		