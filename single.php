<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package automotive-wp
 */
get_header(); ?>
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