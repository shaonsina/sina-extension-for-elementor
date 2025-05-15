<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Extension_Activation Class for activation functionality
 *
 * @since 3.7.0
 */
class Sina_Extension_Activation{
	public static function activation() {
		add_option( 'sina_extension_activation', true );
		$data = get_option( 'sina_widgets' );
		if ( !empty($data) ) {
			$data = array_merge(SINA_WIDGETS, $data);
			update_option( 'sina_widgets', $data);
		} else{
			update_option( 'sina_widgets', SINA_WIDGETS);
		}
		add_option( 'sina_map_apikey', '' );
		add_option( 'sina_mailchimp', [
			'apikey'	=> '',
			'list_id'	=> '',
		] );
		add_option( 'sina_templates_option', [] );
	}
}