<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_admin_enqueue( $hook ) {
	if ( 'elementor_page_sina_ext_settings' == $hook ) {
		// CSS Files
		wp_enqueue_style( 'sina-admin-style', SINA_EXT_URL .'admin/assets/css/sina-admin.min.css', [], SINA_EXT_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'sina_admin_enqueue' );
