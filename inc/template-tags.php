<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Mercia
 */

if ( ! function_exists( 'mercia_site_logo' ) ) :
	/**
	 * Displays the site logo in the header area
	 */
	function mercia_site_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {

			the_custom_logo();

		}
	}
endif;


if ( ! function_exists( 'mercia_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function mercia_site_title() {

		if ( is_home() or is_page_template( 'template-magazine.php' ) ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function mercia_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) : ?>

			<p class="site-description"><?php echo $description; ?></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function mercia_header_image() {

		if ( has_header_image() ) : ?>

			<div id="headimg" class="header-image">

				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>

			</div>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_blog_title' ) ) :
	/**
	 * Displays the archive title and archive description for the blog index
	 */
	function mercia_blog_title() {

		// Get blog title and descripton from database.
		$blog_title = mercia_get_option( 'blog_title' );
		$blog_description = mercia_get_option( 'blog_description' );

		// Display Blog Title.
		if ( '' !== $blog_title || '' !== $blog_description || is_customize_preview() ) : ?>

			<header class="page-header blog-header clearfix">

				<?php // Display Blog Title.
				if ( '' !== $blog_title || is_customize_preview() ) : ?>

					<h3 class="archive-title blog-title"><?php echo wp_kses_post( $blog_title ); ?></h3>

				<?php endif;

				// Display Blog Description.
				if ( '' !== $blog_description || is_customize_preview() ) : ?>

					<p class="blog-description"><?php echo wp_kses_post( $blog_description ); ?></p>

				<?php endif; ?>

			</header>

		<?php endif;
	}
endif;


if ( ! function_exists( 'mercia_post_image' ) ) :
	/**
	 * Displays the featured image in Magazine widgets and featured section.
	 *
	 * @param string $size Post thumbnail size.
	 * @param array  $attr Post thumbnail attributes.
	 */
	function mercia_post_image( $size = 'post-thumbnail', $attr = array() ) {

		// Check if post has thumbnail.
		if ( has_post_thumbnail() ) : ?>

			<a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( $size, $attr ); ?>
			</a>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_post_image_archives' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 */
	function mercia_post_image_archives() {

		// Set image size.
		$image_size = ( 'list' === mercia_get_option( 'blog_layout' ) ) ? 'mercia-ratio-four-three-large' : 'post-thumbnail';

		// Display Post Thumbnail if activated.
		if ( true === mercia_get_option( 'post_image_archives' ) && has_post_thumbnail() ) : ?>

			<div class="post-image">
				<a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_post_thumbnail( $image_size ); ?>
				</a>
			</div>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_post_image_single' ) ) :
	/**
	 * Displays the featured image on single posts
	 */
	function mercia_post_image_single() {

		// Set image size.
		$image_size = ( 'full' === mercia_get_option( 'post_layout' ) ) ? 'mercia-single-post' : 'post-thumbnail';

		// Display Post Thumbnail if activated.
		if ( true === mercia_get_option( 'post_image_single' ) ) : ?>

			<div class="post-image">
				<?php the_post_thumbnail( $image_size ); ?>
			</div>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_entry_meta' ) ) :
	/**
	 * Displays the date, author and categories of a post
	 */
	function mercia_entry_meta() {

		$postmeta = mercia_meta_date();
		$postmeta .= mercia_meta_author();
		$postmeta .= mercia_meta_category();

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'mercia_meta_date' ) ) :
	/**
	 * Displays the post date
	 */
	function mercia_meta_date() {

		$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$posted_on = mercia_get_svg( 'time' ) . $time_string;

		return '<span class="meta-date">' . $posted_on . '</span>';
	}
endif;


if ( ! function_exists( 'mercia_meta_author' ) ) :
	/**
	 * Displays the post author
	 */
	function mercia_meta_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'mercia' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		$posted_by = mercia_get_svg( 'user' ) . $author_string;

		return '<span class="meta-author"> ' . $posted_by . '</span>';
	}
endif;

if ( ! function_exists( 'mercia_meta_category' ) ) :
	/**
	 * Displays the post category
	 */
	function mercia_meta_category() {

		// Return early if post has no category.
		if ( ! has_category() ) {
			return;
		}

		$posted_in = mercia_get_svg( 'category' ) . get_the_category_list( ', ' );

		return '<span class="meta-category"> ' . $posted_in . '</span>';
	}
endif;


if ( ! function_exists( 'mercia_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function mercia_entry_tags() {

		// Get tags.
		$tag_list = get_the_tag_list();

		// Display tags.
		if ( $tag_list ) : ?>

			<div class="entry-tags clearfix">
				<?php echo mercia_get_svg( 'tag' ); ?>
				<span class="meta-tags">
					<?php echo $tag_list; ?>
				</span>
			</div><!-- .entry-tags -->

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function mercia_more_link() {

		// Get Read More Text.
		$read_more = mercia_get_option( 'read_more_text' );

		if ( '' !== $read_more || is_customize_preview() ) :
		?>

			<a href="<?php echo esc_url( get_permalink() ) ?>" class="more-link"><?php echo esc_html( $read_more ); ?></a>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'mercia_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function mercia_post_navigation() {

		if ( true === mercia_get_option( 'post_navigation' ) || is_customize_preview() ) {

			the_post_navigation( array(
				'prev_text' => '<span class="nav-link-text">' . esc_html_x( 'Previous Post', 'post navigation', 'mercia' ) . '</span><h3 class="entry-title">%title</h3>',
				'next_text' => '<span class="nav-link-text">' . esc_html_x( 'Next Post', 'post navigation', 'mercia' ) . '</span><h3 class="entry-title">%title</h3>',
			) );

		}
	}
endif;


if ( ! function_exists( 'mercia_breadcrumbs' ) ) :
	/**
	 * Displays ThemeZee Breadcrumbs plugin
	 */
	function mercia_breadcrumbs() {

		if ( function_exists( 'themezee_breadcrumbs' ) ) {

			themezee_breadcrumbs( array(
				'before' => '<div class="breadcrumbs-container container clearfix">',
				'after' => '</div>',
			) );

		}
	}
endif;


if ( ! function_exists( 'mercia_related_posts' ) ) :
	/**
	 * Displays ThemeZee Related Posts plugin
	 */
	function mercia_related_posts() {

		if ( function_exists( 'themezee_related_posts' ) ) {

			themezee_related_posts( array(
				'class' => 'related-posts type-page clearfix',
				'before_title' => '<h2 class="archive-title related-posts-title">',
				'after_title' => '</h2>',
			) );

		}
	}
endif;


if ( ! function_exists( 'mercia_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function mercia_pagination() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo;<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'mercia' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'mercia' ) . '</span>&raquo;',
		) );

	}
endif;


/**
 * Displays credit link on footer line
 */
function mercia_credit_link() {
	if ( true === mercia_get_option( 'credit_link' ) || is_customize_preview() ) :
		?>

		<span class="credit-link">
			<?php
			// translators: Theme Name and Link to ThemeZee.
			printf( esc_html__( 'WordPress Theme: %1$s by %2$s.', 'mercia' ),
				esc_html__( 'Mercia', 'mercia' ),
				'ThemeZee'
			);
			?>
		</span>

		<?php
	endif;
}
