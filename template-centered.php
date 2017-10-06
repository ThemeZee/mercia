<?php
/**
 * Template Name: Centered Layout
 * Template Post Type: page
 *
 * Description: A custom template for displaying a centered layout with no sidebar.
 *
 * @package Mercia
 */

get_header(); ?>

	<div id="content" class="site-content centered-site-content container clearfix">

		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					comments_template();

				endwhile; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

	</div><!-- #content -->

<?php get_footer(); ?>
