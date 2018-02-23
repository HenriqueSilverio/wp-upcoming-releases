<?php

function has_wpur_register_post_type() {
    $labels = array(
        'name'               => __( 'Releases', 'wp-upcoming-releases' ),
        'singular_name'      => __( 'Release', 'wp-upcoming-releases' ),
        'menu_name'          => __( 'Releases', 'wp-upcoming-releases' ),
        'all_items'          => __( 'All Releases', 'wp-upcoming-releases' ),
        'add_new'            => __( 'New Release', 'wp-upcoming-releases' ),
        'add_new_item'       => __( 'New Release', 'wp-upcoming-releases' ),
        'edit_item'          => __( 'Edit Release', 'wp-upcoming-releases' ),
        'new_item'           => __( 'New Release', 'wp-upcoming-releases' ),
        'view_item'          => __( 'View Release', 'wp-upcoming-releases' ),
        'search_items'       => __( 'Search Release', 'wp-upcoming-releases' ),
        'not_found'          => __( 'Not found release', 'wp-upcoming-releases' ),
        'not_found_in_trash' => __( 'Not found releases in trash', 'wp-upcoming-releases' )
    );

    $args = array(
        'labels'      => $labels,
        'description' => __( 'Register releases.', 'wp-upcoming-releases' ),
        'public'      => true,
        'menu_icon'   => 'dashicons-list-view',
        'supports'    => array( 'title', 'thumbnail' ),
        'rewrite'     => array( 'slug' => 'releases', 'with_front' => true )
    );

    register_post_type( 'has_releases', $args );
}

add_action( 'init', 'has_wpur_register_post_type' );
