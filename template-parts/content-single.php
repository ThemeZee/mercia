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

		do_action( 'mercia_after_posts' );

		mercia_related_posts();

		comments_template();
		?>

	</section>

	<?php get_sidebar(); ?>

</article>
