<?php
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );

if (class_exists('Woocommerce')){
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
}
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

//Both Image Size and Product Grid
function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 150,
		'single_image_width'    => 300,
		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'max_rows'        => 8,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 5,
		),
	));
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

function add_gallery_support() {
	//Image Zoom/Magnification
    add_theme_support( 'wc-product-gallery-zoom' );
    //Lightbox for Gallery
	add_theme_support( 'wc-product-gallery-lightbox' );
	//Image Slider
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'add_gallery_support' );


?>