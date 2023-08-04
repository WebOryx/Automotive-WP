<?php

// IMAGE SLIDER
// Register Custom Post Type
function gaming_products() {
	$labels = array(
		'name'                  => _x( 'Products', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Products', 'text_domain' ),
		'name_admin_bar'        => __( 'Product', 'text_domain' ),
		'archives'              => __( 'Product Archives', 'text_domain' ),
		'attributes'            => __( 'Product Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Product:', 'text_domain' ),
		'all_items'             => __( 'All Products', 'text_domain' ),
		'add_new_item'          => __( 'Add New Product', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Product', 'text_domain' ),
		'edit_item'             => __( 'Edit Product', 'text_domain' ),
		'update_item'           => __( 'Update Product', 'text_domain' ),
		'view_item'             => __( 'View Product', 'text_domain' ),
		'view_items'            => __( 'View Products', 'text_domain' ),
		'search_items'          => __( 'Search Product', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into Product', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Product', 'text_domain' ),
		'items_list'            => __( 'Products list', 'text_domain' ),
		'items_list_navigation' => __( 'Products list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter Products list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Product', 'text_domain' ),
		'description'           => __( 'Product Description', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'post-formats' ),
		'taxonomies'            => array( 'product-category' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-products',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'product', $args );
}
add_action( 'init', 'gaming_products', 0 );
// IMAGE SLIDER - CUSTOM TAXONOMY
function gaming_products_custom_taxonomy() {
    register_taxonomy(
        'product-category',
        'product',
        array(
            'label' => __( 'Product Category' ),
            'rewrite' => array( 'slug' => 'product-category' ),
            'hierarchical' => true,
        )
    );
}
add_action( 'init', 'gaming_products_custom_taxonomy' );
// IMAGE SLIDER - CUSTOM TAXONOMY
// IMAGE SLIDER




      // Meta-Box Generator
      // How to use: $meta_value = get_post_meta( $post_id, $field_id, true );
      // Example: get_post_meta( get_the_ID(), "my_metabox_field", true );

      class ProductGalleryMetabox {

        private $screens = array('post', 'page');

        private $fields = array(
          array(
            'label' => '',
            'id' => 'media_',
            'type' => 'media',
            'returnvalue' => 'url',
          ),
          array(
            'label' => '',
            'id' => 'media_',
            'type' => 'media',
            'returnvalue' => 'url',
          )  
        );

        public function __construct() {
          add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
          add_action( 'save_post', array( $this, 'save_fields' ) );
          add_action( 'admin_footer', array( $this, 'add_media_fields' ) );
        }

        public function add_meta_boxes() {
          foreach ( $this->screens as $s ) {
            add_meta_box(
              'ProductGallery',
              __( 'Product Gallery', 'textdomain' ),
              array( $this, 'meta_box_callback' ),
              $s,
              'normal',
              'default'
            );
          }
        }

        public function meta_box_callback( $post ) {
          wp_nonce_field( 'ProductGallery_data', 'ProductGallery_nonce' ); 
          $this->field_generator( $post );
        }

        public function field_generator( $post ) {
          $output = '';
          foreach ( $this->fields as $field ) {
            $label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
            $meta_value = get_post_meta( $post->ID, $field['id'], true );
            if ( empty( $meta_value ) ) {
              if ( isset( $field['default'] ) ) {
                $meta_value = $field['default'];
              }
            }
            switch ( $field['type'] ) {
              case 'media':
                $meta_url = '';
                if ($meta_value) {
                  if ($field['returnvalue'] == 'url') {
                    $meta_url = $meta_value;
                  } else {
                    $meta_url = wp_get_attachment_url($meta_value);
                  }
                }
                $input = sprintf(
                  '<input style="display:none;" id="%s" name="%s" type="text" value="%s" data-return="%s"><div id="preview%s" style="background-color:#fafafa;margin-right:12px;border:1px solid #eee;width: 150px;height:150px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 15%%;margin-right:5px;" class="button new-media" id="%s_button" name="%s_button" type="button" value="Select" /><input style="width: 15%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Delete" />',
                  $field['id'],
                  $field['id'],
                  $meta_value,
                  $field['returnvalue'],
                  $field['id'],
                  $meta_url,
                  $field['id'],
                  $field['id'],
                  $field['id'],
                  $field['id']
                );
                break;
        
              default:
                $input = sprintf(
                '<input %s id="%s" name="%s" type="%s" value="%s">',
                $field['type'] !== 'color' ? 'style="width: 100%"' : '',
                $field['id'],
                $field['id'],
                $field['type'],
                $meta_value
              );
            }
            $output .= $this->format_rows( $label, $input );
          }
          echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
        }

        public function format_rows( $label, $input ) {
          return '<div style="margin-top: 10px;"><strong>'.$label.'</strong></div><div>'.$input.'</div>';
        }

        
      public function add_media_fields() {
        ?>
        <script>
          jQuery(document).ready(function($){
            if ( typeof wp.media !== 'undefined' ) {
              var _custom_media = true,
              _orig_send_attachment = wp.media.editor.send.attachment;
              $('.new-media').click(function(e) {
                var send_attachment_bkp = wp.media.editor.send.attachment;
                var button = $(this);
                var id = button.attr('id').replace('_button', '');
                _custom_media = true;
                wp.media.editor.send.attachment = function(props, attachment){
                  if ( _custom_media ) {
                    if ($('input#' + id).data('return') == 'url') {
                      $('input#' + id).val(attachment.url);
                    } else {
                      $('input#' + id).val(attachment.id);
                    }
                    $('div#preview'+id).css('background-image', 'url('+attachment.url+')');
                  } else {
                    return _orig_send_attachment.apply( this, [props, attachment] );
                  };
                }
                wp.media.editor.open(button);
                return false;
              });
              $('.add_media').on('click', function(){
                _custom_media = false;
              });
              $('.remove-media').on('click', function(){
                var parent = $(this).parent();
                parent.find('input[type="text"]').val('');
                parent.find('div').css('background-image', 'url()');
              });
            }
          });
        </script><?php
      }
    

        public function save_fields( $post_id ) {
          if ( !isset( $_POST['ProductGallery_nonce'] ) ) {
            return $post_id;
          }
          $nonce = $_POST['ProductGallery_nonce'];
          if ( !wp_verify_nonce( $nonce, 'ProductGallery_data' ) ) {
            return $post_id;
          }
          if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
          }
          foreach ( $this->fields as $field ) {
            if ( isset( $_POST[ $field['id'] ] ) ) {
              switch ( $field['type'] ) {
                case 'email':
                  $_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
                  break;
                case 'text':
                  $_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
                  break;
              }
              update_post_meta( $post_id, $field['id'], $_POST[ $field['id'] ] );
            } else if ( $field['type'] === 'checkbox' ) {
              update_post_meta( $post_id, $field['id'], '0' );
            }
          }
        }

      }

      if (class_exists('ProductGalleryMetabox')) {
        new ProductGalleryMetabox;
      };

      

?>