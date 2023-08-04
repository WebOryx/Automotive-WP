<?php
/*
 * Template Name: Homepage
 * description: HomePage template
 */
get_header();

include_once( "slider.php" ); ?>

	<section class="home-page">
		<?php include_once( "section-page.php" ); ?>
	</section>

	<section class="shop-cols">
		<div class="container">
			<div class="row">
				<?php include_once( 'blog-section.php' ); ?>
			</div>
		</div>
	</section>

	<section class="login-sec">
		<div class="container">
			<div class="row">
				<?php global $user_ID, $user_identity;
				if ($user_ID > 0) { ?>
				<div class="col-12 login-col-main">
					<div>
						<div class="col-inner">
							<?php include_once("login-section.php"); ?>
						</div>
					</div>
				</div>
				<?php } else { ?>
					<div class="col-lg-6 col-md-6 col-sm-12 col-12 login-col-main">
						<div>
							<div class="col-inner">
								<?php include_once("login-section.php"); ?>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-12 login-col-main">
						<div class="col-inner">
							<?php include_once("sign-up-section.php"); ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
