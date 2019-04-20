<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_admin_enqueue( $hook ) {
	if ( 'elementor_page_sina_ext_settings' == $hook ) {
		wp_enqueue_style( 'sina-admin-style', SINA_EXT_URL .'admin/assets/css/sina-admin.css', [], SINA_EXT_VERSION );
		wp_enqueue_style( 'sina-admin-scripts', SINA_EXT_URL .'admin/assets/css/sina-admin.js', [], SINA_EXT_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'sina_admin_enqueue' );
