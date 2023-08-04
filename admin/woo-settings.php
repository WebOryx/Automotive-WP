<?php
// WooCommerce Section 
$wp_customize->add_section('woo_com', array(
	'title' => 'WooCommerce Support',
	'description' => '',
	'priority' => 121,
));

$wp_customize->add_setting('woo_enb', array(
	'default' => '0',
	'type' => 'theme_mod',
));
$wp_customize->add_control(
	new WP_Customize_Control(
		$wp_customize,
		'woo_enb',
		array(
			'label' => __( 'Enable WooCommerce Support', 'theme_name' ),
			'type'  => 'radio',
			'choices'    => array(
				'1' => 'Yes',
				'0' => 'No',
			),
			'section' => 'woo_com',
			'settings' => 'woo_enb'
		)
	)
);

// WooCommerce Section 

?>