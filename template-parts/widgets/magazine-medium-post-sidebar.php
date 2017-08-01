<?php
/**
 * The template for displaying posts in the Magazine Sidebar widget
 *
 * @package Mercia
 */

// Get widget settings.
$post_excerpt = get_query_var( 'mercia_post_excerpt', false );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'medium-post' ); ?>>

	<?php mercia_post_image( 'mercia-thumbnail-large' ); ?>

	<header class="entry-header">

		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

		<?php mercia_magazine_entry_date(); ?>

	</header><!-- .entry-header -->

	<?php // Display post excerpt if enabled.
	if ( $post_excerpt ) : ?>

		<div class="entry-content clearfix">

			<?php the_excerpt(); ?>
			<?php mercia_more_link(); ?>

		</div><!-- .entry-content -->

	<?php endif; ?>

</article>
