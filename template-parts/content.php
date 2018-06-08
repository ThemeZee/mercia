<?php
/**
 * The template for displaying articles in the loop with full content
 *
 * @package Mercia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php mercia_post_image_archives(); ?>

	<div class="post-content">

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php mercia_entry_meta(); ?>

		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php the_content( esc_html( mercia_get_option( 'read_more_text' ) ) ); ?>
		</div><!-- .entry-content -->

	</div>

</article>
