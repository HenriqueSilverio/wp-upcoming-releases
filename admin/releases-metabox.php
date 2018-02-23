<?php
/**
 * Register
 */
function has_wpur_register_metabox() {
    add_meta_box(
        'has-wpur-metabox',
        __( 'Additional informations', 'wp-upcoming-releases' ),
        'has_wpur_metabox_render',
        'has_releases',
        'normal',
        'high'
    );
}

/**
 * Display
 */
function has_wpur_metabox_render( $post ) {
    $values         = get_post_custom( $post->ID );
    $classification = isset( $values['has_wpur_classification'] ) ? esc_attr( $values['has_wpur_classification'][0] ) : '';
    $release_date   = isset( $values['has_wpur_release_date'] )   ? esc_attr( $values['has_wpur_release_date'][0]   ) : '';

    wp_nonce_field( 'has_wpur_metabox_nonce', 'has_wpur_nonce' );
?>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">
                <label for="has_wpur_classification">
                    <?php _e( 'Age Rating:', 'wp-upcoming-releases' ); ?>
                </label>
            </th>
            <td>
                <input type="text"
                       id="has_wpur_classification"
                       name="has_wpur_classification"
                       size="35"
                       value="<?php echo $classification; ?>">
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">
                <label for="has_wpur_release_date">
                    <?php _e( 'Release date:', 'wp-upcoming-releases' ); ?>
                </label>
            </th>
            <td>
                <input type="text"
                       id="has_wpur_release_date"
                       name="has_wpur_release_date"
                       size="35"
                       value="<?php echo $release_date; ?>">
            </td>
        </tr>
    </table>
<?php }

/**
 * Save
 */
function has_wpur_metabox_save( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if( false == isset( $_POST['has_wpur_nonce'] ) || false == wp_verify_nonce( $_POST['has_wpur_nonce'], 'has_wpur_metabox_nonce' ) ) {
        return;
    }

    if( false == current_user_can( 'edit_post' ) ) {
        return;
    }

    if( isset( $_POST['has_wpur_classification'] ) ) {
        update_post_meta( $post_id, 'has_wpur_classification', esc_attr( $_POST['has_wpur_classification'] ) );
    }

    if( isset( $_POST['has_wpur_release_date'] ) ) {
        update_post_meta( $post_id, 'has_wpur_release_date', esc_attr( $_POST['has_wpur_release_date'] ) );
    }
}

/**
 * Hooks
 */
add_action( 'add_meta_boxes', 'has_wpur_register_metabox' );
add_action( 'save_post', 'has_wpur_metabox_save' );
