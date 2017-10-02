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
		'priority' => 30,
		'panel' => 'mercia_options_panel',
	) );

	// Add Post Details Headline.
	$wp_customize->add_control( new Mercia_Customize_Header_Control(
		$wp_customize, 'mercia_theme_options[post_details]', array(
			'label' => esc_html__( 'Post Details', 'mercia' ),
			'section' => 'mercia_section_post',
			'settings' => array(),
			'priority' => 10,
		)
	) );

	// Add Setting and Control for showing post date.
	$wp_customize->add_setting( 'mercia_theme_options[meta_date]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_date]', array(
		'label'    => esc_html__( 'Display date', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_date]',
		'type'     => 'checkbox',
		'priority' => 20,
	) );

	// Add Setting and Control for showing post author.
	$wp_customize->add_setting( 'mercia_theme_options[meta_author]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_author]', array(
		'label'    => esc_html__( 'Display author', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_author]',
		'type'     => 'checkbox',
		'priority' => 30,
	) );

	// Add Setting and Control for showing post categories.
	$wp_customize->add_setting( 'mercia_theme_options[meta_category]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_category]', array(
		'label'    => esc_html__( 'Display categories', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_category]',
		'type'     => 'checkbox',
		'priority' => 40,
	) );

	// Add Single Post Headline.
	$wp_customize->add_control( new Mercia_Customize_Header_Control(
		$wp_customize, 'mercia_theme_options[single_post]', array(
			'label' => esc_html__( 'Single Post', 'mercia' ),
			'section' => 'mercia_section_post',
			'settings' => array(),
			'priority' => 50,
		)
	) );

	// Add Setting and Control for showing post tags.
	$wp_customize->add_setting( 'mercia_theme_options[meta_tags]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[meta_tags]', array(
		'label'    => esc_html__( 'Display tags', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[meta_tags]',
		'type'     => 'checkbox',
		'priority' => 60,
	) );

	// Add Setting and Control for showing post navigation.
	$wp_customize->add_setting( 'mercia_theme_options[post_navigation]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_navigation]', array(
		'label'    => esc_html__( 'Display previous/next post navigation', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_navigation]',
		'type'     => 'checkbox',
		'priority' => 70,
	) );

	// Add Featured Images Headline.
	$wp_customize->add_control( new Mercia_Customize_Header_Control(
		$wp_customize, 'mercia_theme_options[featured_images]', array(
		'label' => esc_html__( 'Featured Images', 'mercia' ),
		'section' => 'mercia_section_post',
		'settings' => array(),
		'priority' => 80,
		)
	) );

	// Add Setting and Control for featured images on blog and archives.
	$wp_customize->add_setting( 'mercia_theme_options[post_image_archives]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_image_archives]', array(
		'label'    => esc_html__( 'Display images on blog and archives', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_image_archives]',
		'type'     => 'checkbox',
		'priority' => 90,
	) );

	$wp_customize->selective_refresh->add_partial( 'mercia_theme_options[post_image_archives]', array(
		'selector'         => '.site-main .post-wrapper',
		'render_callback'  => 'mercia_customize_partial_blog_content',
		'fallback_refresh' => false,
	) );

	// Add Setting and Control for featured images on single posts.
	$wp_customize->add_setting( 'mercia_theme_options[post_image_single]', array(
		'default'           => true,
		'type'           	=> 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'mercia_theme_options[post_image_single]', array(
		'label'    => esc_html__( 'Display image on single posts', 'mercia' ),
		'section'  => 'mercia_section_post',
		'settings' => 'mercia_theme_options[post_image_single]',
		'type'     => 'checkbox',
		'priority' => 100,
	) );

	$wp_customize->selective_refresh->add_partial( 'mercia_theme_options[post_image_single]', array(
		'selector'        => '.content-single .site-main',
		'render_callback' => 'mercia_customize_partial_post_image_single',
		'fallback_refresh' => false,
	) );
}
add_action( 'customize_register', 'mercia_customize_register_post_settings' );


/**
 * Render featured image on single posts for the selective refresh partial.
 */
function mercia_customize_partial_post_image_single() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', 'single' );
		mercia_related_posts();
		comments_template();
	}
}
