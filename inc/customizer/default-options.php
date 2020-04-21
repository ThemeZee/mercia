<?php
/**
 * Returns theme options
 *
 * Uses sane defaults in case the user has not configured any theme options yet.
 *
 * @package Mercia
 */

/**
* Get a single theme option
*
* @return mixed
*/
function mercia_get_option( $option_name = '' ) {

	// Get all Theme Options from Database.
	$theme_options = mercia_theme_options();

	// Return single option.
	if ( isset( $theme_options[ $option_name ] ) ) {
		return $theme_options[ $option_name ];
	}

	return false;
}


/**
 * Get saved user settings from database or theme defaults
 *
 * @return array
 */
function mercia_theme_options() {

	// Merge theme options array from database with default options array.
	$theme_options = wp_parse_args( get_option( 'mercia_theme_options', array() ), mercia_default_options() );

	// Return theme options.
	return $theme_options;
}


/**
 * Returns the default settings of the theme
 *
 * @return array
 */
function mercia_default_options() {

	$default_options = array(
		'retina_logo'           => false,
		'site_title'            => true,
		'site_description'      => true,
		'sidebar_position'      => 'right-sidebar',
		'blog_title'            => '',
		'blog_description'      => '',
		'blog_layout'           => 'large',
		'blog_content'          => 'excerpt',
		'excerpt_length'        => 35,
		'read_more_text'        => esc_html__( 'Continue reading', 'mercia' ),
		'blog_magazine_widgets' => true,
		'post_layout'           => 'default',
		'meta_date'             => true,
		'meta_author'           => true,
		'meta_category'         => true,
		'meta_tags'             => true,
		'post_navigation'       => true,
		'post_image_archives'   => true,
		'post_image_single'     => true,
		'credit_link'           => true,
	);

	return $default_options;
}
