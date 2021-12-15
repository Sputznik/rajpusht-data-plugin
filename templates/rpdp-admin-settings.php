<?php

	if( isset( $_POST['submit'] ) && isset( $_POST['rpdp_settings'] ) ){
		$this->writeSettings( $_POST['rpdp_settings'] );
	}

	$settings = $this->getSettings();

	$fields = array(
		'api_key' => array(
			'label'       => 'API KEY',
			'type'				=> 'text'
		),
		'cache_time' => array(
			'label'       => 'Cache Time ( in minutes )',
			'type'				=> 'number'
		)
	);
?>
<div class="wrap">
	<h1>Rajpusht Plugin Settings</h1>
  <form method="POST">
		<table class="form-table" role="presentation">
	    <tbody>
				<?php foreach( $fields as $slug => $field ): $field_value = isset( $settings[$slug] ) ? $settings[$slug] : ""; ?>
					<tr>
	          <th scope="row">
	            <label for="<?php _e( $slug );?>">
								<?php _e( $field['label'] );?>
							</label>
	          </th>
	          <td>
							<input type="<?php _e( $field['type'] );?>" id="<?php _e( $slug );?>" name="<?php _e( "rpdp_settings[$slug]" );?>" value="<?php _e( $field_value );?>" class="regular-text">
						</td>
				<?php endforeach;?>
			</tbody>
		</table>
    <p class='submit'><input type="submit" name="submit" class="button button-primary" value="Save Changes"><p>
  </form>
</div>
