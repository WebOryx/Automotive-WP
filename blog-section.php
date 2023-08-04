<?php /*
<div class="col-lg-3 col-md-6 col-sm-12 col-12">
	<div class="col-inner">
		<div class="vehicle-image"><img src="<?php echo get_template_directory_uri(); ?>/assets/car.png"></div>
		<div class="content">
			<h3>VEHICLE OWNER</h3>
			<p>We Offer a platform to manage your vehicles, vehicle repair and maintainance histories, create appointments, view estimates, authorize work, pay invoices, and understand what your vehicles need are.</p>
		</div>
		<div class="col-btns-div-main">
			<div class="inner">
				<a href="#">SIGN UP</a> <a href="#">LOGIN</a>
			</div>
		</div>
	</div>
</div>
*/ ?>

<?php
$args = array(  
	'post_type' => 'blog',
	'post_status' => 'publish',
	'posts_per_page' => 4, 
	'orderby' => 'title', 
	'order' => 'ASC',
);
$loop = new WP_Query( $args );
$i = 0;
while ( $loop->have_posts() ){
	$loop->the_post();
	//var_dump( $post );
	$featured_img = get_the_post_thumbnail_url( $post->ID ); ?>
	<div class="col-lg-3 col-md-6 col-sm-12 col-12">
		<div class="col-inner">		
			<?php if ( $featured_img  != "" ){?>
				<div class="vehicle-image"><a href="<?php echo get_post_permalink( $post->ID ); ?>"><img src="<?php echo $featured_img; ?>"></a></div>
			<?php }?>
			<div class="content">
				<a class="page_title" href="<?php echo get_post_permalink( $post->ID ); ?>"><?php the_title( '<h3>', '</h3>'); ?></a>
				<p><?php $excerpt = get_the_excerpt(); 
					$excerpt = substr( $excerpt, 0, 195 ); // Only display first 260 characters of excerpt
					$result = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
					echo '<a class="blog_txt" href="' . get_post_permalink( $post->ID ) . '">' . $result . "... </a>"; ?></p>
			</div>
			<div class="col-btns-div-main">
				<div class="inner">
					<a href="<?php echo get_post_permalink( $post->ID ); ?>">Read more</a>
				</div>
			</div>
		</div>
		<div class="clearfix">&nbsp;</div>
	</div>
<?php $i++;
}
wp_reset_postdata(); ?>