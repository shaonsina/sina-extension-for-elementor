<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;

/**
 * Sina_Ext_Controls Class for extends controls
 *
 * @since 3.0.1
 */
class Sina_Ext_Controls{
	/**
	 * Instance
	 *
	 * @since 3.1.13
	 * @var Sina_Ext_Controls The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.1.13
	 * @return Sina_Ext_Controls An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->controls_files();

		add_action('elementor/controls/controls_registered', [$this, 'controls'], 15 );
		add_action('elementor/element/common/_section_style/before_section_end', [$this, 'register_controls']);
	}

	private function controls_files(){
		require_once SINA_EXT_INC .'controls/icon.php';
		require_once SINA_EXT_INC .'controls/gradient-text.php';
	}

	public function controls( $manager ) {
		$manager->unregister_control( $manager::ICON );
		$manager->register_control( $manager::ICON, new \Sina_Extension\Sina_Ext_Icon());
		$manager->add_group_control( Sina_Ext_Gradient_Text::get_type(), new \Sina_Extension\Sina_Ext_Gradient_Text());
	}

	public function register_controls($elems) {
		$elems->add_control(
			'sina_is_morphing_animation',
			[
				'label' => '<strong>'.esc_html__( 'Sina Morphing Animation', 'sina-ext' ).'</strong>',
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);
		$elems->add_control(
			'sina_is_morphing_pattern',
			[
				'label' => esc_html__( 'Morphing Pattern', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Pattern 1', 'sina-ext' ),
					'pattern-2' => esc_html__( 'Pattern 2', 'sina-ext' ),
					'pattern-3' => esc_html__( 'Pattern 3', 'sina-ext' ),
					'pattern-4' => esc_html__( 'Pattern 4', 'sina-ext' ),
				],
				'prefix_class' => 'sina-morphing-anim-',
				'default' => 'yes',
				'condition' => [
					'sina_is_morphing_animation' => 'yes',
				],
			]
		);
		$elems->add_control(
			'sina_transform_effects',
			[
				'label' => '<strong>'.esc_html__( 'Sina Transform Effects', 'sina-ext' ).'</strong>',
				'type' => Controls_Manager::SELECT,
				'options' => [
					'translate' => esc_html__( 'Translate', 'sina-ext' ),
					'scaleX' => esc_html__( 'Scale X', 'sina-ext' ),
					'scaleY' => esc_html__( 'Scale Y', 'sina-ext' ),
					'scaleZ' => esc_html__( 'Scale Z', 'sina-ext' ),
					'rotateX' => esc_html__( 'Rotate X', 'sina-ext' ),
					'rotateY' => esc_html__( 'Rotate Y', 'sina-ext' ),
					'rotateZ' => esc_html__( 'Rotate Z', 'sina-ext' ),
					'skewX' => esc_html__( 'Skew X', 'sina-ext' ),
					'skewY' => esc_html__( 'Skew Y', 'sina-ext' ),
					'none' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => 'none',
			]
		);
		$elems->add_responsive_control(
			'sina_transform_perspective',
			[
				'label' => esc_html__( 'Perspective Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 10000,
					],
				],
				'default' => [
					'size' => '1000',
				],
				'condition' => [
					'sina_transform_effects' => ['rotateX', 'rotateY'],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'perspective: {{SIZE}}px;',
				],
			]
		);

		$elems->start_controls_tabs( 'sina_transform_effects_tabs' );

		$elems->start_controls_tab(
			'sina_transform_effects_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$elems->add_responsive_control(
			'sina_transform_effects_translateX',
			[
				'label' => esc_html__( 'Translate X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'translate',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_translateY',
			[
				'label' => esc_html__( 'Translate Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'translate',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .elementor-widget-container' => 'transform: translate({{sina_transform_effects_translateX.SIZE || 0}}px, {{sina_transform_effects_translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .elementor-widget-container' => 'transform: translate({{sina_transform_effects_translateX_tablet.SIZE || 0}}px, {{sina_transform_effects_translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .elementor-widget-container' => 'transform: translate({{sina_transform_effects_translateX_mobile.SIZE || 0}}px, {{sina_transform_effects_translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_scaleX',
			[
				'label' => esc_html__( 'Scale X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'condition' => [
					'sina_transform_effects' => 'scaleX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: scaleX({{SIZE}});',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_scaleY',
			[
				'label' => esc_html__( 'Scale Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'condition' => [
					'sina_transform_effects' => 'scaleY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: scaleY({{SIZE}});',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_scaleZ',
			[
				'label' => esc_html__( 'Scale Z', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1',
				],
				'condition' => [
					'sina_transform_effects' => 'scaleZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_rotateX',
			[
				'label' => esc_html__( 'Rotate X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'rotateX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: rotateX({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_rotateY',
			[
				'label' => esc_html__( 'Rotate Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'rotateY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: rotateY({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_rotateZ',
			[
				'label' => esc_html__( 'Rotate Z', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'rotateZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: rotateZ({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_skewX',
			[
				'label' => esc_html__( 'Skew X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'skewX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_skewY',
			[
				'label' => esc_html__( 'Skew Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'skewY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transform: skewY({{SIZE}}deg);',
				],
			]
		);
		$elems->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'sina_transform_effects_filters',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
			]
		);

		$elems->end_controls_tab();

		$elems->start_controls_tab(
			'sina_transform_effects_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$elems->add_responsive_control(
			'sina_transform_effects_translateX_hover',
			[
				'label' => esc_html__( 'Translate X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'sina_transform_effects' => 'translate',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_translateY_hover',
			[
				'label' => esc_html__( 'Translate Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '-10',
				],
				'condition' => [
					'sina_transform_effects' => 'translate',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .elementor-widget-container:hover' => 'transform: translate({{sina_transform_effects_translateX_hover.SIZE || 0}}px, {{sina_transform_effects_translateY_hover.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .elementor-widget-container:hover' => 'transform: translate({{sina_transform_effects_translateX_hover_tablet.SIZE || 0}}px, {{sina_transform_effects_translateY_hover_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .elementor-widget-container:hover' => 'transform: translate({{sina_transform_effects_translateX_hover_mobile.SIZE || 0}}px, {{sina_transform_effects_translateY_hover_mobile.SIZE || 0}}px);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_scaleX_hover',
			[
				'label' => esc_html__( 'Scale X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'sina_transform_effects' => 'scaleX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: scaleX({{SIZE}});',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_scaleY_hover',
			[
				'label' => esc_html__( 'Scale Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'sina_transform_effects' => 'scaleY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: scaleY({{SIZE}});',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_scaleZ_hover',
			[
				'label' => esc_html__( 'Scale Z', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.05',
				],
				'condition' => [
					'sina_transform_effects' => 'scaleZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_rotateX_hover',
			[
				'label' => esc_html__( 'Rotate X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '15',
				],
				'condition' => [
					'sina_transform_effects' => 'rotateX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: rotateX({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_rotateY_hover',
			[
				'label' => esc_html__( 'Rotate Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '15',
				],
				'condition' => [
					'sina_transform_effects' => 'rotateY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: rotateY({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_rotateZ_hover',
			[
				'label' => esc_html__( 'Rotate Z', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 360,
					],
				],
				'default' => [
					'size' => '5',
				],
				'condition' => [
					'sina_transform_effects' => 'rotateZ',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: rotateZ({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_skewX_hover',
			[
				'label' => esc_html__( 'Skew X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '10',
				],
				'condition' => [
					'sina_transform_effects' => 'skewX',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);
		$elems->add_responsive_control(
			'sina_transform_effects_skewY_hover',
			[
				'label' => esc_html__( 'Skew Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '5',
				],
				'condition' => [
					'sina_transform_effects' => 'skewY',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'transform: skewY({{SIZE}}deg);',
				],
			]
		);
		$elems->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'sina_transform_effects_filters_hover',
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover',
			]
		);
		$elems->add_control(
			'sina_transform_effects_duration',
			[
				'label' => esc_html__( 'Transition Duration', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 100,
						'min' => 0,
						'max' => 10000,
					],
				],
				'default' => [
					'size' => '400',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'transition: all {{SIZE}}ms;',
				],
			]
		);

		$elems->end_controls_tab();

		$elems->end_controls_tabs();
	}
}