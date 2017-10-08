<?php
/**
 * The template for displaying the footer.
 *
 * Contains all content after the main content area and sidebar
 *
 * @package Mercia
 */

?>

	<?php do_action( 'mercia_before_footer' ); ?>

	<div id="footer" class="footer-wrap">

		<footer id="colophon" class="site-footer container clearfix" role="contentinfo">

			<?php do_action( 'mercia_footer_menu' ); ?>

			<div id="footer-line" class="site-info">
				<?php do_action( 'mercia_footer_text' ); ?>
				<?php mercia_credit_link(); ?>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->

	</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
