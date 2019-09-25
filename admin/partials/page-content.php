<div class="sina-ext-wrap">
	<h1><?php _e( 'Sina Extension Settings', 'sina-ext' ); ?></h1>
	<p class="sina-ext-pb">
		<?php _e('Thank you for using <strong><i>Sina Extension</i></strong>. This plugin has been developed by <a href="https://shaonsina.com/shaonsina" target="_blank">shaonsina</a> and I hope you enjoy using it.', 'sina-ext'); ?>
	</p>

	<form action="options.php" method="POST">
		<?php settings_errors(); ?>
		<?php do_settings_sections( 'sina_ext_license_info' ); ?>

		<h2 class="sina-ext-pt"><?php _e( 'API Settings', 'sina-ext' ); ?></h2>
		<div class="sina-ext-pb">
			<?php do_settings_sections( 'sina_ext_settings' ); ?>
		</div>

		<div class="sina-ext-options sina-ext-pt">
			<h2><?php _e( 'Widget Settings', 'sina-ext' ); ?></h2>
			<p class="sina-ext-pb">
				<?php _e( 'You can disable widget(s) if you would like to not using on your site.', 'sina-ext' ); ?>
			</p>

			<?php
				$get_widgets = get_option( 'sina_widgets' );
				foreach ($get_widgets as $cat => $data) {
					printf("<div class='sina-ext-pb'><h2>%s</h2>", __( ucfirst($cat), 'sina-ext' ));
					do_settings_sections( 'sina_widgets_'.$cat );
					echo '</div>';
				}
				settings_fields( 'sina_settings_group' );
			?>
		</div>

		<div class="sina-ext-options sina-ext-pt sina-ext-pb">
			<h2><?php _e( 'Template Settings', 'sina-ext' ); ?></h2>
			<p class="sina-ext-pb">
				<?php _e( 'You can use <strong><i>SINA TEMPLATES</i></strong> on your site.', 'sina-ext' ); ?>
			</p>

			<div class="sina-ext-pb">
				<?php do_settings_sections( 'sina_ext_templates' ); ?>
			</div>
			<?php submit_button(); ?>
		</div>
	</form>

	<div class="sina-ext-options">
		<h2><?php _e( 'Rollback to Previous Version', 'sina-ext' ); ?></h2>
		<p>
			<?php _e( 'Experiencing an issue with this version? You can rollback the previous version.', 'sina-ext' ); ?>
		</p>
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
			<?php _e( 'Warning: Please backup your database before making the rollback.', 'sina-ext' ); ?>
		</p>
	</div>

	<div class="sina-ext-options">
	    <p>Did you like <strong><i>Sina Extension</i></strong> Plugin? Please <a href="https://wordpress.org/support/plugin/sina-extension-for-elementor/reviews/#new-post" target="_blank">Click Here to Rate it ★★★★★</a></p>
	</div>
</div>