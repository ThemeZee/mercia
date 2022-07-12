<?php
/**
 * Add theme support for the Gutenberg Editor
 *
 * @package Mercia
 */


/**
 * Registers support for various Gutenberg features.
 *
 * @return void
 */
function mercia_gutenberg_support() {

	// Add theme support for dimension controls.
	add_theme_support( 'custom-spacing' );

	// Add theme support for custom line heights.
	add_theme_support( 'custom-line-height' );

	// Define block color palette.
	$color_palette = apply_filters( 'mercia_color_palette', array(
		'primary_color'    => '#3377bb',
		'secondary_color'  => '#0d5195',
		'tertiary_color'   => '#002b6f',
		'accent_color'     => '#0d9551',
		'highlight_color'  => '#bb3353',
		'light_gray_color' => '#e5e5e5',
		'gray_color'       => '#858585',
		'dark_gray_color'  => '#353535',
	) );

	// Add theme support for block color palette.
	add_theme_support( 'editor-color-palette', apply_filters( 'mercia_editor_color_palette_args', array(
		array(
			'name'  => esc_html_x( 'Primary', 'block color', 'mercia' ),
			'slug'  => 'primary',
			'color' => esc_html( $color_palette['primary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Secondary', 'block color', 'mercia' ),
			'slug'  => 'secondary',
			'color' => esc_html( $color_palette['secondary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Tertiary', 'block color', 'mercia' ),
			'slug'  => 'tertiary',
			'color' => esc_html( $color_palette['tertiary_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Accent', 'block color', 'mercia' ),
			'slug'  => 'accent',
			'color' => esc_html( $color_palette['accent_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Highlight', 'block color', 'mercia' ),
			'slug'  => 'highlight',
			'color' => esc_html( $color_palette['highlight_color'] ),
		),
		array(
			'name'  => esc_html_x( 'White', 'block color', 'mercia' ),
			'slug'  => 'white',
			'color' => '#ffffff',
		),
		array(
			'name'  => esc_html_x( 'Light Gray', 'block color', 'mercia' ),
			'slug'  => 'light-gray',
			'color' => esc_html( $color_palette['light_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Gray', 'block color', 'mercia' ),
			'slug'  => 'gray',
			'color' => esc_html( $color_palette['gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Dark Gray', 'block color', 'mercia' ),
			'slug'  => 'dark-gray',
			'color' => esc_html( $color_palette['dark_gray_color'] ),
		),
		array(
			'name'  => esc_html_x( 'Black', 'block color', 'mercia' ),
			'slug'  => 'black',
			'color' => '#000000',
		),
	) ) );

	// Check if block style functions are available.
	if ( function_exists( 'register_block_style' ) ) {

		// Register Widget Title Block style.
		register_block_style( 'core/heading', array(
			'name'         => 'widget-title',
			'label'        => esc_html__( 'Widget Title', 'mercia' ),
			'style_handle' => 'mercia-stylesheet',
		) );
	}
}
add_action( 'after_setup_theme', 'mercia_gutenberg_support' );


/**
 * Enqueue block styles and scripts for Gutenberg Editor.
 */
function mercia_block_editor_assets() {

	// Enqueue Editor Styling.
	wp_enqueue_style( 'mercia-editor-styles', get_theme_file_uri( '/assets/css/editor-styles.css' ), array(), '20210306', 'all' );

	// Enqueue Page Template Switcher Editor plugin.
	#wp_enqueue_script( 'mercia-page-template-switcher', get_theme_file_uri( '/assets/js/page-template-switcher.js' ), array( 'wp-blocks', 'wp-element', 'wp-edit-post' ), '20210306' );
}
add_action( 'enqueue_block_editor_assets', 'mercia_block_editor_assets' );


/**
 * Add body classes in Gutenberg Editor.
 */
function mercia_block_editor_body_classes( $classes ) {
	global $post;
	$current_screen = get_current_screen();

	// Return early if we are not in the Gutenberg Editor.
	if ( ! ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) ) {
		return $classes;
	}

	// Fullwidth Page Template?
	if ( 'templates/template-fullwidth.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' mercia-fullwidth-page-layout ';
	}

	// No Title Page Template?
	if ( 'templates/template-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-left-no-title.php' === get_page_template_slug( $post->ID ) or
		'templates/template-sidebar-right-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' mercia-page-title-hidden ';
	}

	// Full-width / No Title Page Template?
	if ( 'templates/template-fullwidth-no-title.php' === get_page_template_slug( $post->ID ) ) {
		$classes .= ' mercia-fullwidth-page-layout mercia-page-title-hidden ';
	}

	return $classes;
}
#add_filter( 'admin_body_class', 'mercia_block_editor_body_classes' );
