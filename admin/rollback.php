<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_ext_rollback() {
	check_admin_referer( 'sina_ext_rollback' );

	require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

	$upgrader_args = [
		'url' => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( SINA_EXT_SLUG ),
		'plugin' => SINA_EXT_SLUG,
		'nonce' => 'upgrade-plugin_' . SINA_EXT_SLUG,
		'title' => __( 'Rollback to Previous Version', 'sina-ext' ),
	];

	$upgrader = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $upgrader_args ) );
	$upgrader->upgrade( SINA_EXT_SLUG );

	die();
}
add_action( 'wp_ajax_sina_ext_rollback', 'sina_ext_rollback' );