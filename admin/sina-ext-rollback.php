<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Rollback Class
 *
 * @since 3.0.0
 */
class Sina_Ext_Rollback{
	public static function print_inline_style() {
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

	public static function apply_package() {
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

	public static function upgrade() {
		require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );

		$upgrader_args = [
			'url' => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( SINA_EXT_SLUG ),
			'plugin' => SINA_EXT_SLUG,
			'nonce' => 'upgrade-plugin_' . SINA_EXT_SLUG,
			'title' => esc_html__( 'Sina Extension Rollback to Previous Version', 'sina-ext' ),
		];

		self::print_inline_style();

		$upgrader = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $upgrader_args ) );
		$upgrader->upgrade( SINA_EXT_SLUG );
	}

	public static function rollback() {
		check_admin_referer( 'sina_ext_rollback' );

		self::apply_package();
		self::upgrade();

		wp_die(
			'', esc_html__( 'Rollback to Previous Version', 'sina-ext' ), [
				'response' => 200,
			]
		);
	}
}