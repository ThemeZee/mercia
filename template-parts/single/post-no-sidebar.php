<?php
/**
 * The template for displaying single posts
 *
 * @package Mercia
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<section class="single-header">

		<?php get_template_part( 'template-parts/single/post', 'header' ); ?>

	</section>

	<section id="primary" class="single-content">

		<?php
		get_template_part( 'template-parts/single/post', 'content' );

		mercia_related_posts();

		comments_template();
		?>

	</section>

</article>
