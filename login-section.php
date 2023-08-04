<?php
global $user_ID, $user_identity; 
if (!$user_ID) {
	echo '<h3>LOGIN</h3>';
	do_shortcode('[show_login_form]'); 
}else{ ?>
	<h3>Welcome, <?php echo $user_identity; ?></h3>
	<div class="usericon">
		<?php global $userdata; echo get_avatar($userdata->ID, 60); ?>
	</div>
	<div class="userinfo">
		<p>You’re logged in as <strong><?php echo $user_identity; ?></strong></p>
		<p> <a href="<?php echo wp_logout_url('index.php'); ?>">Log out</a> |
			<?php
			if ( current_user_can( 'manage_options' ) ) {
				echo '<a href="' . admin_url() . '">' . __( 'Admin' ) . '</a>';
			} else {
				echo '<a href="' . admin_url() . 'profile.php">' . __( 'Profile' ) . '</a>';
			}
			?>
		</p>
	</div>
<?php } ?>