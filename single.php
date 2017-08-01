<?php
/**
 * The template for displaying all single posts.
 *
 * @package Mercia
 */

get_header();

while ( have_posts() ) : the_post(); ?>

	<?php get_template_part( 'template-parts/header/header', 'single' ); ?>

	<div id="content" class="site-content container clearfix">

		<section id="primary" class="content-single content-area">
			<main id="main" class="site-main" role="main">

				<?php
				get_template_part( 'template-parts/content', 'single' );

				mercia_related_posts();

				comments_template();
				?>

			</main><!-- #main -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- #content -->

<?php endwhile; ?>

<?php get_footer(); ?>
