<?php
/**
 * The template for displaying the footer.
 *
 * Contains all content after the main content area and sidebar
 *
 * @package Mercia
 */

?>

	</div><!-- #content -->

	<?php do_action( 'mercia_before_footer' ); ?>

	<div id="footer" class="footer-wrap">

		<footer id="colophon" class="site-footer container clearfix" role="contentinfo">

			<div id="footer-text" class="site-info">
				<?php do_action( 'mercia_footer_text' ); ?>
				<?php mercia_credit_link(); ?>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->

	</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
