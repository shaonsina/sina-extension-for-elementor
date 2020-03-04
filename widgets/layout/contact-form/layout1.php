<div class="sina-contact-input">
	<input class="sina-input-field sina-input-name" type="text" placeholder="<?php echo esc_attr( $data['name_placeholder'] ); ?>" >
	<input class="sina-input-field sina-input-email" type="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
	<input class="sina-input-field sina-input-subject" type="text" placeholder="<?php echo esc_attr( $data['sub_placeholder'] ); ?>" >
	<textarea class="sina-input-field sina-input-block sina-input-message" placeholder="<?php echo esc_attr( $data['msg_placeholder'] ); ?>"></textarea>

	<!-- For Google Recaptcha -->
	<?php if ( 'yes' == $data['is_recaptcha'] ): ?>
		<div class="sina-google-recaptcha">
			<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $recaptcha_key ); ?>"></div>
		</div>
	<?php endif; ?>
	
	<button type="submit" class="sina-button sina-contact-btn <?php echo esc_attr( $data['btn_effect'].' '.$data['btn_bg_layer_effects'] ); ?>">
		<?php Sina_Common_Data::button_html($data); ?>
	</button>
</div>