<?php
/**
 * Main Navigation
 *
 * @package Mercia
 */
?>

<div id="main-navigation-wrap" class="primary-navigation-wrap">

	<?php do_action( 'mercia_header_search' ); ?>

	<nav id="main-navigation" class="primary-navigation navigation container clearfix" role="navigation">
		<?php
			// Display Main Navigation.
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container' => false,
				'menu_class' => 'main-navigation-menu',
				'echo' => true,
				'fallback_cb' => 'mercia_default_menu',
				)
			);
		?>
	</nav><!-- #main-navigation -->

</div>
