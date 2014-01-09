<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package WP_Upcoming_Releases
 * @author Henrique Antonini Silvério <contato@henriquesilverio.com>
 * @license GPL-2.0+
 * @copyright 2013 Henrique Antonini Silvério
 */

// If uninstall not called from WordPress, then exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Widget
unregister_widget( 'has_wpur_widget' );

// Custom Post Types and Attachments
$all_posts = get_posts( array( 'post_type' => 'has_releases', 'fields' => 'ids') );

if( is_array( $all_posts ) ) {
	foreach( $all_posts as $post ) {
		$all_attachs = get_children( array( 'post_parent' => $post ) );

		if( is_array( $all_attachs ) ) {
			foreach( $all_attachs as $attach ) {
				$attach_id = $attach->ID;
				$file      = get_attached_file( $attach_id );

				wp_delete_attachment( $attach_id, true );
				unlink( $file );
			}
		}
		
		wp_delete_post( $post, true );
	}
}

// Taxonomies and Terms					
global $wp_taxonomies;
$taxonomy = 'has_wpur_category';
$terms    = get_terms( $taxonomy );

if( $terms ) {
	foreach ($terms as $term) {
		wp_delete_term( $term->term_id, $taxonomy );
	}
}

unset( $wp_taxonomies[ $taxonomy ] );