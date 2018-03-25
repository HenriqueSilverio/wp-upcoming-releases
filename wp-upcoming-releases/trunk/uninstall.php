<?php
/**
 * Plugin uninstall
 *
 * Handles proper database clean up when plugin is deleted.
 *
 * @see https://developer.wordpress.org/plugins/the-basics/uninstall-methods/#method-2-uninstall-php
 */

// If uninstall not called from WordPress, then exit
if ( false === defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    die();
}

// Delete all `has_releases` posts
$all_posts = get_posts( array( 'post_type' => 'has_releases', 'fields' => 'ids') );

if( is_array( $all_posts ) ) {
    foreach( $all_posts as $post ) {
        wp_delete_post( $post, true );
    }
}

// Delete all `has_wpur_category` terms
$taxonomy = 'has_wpur_category';
$terms    = get_terms( $taxonomy );

if( is_array( $terms ) ) {
    foreach ($terms as $term) {
        wp_delete_term( $term->term_id, $taxonomy );
    }
}
