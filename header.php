<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"><!-- CSS only -->
	<?php wp_head(); ?>
	<title>Automotive</title>
</head>
<body>
	<header class="main-header">
		<div class="container-2">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-6">
					<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
					$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>
					<a href="<?php echo home_url(); ?>" class="navbar-default"><img src="<?php echo $logo[0]; ?>" /></a>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-6 col-6">
					<div class="inner-nav">
						<nav class="navbar navbar-expand-lg navbar-light">
							<button aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarSupportedContent" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<?php wp_nav_menu(array(
									'theme_location'	=>	'primary-menu',
									'container'			=>	'div',
									'container_class'	=>	'collapse navbar-collapse',
									'container_id'		=>	'navbarSupportedContent',
									'menu_id'			=>	'primaary-menu',
									'menu_class'		=>	'navbar-nav mr-auto',
									'add_li_class'		=>	'nav-item'
								)); ?>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>