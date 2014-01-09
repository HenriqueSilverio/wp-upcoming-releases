<?php

/**
 * @package   WP_Upcoming_Releases
 * @author    Henrique Antonini Silvério <contato@henriquesilverio.com>
 * @license   GPL-2.0+
 * @copyright 2013 Henrique Antonini Silvério
 *
 * Plugin Name: WP Upcoming Releases
 * Plugin URI:  https://github.com/HenriqueSilverio/wp-upcoming-releases
 * Description: Display a widget with a list of upcoming releases of games, books, films, music albums and what you want. Easy management with custom post types.
 * Version:     1.0.0
 * Author:      Henrique Antonini Silvério
 * Author URI:  http://henriquesilverio.com/
 * License:     GPL-2.0+
 *
 * Copyright 2013 Henrique Antonini Silvério <contato@henriquesilverio.com>
 *	
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *	
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *	
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Define some util globals
if( ! defined( 'WPUR_PATH' ) ) {
	define( 'WPUR_PATH', plugin_dir_path( __FILE__ ) );
}

// Text domain
load_plugin_textdomain( 'wp-upcoming-releases', false, 'wp-upcoming-releases/languages' );


/*----------------------------------------------------------------------------
 Styles and Scripts
----------------------------------------------------------------------------*/

/**
 * Register plugin styles
 */
function has_wpur_register_styles() {
	wp_register_style(
		'has_wpur_admin',
		plugins_url( 'admin/css/admin.css', __FILE__ )
	);

	wp_register_style(
		'has_wpur_public',
		plugins_url( 'public/css/public.css', __FILE__ )
	);
}

add_action( 'wp_enqueue_scripts', 'has_wpur_register_styles' );


/**
 * Enqueue admin styles
 */
function has_wpur_enqueue_admin_styles( $hook ) {
	global $post;
	$has_post_type = 'has_releases';
	
	if( $hook == 'post-new.php' || $hook == 'post.php' ) {
		if( 'has_releases' == $post->post_type ) {
			wp_enqueue_style( 
				'has_wpur_admin',
				plugins_url( 'admin/css/admin.css', __FILE__ )
			);
		}
	}
}

add_action( 'admin_enqueue_scripts', 'has_wpur_enqueue_admin_styles', 10, 1 );


/**
 * Enqueue public styles
 */
function has_wpur_enqueue_public_styles() {
	wp_enqueue_style( 'has_wpur_public' );
}

add_action( 'wp_enqueue_scripts', 'has_wpur_enqueue_public_styles' );


/*----------------------------------------------------------------------------
 Post type, Metabox, Taxonomy, Widget
----------------------------------------------------------------------------*/

/**
 * Custom Post Type
 */
require_once( plugin_dir_path( __FILE__ ) . '/admin/releases-cpt.php' );


/**
 * Metabox
 */
require_once( plugin_dir_path( __FILE__ ) . '/admin/releases-metabox.php' );


/**
 * Taxonomy
 */
require_once( plugin_dir_path( __FILE__ ) . '/admin/releases-taxonomy.php' );


/**
 * Widget
 */
require_once( plugin_dir_path( __FILE__ ) . '/admin/releases-widget.php' );


/**
 * Image size
 */
if( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
	add_image_size( 'has_wpur_cover', 77, 105 );
}