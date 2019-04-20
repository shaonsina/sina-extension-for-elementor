<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Rollback;

function sina_ext_rollback() {
	check_admin_referer( 'sina_ext_rollback' );

	$rollback = new Rollback(
		[
			'version' => SINA_EXT_PREVIOUS_VERSION,
			'plugin_name' => SINA_EXT_SLUG,
			'plugin_slug' => SINA_EXT_SLUG,
			'package_url' => sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', SINA_EXT_SLUG, SINA_EXT_PREVIOUS_VERSION ),
		]
	);

	$rollback->run();

	wp_die(
		'', __( 'Rollback to Previous Version', 'sina-ext' ), [
			'response' => 200,
		]
	);
}
add_action( 'admin_post_sina_ext_rollback', 'sina_ext_rollback' );