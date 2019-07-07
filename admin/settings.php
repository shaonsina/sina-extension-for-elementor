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

	add_action( 'admin_init', 'sina_settings_group' );
	add_option( 'sina_map_apikey', '' );
	add_option( 'sina_mailchimp', [
		'apikey'	=> '',
		'list_id'	=> '',
	] );
	add_option( 'sina_templates_option', [] );
}
add_action( 'admin_menu', 'sina_add_submenu', 550 );

function sina_settings_group() {
	register_setting( 'sina_settings_group', 'sina_map_apikey' );
	register_setting( 'sina_settings_group', 'sina_mailchimp' );
	register_setting( 'sina_settings_group', 'sina_widgets' );
	register_setting( 'sina_settings_group', 'sina_templates_option' );

	add_settings_section( 'sina_api_section', '', '', 'sina_ext_settings' );
	add_settings_field( 'sina_google_map_key', __('Google Map API Key', 'sina-ext'), 'sina_map_api_key', 'sina_ext_settings', 'sina_api_section' );
	add_settings_field( 'sina_mailchimp_key', __('MailChimp API Key', 'sina-ext'), 'sina_mail_chimp_key', 'sina_ext_settings', 'sina_api_section' );
	add_settings_field( 'sina_mailchimp_list_id', __('MailChimp List Id', 'sina-ext'), 'sina_mail_chimp_list_id', 'sina_ext_settings', 'sina_api_section' );

	$templates = get_option( 'sina_templates_option' );
	add_settings_section( 'sina_templates_section', '', '', 'sina_ext_templates' );
	add_settings_field( 'sina_ext_templates_only', __('Sina Templates', 'sina-ext'), 'sina_templates_option', 'sina_ext_templates', 'sina_templates_section', ['temps' => 'sina_templates_only', 'get_temps' => $templates] );
	add_settings_field( 'sina_ext_templates_merge', __('Sina Templates Merge', 'sina-ext'), 'sina_templates_option', 'sina_ext_templates', 'sina_templates_section', ['temps' => 'sina_templates_merge', 'get_temps' => $templates] );

	$get_widgets = get_option( 'sina_widgets' );
	foreach ( SINA_WIDGETS as $cat => $widgets ) {
		$section = 'sina_'.$cat.'_widgets_section';
		$page = 'sina_widgets_'.$cat;
		add_settings_section( $section, '', '', $page );

		foreach ($widgets as $widget => $status) {
			add_settings_field( 'sina_'.str_replace('-', '_', $widget), __('Sina '. ucwords( str_replace('-', ' ', $widget) ), 'sina-ext'), 'sina_widgets_ac_dc', $page, $section, ['widget' => $widget, 'cat' => $cat, 'get_widgets' => $get_widgets]  );
		}
	}
}

function sina_page_content() {
	?>
	<h1><?php echo __( 'Sina Extension Settings', 'sina-ext' ); ?></h1>
	<p class="sina-ext-pb"><?php _e('Thank you for using <strong><i>Sina Extension</i></strong>. This plugin has been developed by <a href="https://github.com/shaonsina" target="_blank">shaonsina</a> and I hope you enjoy using it.', 'sina-ext'); ?></p>

	<form action="options.php" method="POST">
		<?php settings_errors(); ?>
		<h2 class="sina-ext-pt"><?php echo __( 'API Settings', 'sina-ext' ); ?></h2>
		<div class="sina-ext-pb">
			<?php do_settings_sections( 'sina_ext_settings' ); ?>
		</div>

		<div class="sina-ext-options sina-ext-pt">
			<h2><?php echo __( 'Widget Settings', 'sina-ext' ); ?></h2>
			<p class="sina-ext-pb"><?php echo __( 'You can disable the widgets if you would like to not using on your site.', 'sina-ext' ); ?></p>

			<?php
				foreach (SINA_WIDGETS as $cat => $data) {
					printf("<div class='sina-ext-pb'><h2>%s</h2>", __( ucfirst($cat), 'sina-ext' ));
					do_settings_sections( 'sina_widgets_'.$cat );
					echo '</div>';
				}
				settings_fields( 'sina_settings_group' );
			?>
		</div>
		<div class="sina-ext-options sina-ext-wfull sina-ext-pt sina-ext-pb">
			<h2><?php echo __( 'Template Settings', 'sina-ext' ); ?></h2>
			<p class="sina-ext-pb"><?php echo __( 'You can use <strong><i>SINA TEMPLATES</i></strong> on your site.', 'sina-ext' ); ?></p>

			<div class="sina-ext-pb">
				<?php do_settings_sections( 'sina_ext_templates' ); ?>
			</div>
			<?php submit_button(); ?>
		</div>
	</form>

	<div class="sina-ext-options">
		<h2><?php echo __( 'Rollback to Previous Version', 'sina-ext' ); ?></h2>
		<p><?php echo __( 'Experiencing an issue with this version? You can rollback the previous version.', 'sina-ext' ); ?></p>
		<?php
			printf( '<a href="%1$s" class="sina-ext-rollback-btn button elementor-button-spinner elementor-rollback-button">%2$s</a>',
				wp_nonce_url( admin_url( 'admin-post.php?action=sina_ext_rollback' ), 'sina_ext_rollback' ),
				sprintf(
					__( 'Reinstall v%s', 'elementor' ),
					SINA_EXT_PREVIOUS_VERSION
				)
			);
		?>
		<p style="color: #e00;">
			<?php echo __( 'Warning: Please backup your database before making the rollback.', 'sina-ext' ); ?>
		</p>
	</div>

	<div class="sina-ext-options">
	    <p>Did you like <strong><i>Sina Extension</i></strong> Plugin? Please <a href="https://wordpress.org/support/plugin/sina-extension-for-elementor/reviews/#new-post" target="_blank">Click Here to Rate it ★★★★★</a></p>
	</div>
	<?php
}

function sina_map_api_key() {
	?>
	<input type="text" class="regular-text" name="sina_map_apikey" value="<?php echo esc_attr( get_option( 'sina_map_apikey' ) ); ?>">
	<?php
}

function sina_mail_chimp_key() {
	?>
	<input type="text" class="regular-text" name="sina_mailchimp[apikey]" value="<?php echo esc_attr( get_option( 'sina_mailchimp' )['apikey'] ); ?>">
	<?php
}

function sina_mail_chimp_list_id() {
	?>
	<input type="text" class="regular-text" name="sina_mailchimp[list_id]" value="<?php echo esc_attr( get_option( 'sina_mailchimp' )['list_id'] ); ?>">
	<?php
}

function sina_templates_option($data) {
	$get_temps 	= $data['get_temps'];
	$temps 		= $data['temps'];
	$name 		= 'sina-'.$temps;
	$checked	= isset($get_temps[ $temps ]) && 1 == $get_temps[ $temps ] ? 'checked' : '';

	echo '<div class="sina-ext-toggle"><input type="checkbox" id="'. $name .'" name="sina_templates_option['.$temps.']" value="1" '. $checked.'><label for="'. $name .'"><div></div></label></div>';
}

function sina_widgets_ac_dc($data) {
	$widgets 	= $data['get_widgets'];
	$widget 	= $data['widget'];
	$cat 		= $data['cat'];
	$name 		= 'sina-'.$widget;
	$checked	= isset($widgets[ $cat ][ $widget ]) && 1 == $widgets[ $cat ][ $widget ] ? 'checked' : '';

	echo '<div class="sina-ext-toggle"><input type="checkbox" id="'. $name .'" name="sina_widgets['.$cat.']['. $widget .']" value="1" '. $checked.'><label for="'. $name .'"><div></div></label></div>';
}