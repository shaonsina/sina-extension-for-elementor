<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Extension_Base Class for basic functionality
 *
 * @since 3.0.0
 */
abstract class Sina_Extension_Base{
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		};

		$plugin = 'elementor/elementor.php';
		$plugins = get_plugins();

		if ( isset($plugins[ $plugin ]) ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

			$message = sprintf('<p>' . esc_html__( '"%1$s" requires "%2$s" to be activate.', 'sina-ext' ) . '</p>', '<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>', '<strong>' . esc_html__( 'Elementor', 'sina-ext' ) . '</strong>');

			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor', 'sina-ext' ) ) . '</p>';
		} else {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

			$message = sprintf('<p>' . esc_html__( '"%1$s" requires "%2$s" to be install.', 'sina-ext' ) . '</p>', '<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>', '<strong>' . esc_html__( 'Elementor', 'sina-ext' ) . '</strong>');

			$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor', 'sina-ext' ) ) . '</p>';
		}

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		};

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension Elementor', 'sina-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'sina-ext' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'sina-ext' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Load Action Hooks
	 *
	 * @since 3.0.0
	 */
	public function load_actions() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'admin_init', [$this, 'redirection'] );
		add_action( 'admin_post_sina_ext_rollback', ['Sina_Ext_Rollback', 'rollback'] );

		add_action( 'wp_ajax_sina_mc_subscribe', ['Sina_Ext_Hooks', 'mailchimp_subscribe'] );
		add_action( 'wp_ajax_nopriv_sina_mc_subscribe', ['Sina_Ext_Hooks', 'mailchimp_subscribe'] );

		add_action( 'wp_ajax_sina_contact', ['Sina_Ext_Hooks', 'ajax_contact'] );
		add_action( 'wp_ajax_nopriv_sina_contact', ['Sina_Ext_Hooks', 'ajax_contact'] );

		add_action( 'wp_ajax_sina_login', ['Sina_Ext_Hooks', 'ajax_login'] );
		add_action( 'wp_ajax_nopriv_sina_login', ['Sina_Ext_Hooks', 'ajax_login'] );

		add_action( 'wp_ajax_sina_load_more_posts', ['Sina_Ext_Hooks', 'ajax_load_more_posts'] );
		add_action( 'wp_ajax_nopriv_sina_load_more_posts', ['Sina_Ext_Hooks', 'ajax_load_more_posts'] );

		add_action( 'wp_ajax_sina_user_counter', ['Sina_Ext_Hooks', 'ajax_user_counter'] );
		add_action( 'wp_ajax_nopriv_sina_user_counter', ['Sina_Ext_Hooks', 'ajax_user_counter'] );

		add_action( 'wp_ajax_sina_visit_counter', ['Sina_Ext_Hooks', 'ajax_visit_counter'] );
		add_action( 'wp_ajax_nopriv_sina_visit_counter', ['Sina_Ext_Hooks', 'ajax_visit_counter'] );
	}

	/**
	 * Load Action Hooks
	 *
	 * @since 3.0.0
	 */
	public function load_filters() {
		add_filter( 'plugin_action_links_'. SINA_EXT_BASENAME, [ $this, 'settings' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * @since 1.0.0
	 */
	public function i18n() {
		load_plugin_textdomain( 'sina-ext', false, SINA_EXT_DIRNAME.'/languages' );
	}

	/**
	 * For activation
	 *
	 * @since 3.0.0
	 */
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

	/**
	 * Redirect after activation
	 *
	 * @since 3.0.0
	 */
	public function redirection() {
		add_option( 'sina_ext_type', 'free' );
		add_option( 'sina_ext_license_key', substr( md5( microtime() ), 0, 16 ) );
		add_option( 'sina_widgets', SINA_WIDGETS);

		if ( did_action( 'elementor/loaded' ) && get_option('sina_extension_activation', false ) ) {
			delete_option('sina_extension_activation');

			if ( ! is_network_admin() ) {
				wp_redirect("admin.php?page=sina_ext_settings");
			}
		}
	}

	/**
	 * Create settings link
	 *
	 * @since 3.0.0
	 */
	public function settings( $links ) {
		$links[] = '<a href="admin.php?page=sina_ext_settings">Settings</a>';
		if ( ! defined('SINA_EXT_PRO_WIDGETS') ) {
			$links[] = '<a href="https://sina-extension.sinaextra.com/" target="_blank"><span style="font-weight: 700; color: #1085e4">Go Pro</span></a>';
		}
		return $links;
	}
}