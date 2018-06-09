<?php
/**
 * Post Settings
 *
 * Register Post Settings section, settings and controls for Theme Customizer
 *
 * @package Mercia
 */

/**
 * Adds post settings in the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function mercia_customize_register_post_settings( $wp_customize ) {

	// Add Sections for Post Settings.
	$wp_customize->add_section( 'mercia_section_post', array(
		'title'    => esc_html__( 'Post Settings', 'mercia' ),
		'priority' => 40,
		'panel'    => 'mercia_options_panel',
	) );

	// Add Setting and Control for post layout.
	$wp_customize->add_setting( 'mercia_theme_options[post_layout]', array(
		'default'           => 'default',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_select',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_layout]', array(
		'label'    => esc_html__( 'Single Post Layout', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_layout]',
		'type'     => 'select',
		'priority' => 10,
		'choices'  => array(
			'default' => esc_html__( 'Default', 'mercia' ),
			'full'    => esc_html__( 'Full Width Header', 'mercia' ),
		),
	) );

	// Add Post Details Headline.
	$wp_customize->add_control( new Mercia_Customize_Header_Control(
		$wp_customize, 'mercia_theme_options[post_details]', array(
			'label'    => esc_html__( 'Post Details', 'mercia' ),
			'section'  => 'mercia_section_post',
			'settings' => array(),
			'priority' => 20,
		)
	) );

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'mercia_theme_options[meta_date]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display date', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 30,
	) );

	// Add Setting and Control for showing post author.
	$wp_customize->add_setting( 'mercia_theme_options[meta_author]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display author', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 40,
	) );

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'mercia_theme_options[meta_category]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_category]', array(
		'label'    => esc_html__( 'Display categories', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 50,
	) );

	// Add Single Post Headline.
	$wp_customize->add_control( new Mercia_Customize_Header_Control(
		$wp_customize, 'mercia_theme_options[single_post]', array(
			'label'    => esc_html__( 'Single Post', 'mercia' ),
			'section'  => 'mercia_section_post',
			'settings' => array(),
			'priority' => 60,
		)
	) );

	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'mercia_theme_options[meta_tags]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display tags', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 70,
	) );

	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'mercia_theme_options[post_navigation]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 80,
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new Mercia_Customize_Header_Control(
		$wp_customize, 'mercia_theme_options[featured_images]', array(
			'label' => esc_html__( 'Featured Images', 'mercia' ),
			'section' => 'mercia_section_post',
			'settings' => array(),
			'priority' => 90,
		)
	) );

	// Add Setting and Control for featured images on blog and archives.
	$wp_customize->add_setting( 'mercia_theme_options[post_image_archives]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_image_archives]', array(
		'label'    => esc_html__( 'Display images on blog and archives', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_image_archives]',
		'type'     => 'checkbox',
		'priority' => 100,
	) );

	$wp_customize->selective_refresh->add_partial( 'mercia_theme_options[post_image_archives]', array(
		'selector'         => '.site-main .post-wrapper',
		'render_callback'  => 'mercia_customize_partial_blog_content',
		'fallback_refresh' => false,
	) );

	// Add Setting and Control for featured images on single posts.
	$wp_customize->add_setting( 'mercia_theme_options[post_image_single]', array(
		'default'           => true,
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_image_single]', array(
		'label'    => esc_html__( 'Display image on single posts', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 110,
	) );

	// Add Partial for Single Post Layout and Single Post Image.
	$wp_customize->selective_refresh->add_partial( 'mercia_post_layout_partial', array(
		'selector'         => '.single-post .content-single .site-main',
		'settings'         => array(
			'mercia_theme_options[post_layout]',
			'mercia_theme_options[post_image_single]',
		),
		'render_callback'  => 'mercia_customize_partial_post_layout',
		'fallback_refresh' => false,
	) );
}
add_action( 'customize_register', 'mercia_customize_register_post_settings' );


/**
 * Render single posts partial
 */
function mercia_customize_partial_post_layout() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'single' );
	}
}
