<?php
/**
 * EnterpriseWP Theme Customizer
 *
 * @package EnterpriseWP
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function enterprisewp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_control( 'custom_logo' );
	$wp_customize->remove_control( 'display_header_text' );

	$wp_customize->add_panel( 'theme_options', array(
		'priority'				=> 10,
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Theme Options', 'enterprisewp' ),
		'description'			=> __( 'Custom options for the theme.', 'enterprisewp' ),
	));

	$wp_customize->add_section( 'theme_options_logo', array(
		'capability'			=> 'edit_theme_options',
		'title'						=> __( 'Logo', 'enterprisewp' ),
		'description'			=> __( 'Logo for the enterprisewp theme.', 'enterprisewp' ),
		'panel'						=> 'theme_options',
	));

	$wp_customize->add_setting( 'logo_img' );

	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control(
		$wp_customize, 'logo_img', array(
			'label'					=> __( 'Logo', 'enterprisewp' ),
			'description'		=> __( 'Recommended logo dimensions: 245x100', 'enterprisewp' ),
			'section'				=> 'theme_options_logo',
			'settings'			=> 'logo_img',
			'width'				=> 245,
			'height'			=> 100,
			'flex_width'		=> false,
			'flex_height'		=> false,
	) ) );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'enterprisewp_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'enterprisewp_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'enterprisewp_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function enterprisewp_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function enterprisewp_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function enterprisewp_customize_preview_js() {
	wp_enqueue_script( 'enterprisewp-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'enterprisewp_customize_preview_js' );
