<?php
/**
 * Widget template
 *
 * Displays the Upcoming Releases widget.
 *
 * Available variables:
 *
 *     array $data Attributes to use in template.
 *
 * @see has_wpur_widget::widget()
 */
?>

<?php echo $data['title']; ?>


<?php if ( empty( $data['releases'] ) ) : ?>

    <div class="has-wpur-alert has-wpur-alert--warning">
        <?php _e( 'Nothing new for now. Stay tuned!', 'wp-upcoming-releases' ); ?>
    </div>

<?php else : ?>

    <ul class="has-wpur-list">

        <?php foreach( $data['releases'] as $release ) : ?>

            <?php
                $thumbId        = get_post_meta( $release->ID, '_thumbnail_id', true );
                $thumbSrc       = wp_get_attachment_image_src( $thumbId, 'has_wpur_cover' );
                $classification = get_post_meta( $release->ID, 'has_wpur_classification', true );
                $categories     = wp_get_post_terms( $release->ID, 'has_wpur_category' );
                $releaseDate    = get_post_meta( $release->ID, 'has_wpur_release_date', true );

                $itemData = array(
                    'showLabels'     => $data['showLabels'],
                    'thumbSrc'       => empty( $thumbSrc ) ? false : $thumbSrc[0],
                    'title'          => $release->post_title,
                    'classification' => $classification,
                    'category'       => empty( $categories ) || is_wp_error( $categories ) ? '' : $categories[0]->name,
                    'releaseDate'    => $releaseDate,
                );
            ?>

            <li class="has-wpur-list__item">

                <?php require WPUR_PATH . '/templates/partials/release-item.php'; ?>

            </li>

        <?php endforeach; ?>

    </ul>

<?php endif; ?>
