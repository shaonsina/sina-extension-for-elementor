<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_add_submenu() {
	add_submenu_page(
		'elementor',
		__('Sina Extension Settings', 'sina-ext'),
		__('Sina Extension', 'sina-ext'),
		'manage_options',
		'sina_ext_settings',
		'sina_page_content'
	);

	add_option( 'sina_map_apikey', '' );
	add_action( 'admin_init', 'sina_settings_group' );
}
add_action( 'admin_menu', 'sina_add_submenu', 550 );

function sina_settings_group() {
	register_setting( 'sina_settings_group', 'sina_map_apikey' );
	register_setting( 'sina_widgets_group', 'sina_widgets' );

	add_settings_section( 'sina_api_section', '', '', 'sina_ext_settings' );
	add_settings_field( 'sina_google_map_key', __('Google Map API Key', 'sina-ext'), 'sina_map_api_key', 'sina_ext_settings', 'sina_api_section' );

	foreach ( SINA_WIDGETS as $cat => $widgets ) {
		$section = 'sina_'.$cat.'_widgets_section';
		$page = 'sina_widgets_'.$cat;
		add_settings_section( $section, '', '', $page );

		foreach ($widgets as $widget => $status) {
			add_settings_field( 'sina_'.str_replace('-', '_', $widget), __('Sina '. ucwords( str_replace('-', ' ', $widget) ), 'sina-ext'), 'sina_widgets_ac_dc', $page, $section, ['widget' => $widget, 'cat' => $cat]  );
		}
	}
}

function sina_page_content() {
	?>
	<h1><?php echo __( 'Sina Extension Settings', 'sina-ext' ); ?></h1>
	<p><?php _e('Thank you for using <strong><i>Sina Extension</i></strong>. This plugin has been developed by <a href="https://github.com/shaonsina" target="_blank">shaonsina</a> and I hope you enjoy using it.', 'sina-ext'); ?></p>
	<h2><?php echo __( 'API Settings', 'sina-ext' ); ?></h2>
	<form action="options.php" method="POST">
		<?php
			settings_errors();
			do_settings_sections( 'sina_ext_settings' );
			settings_fields( 'sina_settings_group' );
		?>
		<div class="sina-widget-options">
			<h2><?php echo __( 'Widget Settings', 'sina-ext' ); ?></h2>
			<p><?php echo __( 'You can disable the widgets if you would like to not using on your site.', 'sina-ext' ); ?></p>

			<?php
				foreach (SINA_WIDGETS as $cat => $data) {
					printf("<div class='sina-widget-cats'><h2>%s</h2>", __( ucfirst($cat), 'sina-ext' ));
					do_settings_sections( 'sina_widgets_'.$cat );
					echo '</div>';
				}
				settings_fields( 'sina_widgets_group' );
				submit_button();
			?>
		</div>
	</form>
	<h2><?php echo __( 'Rollback to Previous Version', 'sina-ext' ); ?></h2>
	<p><?php echo __( 'Experiencing an issue with this version? You can rollback the previous version.', 'sina-ext' ); ?></p>
	<?php
		printf( '<a href="%1$s" class="sina-ext-rollback-btn">%2$s</a>',
			wp_nonce_url( admin_url( 'admin-post.php?action=sina_ext_rollback' ), 'sina_ext_rollback' ),
			sprintf(
				__( 'Reinstall v%s', 'elementor' ),
				SINA_EXT_PREVIOUS_VERSION
			)
		);
		// 'desc' => '<span style="color: red;">' . __( 'Warning: Please backup your database before making the rollback.', 'elementor' ) . '</span>',

		// printf( '<a href="https://downloads.wordpress.org/plugin/%1$s.%2$s.zip">Rollback(%2$s)</a>', SINA_EXT_SLUG, SINA_EXT_PREVIOUS_VERSION );
	?>
	<div>
	    <p>Did you like <strong><i>Sina Extension</i></strong> Plugin? Please <a href="https://wordpress.org/support/plugin/sina-extension-for-elementor/reviews/#new-post" target="_blank">Click Here to Rate it ★★★★★</a></p>
	</div>
	<?php
}

function sina_map_api_key() {
	?>
	<input type="text" class="regular-text" name="sina_map_apikey" value="<?php echo esc_attr( get_option( 'sina_map_apikey' ) ); ?>">
	<?php
}

function sina_widgets_ac_dc($data) {
	$widget 		= $data['widget'];
	$cat 			= $data['cat'];
	$name 			= 'sina-'.$widget;
	$option_name	= 'sina_widgets';
	$checkbox 		= get_option( $option_name );
	$checked		= isset( $checkbox[ $cat ][ $widget ] ) && 1 == $checkbox[ $cat ][ $widget ]  ? 'checked' : '';

	echo '<div class="sina-widget-toggle"><input type="checkbox" id="'. $name .'" name="'.$option_name.'['.$cat.']['. $widget .']" value="1" '. $checked.'><label for="'. $name .'"><div></div></label></div>';
}