<?php
namespace Sina_Extension;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use \Elementor\Base_Data_Control;

/**
 * Sina_Ext_Menu_Icon icon control.
 *
 * @since 3.7.0
 */
class Sina_Ext_Menu_Icon extends Base_Data_Control{

	/**
	 * Get icon control type.
	 *
	 * Retrieve the control type, in this case `icon`.
	 *
	 * @since 3.7.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'sina_menu_icon';
	}

	public function enqueue() {
		wp_enqueue_style( 'icofont', SINA_EXT_URL .'admin/assets/css/icofont.min.css', [], SINA_EXT_VERSION );

		wp_enqueue_script( 'sina-menu-icon', SINA_EXT_URL .'inc/controls/assets/js/menu-icon.min.js', ['jquery'], SINA_EXT_VERSION );
	}

	/**
	 * Get icons.
	 *
	 * Retrieve all the available icons.
	 *
	 * @since 3.7.0
	 * @access public
	 * @static
	 *
	 * @return array Available icons.
	 */
	public static function get_icons() {
		return [
			'icofont icofont-arrow-down' => 'Arrow Down',
			'icofont icofont-arrow-left' => 'Arrow Left',
			'icofont icofont-arrow-right' => 'Arrow Right',
			'icofont icofont-arrow-up' => 'Arrow Up',
			'icofont icofont-caret-down' => 'Caret Down',
			'icofont icofont-caret-left' => 'Caret Left',
			'icofont icofont-caret-right' => 'Caret Right',
			'icofont icofont-caret-up' => 'Caret Up',
			'icofont icofont-rounded-down' => 'Rounded Down',
			'icofont icofont-rounded-left' => 'Rounded Left',
			'icofont icofont-rounded-right' => 'Rounded Right',
			'icofont icofont-rounded-up' => 'Rounded Up',
			'icofont icofont-simple-down' => 'Simple Down',
			'icofont icofont-simple-left' => 'Simple Left',
			'icofont icofont-simple-right' => 'Simple Right',
			'icofont icofont-simple-up' => 'Simple Up',
			'icofont icofont-swoosh-down' => 'Swoosh Down',
			'icofont icofont-swoosh-left' => 'Swoosh Left',
			'icofont icofont-swoosh-right' => 'Swoosh Right',
			'icofont icofont-swoosh-up' => 'Swoosh Up',
			'icofont icofont-double-left' => 'Double Left',
			'icofont icofont-double-right' => 'Double Right',
			'icofont icofont-rounded-double-left' => 'Rounded Double Left',
			'icofont icofont-rounded-double-right' => 'Rounded Double Right',
			'icofont icofont-plus' => 'Plus',
			'icofont icofont-minus' => 'Minus',
		];
	}

	/**
	 * Get icons control default settings.
	 *
	 * Retrieve the default settings of the icons control. Used to return the default
	 * settings while initializing the icons control.
	 *
	 * @since 3.7.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'options' => self::get_icons(),
			'include' => '',
			'exclude' => '',
		];
	}

	/**
	 * Render icons control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 3.7.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo $control_uid; ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<select id="<?php echo $control_uid; ?>" class="elementor-control-icon" data-setting="{{ data.name }}" data-placeholder="<?php echo __( 'Select Icon', 'sina-ext' ); ?>">
					<option value=""><?php echo __( 'Select Icon', 'sina-ext' ); ?></option>
					<# _.each( data.options, function( option_title, option_value ) { #>
					<option value="{{ option_value }}">{{{ option_title }}}</option>
					<# } ); #>
				</select>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{ data.description }}</div>
		<# } #>
		<?php
	}
}
