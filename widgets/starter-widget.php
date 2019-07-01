<?php
/*
For size default value
'default' => [
	'size' => '10',
],
For padding-margin Default Value
'default' => [
	'top' => '0',
	'right' => '0',
	'bottom' => '15',
	'left' => '0',
	'isLinked' => false,
],
For box shadow default value
'fields_options' => [
	'box_shadow_type' => [ 
		'default' =>'yes' 
	],
	'box_shadow' => [
		'default' => [
			'horizontal' => '0',
			'vertical' => '10',
			'blur' => '6',
			'color' => 'rgba(0,0,0,0.1)'
		]
	]
],
For Border Default Value
'fields_options' => [
	'border' => [
		'default' => 'solid',
	],
	'color' => [
		'default' => '#1085e4',
	],
	'width' => [
		'default' => [
			'top' => '1',
			'right' => '1',
			'bottom' => '1',
			'left' => '1',
			'isLinked' => true,
		]
	],
],
For Typography Default value
'fields_options' => [
	'typography' => [ 
		'default' =>'custom', 
	],
	'font_weight' => [
		'default' => '600',
	],
	'font_size'   => [
		'default' => [
			'size' => '24',
		],
	],
	'line_height'   => [
		'default' => [
			'unit' => 'px',
			'size' => '24',
		],
	],
	'text_transform' => [
		'default' => 'uppercase',
	],
],

For Background default value
'fields_options' => [
	'background' => [ 
		'default' =>'gradient', 
	],
	'gradient_type' => [
		'default' => 'linear',
	],
	'gradient_angle' => [
		'default' => [
			'unit' => 'deg',
			'size' => -35,
		],
	],
	'color' => [
		'default' => '#00e',
	],
	'color_b' => [
		'default' => '#e0e',
	],
],

For Responsive Default value
'desktop_default' => [
	'size' => 600,
],
'tablet_default' => [
	'size' => 500,
],
'mobile_default' => [
	'size' => 400,
],

'range' => [
	'px' => [
		'max' => 1000,
	],
	'em' => [
		'max' => 50,
	],
],


$this->add_control(
	'icon_color',
	[
		'label' => __( 'Color', 'sina-ext' ),
		'type' => Controls_Manager::COLOR,
		'default' => '#FFFFFF',
		'selectors' => [
			'{{WRAPPER}} {{CURRENT_ITEM}} > a' => 'color: {{VALUE}};',
		],
	]
);
That is major release of this plugin. So, please review your site after updated.
Mailchimp field padding issue fixed.

Would it take more time to load more than one CSS lower-size file or will it take a longer time to load a more sized CSS file?
*/



/**
 * Starter Widget.
 *
 * @since 1.2.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Starter_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.2.0
	 */
	public function get_name() {
		return 'sina_';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.2.0
	 */
	public function get_title() {
		return __( 'Sina ', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.2.0
	 */
	public function get_icon() {
		return 'fa fa-search-plus';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.2.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.2.0
	 */
	public function get_keywords() {
		return [ 'sina ' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.2.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 1.2.0
	 */
	public function get_script_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.2.0
	 */
	protected function _register_controls() {
		// Start 
		// ===================
		$this->start_controls_section(
			'_content',
			[
				'label' => __( ' Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End 
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-">
		</div><!-- .sina- -->
		<?php
	}


	protected function _content_template() {

	}
}