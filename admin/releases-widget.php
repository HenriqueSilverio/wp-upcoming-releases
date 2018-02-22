<?php
/**
 * Adds has_wpur_widget widget.
 */
class has_wpur_widget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$widget_args = array(
			'classname'   => 'has_wpur_widget',
			'description' => __( 'Displays a list of your upcoming releases.', 'wp-upcoming-releases' )
		);

		parent::__construct(
			'has_wpur_widget',
			__( 'Next Releases', 'wp-upcoming-releases' ),
			$widget_args
		);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form( $instance ) {
		$defaults = array(
			'title'         => __( 'Next Releases', 'wp-upcoming-releases' ),
			'show_releases' => 4
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title         = $instance['title'];
		$show_releases = $instance['show_releases'];
		$show_labels   = isset($instance['show_labels']) ? $instance['show_labels'] : '0';
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_releases' ); ?>">
				<strong><?php _e( 'Title:', 'wp-upcoming-releases' ); ?></strong>
			</label>
			<input type="text"
				   class="widefat"
				   name="<?php echo $this->get_field_name( 'title' ); ?>"
				   id="<?php echo $this->get_field_id( 'show_releases' ); ?>"
				   value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'show_releases' ); ?>">
				<strong><?php _e( 'Number of releases to show:', 'wp-upcoming-releases' ); ?></strong>
			</label>
			<input type="text"
				   size="2"
				   maxlength="2"
				   name="<?php echo $this->get_field_name( 'show_releases' ); ?>"
				   id="<?php echo $this->get_field_id( 'show_releases' ); ?>"
				   value="<?php echo esc_attr( $show_releases ); ?>">
		</p>

		<p>
			<strong><?php _e( 'Show item labels?', 'wp-upcoming-releases' ); ?></strong> <br>

			<input type="radio"
				   name="<?php echo $this->get_field_name( 'show_labels' ); ?>"
				   id="<?php echo $this->get_field_id( 'show_labels_no' ); ?>"
				   value="0"
				   <?php checked( '0', $show_labels ); ?>
				   data-val="<?php echo $show_labels; ?>">
			<label for="<?php echo $this->get_field_id( 'show_labels_no' ); ?>">
				<?php _e( 'No', 'wp-upcoming-releases' ) ?>
			</label> <br>

			<input type="radio"
				   name="<?php echo $this->get_field_name( 'show_labels' ); ?>"
				   id="<?php echo $this->get_field_id( 'show_labels_yes' ); ?>"
				   value="1"
				   <?php checked( '1', $show_labels ); ?>
				   data-val="<?php echo $show_labels; ?>">
			<label for="<?php echo $this->get_field_id( 'show_labels_yes' ); ?>">
				<?php _e( 'Yes', 'wp-upcoming-releases' ) ?>
			</label>
		</p>

	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
		$instance =	$old_instance;

		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['show_labels'] = esc_attr( $new_instance['show_labels'] );

		if( is_numeric( $new_instance['show_releases'] ) && $new_instance['show_releases'] <= 10 ) {
			$instance['show_releases'] = strip_tags( $new_instance['show_releases'] );
		} else {
			$instance['show_releases'] = 0;
		}

		if( isset( $new_instance['show_labels'] ) && ( $new_instance['show_labels'] == '0' || $new_instance['show_labels'] == '1') ) {
			$instance['show_labels'] = esc_attr( $new_instance['show_labels'] );
		} else {
			$instance['show_labels'] = 0;
		}

		return $instance;
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
			require_once( WPUR_PATH . 'public/releases-view.php' );
		echo $after_widget;
	}
} // class has_wpur_widget

// register has_wpur_widget widget.
function has_wpur_register_widget() {
	register_widget( 'has_wpur_widget' );
}

add_action( 'widgets_init', 'has_wpur_register_widget' );
