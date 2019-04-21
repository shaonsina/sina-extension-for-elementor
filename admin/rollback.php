<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_print_inline_style() {
	?>
	<style>
		.wrap {
			overflow: hidden;
		}

		h1 {
			background: #1085e4;
			text-align: center;
			color: #fff !important;
			padding: 70px !important;
			text-transform: uppercase;
			letter-spacing: 1px;
		}
	</style>
	<?php
}

function sina_apply_package() {
	$update_plugins = get_site_transient( 'update_plugins' );
	if ( ! is_object( $update_plugins ) ) {
		$update_plugins = new \stdClass();
	}

	$plugin_info = new \stdClass();
	$plugin_info->new_version = SINA_EXT_PREVIOUS_VERSION;
	$plugin_info->slug = SINA_EXT_SLUG;
	$plugin_info->package = sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', SINA_EXT_SLUG, SINA_EXT_PREVIOUS_VERSION );
	$plugin_info->url = 'https://wordpress.org/plugins/sina-extension-for-elementor';

	$update_plugins->response[ SINA_EXT_SLUG ] = $plugin_info;

	set_site_transient( 'update_plugins', $update_plugins );
}

function sina_upgrade() {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

	$upgrader_args = [
		'url' => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( SINA_EXT_SLUG ),
		'plugin' => SINA_EXT_SLUG,
		'nonce' => 'upgrade-plugin_' . SINA_EXT_SLUG,
		'title' => __( 'Sina Extension Rollback to Previous Version', 'sina-ext' ),
	];

	sina_print_inline_style();

	$upgrader = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $upgrader_args ) );
	$upgrader->upgrade( SINA_EXT_SLUG );
}


function sina_ext_rollback() {
	check_admin_referer( 'sina_ext_rollback' );

	sina_apply_package();
	sina_upgrade();

	wp_die(
		'', __( 'Rollback to Previous Version', 'sina-ext' ), [
			'response' => 200,
		]
	);
}
add_action( 'admin_post_sina_ext_rollback', 'sina_ext_rollback' );