<?php
/**
 * Widget Title
 */
$title = apply_filters( 'widget_title', $instance['title'] );
if( isset( $title ) ) { echo $before_title . $title . $after_title; }

/**
 * WP Query
 */
$show_releases = empty( $instance['show_releases'] ) ? 4 : (int) $instance['show_releases'];
$query         = array( 'post_type' => 'has_releases', 'posts_per_page' => $show_releases );
$release_query = new WP_Query( $query );

/**
 * Loop
 */
if( $release_query->have_posts() ) : 
	while( $release_query->have_posts() ) : $release_query->the_post();
		// Grab and define vars
		global $post;
		$cover;
		$release_title;
		$classification;
		$release_date;
		
		// Define values for vars
		$cover = ( has_post_thumbnail() ) ? get_the_post_thumbnail( $post->ID, 'has_wpur_cover' ) : '';
		
		$release_title = get_the_title( $post->ID );
		
		$classification = get_post_meta( $post->ID, 'has_wpur_classification', true );
		
		$release_date = get_post_meta( $post->ID, 'has_wpur_release_date', true );
		
		if( has_term( '', 'has_wpur_category' ) ) {
			$term_list     = wp_get_post_terms( $post->ID, 'has_wpur_category' );
			$category_name = $term_list[0]->name;
		}
		else{
			$category_name = __( 'No category', 'wp-upcoming-releases' );
		}

		// Mount the view
		$output = '
			<div class="has-wpur-box">
				<figure class="has-wpur-box__cover">' . $cover . '</figure>
				<span class="has-wpur-box__txt has-wpur-box__txt--title">' . $release_title . '</span>
				<span class="has-wpur-box__title">' . __( 'Age Rating', 'wp-upcoming-releases' ) . '</span> <span class="has-wpur-box__txt">' . $classification . '</span>
				<span class="has-wpur-box__title">' . __( 'Category', 'wp-upcoming-releases' ) . '</span> <span class="has-wpur-box__txt">' . $category_name . '</span>
				<span class="has-wpur-box__title">' . __( 'Release Date', 'wp-upcoming-releases' ) . '</span> <span class="has-wpur-box__txt">' . $release_date . '</span>
			</div>
		';

		// Display the view
		echo $output;
	endwhile;
else :
	$cotent = __( 'Not found releases.', 'wp-upcoming-releases' );
	echo '<p>' . $cotent . '<p>';
endif;
?>