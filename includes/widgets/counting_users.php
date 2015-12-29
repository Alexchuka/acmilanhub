<aside class="aside_news">
		<h2>Users</h2>
		<?php
		$user_count = user_count();
		$suffix = ($user_count != 1) ? 's' : '';
		
		?>
		
		We Currently have <?php echo user_count(); ?> Registered user<?php echo $suffix; ?>.
</aside>
