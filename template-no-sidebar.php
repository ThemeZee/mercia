<?php
/**
 * Template Name: No Sidebar
 * Template Post Type: post
 *
 * Description: A custom template for displaying a single post without sidebar.
 *
 * @package Mercia
 */

get_header(); ?>

	<div id="content" class="site-content container clearfix">

		<section id="primary" class="content-single content-no-sidebar">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/single/post', 'no-sidebar' );

				endwhile; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

	</div><!-- #content -->

<?php get_footer(); ?>
