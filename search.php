<?php
/**
 * The template for displaying search results pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mercia
 */

get_header(); ?>

	<div id="content" class="site-content container clearfix">

		<section id="primary" class="content-archive content-area">
			<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">

					<h1 class="archive-title"><?php printf( esc_html__( 'Search Results for: %s', 'mercia' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php get_search_form(); ?>

				</header><!-- .page-header -->

				<div class="post-wrapper">

				<?php while ( have_posts() ) : the_post();

					if ( 'post' === get_post_type() ) :

						get_template_part( 'template-parts/content', esc_attr( mercia_get_option( 'blog_content' ) ) );

					else :

						get_template_part( 'template-parts/content', 'search' );

					endif;

				endwhile; ?>

				</div>

				<?php
				mercia_pagination();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- #content -->

<?php get_footer(); ?>
