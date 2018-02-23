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
            __( 'Upcoming Releases', 'wp-upcoming-releases' ),
            $widget_args
        );
    }

    /**
     * Back-End widget form
     *
     * A form with configurable options to control how widget is displayed.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    function form( $instance ) {
        $defaults = array(
            'title'         => __( 'Upcoming Releases', 'wp-upcoming-releases' ),
            'show_releases' => 4
        );

        $instance = wp_parse_args( (array) $instance, $defaults );

        $title      = sanitize_text_field( $instance['title'] );
        $perPage    = (int) sanitize_text_field( $instance['show_releases'] );
        $showLabels = (int) sanitize_text_field( $instance['show_labels'] );

        $data = array(
            'title'   => array(
                'id'    => $this->get_field_id( 'title' ),
                'name'  => $this->get_field_name( 'title' ),
                'value' => $title
            ),

            'perPage' => array(
                'id'    => $this->get_field_id( 'show_releases' ),
                'name'  => $this->get_field_name( 'show_releases' ),
                'value' => $perPage
            ),

            'showLabels' => array(
                'idNo'  => $this->get_field_id( 'show_labels_no' ),
                'idYes' => $this->get_field_id( 'show_labels_yes' ),
                'name'  => $this->get_field_name( 'show_labels' ),
                'value' => $showLabels
            )
        );

        require WPUR_PATH . '/templates/widget-form.php';
    }

    /**
     * Sanitize values
     *
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
        $instance = $old_instance;

        $instance['title']       = sanitize_text_field( $new_instance['title'] );
        $instance['title']       = ( $instance['title'] ) ? $instance['title'] : __( 'Upcoming Releases', 'wp-upcoming-releases' );
        $instance['show_labels'] = (int) sanitize_text_field( $new_instance['show_labels'] );

        $perPage    = (int) sanitize_text_field( $new_instance['show_releases'] );
        $showLabels = (int) sanitize_text_field( $new_instance['show_labels'] );

        $instance['show_releases'] = ( $perPage > 0 && $perPage <= 10 ) ? $perPage : 4;
        $instance['show_labels']   = ( $showLabels ) ? 1 : 0;

        return $instance;
    }

    /**
     * Widget Front-End display.
     *
     * @see WP_Widget::widget()
     *
     * @param array $arguments Widget arguments.
     * @param array $instance  Saved values from database.
     */
    function widget( $arguments, $instance ) {
        /**
         * Widget Title
         */
        $before_title = empty($arguments['before_title']) ? '' : $arguments['before_title'];
        $after_title  = empty($arguments['after_title'])  ? '' : $arguments['after_title'];
        $title        = apply_filters( 'widget_title', $instance['title'] );
        $title        = empty( $title ) ? '' : $title;
        $title        = $before_title . $title . $after_title;

        /**
         * Widget Options
         */
        $perPage    = empty( $instance['show_releases'] ) ? 4 : (int) $instance['show_releases'];
        $showLabels = empty( $instance['show_labels'] ) ? 0 : (int) $instance['show_labels'];

        /**
         * WP Query
         */
        $criteria = array( 'post_type' => 'has_releases', 'posts_per_page' => $perPage );
        $storage  = new WP_Query();
        $releases = $storage->query($criteria);

        /**
         * Template data
         */
        $data = array(
            'title'      => $title,
            'releases'   => $releases,
            'showLabels' => $showLabels
        );

        echo empty( $arguments['before_widget'] ) ? '' : $arguments['before_widget'];

        require_once WPUR_PATH . '/templates/releases-list.php';

        echo empty( $arguments['after_widget'] ) ? '' : $arguments['after_widget'];
    }
}

// register has_wpur_widget widget.
function has_wpur_register_widget() {
    register_widget( 'has_wpur_widget' );
}

add_action( 'widgets_init', 'has_wpur_register_widget' );
