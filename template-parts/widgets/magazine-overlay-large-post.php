<?php
/**
 * The template for displaying large posts in Magazine Post widgets
 *
 * @package Mercia
 */

?>

<div class="magazine-post-large magazine-post-overlay magazine-post">

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'large-post' ); ?>>

		<div class="post-image">

			<?php mercia_post_image( 'mercia-ratio-four-three-large' ); ?>

		</div>

		<div class="post-content">

			<header class="entry-header">

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php mercia_magazine_entry_meta(); ?>

			</header><!-- .entry-header -->

		</div>

	</article>

</div>
