<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Base Class
 *
 * @since 2.3.2
 */
abstract class Sina_Base {
	/**
	 * Minimum Elementor Version
	 *
	 * @since 2.3.2
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 2.3.2
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Load Textdomain
	 *
	 * @since 2.3.2
	 */
	public function i18n() {
		load_plugin_textdomain( 'sina-ext' );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 2.3.2
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'sina-ext' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 2.3.2
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'sina-ext' ),
			'<strong>' . esc_html__( 'Sina Extension for Elementor', 'sina-ext' ) . '</strong>',
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
	 * @since 2.3.2
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
	 * For activation
	 *
	 * @since 1.0.3
	 */
	public function activation() {
		add_option('sina_extension_activation', true);
	}

	/**
	 * Redirect after activation
	 *
	 * @since 1.0.3
	 */
	public function redirection() {
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
	 * @since 2.3.2
	 */
	public function admin_page() {
		add_filter( 'plugin_action_links_'. SINA_EXT_BASENAME, [ $this, 'settings_link' ] );
	}

	/**
	 * Create settings link
	 *
	 * @since 2.3.2
	 */
	public function settings_link( $links ) {
		$links[] = '<a href="admin.php?page=sina_ext_settings">Settings</a>';
		return $links;
	}
}