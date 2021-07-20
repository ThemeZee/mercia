<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Mercia
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mercia' ); ?></a>

	<?php do_action( 'mercia_before_site' ); ?>

	<?php mercia_header_image(); ?>

	<div id="page" class="hfeed site">

		<?php do_action( 'mercia_header_bar' ); ?>

		<?php do_action( 'mercia_before_header' ); ?>

		<header id="masthead" class="site-header clearfix" role="banner">

			<div class="header-main container clearfix">

				<div id="logo" class="site-branding clearfix">

					<?php mercia_site_logo(); ?>
					<?php mercia_site_title(); ?>
					<?php mercia_site_description(); ?>

				</div><!-- .site-branding -->

				<?php get_template_part( 'template-parts/header/navigation', 'social' ); ?>

			</div><!-- .header-main -->

			<?php get_template_part( 'template-parts/header/navigation', 'main' ); ?>

		</header><!-- #masthead -->

		<?php do_action( 'mercia_after_header' ); ?>

		<?php mercia_breadcrumbs(); ?>
