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
			'primary'   => esc_html__( 'Main Navigation', 'mercia' ),
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
			'height' => 60,
			'width' => 300,
			'flex-height' => true,
			'flex-width' => true,
		) ) );

		// Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'mercia_custom_header_args', array(
			'header-text' => false,
			'width'	      => 2560,
			'height'      => 500,
			'flex-width'  => true,
			'flex-height' => true,
		) ) );

		// Add extra theme styling to the visual editor.
		add_editor_style( array( 'css/editor-style.css', mercia_google_fonts_url() ) );

		// Add Theme Support for Selective Refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
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
		'name' => esc_html__( 'Sidebar', 'mercia' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the full width template.', 'mercia' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));

	register_sidebar( array(
		'name' => esc_html__( 'Magazine Homepage', 'mercia' ),
		'id' => 'magazine-homepage',
		'description' => esc_html__( 'Appears on blog index and Magazine Homepage template. You can use the Magazine widgets here.', 'mercia' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3 class="widget-title">',
		'after_title' => '</h3></div>',
	));

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

	// Register and enqueue navigation.js.
	wp_enqueue_script( 'mercia-jquery-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array( 'jquery' ), '20170725' );

	// Passing Parameters to navigation.js.
	wp_localize_script( 'mercia-jquery-navigation', 'mercia_menu_title', mercia_get_svg( 'menu' ) . esc_html__( 'Menu', 'mercia' ) );

	// Enqueue svgxuse to support external SVG Sprites in Internet Explorer.
	wp_enqueue_script( 'svgxuse', get_theme_file_uri( '/assets/js/svgxuse.min.js' ), array(), '1.2.4' );

	// Register and Enqueue Google Fonts.
	wp_enqueue_style( 'mercia-default-fonts', mercia_google_fonts_url(), array(), null );

	// Register Comment Reply Script for Threaded Comments.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'mercia_scripts' );


/**
 * Retrieve Font URL to register default Google Fonts
 */
function mercia_google_fonts_url() {

	// Set default Fonts.
	$font_families = array( 'Raleway:400,400italic,700,700italic', 'Rambla:400,400italic,700,700italic' );

	// Build Fonts URL.
	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return apply_filters( 'mercia_google_fonts_url', $fonts_url );
}


/**
 * Add custom sizes for featured images
 */
function mercia_add_image_sizes() {

	// Add different thumbnail sizes for Magazine Posts widgets.
	add_image_size( 'mercia-thumbnail-small', 120, 80, true );
	add_image_size( 'mercia-thumbnail-medium', 280, 175, true );
	add_image_size( 'mercia-thumbnail-large', 600, 375, true );

}
add_action( 'after_setup_theme', 'mercia_add_image_sizes' );


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

// Include Featured Content Setup.
require get_template_directory() . '/inc/featured-content.php';

// Include Magazine Functions.
require get_template_directory() . '/inc/magazine.php';

// Include Widget Files.
require get_template_directory() . '/inc/widgets/widget-magazine-posts-columns.php';
require get_template_directory() . '/inc/widgets/widget-magazine-posts-grid.php';
