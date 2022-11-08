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
	/**
	 * Instance
	 *
	 * @since 3.1.13
	 * @var Sina_Ext_Settings The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.1.13
	 * @return Sina_Ext_Settings An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_action( 'admin_menu', [$this, 'add_submenu'], 550 );
		add_action( 'admin_init', [$this, 'settings_group'] );
		add_action( 'admin_enqueue_scripts', [$this, 'admin_scripts'] );
	}

	public function add_submenu() {
		add_submenu_page(
			'elementor',
			esc_html__('Sina Extension Settings', 'sina-ext'),
			esc_html__('Sina Extension', 'sina-ext'),
			'manage_options',
			'sina_ext_settings',
			[$this, 'page_content']
		);
	}

	public function admin_scripts( $hook ) {
		if ( 'elementor_page_sina_ext_settings' == $hook || '%d8%a7%d9%84%d9%85%d9%86%d8%aa%d9%88%d8%b1_page_sina_ext_settings' == $hook ) {
			// CSS Files
			wp_enqueue_style( 'sina-admin', SINA_EXT_URL .'admin/assets/css/sina-admin.min.css', [], SINA_EXT_VERSION );

			// JS Files
			if ( !defined('SINA_EXT_PRO_VERSION') ) {
				wp_enqueue_script( 'sweetalert2', SINA_EXT_URL .'admin/assets/js/sweetalert2.min.js', ['jquery'], SINA_EXT_VERSION );
			}
			wp_enqueue_script( 'sina-admin', SINA_EXT_URL .'admin/assets/js/sina-admin.min.js', ['jquery'], SINA_EXT_VERSION );
		}
	}

	public function settings_group() {
		register_setting( 'sina_settings_group', 'sina_map_apikey' );
		register_setting( 'sina_settings_group', 'sina_mailchimp' );
		register_setting( 'sina_settings_group', 'sina_widgets' );
		register_setting( 'sina_settings_group', 'sina_templates_option' );
		register_setting( 'sina_settings_group', 'sina_extenders' );
		register_setting( 'sina_settings_group', 'sina_ext_pro_recaptcha_key' );
		register_setting( 'sina_settings_group', 'sina_ext_pro_recaptcha_secret_key' );
		register_setting( 'sina_settings_group', 'sina_ext_after_logout_url' );

		add_settings_section( 'sina_api_section', '', '', 'sina_ext_settings' );
		add_settings_field( 'sina_google_map_key', esc_html__('Google Map API Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_map_apikey'] );
		add_settings_field( 'sina_mailchimp_key', esc_html__('MailChimp API Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_mailchimp', 'index' => 'apikey' ] );
		add_settings_field( 'sina_mailchimp_list_id', esc_html__('MailChimp List Id', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_mailchimp', 'index' => 'list_id' ] );
		add_settings_field( 'sina_ext_pro_recaptcha_key', esc_html__('Google Recaptcha Site Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_ext_pro_recaptcha_key'] );
		add_settings_field( 'sina_ext_pro_recaptcha_secret_key', esc_html__('Google Recaptcha Secret Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_ext_pro_recaptcha_secret_key'] );
		add_settings_field( 'sina_ext_after_logout_url', esc_html__('After Logout Redirect URL', 'sina-ext'), [$this, 'text_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_ext_after_logout_url'] );


		$templates = get_option( 'sina_templates_option' );
		add_settings_section( 'sina_templates_section', '', '', 'sina_ext_templates' );
		add_settings_field( 'sina_ext_templates_only', esc_html__('Sina Templates', 'sina-ext'), [$this, 'templates_option'], 'sina_ext_templates', 'sina_templates_section', ['temps' => 'templates_only', 'get_temps' => $templates] );

		$get_widgets = get_option( 'sina_widgets' );
		$set_widgets = SINA_WIDGETS;
		if ( defined('SINA_EXT_PRO_WIDGETS') ) {
			$set_widgets = array_merge(SINA_WIDGETS, SINA_EXT_PRO_WIDGETS);
		}
		foreach ( $set_widgets as $cat => $widgets ) {
			$section = 'sina_'.$cat.'_widgets_section';
			$page = 'sina_widgets_'.$cat;
			add_settings_section( $section, '', '', $page );

			foreach ($widgets as $widget => $trans) {
				add_settings_field( 'sina_'.str_replace('-', '_', $widget), '', [$this, 'widgets_switcher'], $page, $section, ['widget' => $widget, 'translate' => $trans, 'cat' => $cat, 'get_widgets' => $get_widgets]  );
			}
		}

		// Extenders section
		$get_extenders = get_option( 'sina_extenders' );
		$set_extenders = SINA_EXTENDERS;
		if ( defined('SINA_EXT_PRO_EXTENDERS') ) {
			$set_extenders = array_merge(SINA_EXTENDERS, SINA_EXT_PRO_EXTENDERS);
		}
		add_settings_section( 'sina_extenders_section', '', '', 'sina_extenders' );
		foreach ($set_extenders as $type => $extenders) {
			foreach ($extenders as $extender => $translate) {
				add_settings_field( 'sina_ext'.str_replace('-', '_', $extender), '', [$this, 'extenders_switcher'], 'sina_extenders', 'sina_extenders_section', ['extender' => $extender, 'translate' => $translate, 'type' => $type, 'get_extenders' => $get_extenders]  );
			}
		}
	}

	public function page_content() {
		require SINA_EXT_ADMIN.'partials/page-content.php';
	}

	public function text_field($field) {
		$data = get_option( $field['key'] );
		$key  = $field['key'];

		if ( is_array($data) ) {
			$data = $data[ $field['index'] ];
			$key = $key.'['. $field['index'] .']';
		}
		$data = sanitize_text_field( $data );
		printf('<input class="regular-text" type="text" name="%s" value="%s">', $key, $data);
	}

	public function password_field($field) {
		$data = get_option( $field['key'] );
		$key  = $field['key'];

		if ( is_array($data) ) {
			$data = $data[ $field['index'] ];
			$key = $key.'['. $field['index'] .']';
		}
		$data = sanitize_text_field( $data );
		printf('<input class="regular-text" type="password" name="%s" value="%s">', $key, $data);
	}

	public function templates_option($data) {
		$get_temps 	= $data['get_temps'];
		$temps 		= $data['temps'];
		$name 		= 'sina-'.$temps;
		$label 		= esc_html__('Sina Templates', 'sina-ext');
		$pro 		= '';
		$checked	= isset($get_temps[ $temps ]) ? 'checked' : '';
		$key		= 'sina_templates_option['.$temps.']';
		require SINA_EXT_ADMIN.'partials/switch.php';
	}

	public function widgets_switcher($data) {
		$widgets 	= $data['get_widgets'];
		$widget 	= $data['widget'];
		$cat 		= $data['cat'];
		$name 		= 'sina-'.$widget;
		$pro 		= ( !defined('SINA_EXT_PRO_VERSION') && ('pro' == $cat || 'wooCommerce' == $cat) ) ? 'sina-ext-pro' : '';
		$checked	= isset($widgets[ $cat ][ $widget ]) ? 'checked' : '';
		$key 		= 'sina_widgets['.$cat.']['. $widget .']';

		if (defined('SINA_EXT_PRO_VERSION') && ('pro' == $cat || 'wooCommerce' == $cat)) {
			$label 	= __( $data['translate'], 'sina-ext-pro' );
		} else{
			$label	= __( $data['translate'], 'sina-ext' );
		}
		require SINA_EXT_ADMIN.'partials/switch.php';
	}

	public function extenders_switcher($data) {
		$name 		= $data['extender'];
		$key 		= 'sina_extenders['.$name.']';
		$pro 		= ( !defined('SINA_EXT_PRO_VERSION') && 'pro' == $data['type'] ) ? 'sina-ext-pro' : '';
		$checked 	= isset($data[ 'get_extenders' ][ $name ]) ? 'checked' : '';
		$name 		= 'sina-'.$name;

		if (defined('SINA_EXT_PRO_VERSION') && 'pro' == $data['type']) {
			$label 	= __( $data['translate'], 'sina-ext-pro' );
		} else{
			$label	= __( $data['translate'], 'sina-ext' );
		}
		require SINA_EXT_ADMIN.'partials/switch.php';
	}
}