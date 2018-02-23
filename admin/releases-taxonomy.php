<?php

function has_wpur_register_taxonomy() {
    $args = array(
        'hierarchical'      => false,
        'label'             => __( 'Categories', 'wp-upcoming-releases' ),
        'query_var'         => 'category',
        'rewrite'           => array( 'slug' => 'category' ),
        'show_admin_column' => true
    );

    register_taxonomy( 'has_wpur_category', 'has_releases', $args );
}

add_action( 'init', 'has_wpur_register_taxonomy' );
