<?php
/**
 * Layout Settings
 *
 * Register Layout section, settings and controls for Theme Customizer
 *
 * @package Mercia
 */

/**
 * Adds all layout settings to the Customizer
 *
 * @param object $wp_customize / Customizer Object.
 */
function mercia_customize_register_layout_settings( $wp_customize ) {

	// Add Section for Theme Options.
	$wp_customize->add_section( 'mercia_section_layout', array(
		'title'    => esc_html__( 'Layout Settings', 'mercia' ),
		'priority' => 10,
		'panel'    => 'mercia_options_panel',
	) );

	// Add Settings and Controls for Layout.
	$wp_customize->add_setting( 'mercia_theme_options[sidebar_position]', array(
		'default'           => 'right-sidebar',
		'type'              => 'option',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'mercia_sanitize_select',
	) );

	$wp_customize->add_control( 'mercia_theme_options[sidebar_position]', array(
		'label'    => esc_html__( 'Sidebar Position', 'mercia' ),
		'section'  => 'mercia_section_layout',
		'settings' => 'mercia_theme_options[sidebar_position]',
		'type'     => 'radio',
		'priority' => 10,
		'choices'  => array(
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'mercia' ),
			'right-sidebar' => esc_html__( 'Right Sidebar', 'mercia' ),
		),
	) );
}
add_action( 'customize_register', 'mercia_customize_register_layout_settings' );
