<?php
function sina_add_submenu() {
	add_submenu_page(
		'elementor',
		__('Sina Extension Settings', 'sina-ext'),
		__('Sina Extension', 'sina-ext'),
		'manage_options',
		'sina_ext_settings',
		'sina_page_content'
	);

	add_option( 'sina_map_apikey', '' );
	add_action( 'admin_init', 'sina_settings_group' );
}
add_action( 'admin_menu', 'sina_add_submenu', 550 );

function sina_settings_group() {
	register_setting( 'sina_settings_group', 'sina_map_apikey' );

	add_settings_section( 'sina_ext_section', '', '', 'sina_ext_settings' );

	add_settings_field( 'sina_google_map_key', __('Google Map API Key', 'sina-ext'), 'sina_map_api_key', 'sina_ext_settings', 'sina_ext_section' );
}

function sina_page_content() {
	?>
	<h1><?php echo esc_html( 'Sina Extension Settings' ); ?></h1>
	<p><?php _e('Thank you for using <strong><i>Sina Extension</i></strong>. This plugin has been developed by <a href="https://github.com/shaonsina" target="_blank">shaonsina</a> and I hope you enjoy using it.', 'sina-ext'); ?></p>
	<form action="options.php" method="POST">
	<?php
		settings_errors();
		do_settings_sections( 'sina_ext_settings' );
		settings_fields( 'sina_settings_group' );
		submit_button();
	?>
		<div>
		    <p>Did you like <strong><i>Sina Extension</i></strong> Plugin? Please <a href="https://wordpress.org/support/plugin/sina-extension-for-elementor/reviews/#new-post" target="_blank">Click Here to Rate it ★★★★★</a></p>
		</div>
	</form>
	<?php
}

function sina_map_api_key() {
	?>
	<input type="text" class="regular-text" name="sina_map_apikey" value="<?php echo esc_attr( get_option( 'sina_map_apikey' ) ); ?>">
	<?php
}