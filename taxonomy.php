<?php get_header(); ?>
<section class="shop-cols">
	<div class="container">
		<div class="row">
			<?php if(have_posts()) {
				while(have_posts()){
					the_post();
					$Col1 = 3;	$Col2 = 9;
					$featured_img = get_the_post_thumbnail_url( $post->ID );
					if ( $featured_img != "" ){ 
						$Col1 = 3;	$Col2 = 9; ?>
						<div class="col-sm-<?php echo $Col1; ?> text-center">
							<a href="<?php echo get_post_permalink( $post->ID ); ?>"><img src="<?php echo $featured_img; ?>"></a>
						</div>
					<?php } else {
						$Col1 = 0;	$Col2 = 12;
					}?>
					<div class="col-sm-<?php echo $Col2; ?>">
						<a class="page_title" href="<?php echo get_post_permalink( $post->ID ); ?>"><?php the_title( '<h2>', '</h2>'); ?></a>
						<p><?php $excerpt = get_the_excerpt(); 
						$excerpt = substr( $excerpt, 0, 195 ); // Only display first 260 characters of excerpt
						$result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
						echo '<a class="blog_txt" href="' . get_post_permalink( $post->ID ) . '">' . $result . "... </a>"; ?></p>
						<a class="read_more" href="<?php echo get_post_permalink( $post->ID ); ?>">Read more...</a>
					</div>
					<div class="clearfix">&nbsp;</div>
				<?php }
			}?>
		</div>
	</div>
</section>
<?php get_footer(); ?>