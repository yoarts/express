<?php
function express_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'express_theme_options[site_logo]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
		'label' => __( 'Site Logo', 'express' ),
		'section' => 'title_tagline',
		'settings' => 'express_theme_options[site_logo]',
	)));

	$wp_customize->add_setting( 'express_theme_options[favicon]', array(
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon', array(
		'label' => __( 'Site Favicon', 'express' ),
		'section' => 'title_tagline',
		'settings' => 'express_theme_options[favicon]',
	) ) );

	$wp_customize->add_section( 'typography', array(
		'title' => __( 'Typography', 'express' ),
		'priority' => 50,
	));

	$wp_customize->add_setting( 'express_theme_options[global_font_family]', array(
		'default' => 'Roboto',
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback' => 'express_sanitize_global_font_family',
	));

	$wp_customize->add_control( 'global_font_family', array(
		'settings' => 'express_theme_options[global_font_family]',
		'label' => __( 'Global Font Family', 'express' ),
		'section' => 'typography',
		'type' => 'select',
		'choices' => array(
			'Default' => 'Default',
			'Roboto:400,700' => 'Roboto',
			'Lato:400,700' => 'Lato',
			'Droid+Sans:400,700' => 'Droid Sans',
			'Open+Sans:400,700' => 'Open Sans',
			'PT+Sans:400,700' => 'PT Sans',
			'Source+Sans+Pro:400,700' => 'Source Sans Pro',
		),
	));

	$wp_customize->add_setting( 'express_theme_options[heading_font_family]', array(
		'default' => 'Roboto Slab',
		'capability' => 'edit_theme_options',
		'type' => 'option',
		'sanitize_callback' => 'express_sanitize_heading_font_family',
	));

	$wp_customize->add_control( 'heading_font_family', array(
		'settings' => 'express_theme_options[heading_font_family]',
		'label' => __( 'Heading Font Family', 'express' ),
		'section' => 'typography',
		'type' => 'select',
		'choices' => array(
			'Default' => 'Default',
			'Roboto+Slab' => 'Roboto Slab',
			'Droid+Serif' => 'Droid Serif',
			'Lora' => 'Lora',
			'Bitter' => 'Bitter',
			'Arvo' => 'Arvo',
			'PT+Serif' => 'PT Serif',
			'Rokkitt' => 'Rokkitt',
			'Open+Sans+Condensed' => 'Open Sans Condensed',
		),
	));
}
add_action( 'customize_register', 'express_customize_register' );

function express_sanitize_global_font_family( $global_font_family ) {
	if ( ! in_array( $global_font_family, array( 'Default', 'Roboto:400,700', 'Lato:400,700', 'Droid+Sans:400,700', 'Open+Sans:400,700', 'PT+Sans:400,700', 'Source+Sans+Pro:400,700' ) ) ) {
		$global_font_family = 'Default';
	}
	return $global_font_family;
}

function express_sanitize_heading_font_family( $heading_font_family ) {
	if ( ! in_array( $heading_font_family, array( 'Default', 'Roboto+Slab', 'Droid+Serif', 'Lora', 'Bitter', 'Arvo', 'PT+Serif', 'Rokkitt', 'Open+Sans+Condensed' ) ) ) {
		$heading_font_family = 'Default';
	}
	return $heading_font_family;
}

function express_custom_font() {
	$global_font_family = express_get_theme_option( 'global_font_family', 'Default' );
	$heading_font_family = express_get_theme_option( 'heading_font_family', 'Default' );

	echo '<style type="text/css">';
		if ( $global_font_family && $global_font_family != 'Default' ) {
			echo 'body {font-family:' . esc_attr( str_replace( array( '+', ':400,700'), array( ' ', ' ' ), $global_font_family ) ) . '}';
		}
		if ( $heading_font_family && $heading_font_family != 'Default' ) {
			echo 'h1,h2,h3,h4,h5,h6 {font-family:' . esc_attr( str_replace( array( '+', ':400,700'), array( ' ', ' ' ), $heading_font_family ) ) . '}';
		}
	echo '</style>';
}
add_action( 'wp_head', 'express_custom_font' );

function express_fonts_url() {
	$fonts_url = '';
	$fonts = array();
	$global_font_family = express_get_theme_option( 'global_font_family', 'Default' );
	$heading_font_family = express_get_theme_option( 'heading_font_family', 'Default' );
	if ( $global_font_family && $global_font_family != 'Default' ) {
		$fonts[] = express_get_theme_option( 'global_font_family', 'Default' );
	}
	if ( $heading_font_family && $heading_font_family != 'Default' ) {
		$fonts[] = express_get_theme_option( 'heading_font_family', 'Default' );
	}
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => esc_attr( implode( '%7C', $fonts ) )
		), '//fonts.googleapis.com/css' );
	}
	return $fonts_url;
}

function express_favicon() {
	$icon_path = esc_url( express_get_theme_option( 'favicon' ) );
	if ( ! empty( $icon_path ) ) {
		echo '<link type="image/x-icon" href="' . esc_attr( $icon_path ) . '" rel="shortcut icon">';
	}
}
add_action( 'wp_head', 'express_favicon' );

function express_get_theme_option( $option_name, $default = '' ) {
  $options = get_option( 'express_theme_options' );
  if( isset($options[$option_name]) ) {
    return $options[$option_name];
  }
  return $default;
}
