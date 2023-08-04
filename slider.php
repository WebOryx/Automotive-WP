<?php
$args = array(  
	'post_type' => 'img_slider',
	'post_status' => 'publish',
	'posts_per_page' => -1, 
	'orderby' => 'title', 
	'order' => 'ASC',
	'cat' => 'home-page',
);
$loop = new WP_Query( $args );
$total = $loop->found_posts; ?>
<section class="hero-section">
	<div class="container-3">
		<div class="carousel slide" data-bs-ride="carousel" id="carouselExampleCaptions">
			<div class="carousel-indicators">

				<?php for( $a = 0; $a <= ( $total -1 ); $a++ ){ ?>
					<button aria-label="Slide <?php echo $a+1; ?>" class="active" data-bs-slide-to="<?php echo $a; ?>" data-bs-target="#carouselExampleCaptions" type="button"></button>
				<?php } ?>
			</div>
			<div class="carousel-inner">
				<?php $i = 0;
				while ( $loop->have_posts() ){
					$loop->the_post();
					$featured_img = get_the_post_thumbnail_url( $post->ID ); ?>
					<div class="carousel-item <?php if ($i==0){echo "active"; }?>" style="background-image: linear-gradient(to top, rgba(245, 246, 252, 0.52), rgba(245, 245, 245, 0.73)), url('<?php echo $featured_img; ?>');">
						<div class="carousel-caption">
							<div class="item">
								<h4><?php the_title(); ?></h4>
								<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php $i++;
				}
				wp_reset_postdata(); ?>
			</div>
			
			<button class="carousel-control-prev" data-bs-slide="prev" data-bs-target="#carouselExampleCaptions" type="button">
				<span aria-hidden="true" class="carousel-control-prev-icon"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" data-bs-slide="next" data-bs-target="#carouselExampleCaptions" type="button">
				<span aria-hidden="true" class="carousel-control-next-icon"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
</section>