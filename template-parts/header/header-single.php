<?php
/**
 * The template for displaying the header of single posts
 *
 * @package Mercia
 */

?>

<header class="entry-header single-header">

	<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	<?php mercia_entry_meta(); ?>

</header><!-- .entry-header -->

<?php mercia_post_image_single(); ?>
