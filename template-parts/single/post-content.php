<?php
/**
 * The template for displaying single posts
 *
 * @package Mercia
 */

?>

<article class="post-content">

	<div class="entry-content clearfix">

		<?php the_content(); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mercia' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php mercia_entry_tags(); ?>
		<?php do_action( 'mercia_author_bio' ); ?>
		<?php mercia_post_navigation(); ?>

	</footer><!-- .entry-footer -->

</article>
