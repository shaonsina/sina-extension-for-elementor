<?php
namespace Sina_Extension;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use \Elementor\Group_Control_Base;
use \Elementor\Controls_Manager;
use \Elementor\Controls_Stack;

/**
 * Sina Gradient Text control.
 *
 * @since 3.0.2
 */
class Sina_Ext_Gradient_Text extends Group_Control_Base{

	/**
	 * Fields.
	 *
	 * Holds all the background control fields.
	 *
	 * @since 3.0.2
	 * @var array Background control fields.
	 */
	protected static $fields;

	/**
	 * Get background control type.
	 *
	 * Retrieve the control type, in this case `background`.
	 *
	 * @since 3.0.2
	 */
	public static function get_type() {
		return 'gradient-text';
	}

	/**
	 * Init fields.
	 *
	 * Initialize background control fields.
	 *
	 * @since 3.0.2
	 */
	public function init_fields() {
		$fields = [];

		$fields['background'] = [
			'label' => __( 'Color Type', 'sina-ext' ),
			'type' => Controls_Manager::CHOOSE,
			'label_block' => false,
			'render_type' => 'ui',
			'options' => [
				'classic' => [
					'title' => __( 'Classic', 'sina-ext' ),
					'icon' => 'eicon-paint-brush',
				],
				'gradient' => [
					'title' => __( 'Gradient', 'sina-ext' ),
					'icon' => 'eicon-barcode',
				],
				'image' => [
					'title' => __( 'Image', 'sina-ext' ),
					'icon' => 'eicon-image-bold',
				],
			],
			'default' => 'classic',
		];

		$fields['color'] = [
			'label' => __( 'Color', 'sina-ext' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => [
				'{{SELECTOR}}' => 'color: {{VALUE}};',
			],
			'condition' => [
				'background' => [ 'classic', 'gradient' ],
			],
			'default' => '#222',
		];

		$fields['color_stop'] = [
			'label' => __( 'Location (%)', 'sina-ext' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [
				'unit' => '%',
				'size' => 0,
			],
			'render_type' => 'ui',
			'condition' => [
				'background' => 'gradient',
			],
			'of_type' => 'gradient',
		];

		$fields['color_b'] = [
			'label' => __( 'Second Color', 'sina-ext' ),
			'type' => Controls_Manager::COLOR,
			'default' => '#1085e4',
			'render_type' => 'ui',
			'condition' => [
				'background' => 'gradient',
			],
			'of_type' => 'gradient',
		];

		$fields['color_b_stop'] = [
			'label' => __( 'Location (%)', 'sina-ext' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ '%' ],
			'default' => [
				'unit' => '%',
				'size' => 100,
			],
			'render_type' => 'ui',
			'condition' => [
				'background' => 'gradient',
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_type'] = [
			'label' => __( 'Type', 'sina-ext' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'linear' => __( 'Linear', 'sina-ext' ),
				'radial' => __( 'Radial', 'sina-ext' ),
			],
			'default' => 'linear',
			'render_type' => 'ui',
			'condition' => [
				'background' => 'gradient',
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_angle'] = [
			'label' => __( 'Angle (deg)', 'sina-ext' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => [ 'deg' ],
			'default' => [
				'unit' => 'deg',
				'size' => 30,
			],
			'range' => [
				'deg' => [
					'step' => 5,
				],
			],
			'selectors' => [
				'{{SELECTOR}}' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
			],
			'condition' => [
				'background' => 'gradient',
				'gradient_type' => 'linear',
			],
			'of_type' => 'gradient',
		];

		$fields['gradient_position'] = [
			'label' => __( 'Position', 'sina-ext' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				'center center' => __( 'Center Center', 'sina-ext' ),
				'center left' => __( 'Center Left', 'sina-ext' ),
				'center right' => __( 'Center Right', 'sina-ext' ),
				'top center' => __( 'Top Center', 'sina-ext' ),
				'top left' => __( 'Top Left', 'sina-ext' ),
				'top right' => __( 'Top Right', 'sina-ext' ),
				'bottom center' => __( 'Bottom Center', 'sina-ext' ),
				'bottom left' => __( 'Bottom Left', 'sina-ext' ),
				'bottom right' => __( 'Bottom Right', 'sina-ext' ),
			],
			'default' => 'center center',
			'selectors' => [
				'{{SELECTOR}}' => '-webkit-background-clip: text; -webkit-text-fill-color: transparent; background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
			],
			'condition' => [
				'background' => 'gradient',
				'gradient_type' => 'radial',
			],
			'of_type' => 'gradient',
		];

		$fields['image'] = [
			'label' => __( 'Image', 'sina-ext' ),
			'type' => Controls_Manager::MEDIA,
			'dynamic' => [
				'active' => true,
			],
			'responsive' => true,
			'selectors' => [
				'{{SELECTOR}}' => 'background-image: url("{{URL}}"); -webkit-background-clip: text; -webkit-text-fill-color: transparent;',
			],
			'render_type' => 'template',
			'condition' => [
				'background' => 'image',
			],
		];

		$fields['position'] = [
			'label' => __( 'Position', 'sina-ext' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'responsive' => true,
			'options' => [
				'' => __( 'Default', 'sina-ext' ),
				'top left' => __( 'Top Left', 'sina-ext' ),
				'top center' => __( 'Top Center', 'sina-ext' ),
				'top right' => __( 'Top Right', 'sina-ext' ),
				'center left' => __( 'Center Left', 'sina-ext' ),
				'center center' => __( 'Center Center', 'sina-ext' ),
				'center right' => __( 'Center Right', 'sina-ext' ),
				'bottom left' => __( 'Bottom Left', 'sina-ext' ),
				'bottom center' => __( 'Bottom Center', 'sina-ext' ),
				'bottom right' => __( 'Bottom Right', 'sina-ext' ),
				'initial' => __( 'Custom', 'sina-ext' ),

			],
			'selectors' => [
				'{{SELECTOR}}' => 'background-position: {{VALUE}};',
			],
			'condition' => [
				'background' => 'image',
				'image[url]!' => '',
			],
		];

		$fields['xpos'] = [
			'label' => __( 'X Position', 'sina-ext' ),
			'type' => Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vw' ],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range' => [
				'px' => [
					'min' => -800,
					'max' => 800,
				],
				'em' => [
					'min' => -100,
					'max' => 100,
				],
				'%' => [
					'min' => -100,
					'max' => 100,
				],
				'vw' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos.SIZE}}{{ypos.UNIT}}',
			],
			'condition' => [
				'background' => 'image',
				'position' => 'initial',
				'image[url]!' => '',
			],
			'required' => true,
			'device_args' => [
				Controls_Stack::RESPONSIVE_TABLET => [
					'selectors' => [
						'{{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_tablet.SIZE}}{{ypos_tablet.UNIT}}',
					],
					'condition' => [
						'background' => 'image',
						'position_tablet' => 'initial',
					],
				],
				Controls_Stack::RESPONSIVE_MOBILE => [
					'selectors' => [
						'{{SELECTOR}}' => 'background-position: {{SIZE}}{{UNIT}} {{ypos_mobile.SIZE}}{{ypos_mobile.UNIT}}',
					],
					'condition' => [
						'background' => 'image',
						'position_mobile' => 'initial',
					],
				],
			],
		];

		$fields['ypos'] = [
			'label' => __( 'Y Position', 'sina-ext' ),
			'type' => Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vh' ],
			'default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'tablet_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'mobile_default' => [
				'unit' => 'px',
				'size' => 0,
			],
			'range' => [
				'px' => [
					'min' => -800,
					'max' => 800,
				],
				'em' => [
					'min' => -100,
					'max' => 100,
				],
				'%' => [
					'min' => -100,
					'max' => 100,
				],
				'vh' => [
					'min' => -100,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{SELECTOR}}' => 'background-position: {{xpos.SIZE}}{{xpos.UNIT}} {{SIZE}}{{UNIT}}',
			],
			'condition' => [
				'background' => 'image',
				'position' => 'initial',
				'image[url]!' => '',
			],
			'required' => true,
			'device_args' => [
				Controls_Stack::RESPONSIVE_TABLET => [
					'selectors' => [
						'{{SELECTOR}}' => 'background-position: {{xpos_tablet.SIZE}}{{xpos_tablet.UNIT}} {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'background' => 'image',
						'position_tablet' => 'initial',
					],
				],
				Controls_Stack::RESPONSIVE_MOBILE => [
					'selectors' => [
						'{{SELECTOR}}' => 'background-position: {{xpos_mobile.SIZE}}{{xpos_mobile.UNIT}} {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'background' => 'image',
						'position_mobile' => 'initial',
					],
				],
			],
		];

		$fields['attachment'] = [
			'label' => __( 'Attachment', 'sina-ext' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'options' => [
				'' => __( 'Default', 'sina-ext' ),
				'scroll' => __( 'Scroll', 'sina-ext' ),
				'fixed' => __( 'Fixed', 'sina-ext' ),
			],
			'selectors' => [
				'(desktop+){{SELECTOR}}' => 'background-attachment: {{VALUE}};',
			],
			'condition' => [
				'background' => 'image',
				'image[url]!' => '',
			],
		];

		$fields['attachment_alert'] = [
			'type' => Controls_Manager::RAW_HTML,
			'content_classes' => 'elementor-control-field-description',
			'raw' => __( 'Note: Attachment Fixed works only on desktop.', 'sina-ext' ),
			'separator' => 'none',
			'condition' => [
				'background' => 'image',
				'image[url]!' => '',
				'attachment' => 'fixed',
			],
		];

		$fields['repeat'] = [
			'label' => __( 'Repeat', 'sina-ext' ),
			'type' => Controls_Manager::SELECT,
			'default' => '',
			'responsive' => true,
			'options' => [
				'' => __( 'Default', 'sina-ext' ),
				'no-repeat' => __( 'No-repeat', 'sina-ext' ),
				'repeat' => __( 'Repeat', 'sina-ext' ),
				'repeat-x' => __( 'Repeat-x', 'sina-ext' ),
				'repeat-y' => __( 'Repeat-y', 'sina-ext' ),
			],
			'selectors' => [
				'{{SELECTOR}}' => 'background-repeat: {{VALUE}};',
			],
			'condition' => [
				'background' => 'image',
				'image[url]!' => '',
			],
		];

		$fields['size'] = [
			'label' => __( 'Size', 'sina-ext' ),
			'type' => Controls_Manager::SELECT,
			'responsive' => true,
			'default' => '',
			'options' => [
				'' => __( 'Default', 'sina-ext' ),
				'auto' => __( 'Auto', 'sina-ext' ),
				'cover' => __( 'Cover', 'sina-ext' ),
				'contain' => __( 'Contain', 'sina-ext' ),
				'initial' => __( 'Custom', 'sina-ext' ),
			],
			'selectors' => [
				'{{SELECTOR}}' => 'background-size: {{VALUE}};',
			],
			'condition' => [
				'background' => 'image',
				'image[url]!' => '',
			],
		];

		$fields['bg_width'] = [
			'label' => __( 'Width', 'sina-ext' ),
			'type' => Controls_Manager::SLIDER,
			'responsive' => true,
			'size_units' => [ 'px', 'em', '%', 'vw' ],
			'range' => [
				'px' => [
					'min' => 0,
					'max' => 1000,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
				],
				'vw' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'default' => [
				'size' => 100,
				'unit' => '%',
			],
			'required' => true,
			'selectors' => [
				'{{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
			],
			'condition' => [
				'background' => 'image',
				'size' => 'initial',
				'image[url]!' => '',
			],
			'device_args' => [
				Controls_Stack::RESPONSIVE_TABLET => [
					'selectors' => [
						'{{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
					],
					'condition' => [
						'background' => 'image',
						'size_tablet' => 'initial',
					],
				],
				Controls_Stack::RESPONSIVE_MOBILE => [
					'selectors' => [
						'{{SELECTOR}}' => 'background-size: {{SIZE}}{{UNIT}} auto',
					],
					'condition' => [
						'background' => 'image',
						'size_mobile' => 'initial',
					],
				],
			],
		];

		return $fields;
	}

	/**
	 * Get child default args.
	 *
	 * Retrieve the default arguments for all the child controls for a specific group
	 * control.
	 *
	 * @since 3.0.2
	 */
	protected function get_child_default_args() {
		return [
			'types' => [ 'classic', 'gradient' ],
		];
	}

	/**
	 * Filter fields.
	 *
	 * Filter which controls to display, using `include`, `exclude`, `condition`
	 * and `of_type` arguments.
	 *
	 * @since 3.0.2
	 */
	protected function filter_fields() {
		$fields = parent::filter_fields();

		$args = $this->get_args();

		foreach ( $fields as &$field ) {
			if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'] ) ) {
				unset( $field );
			}
		}

		return $fields;
	}

	/**
	 * Get default options.
	 *
	 * Retrieve the default options of the background control. Used to return the
	 * default options while initializing the background control.
	 *
	 * @since 3.0.2
	 */
	protected function get_default_options() {
		return [
			'popover' => false,
		];
	}
}
