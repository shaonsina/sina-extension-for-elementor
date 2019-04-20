<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_admin_enqueue( $hook ) {
	if ( 'elementor_page_sina_ext_settings' == $hook ) {
		// CSS Files
		wp_enqueue_style( 'sina-admin-style', SINA_EXT_URL .'admin/assets/css/sina-admin.css', [], SINA_EXT_VERSION );

		// JS Files
		$ajax_url = admin_url('admin-ajax.php');
		wp_enqueue_script( 'sina-admin-scripts', SINA_EXT_URL .'admin/assets/js/sina-admin.js', ['jquery'], SINA_EXT_VERSION );
		wp_localize_script( 'sina-admin-scripts', 'sinaAdminAjax', ['adminAjaxURL' => $ajax_url] );
	}
}
add_action( 'admin_enqueue_scripts', 'sina_admin_enqueue' );
