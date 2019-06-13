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
		<?php if ( $data['icon'] && 'left' == $data['icon_position'] ): ?>
			<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-left"></i>
		<?php endif ?>
		<span <?php echo $this->get_render_attribute_string( 'label' ); ?>>
			<?php echo esc_html( $data['label'] ); ?>
		</span>
		<?php if ( $data['icon'] && 'right' == $data['icon_position'] ): ?>
			<i class="<?php echo esc_attr( $data['icon'] ); ?> sina-btn-icon-right"></i>
		<?php endif ?>
	</button>
</div>