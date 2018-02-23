<?php
/**
 * Widget Form
 *
 * Display a form to configure widgets options.
 *
 * Available variables:
 *
 *     array $data
 *
 * @see has_wpur_widget::form()
 */
?>

<p>
    <label for="<?php esc_attr_e( $data['title']['id'] ); ?>">
        <b><?php _e( 'Title:', 'wp-upcoming-releases' ); ?></b>
    </label>
    <input
        id="<?php esc_attr_e( $data['title']['id'] ); ?>"
        class="widefat"
        name="<?php esc_attr_e( $data['title']['name'] ); ?>"
        value="<?php esc_attr_e( $data['title']['value'] ); ?>"
        type="text"
    >
</p>

<p>
    <label for="<?php esc_attr_e( $data['perPage']['id'] ); ?>">
        <b><?php _e( 'Number of releases to show:', 'wp-upcoming-releases' ); ?></b>
    </label>
    <input
        id="<?php esc_attr_e( $data['perPage']['id'] ); ?>"
        class="tiny-text"
        type="number"
        size="2"
        min="1"
        max="10"
        setp="1"
        name="<?php esc_attr_e( $data['perPage']['name'] ); ?>"
        value="<?php esc_attr_e( $data['perPage']['value'] ); ?>"
    >
</p>

<p>
    <b><?php _e( 'Show item labels?', 'wp-upcoming-releases' ); ?></b>
</p>

<p>
    <input
        type="radio"
        id="<?php esc_attr_e( $data['showLabels']['idNo'] ); ?>"
        name="<?php esc_attr_e( $data['showLabels']['name'] ); ?>"
        value="0"
        data-val="<?php esc_attr_e( $data['showLabels']['value'] ); ?>"
        <?php checked( 0, $data['showLabels']['value'] ); ?>
    >
    <label for="<?php esc_attr_e( $data['showLabels']['idNo'] ); ?>">
        <?php _e( 'No', 'wp-upcoming-releases' ) ?>
    </label>

    <br>

    <input
        type="radio"
        id="<?php esc_attr_e( $data['showLabels']['idYes'] ); ?>"
        name="<?php esc_attr_e( $data['showLabels']['name'] ); ?>"
        value="1"
        data-val="<?php esc_attr_e( $data['showLabels']['value'] ); ?>"
        <?php checked( 1, $data['showLabels']['value'] ); ?>
    >
    <label for="<?php esc_attr_e( $data['showLabels']['idYes'] ); ?>">
        <?php _e( 'Yes', 'wp-upcoming-releases' ) ?>
    </label>
</p>
