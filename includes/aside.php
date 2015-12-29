<aside class="aside_news">
		<?php
		if (logged_in() === true){
			include 'includes/widgets/loggedin.php';
		}else{
			include 'includes/widgets/logon.php';
		}
		include 'includes/widgets/counting_users.php'; 
		?>	
		</aside>