<div class="sina-contact-input">
	<div class="sina-contact-input-half">
		<input class="sina-input-field sina-input-block sina-input-name" type="text" name="name" placeholder="<?php echo esc_attr( $data['name_placeholder'] ); ?>" >
		<input class="sina-input-field sina-input-block sina-input-email" type="email" name="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
		<input class="sina-input-field sina-input-block sina-input-subject" type="text" name="subject" placeholder="<?php echo esc_attr( $data['sub_placeholder'] ); ?>" >
	</div>
	<div class="sina-contact-input-half">
		<textarea class="sina-input-field sina-input-block sina-input-message" placeholder="<?php echo esc_attr( $data['msg_placeholder'] ); ?>"></textarea>
	</div>
</div>
<div class="sina-contact-input">
	<button type="submit" class="sina-button sina-contact-btn">
		<?php Sina_Common_Data::button_html($data); ?>
	</button>
</div>