<?php
/**
 * Plugin Name: WP Upcoming Releases
 * Plugin URI:  https://github.com/HenriqueSilverio/wp-upcoming-releases
 * Description: Widget to show a list of upcoming releases: movies, games, musics, or any other thing your creative ideas needs. Easy management with custom post types and categories.
 * Version:     1.2.0
 * Author:      Henrique Silvério
 * Author URI:  https://henriquesilverio.com.br
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: wp-upcoming-releases
 * Domain Path: languages
 *
 * Copyright (C) 2014 ~ 2018 Henrique Silvério
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

// If this file is called directly, abort.
if ( false === defined( 'ABSPATH' ) ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    die();
}

// Define some util globals
if( false === defined( 'WPUR_PATH' ) ) {
    define( 'WPUR_PATH', dirname( __FILE__ ) );
}

// Text domain
function loadUpcomingReleasesDomain () {
    load_plugin_textdomain( 'wp-upcoming-releases', false, WPUR_PATH . '/languages' );
}

add_action( 'init', 'loadUpcomingReleasesDomain' );

/*------------------------------------------------------------------------------
 Styles and Scripts
------------------------------------------------------------------------------*/

/**
 * Enqueue admin styles
 */
function has_wpur_enqueue_admin_styles( $hook ) {
    if ( false === in_array( $hook, array( 'post.php', 'post-new.php' ) ) ) {
        return;
    }

    $screen = get_current_screen();

    if ( false === ( is_object( $screen ) && 'has_releases' === $screen->post_type ) ) {
        return;
    }

    wp_enqueue_style(
        'has-wpur-admin',
        plugins_url( 'assets/css/admin.css', __FILE__ ),
        array(),
        null,
        'all'
    );
}

add_action( 'admin_enqueue_scripts', 'has_wpur_enqueue_admin_styles', 10, 1 );

/**
 * Enqueue public styles
 */
function has_wpur_enqueue_public_styles() {
    wp_enqueue_style(
        'has-wpur-public',
        plugins_url( 'assets/css/public.css', __FILE__ ),
        array(),
        null,
        'all'
    );
}

add_action( 'wp_enqueue_scripts', 'has_wpur_enqueue_public_styles' );

/*------------------------------------------------------------------------------
 Post type, Metabox, Taxonomy, Widget
------------------------------------------------------------------------------*/

/**
 * Custom Post Type
 */
require_once WPUR_PATH . '/admin/releases-cpt.php';

/**
 * Metabox
 */
require_once WPUR_PATH . '/admin/releases-metabox.php';

/**
 * Taxonomy
 */
require_once WPUR_PATH . '/admin/releases-taxonomy.php';

/**
 * Widget
 */
require_once WPUR_PATH . '/admin/releases-widget.php';

/**
 * Add Thumbnails support and custom Image size
 */
function addUpcomingReleasesThumbnail () {
    add_theme_support( 'post-thumbnails', array( 'has_releases' ) );
    add_image_size( 'has_wpur_cover', 90, 120 );
}

add_action( 'after_setup_theme', 'addUpcomingReleasesThumbnail' );

/**
 * Add Upcoming Releases Cover selectable from Media Library dropdown
 */
function upcomingReleasesImageSizeName( $sizes ) {
    return array_merge( $sizes, array(
        'has_wpur_cover' => __( 'Upcoming Release Cover', 'wp-upcoming-releases' ),
    ) );
}

add_filter( 'image_size_names_choose', 'upcomingReleasesImageSizeName' );
