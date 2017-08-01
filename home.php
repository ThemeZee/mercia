<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mercia
 */

get_header();

// Display Magazine Homepage Widgets.
mercia_magazine_widgets();

if ( have_posts() ) :
	mercia_blog_title();
endif;
?>

	<div id="content" class="site-content container clearfix">

		<section id="primary" class="content-archive content-area">
			<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) :

				echo '<div class="post-wrapper">';

				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', esc_attr( mercia_get_option( 'blog_layout' ) ) );

				endwhile;

				echo '</div>';

				mercia_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- #content -->

<?php get_footer(); ?>
