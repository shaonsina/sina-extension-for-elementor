<div class="sina-contact-input">
	<input class="sina-input-field sina-input-name" type="text" name="text" placeholder="<?php echo esc_attr( $data['name_placeholder'] ); ?>" >
	<input class="sina-input-field sina-input-email" type="email" name="email" placeholder="<?php echo esc_attr( $data['email_placeholder'] ); ?>" >
	<input class="sina-input-field sina-input-subject" type="text" name="subject" placeholder="<?php echo esc_attr( $data['sub_placeholder'] ); ?>" >
	<textarea class="sina-input-field sina-input-block sina-input-message" placeholder="<?php echo esc_attr( $data['msg_placeholder'] ); ?>"></textarea>
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