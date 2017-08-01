<?php
/**
 * Pro Version Upgrade Section
 *
 * Registers Upgrade Section for the Pro Version of the theme
 *
 * @package Mercia
 */

/**
 * Adds pro version description and CTA button
 *
 * @param object $wp_customize / Customizer Object.
 */
function mercia_customize_register_upgrade_settings( $wp_customize ) {

	// Add Upgrade / More Features Section.
	$wp_customize->add_section( 'mercia_section_upgrade', array(
		'title'    => esc_html__( 'More Features', 'mercia' ),
		'priority' => 70,
		'panel' => 'mercia_options_panel',
		)
	);

	// Add custom Upgrade Content control.
	$wp_customize->add_setting( 'mercia_theme_options[upgrade]', array(
		'default'           => '',
		'type'           	=> 'option',
		'transport'         => 'refresh',
		'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( new Mercia_Customize_Upgrade_Control(
		$wp_customize, 'mercia_theme_options[upgrade]', array(
		'section' => 'mercia_section_upgrade',
		'settings' => 'mercia_theme_options[upgrade]',
		'priority' => 1,
		)
	) );

}
add_action( 'customize_register', 'mercia_customize_register_upgrade_settings' );
