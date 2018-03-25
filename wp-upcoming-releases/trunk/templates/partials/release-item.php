<?php
/**
 * Without label template
 *
 * Displays a release item without labels.
 *
 * Available variables:
 *
 *     array $itemData Attributes to use in template.
 *
 * @see has_wpur_widget::widget()
 */
?>

<?php if ( false === empty( $itemData['thumbSrc'] ) ) : ?>

  <div class="has-wpur-thumbnail">
    <img
      class="has-wpur-thumbnail__image"
      src="<?php esc_attr_e( $itemData['thumbSrc'] ); ?>"
      alt="<?php esc_attr_e( $itemData['title'] ); ?>"
    >
  </div>

<?php endif; ?>

<?php
  if (
    false === empty( $itemData['title'] )          ||
    false === empty( $itemData['classification'] ) ||
    false === empty( $itemData['category'] )       ||
    false === empty( $itemData['releaseDate'] )
  ) :
?>

  <div class="has-wpur-details">

    <?php if ( false === empty( $itemData['title'] ) ) : ?>

      <div class="has-wpur-text-group">
        <span class="has-wpur-text has-wpur-text--title">
          <?php esc_html_e( $itemData['title'] ); ?>
        </span>
      </div>

    <?php endif; ?>

    <?php if ( false === empty( $itemData['classification'] ) ) : ?>

      <div class="has-wpur-text-group">

        <?php if ( $itemData['showLabels'] ) : ?>

          <span class="has-wpur-label">
            <?php _e( 'Rating', 'wp-upcoming-releases' ); ?>:
          </span>

        <?php endif; ?>

        <span class="has-wpur-text">
          <?php esc_html_e( $itemData['classification'] ); ?>
        </span>

      </div>

    <?php endif; ?>

    <?php if ( false === empty( $itemData['category'] ) ) : ?>

      <div class="has-wpur-text-group">

        <?php if ( $itemData['showLabels'] ) : ?>

          <span class="has-wpur-label">
            <?php _e( 'Category', 'wp-upcoming-releases' ); ?>:
          </span>

        <?php endif; ?>

        <span class="has-wpur-text">
          <?php esc_html_e( $itemData['category'] ); ?>
        </span>

      </div>

    <?php endif; ?>

    <?php if ( false === empty( $itemData['releaseDate'] ) ) : ?>

      <div class="has-wpur-text-group">

        <?php if ( $itemData['showLabels'] ) : ?>

          <span class="has-wpur-label">
            <?php _e( 'Release Date', 'wp-upcoming-releases' ); ?>:
          </span>

        <?php endif; ?>

        <span class="has-wpur-text">
          <?php esc_html_e( $itemData['releaseDate'] ); ?>
        </span>

      </div>

    <?php endif; ?>

  </div>

<?php endif; ?>
