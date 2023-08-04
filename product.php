<?php
/*
 * Template Name: Product
 * description: Product Page template
 */
get_header(); ?>
SINGLE
<section class="shop-cols">
	<div class="container">
		<div class="row">
			<?php if(have_posts()) {
				while(have_posts()){
					the_post();
					$featured_img = get_the_post_thumbnail_url( $post->ID ); ?>
					<div class="col-sm-3 text-center">
						<img src="<?php echo $featured_img; ?>">	
					</div>
					<div class="col-sm-9">
						<?php the_title( '<h2 class="page_title">', '</h2>');
						echo '<div>'; the_content(); echo '</div>'; ?>
					</div>
				<?php }
			}?>
		</div>
	</div>
</section>
<?php get_footer(); ?>