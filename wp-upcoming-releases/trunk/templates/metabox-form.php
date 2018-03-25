<table class="form-table">
  <tr valign="top">
    <th scope="row">
      <label for="has_wpur_classification">
        <?php _e( 'Age Rating:', 'wp-upcoming-releases' ); ?>
      </label>
    </th>
    <td>
      <input
        type="text"
        id="has_wpur_classification"
        name="has_wpur_classification"
        size="35"
        value="<?php echo $classification; ?>"
      >
    </td>
  </tr>

  <tr valign="top">
    <th scope="row">
      <label for="has_wpur_release_date">
        <?php _e( 'Release date:', 'wp-upcoming-releases' ); ?>
      </label>
    </th>
    <td>
      <input
        type="text"
        id="has_wpur_release_date"
        name="has_wpur_release_date"
        size="35"
        value="<?php echo $release_date; ?>"
      >
    </td>
  </tr>
</table>
