<?php
/**
 * The template for displaying medium posts in Magazine Post widgets
 *
 * @package Mercia
 */

?>

<div class="magazine-post-medium magazine-post-overlay magazine-post">

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'medium-post' ); ?>>

		<div class="post-image">

			<?php mercia_post_image( 'mercia-ratio-four-three-medium' ); ?>

		</div>

		<div class="post-content">

			<header class="entry-header">

				<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>

			</header><!-- .entry-header -->

		</div>

	</article>

</div>
