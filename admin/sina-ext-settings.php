<?php
namespace Sina_Extension\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Settings Class for settings panel
 *
 * @since 3.0.0
 */
class Sina_Ext_Settings{

	public function __construct() {
		add_action( 'admin_menu', [$this, 'add_submenu'], 550 );
		add_action( 'admin_enqueue_scripts', [$this, 'admin_scripts'] );
		add_action( 'admin_init', [$this, 'settings_group'] );
	}

	public function add_submenu() {
		add_submenu_page(
			'elementor',
			__('Sina Extension Settings', 'sina-ext'),
			__('Sina Extension', 'sina-ext'),
			'manage_options',
			'sina_ext_settings',
			[$this, 'page_content']
		);
	}

	public function admin_scripts( $hook ) {
		if ( 'elementor_page_sina_ext_settings' == $hook ) {
			// CSS Files
			wp_enqueue_style( 'sina-admin', SINA_EXT_URL .'admin/assets/css/sina-admin.min.css', [], SINA_EXT_VERSION );
		}
	}

	public function settings_group() {
		register_setting( 'sina_settings_group', 'sina_map_apikey' );
		register_setting( 'sina_settings_group', 'sina_mailchimp' );
		register_setting( 'sina_settings_group', 'sina_widgets' );
		register_setting( 'sina_settings_group', 'sina_templates_option' );

		add_settings_section( 'sina_api_section', '', '', 'sina_ext_settings' );
		add_settings_field( 'sina_google_map_key', __('Google Map API Key', 'sina-ext'), [$this, 'text_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_map_apikey'] );
		add_settings_field( 'sina_mailchimp_key', __('MailChimp API Key', 'sina-ext'), [$this, 'text_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_mailchimp', 'index' => 'apikey' ] );
		add_settings_field( 'sina_mailchimp_list_id', __('MailChimp List Id', 'sina-ext'), [$this, 'text_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_mailchimp', 'index' => 'list_id' ] );

		$templates = get_option( 'sina_templates_option' );
		add_settings_section( 'sina_templates_section', '', '', 'sina_ext_templates' );
		add_settings_field( 'sina_ext_templates_only', __('Sina Templates', 'sina-ext'), [$this, 'templates_option'], 'sina_ext_templates', 'sina_templates_section', ['temps' => 'templates_only', 'get_temps' => $templates] );

		$get_widgets = get_option( 'sina_widgets' );
		$set_widgets = SINA_WIDGETS;
		if ( defined('SINA_EXT_PRO_WIDGETS')) {
			$set_widgets = array_merge(SINA_WIDGETS, SINA_EXT_PRO_WIDGETS);
		}
		foreach ( $set_widgets as $cat => $widgets ) {
			$section = 'sina_'.$cat.'_widgets_section';
			$page = 'sina_widgets_'.$cat;
			add_settings_section( $section, '', '', $page );

			foreach ($widgets as $widget => $status) {
				add_settings_field( 'sina_'.str_replace('-', '_', $widget), __('Sina '. ucwords( str_replace('-', ' ', $widget) ), 'sina-ext'), [$this, 'widgets_ac_dc'], $page, $section, ['widget' => $widget, 'cat' => $cat, 'get_widgets' => $get_widgets]  );
			}
		}
	}

	public function page_content() {
		require SINA_EXT_ADMIN.'partials/page-content.php';
	}

	public function text_field($field) {
		$data = get_option( $field['key'] );
		$key = $field['key'];

		if ( is_array($data) ) {
			$data = $data[ $field['index'] ];
			$key = $key.'['. $field['index'] .']';
		}
		$data = sanitize_text_field( $data );
		printf('<input class="regular-text" type="text" name="%s" value="%s">', $key, $data);
	}

	public function templates_option($data) {
		$get_temps 	= $data['get_temps'];
		$temps 		= $data['temps'];
		$name 		= 'sina-'.$temps;
		$checked	= isset($get_temps[ $temps ]) && 1 == $get_temps[ $temps ] ? 'checked' : '';
		$key		= 'sina_templates_option['.$temps.']';

		require SINA_EXT_ADMIN.'partials/switch.php';
	}

	public function widgets_ac_dc($data) {
		$widgets 	= $data['get_widgets'];
		$widget 	= $data['widget'];
		$cat 		= $data['cat'];
		$name 		= 'sina-'.$widget;
		$checked	= isset($widgets[ $cat ][ $widget ]) && 1 == $widgets[ $cat ][ $widget ] ? 'checked' : '';
		$key 		= 'sina_widgets['.$cat.']['. $widget .']';

		require SINA_EXT_ADMIN.'partials/switch.php';
	}
}