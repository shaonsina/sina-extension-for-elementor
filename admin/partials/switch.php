<div class="sina-ext-toggle <?php echo esc_attr($pro); ?>">
	<?php printf('<input type="checkbox" id="%s" name="%s" %s value="1">', $name, $key, $checked); ?>
	<?php printf('<label for="%1$s"><div class="sina-ext-label">%2$s</div><div class="sina-ext-toggle-btn"> <div></div></div></label>', $name, $label); ?>
</div>