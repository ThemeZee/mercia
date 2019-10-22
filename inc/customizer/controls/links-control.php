<?php
/**
 * Theme Links Control for the Customizer
 *
 * @package Mercia
 */

/**
 * Make sure that custom controls are only defined in the Customizer
 */
if ( class_exists( 'WP_Customize_Control' ) ) :

	/**
	 * Displays the theme links in the Customizer.
	 */
	class Mercia_Customize_Links_Control extends WP_Customize_Control {
		/**
		 * Render Control
		 */
		public function render_content() {
			?>

			<div class="theme-links">

				<span class="customize-control-title"><?php esc_html_e( 'Theme Links', 'mercia' ); ?></span>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/themes/mercia/', 'mercia' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=mercia&utm_content=theme-page" target="_blank">
						<?php esc_html_e( 'Theme Page', 'mercia' ); ?>
					</a>
				</p>

				<p>
					<a href="http://preview.themezee.com/?demo=mercia&utm_source=customizer&utm_campaign=mercia" target="_blank">
						<?php esc_html_e( 'Theme Demo', 'mercia' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/docs/mercia-documentation/', 'mercia' ) ); ?>?utm_source=customizer&utm_medium=textlink&utm_campaign=mercia&utm_content=documentation" target="_blank">
						<?php esc_html_e( 'Theme Documentation', 'mercia' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/changelogs/?action=themezee-changelog&type=theme&slug=mercia/', 'mercia' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Theme Changelog', 'mercia' ); ?>
					</a>
				</p>

				<p>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/support/theme/mercia/reviews/', 'mercia' ) ); ?>" target="_blank">
						<?php esc_html_e( 'Rate this theme', 'mercia' ); ?>
					</a>
				</p>

			</div>

			<?php
		}
	}

endif;
