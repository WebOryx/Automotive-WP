<h3>SIGNUP</h3>
<form method="post" action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="wp-user-form">
	<div class="login-input">
		<input type="text" name="user_login" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="20" id="user_login" tabindex="101" placeholder="Username" />
		<input type="text" name="user_email" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="25" id="user_email" tabindex="102" placeholder="Email"/>
	</div>
	<div class="login_fields">
		<?php do_action('register_form'); ?>
		<input type="submit" name="user-submit" value="<?php _e('Sign up!'); ?>" class="user-submit" tabindex="103" />
		<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>?register=true" />
		<input type="hidden" name="user-cookie" value="1" />
	</div>
</form>