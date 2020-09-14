<?php
/**
 * Mercia functions and definitions
 *
 * @package Mercia
 */

/**
 * Mercia only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}


if ( ! function_exists( 'mercia_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mercia_setup() {

		// Make theme available for translation. Translations can be filed at https://translate.wordpress.org/projects/wp-themes/mercia
		load_theme_textdomain( 'mercia', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Set detfault Post Thumbnail size.
		set_post_thumbnail_size( 840, 525, true );

		// Register Navigation Menus.
		register_nav_menus( array(
			'primary' => esc_html__( 'Main Navigation', 'mercia' ),
			'social'  => esc_html__( 'Social Icons', 'mercia' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mercia_custom_background_args', array(
			'default-color' => 'ffffff',
		) ) );

		// Set up the WordPress core custom logo feature.
		add_theme_support( 'custom-logo', apply_filters( 'mercia_custom_logo_args', array(
			'height'      => 60,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		) ) );

		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'mercia_custom_header_args', array(
			'header-text' => false,
			'width'       => 2560,
			'height'      => 500,
			'flex-width'  => true,
			'flex-height' => true,
		) ) );

		// Add extra theme styling to the visual editor.
		add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/assets/css/custom-fonts.css' ) );

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add custom color palette for Gutenberg.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html_x( 'Primary', 'Gutenberg Color Palette', 'mercia' ),
				'slug'  => 'primary',
				'color' => apply_filters( 'mercia_primary_color', '#3377bb' ),
			),
			array(
				'name'  => esc_html_x( 'White', 'Gutenberg Color Palette', 'mercia' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html_x( 'Light Gray', 'Gutenberg Color Palette', 'mercia' ),
				'slug'  => 'light-gray',
				'color' => '#f0f0f0',
			),
			array(
				'name'  => esc_html_x( 'Dark Gray', 'Gutenberg Color Palette', 'mercia' ),
				'slug'  => 'dark-gray',
				'color' => '#777777',
			),
			array(
				'name'  => esc_html_x( 'Black', 'Gutenberg Color Palette', 'mercia' ),
				'slug'  => 'black',
				'color' => '#353535',
			),
		) );

		// Add support for responsive embed blocks.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'mercia_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mercia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mercia_content_width', 840 );
}
add_action( 'after_setup_theme', 'mercia_content_width', 0 );


/**
 * Register widget areas and custom widgets.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mercia_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mercia' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Appears on posts and pages except the full width template.', 'mercia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Magazine Homepage', 'mercia' ),
		'id'            => 'magazine-homepage',
		'description'   => esc_html__( 'Appears on blog index and Magazine Homepage template. You can use the Magazine widgets here.', 'mercia' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'mercia_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function mercia_scripts() {

	// Get Theme Version.
	$theme_version = wp_get_theme()->get( 'Version' );

	// Register and Enqueue Stylesheet.
	wp_enqueue_style( 'mercia-stylesheet', get_stylesheet_uri(), array(), $theme_version );

	// Register and enqueue navigation.min.js.
	if ( ( has_nav_menu( 'primary' ) || has_nav_menu( 'secondary' ) ) && ! mercia_is_amp() ) {
		wp_enqueue_script( 'mercia-navigation', get_theme_file_uri( '/assets/js/navigation.min.js' ), array( 'jquery' ), '20200822', true );
		$mercia_l10n = array(
			'expand'   => esc_html__( 'Expand child menu', 'mercia' ),
			'collapse' => esc_html__( 'Collapse child menu', 'mercia' ),
			'icon'     => mercia_get_svg( 'expand' ),
		);
		wp_localize_script( 'mercia-navigation', 'merciaScreenReaderText', $mercia_l10n );
	}

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	if ( ! mercia_is_amp() ) {
		wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.6' );
	}

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mercia_scripts' );


/**
 * Enqueue custom fonts.
 */
function mercia_custom_fonts() {
	wp_enqueue_style( 'mercia-custom-fonts', get_template_directory_uri() . '/assets/css/custom-fonts.css', array(), '20180413' );
}
add_action( 'wp_enqueue_scripts', 'mercia_custom_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'mercia_custom_fonts', 1 );


/**
 * Enqueue editor styles for the new Gutenberg Editor.
 */
function mercia_block_editor_assets() {
	wp_enqueue_style( 'mercia-editor-styles', get_theme_file_uri( '/assets/css/gutenberg-styles.css' ), array(), '20191118', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'mercia_block_editor_assets' );


/**
 * Add custom sizes for featured images
 */
function mercia_add_image_sizes() {

	add_image_size( 'mercia-single-post', 1200, 600, true );

	// Add different thumbnail sizes for Magazine widgets.
	add_image_size( 'mercia-ratio-sixteen-ten-small', 200, 125, true );
	add_image_size( 'mercia-ratio-sixteen-ten-medium', 440, 275, true );
	add_image_size( 'mercia-ratio-four-three-large', 840, 630, true );
	add_image_size( 'mercia-ratio-four-three-medium', 440, 330, true );
}
add_action( 'after_setup_theme', 'mercia_add_image_sizes' );


/**
 * Make custom image sizes available in Gutenberg.
 */
function mercia_add_image_size_names( $sizes ) {
	return array_merge( $sizes, array(
		'post-thumbnail'                 => esc_html__( 'Mercia Blog Post', 'mercia' ),
		'mercia-single-post'             => esc_html__( 'Mercia Single Post', 'mercia' ),
		'mercia-ratio-four-three-large'  => esc_html__( 'Mercia Magazine Post', 'mercia' ),
		'mercia-ratio-sixteen-ten-small' => esc_html__( 'Mercia Thumbnail', 'mercia' ),
	) );
}
add_filter( 'image_size_names_choose', 'mercia_add_image_size_names' );


/**
 * Add pingback url on single posts
 */
function mercia_pingback_url() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'mercia_pingback_url' );


/**
 * Include Files
 */

// Include Theme Info page.
require get_template_directory() . '/inc/theme-info.php';

// Include Theme Customizer Options.
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/customizer/default-options.php';

// Include Extra Functions.
require get_template_directory() . '/inc/extras.php';

// Include SVG Icon Functions.
require get_template_directory() . '/inc/icons.php';

// Include Template Functions.
require get_template_directory() . '/inc/template-tags.php';

// Include support functions for Theme Addons.
require get_template_directory() . '/inc/addons.php';

// Include Magazine Functions.
require get_template_directory() . '/inc/magazine.php';

// Include Widget Files.
require get_template_directory() . '/inc/widgets/widget-magazine-focus-center.php';
require get_template_directory() . '/inc/widgets/widget-magazine-focus-left.php';
require get_template_directory() . '/inc/widgets/widget-magazine-grid.php';
