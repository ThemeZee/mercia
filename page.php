<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Mercia
 */

get_header(); ?>

	<div id="content" class="site-content container clearfix">

		<section id="primary" class="content-single content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					do_action( 'mercia_after_pages' );

					comments_template();

				endwhile; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- #content -->

<?php get_footer(); ?>
