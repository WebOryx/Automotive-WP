<?php
/**
 * auto functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package automotive-wp
 */

if ( !defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function auto_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	// By adding theme support, we declare that this theme does not use a
	// hard-coded <title> tag in the document head, and expect WordPress to
	// provide it for us.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	// @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	// add_theme_support( 'post-thumbnails' );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary-menu' => esc_html__( 'Primary', 'automotive-wp' ),
		'secondary-menu' => esc_html__( 'Secondary', 'automotive-wp' ),
	) );

	// Switch default core markup for search form, comment form, and comments
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'auto_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
	
	add_theme_support('post-thumbnails');
}
add_action( 'after_setup_theme', 'auto_setup' );

// Set the content width in pixels, based on the theme's design and stylesheet.
// Priority 0 to make it available to lower priority callbacks.
// @global int $content_width
function auto_content_width() {
	$GLOBALS[ 'content_width' ] = apply_filters( 'auto_content_width', 640 );
}
add_action( 'after_setup_theme', 'auto_content_width', 0 );

// Adding multiple widgets areas
function widget_registration($name, $id, $description, $beforeWidget, $afterWidget, $beforeTitle, $afterTitle){
	register_sidebar( array(
		'name' => $name,
		'id' => $id,
		'description' => $description,
		'before_widget' => $beforeWidget,
		'after_widget' => $afterWidget,
		'before_title' => $beforeTitle,
		'after_title' => $afterTitle,
	));
}
function multiple_widget_init(){
	widget_registration('Footer Left', 'footer_left', esc_html__( 'Add widgets here.', 'auto' ), '<div id="%1$s" class="states-col-inner widget %2$s">', '</div>', '<h2 class="widget-title">', '</h2>');
	//widget_registration('Advance Auto Parts', 'adv_auto_part', esc_html__( 'Add widgets here.', 'auto' ), '<section id="%1$s" class="widget %2$s">', '</section>', '<h2 class="widget-title">', '</h2>');
}
add_action('widgets_init', 'multiple_widget_init');


// Enqueue scripts and styles.
function auto_scripts() {
	wp_enqueue_style( 'automotive', get_template_directory_uri() . '/style.css', array(), null );
	wp_enqueue_style( 'automotive-theme', get_template_directory_uri() . '/css/theme-style.css', array(), null );
	wp_enqueue_style( 'automotive-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css', array(), null );
	wp_enqueue_style( 'automotive-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), null );
	wp_enqueue_style( 'automotive-fontaw', get_template_directory_uri() . '/css/font-awesome.min.css', array(), null );
	
	wp_enqueue_style( 'woo-general', get_template_directory_uri() . '/css/woocommerce.css', array(), null );
	
    wp_enqueue_script( 'automotive-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), false, true );
    wp_enqueue_script( 'automotive-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js', array('automotive-jquery'), false, true );
    wp_enqueue_script( 'automotive-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('automotive-jquery'), false, true );
    wp_enqueue_script( 'automotive-custom', get_template_directory_uri() . '/js/custom.js', array('automotive-jquery'), false, true );
}
add_action( 'wp_enqueue_scripts', 'auto_scripts' );

/* */
// IMAGE SLIDER
// Register Custom Post Type
function img_slider() {
	$labels = array(
		'name'                  => _x( 'Slides', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Slide', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Image Slider', 'text_domain' ),
		'name_admin_bar'        => __( 'Image Slider', 'text_domain' ),
		'archives'              => __( 'Image Slider Archives', 'text_domain' ),
		'attributes'            => __( 'Image Slider Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Image Slider:', 'text_domain' ),
		'all_items'             => __( 'All Image Sliders', 'text_domain' ),
		'add_new_item'          => __( 'Add New Image Slider', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Image Slider', 'text_domain' ),
		'edit_item'             => __( 'Edit Image Slider', 'text_domain' ),
		'update_item'           => __( 'Update Image Slider', 'text_domain' ),
		'view_item'             => __( 'View Image Slider', 'text_domain' ),
		'view_items'            => __( 'View Image Sliders', 'text_domain' ),
		'search_items'          => __( 'Search Image Slider', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Image Slider', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Image Slider', 'text_domain' ),
		'items_list'            => __( 'Image Sliders list', 'text_domain' ),
		'items_list_navigation' => __( 'Image Sliders list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Image Sliders list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Slide', 'text_domain' ),
		'description'           => __( 'Image Slider', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'slider-for' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-slides',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'img_slider', $args );
}
add_action( 'init', 'img_slider', 0 );
// IMAGE SLIDER - CUSTOM TAXONOMY
function img_slider_custom_taxonomy() {
    register_taxonomy(
        'slider-for',
        'img_slider',
        array(
            'label' => __( 'Slider For' ),
            'rewrite' => array( 'slug' => 'slider-for' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'img_slider_custom_taxonomy' );
// IMAGE SLIDER - CUSTOM TAXONOMY
// IMAGE SLIDER
/* */

// THEME SETTINGS - CUSTOMIZE
function clinuvel_customizer_settings($wp_customize) {
	/* Footer Section */
	$wp_customize->add_section('theme_footer', array(
		'title' => 'Footer',
		'description' => '',
		'priority' => 120,
	));

	/* Copyright */
	$wp_customize->add_setting('footer_copy', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'copyright',
			array(
				'label' => __( 'Copyrights (C). Use [Y] to show current year.', 'theme_name' ),
				'type'  => 'textarea',
				'section' => 'theme_footer',
				'settings' => 'footer_copy'
			)
		)
	);
	/* Copyright */

	/* Show Map */
	$wp_customize->add_setting('show_map', array(
		'default' => '1',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'show_map',
			array(
				'label' => __( 'Show Map on Homepage only', 'theme_name' ),
				'type'  => 'radio',
				'choices'    => array(
					'1' => 'Yes',
					'0' => 'No',
				),
				'section' => 'theme_footer',
				'settings' => 'show_map'
			)
		)
	);
	/* Show Map */

	/* Footer Section */

	/* Social Media Section */
	$wp_customize->add_section('social_media', array(
		'title' => 'Social Media',
		'description' => '',
		'priority' => 121,
	));

	/* Contact Link */
	$wp_customize->add_setting('git_link', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'git_link',
			array(
				'label' => __( 'Git Link', 'theme_name' ),
				'type'  => 'text',
				'section' => 'social_media',
				'settings' => 'git_link'
			)
		)
	);
	/* Contact Link */

	/* Facebook Link */
	$wp_customize->add_setting('fb_link', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'fb_link',
			array(
				'label' => __( 'Facebook Link', 'theme_name' ),
				'type'  => 'text',
				'section' => 'social_media',
				'settings' => 'fb_link'
			)
		)
	);
	/* Facebook Link */

	/* Twitter Link */
	$wp_customize->add_setting('tw_link', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'tw_link',
			array(
				'label' => __( 'Twitter Link', 'theme_name' ),
				'type'  => 'text',
				'section' => 'social_media',
				'settings' => 'tw_link'
			)
		)
	);
	/* Twitter Link */

	/* YouTube Link */
	$wp_customize->add_setting('yt_link', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'yt_link',
			array(
				'label' => __( 'YouTube Link', 'theme_name' ),
				'type'  => 'text',
				'section' => 'social_media',
				'settings' => 'yt_link'
			)
		)
	);
	/* YouTube Link */

	/* Email */
	$wp_customize->add_setting('email_link', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'email_link',
			array(
				'label' => __( 'Email', 'theme_name' ),
				'type'  => 'text',
				'section' => 'social_media',
				'settings' => 'email_link'
			)
		)
	);
	/* Email */

    /* Instagram */
	$wp_customize->add_setting('insta_link', array(
		'default' => '',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'insta_link',
			array(
				'label' => __( 'Instagram', 'theme_name' ),
				'type'  => 'text',
				'section' => 'social_media',
				'settings' => 'insta_link'
			)
		)
	);
	/* Instagram */

	/* Social Media Section */
	
	include_once("admin/woo-settings.php");
	
}
add_action('customize_register', 'clinuvel_customizer_settings');
// THEME SETTINGS - CUSTOMIZE

add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter( 'nav_menu_link_attributes', 'add_link_atts');
function add_link_atts($atts){
	$atts['class'] = "nav-link";
	return $atts;
}

// LOGIN FORM
function wpdocs_log_me_shortcode_fn() {
	$args = array(
		'redirect' => admin_url(),
		'form_id' => 'loginform-custom',
		'label_username' => __( ' ' ),
		'label_password' => __( ' ' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in' => __( 'Log In' ),
		'remember' => true
	);
	echo '<div class="login_form">';
	wp_login_form( $args );
	echo '</div>';
}
add_shortcode( 'show_login_form', 'wpdocs_log_me_shortcode_fn' );
// LOGIN FORM

// Register Blog Custom Post Type
function blog_post() {
	$labels = array(
		'name'                  => _x( 'Blogs', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Blog', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Blog', 'text_domain' ),
		'name_admin_bar'        => __( 'Blog', 'text_domain' ),
		'archives'              => __( 'Blog Archives', 'text_domain' ),
		'attributes'            => __( 'Blog Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Blog', 'text_domain' ),
		'all_items'             => __( 'All Blogs', 'text_domain' ),
		'add_new_item'          => __( 'Add New Blog', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Blog', 'text_domain' ),
		'edit_item'             => __( 'Edit Blog', 'text_domain' ),
		'update_item'           => __( 'Update Blog', 'text_domain' ),
		'view_item'             => __( 'View Blog', 'text_domain' ),
		'view_items'            => __( 'View Blogs', 'text_domain' ),
		'search_items'          => __( 'Search Blog', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into blog', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this blog', 'text_domain' ),
		'items_list'            => __( 'Blogs list', 'text_domain' ),
		'items_list_navigation' => __( 'Blogs list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter blogs list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Blog', 'text_domain' ),
		'description'           => __( 'My Blogs', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'post-formats' ),
		'taxonomies'            => array( 'blog-category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-welcome-write-blog',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'blog', $args );
}
add_action( 'init', 'blog_post', 0 );
// Blog - CUSTOM TAXONOMY
function blog_custom_taxonomy() {
    register_taxonomy(
        'blog-category',
        'blog',
        array(
            'label' => __( 'Blog Category' ),
            'rewrite' => array( 'slug' => 'blog-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'blog_custom_taxonomy' );
// Blog - CUSTOM TAXONOMY
// Register Blog Custom Post Type

// WooCommerce Support
if (get_theme_mod('woo_enb')){
	include_once("woocommerce-support.php");
}
//include_once("post-types-settings.php");