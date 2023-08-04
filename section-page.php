<div class="container">
	<div class="row">
		<?php if(have_posts()) {
			while(have_posts()){
				the_post();
				$Col1 = 3;	$Col2 = 9;
				$featured_img = get_the_post_thumbnail_url( $post->ID ); 
				if ( $featured_img != "" ){ ?>
					<div class="col-sm-<?php echo $Col1; ?> text-center">
						<img src="<?php echo $featured_img; ?>">	
					</div>
				<?php }else{
					$Col1 = 0;	$Col2 = 12;
				} ?>
				<div class="col-sm-<?php echo $Col2; ?>">
					<?php the_title( '<h2 class="page_title">', '</h2>');
					echo '<div>'; the_content(); echo '</div>'; ?>
				</div>
			<?php }
		}?>
	</div>
</div>