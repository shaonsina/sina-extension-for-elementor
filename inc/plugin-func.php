<?php 

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * For activation
 *
 * @since 1.0.3
 */
function sina_activation() {
	add_option('sina_extension_activation', true);
}

/**
 * Redirect after activation
 *
 * @since 1.0.3
 */
function sina_redirection() {
	add_option( 'sina_widgets', SINA_WIDGETS);

	if ( get_option('sina_extension_activation', false ) ) {
		delete_option('sina_extension_activation');

		if ( ! is_network_admin() ) {
			wp_redirect("admin.php?page=sina_ext_settings");
		}
	}
}

/**
 * Create sub-page under 'Elementor' parent page
 *
 * @since 1.0.0
 */
function sina_create_admin_page() {
	add_filter( 'plugin_action_links_'. SINA_EXT_BASENAME, 'sina_settings_link' );
}

/**
 * Create settings link
 *
 * @since 1.0.0
 */
function sina_settings_link( $links ) {
	$links[] = '<a href="admin.php?page=sina_ext_settings">Settings</a>';
	return $links;
}

/**
 * Create widget category
 *
 * @since 1.0.0
 */
function sina_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'sina-extension',
		[
			'title' => __( 'Sina Basic Widgets', 'sina-ext' ),
			'icon' => 'fa fa-plug',
		]
	);
	$elements_manager->add_category(
		'sina-ext-advanced',
		[
			'title' => __( 'Sina Advaced Widgets', 'sina-ext' ),
			'icon' => 'fa fa-plug',
		]
	);
}

/**
 * Register widgets
 *
 * @since 2.0.0
 */
function sina_register_widgets( $widgets_manager ) {
	$active_widgets = get_option( 'sina_widgets' );

	if ( is_array($active_widgets) ) {
		foreach ($active_widgets as $cat => $widgets) {
			foreach ($widgets as $widget => $status) {
				$file = SINA_EXT_DIR .'/widgets/'.$cat.'/sina-'.$widget.'.php';
				if (1 == $status && file_exists( $file )) {
					require_once( $file );
					$widget = str_replace(' ', '_', ucwords( str_replace('-', ' ', $widget) ) );
					$widget = 'Sina_'.$widget.'_Widget';
					$widgets_manager->register_widget_type( new $widget() );
				}
			}
		}
	}
}
