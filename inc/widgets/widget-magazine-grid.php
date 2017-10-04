<?php
/**
 * Magazine Grid Widget
 *
 * Display the latest posts from a selected category in a grid layout.
 * Intented to be used in the Magazine Homepage widget area to built a magazine layouted page.
 *
 * @package Mercia
 */

/**
 * Magazine Widget Class
 */
class Mercia_Magazine_Grid_Widget extends WP_Widget {

	/**
	 * Widget Constructor
	 */
	function __construct() {

		// Setup Widget.
		parent::__construct(
			'mercia-magazine-grid', // ID.
			esc_html__( 'Magazine (Grid)', 'mercia' ), // Name.
			array(
				'classname' => 'mercia-magazine-grid-widget',
				'description' => esc_html__( 'Displays your posts from a selected category in a grid layout.', 'mercia' ),
				'customize_selective_refresh' => true,
			) // Args.
		);
	}

	/**
	 * Set default settings of the widget
	 */
	private function default_settings() {

		$defaults = array(
			'title'    => esc_html__( 'Magazine (Grid)', 'mercia' ),
			'category' => 0,
			'layout'   => 'three-columns',
			'number'   => 6,
			'style'    => 'regular',
		);

		return $defaults;
	}

	/**
	 * Main Function to display the widget
	 *
	 * @uses this->render()
	 *
	 * @param array $args / Parameters from widget area created with register_sidebar().
	 * @param array $instance / Settings for this widget instance.
	 */
	function widget( $args, $instance ) {

		// Start Output Buffering.
		ob_start();

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );

		// Set Widget classes.
		$class = 'magazine-grid-' . sanitize_key( $settings['layout'] );
		$class .= ( 'overlay' === $settings['style'] ) ? ' magazine-posts-overlay' : ' magazine-posts-regular';

		// Output.
		echo $args['before_widget'];
		?>

		<div class="widget-magazine-grid widget-magazine-posts clearfix">

			<?php // Display Title.
			$this->widget_title( $args, $settings ); ?>

			<div class="widget-magazine-grid-content widget-magazine-content <?php echo $class; ?>">

				<?php $this->render( $settings ); ?>

			</div>

		</div>

		<?php
		echo $args['after_widget'];

		// End Output Buffering.
		ob_end_flush();
	}

	/**
	 * Renders the Widget Content
	 *
	 * Switches between two or three column layout style based on widget settings
	 *
	 * @uses this->magazine_posts_two_column_grid() or this->magazine_posts_three_column_grid()
	 * @used-by this->widget()
	 *
	 * @param array $settings / Settings for this widget instance.
	 */
	function render( $settings ) {

		// Get cached post ids.
		$post_ids = mercia_get_magazine_post_ids( $this->id, $settings['category'], $settings['number'] );

		// Fetch posts from database.
		$query_arguments = array(
			'post__in'            => $post_ids,
			'posts_per_page'      => absint( $settings['number'] ),
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);
		$posts_query = new WP_Query( $query_arguments );

		// Set style.
		$style = ( 'overlay' === $settings['style'] ) ? 'magazine-overlay' : 'magazine-regular';

		// Set template.
		if ( 'two-columns' === $settings['layout'] ) {
			$template = $style . '-large-post';
		} elseif ( 'three-columns' === $settings['layout'] ) {
			$template = $style . '-medium-post';
		} else {
			$template = $style . '-small-post';
		}

		// Check if there are posts.
		if ( $posts_query->have_posts() ) :

			// Limit the number of words for the excerpt.
			add_filter( 'excerpt_length', 'mercia_magazine_posts_excerpt_length' );

			// Display Posts.
			while ( $posts_query->have_posts() ) : $posts_query->the_post();

				get_template_part( 'template-parts/widgets/' . $template, 'grid' );

			endwhile;

			// Remove excerpt filter.
			remove_filter( 'excerpt_length', 'mercia_magazine_posts_excerpt_length' );

		endif;

		// Reset Postdata.
		wp_reset_postdata();
	}

	/**
	 * Displays Widget Title
	 *
	 * @param array $args / Parameters from widget area created with register_sidebar().
	 * @param array $settings / Settings for this widget instance.
	 */
	function widget_title( $args, $settings ) {

		// Add Widget Title Filter.
		$widget_title = apply_filters( 'widget_title', $settings['title'], $settings, $this->id_base );

		if ( ! empty( $widget_title ) ) :

			// Link Widget Title to category archive when possible.
			$widget_title = mercia_magazine_widget_title( $widget_title, $settings['category'] );

			// Display Widget Title.
			echo $args['before_title'] . $widget_title . $args['after_title'];

		endif;
	}

	/**
	 * Update Widget Settings
	 *
	 * @param array $new_instance / New Settings for this widget instance.
	 * @param array $old_instance / Old Settings for this widget instance.
	 * @return array $instance
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['category'] = (int) $new_instance['category'];
		$instance['layout'] = sanitize_text_field( $new_instance['layout'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['style'] = sanitize_text_field( $new_instance['style'] );

		mercia_flush_magazine_post_ids();

		return $instance;
	}

	/**
	 * Displays Widget Settings Form in the Backend
	 *
	 * @param array $instance / Settings for this widget instance.
	 */
	function form( $instance ) {

		// Get Widget Settings.
		$settings = wp_parse_args( $instance, $this->default_settings() );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'mercia' ); ?>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $settings['title'] ); ?>" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php esc_html_e( 'Category:', 'mercia' ); ?></label><br/>
			<?php // Display Category Select.
				$args = array(
					'show_option_all'    => esc_html__( 'All Categories', 'mercia' ),
					'show_count' 		 => true,
					'hide_empty'		 => false,
					'selected'           => $settings['category'],
					'name'               => $this->get_field_name( 'category' ),
					'id'                 => $this->get_field_id( 'category' ),
				);
				wp_dropdown_categories( $args );
			?>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php esc_html_e( 'Grid Layout:', 'mercia' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>">
				<option <?php selected( $settings['layout'], 'two-columns' ); ?> value="two-columns" ><?php esc_html_e( 'Two Columns', 'mercia' ); ?></option>
				<option <?php selected( $settings['layout'], 'three-columns' ); ?> value="three-columns" ><?php esc_html_e( 'Three Columns', 'mercia' ); ?></option>
				<option <?php selected( $settings['layout'], 'four-columns' ); ?> value="four-columns" ><?php esc_html_e( 'Four Columns', 'mercia' ); ?></option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts:', 'mercia' ); ?>
				<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo absint( $settings['number'] ); ?>" size="3" />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php esc_html_e( 'Post Style:', 'mercia' ); ?></label><br/>
			<select id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">
				<option <?php selected( $settings['style'], 'regular' ); ?> value="default" ><?php esc_html_e( 'Default', 'mercia' ); ?></option>
				<option <?php selected( $settings['style'], 'overlay' ); ?> value="overlay" ><?php esc_html_e( 'Image Overlay', 'mercia' ); ?></option>
			</select>
		</p>

		<?php
	}
}

/**
 * Register Widget
 */
function mercia_register_magazine_posts_grid_widget() {

	register_widget( 'Mercia_Magazine_Grid_Widget' );

}
add_action( 'widgets_init', 'mercia_register_magazine_posts_grid_widget' );
