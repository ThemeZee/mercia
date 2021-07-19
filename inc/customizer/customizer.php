<?php
/**
 * Implement theme options in the Customizer
 *
 * @package Mercia
 */

// Load Sanitize Functions.
require( get_template_directory() . '/inc/customizer/sanitize-functions.php' );

// Load Custom Controls.
require( get_template_directory() . '/inc/customizer/controls/headline-control.php' );
require( get_template_directory() . '/inc/customizer/controls/links-control.php' );
require( get_template_directory() . '/inc/customizer/controls/plugin-control.php' );
require( get_template_directory() . '/inc/customizer/controls/upgrade-control.php' );

// Load Customizer Sections.
require( get_template_directory() . '/inc/customizer/sections/customizer-layout.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-blog.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-post.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-info.php' );
require( get_template_directory() . '/inc/customizer/sections/customizer-website.php' );

/**
 * Registers Theme Options panel and sets up some WordPress core settings
 *
 * @param object $wp_customize / Customizer Object.
 */
function mercia_customize_register_options( $wp_customize ) {

	// Add Theme Options Panel.
	$wp_customize->add_panel( 'mercia_options_panel', array(
		'priority'       => 180,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Options', 'mercia' ),
	) );

	// Change default background section.
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
	$wp_customize->get_section( 'background_image' )->title   = esc_html__( 'Background', 'mercia' );
}
add_action( 'customize_register', 'mercia_customize_register_options' );


/**
 * Embed JS file to make Theme Customizer preview reload changes asynchronously.
 */
function mercia_customize_preview_js() {
	wp_enqueue_script( 'mercia-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20200410', true );
}
add_action( 'customize_preview_init', 'mercia_customize_preview_js' );


/**
 * Embed JS for Customizer Controls.
 */
function mercia_customizer_controls_js() {
	wp_enqueue_script( 'mercia-customizer-controls', get_template_directory_uri() . '/assets/js/customizer-controls.js', array(), '20200410', true );
}
add_action( 'customize_controls_enqueue_scripts', 'mercia_customizer_controls_js' );


/**
 * Embed CSS styles Customizer Controls.
 */
function mercia_customizer_controls_css() {
	wp_enqueue_style( 'mercia-customizer-controls', get_template_directory_uri() . '/assets/css/customizer-controls.css', array(), '20200410' );
}
add_action( 'customize_controls_print_styles', 'mercia_customizer_controls_css' );
