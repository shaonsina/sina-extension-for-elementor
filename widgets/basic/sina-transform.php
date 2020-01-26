<?php
/**
 * Transform Widget.
 *
 * @since 2.1.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Frontend;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Transform_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.1.0
	 */
	public function get_name() {
		return 'sina_transform';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.0
	 */
	public function get_title() {
		return __( 'Sina Transform', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.0
	 */
	public function get_icon() {
		return 'eicon-exchange';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.1.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 */
	public function get_keywords() {
		return [ 'sina transform', 'sina shape' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.1.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.1.0
	 */
	protected function _register_controls() {
		// Start Transform Content
		// =========================
		$this->start_controls_section(
			'transform_content',
			[
				'label' => __( 'Transform Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'save_templates',
			[
				'label' => __( 'Use Save Templates', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'template',
			[
				'label' => __( 'Choose Template', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'save_templates!' => '',
				],
				'description' => __('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext'),
			]
		);
		$this->add_control(
			'empty_space',
			[
				'label' => __( 'Space', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'save_templates!' => 'yes',
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'save_templates' => '',
					'empty_space!' => 'yes',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Transform Content
		// =======================


		// Start Transform Style
		// =========================
		$this->start_controls_section(
			'transform_style',
			[
				'label' => __( 'Transform Style', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '100',
					'unit' => 'px',
				],
				'condition' => [
					'empty_space' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'transform_effects',
			[
				'label' => __( 'Transform Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'rotateX' => __( 'Rotate X', 'sina-ext' ),
					'rotateY' => __( 'Rotate Y', 'sina-ext' ),
					'rotateZ' => __( 'Rotate Z', 'sina-ext' ),
					'skewX' => __( 'Skew X', 'sina-ext' ),
					'skewY' => __( 'Skew Y', 'sina-ext' ),
					'translate' => __( 'Translate', 'sina-ext' ),
					'none' => __( 'None', 'sina-ext' ),
				],
				'default' => 'rotateY',
			]
		);
		$this->add_control(
			'transform_3D',
			[
				'label' => __( '3D Transform', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_responsive_control(
			'transform_perspective',
			[
				'label' => __( 'Perspective Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => 0,
						'max' => 2000,
					],
				],
				'default' => [
					'size' => '800',
				],
				'condition' => [
					'transform_3D' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform' => 'perspective: {{SIZE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'transform_tabs' );

		$this->start_controls_tab(
			'transform_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_responsive_control(
			'rotateX',
			[
				'label' => __( 'Rotate X', 'sina-ext' ),
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
					'transform_effects' => 'rotateX',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: rotateX({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'rotateY',
			[
				'label' => __( 'Rotate Y', 'sina-ext' ),
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
					'transform_effects' => 'rotateY',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: rotateY({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'rotateZ',
			[
				'label' => __( 'Rotate Z', 'sina-ext' ),
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
					'transform_effects' => 'rotateZ',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: rotateZ({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'skewX',
			[
				'label' => __( 'Skew X', 'sina-ext' ),
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
					'transform_effects' => 'skewX',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'skewY',
			[
				'label' => __( 'Skew Y', 'sina-ext' ),
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
					'transform_effects' => 'skewY',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: skewY({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'translateX',
			[
				'label' => __( 'Translate X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '10',
				],
				'condition' => [
					'transform_effects' => 'translate',
				],
			]
		);
		$this->add_responsive_control(
			'translateY',
			[
				'label' => __( 'Translate Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '10',
				],
				'condition' => [
					'transform_effects' => 'translate',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: translate({{SIZE}}{{UNIT}});',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-transform-content' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-transform-content' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-transform-content' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'transform_filters',
				'selector' => '{{WRAPPER}} .sina-transform-content',
				'condition' => [
					'empty_space!' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'transform_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-transform-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'transform_border',
				'selector' => '{{WRAPPER}} .sina-transform-content',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'transform_shadow',
				'selector' => '{{WRAPPER}} .sina-transform-content',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'transform_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_responsive_control(
			'rotateX_hover',
			[
				'label' => __( 'Rotate X', 'sina-ext' ),
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
					'transform_effects' => 'rotateX',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform:hover .sina-transform-content' => 'transform: rotateX({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'rotateY_hover',
			[
				'label' => __( 'Rotate Y', 'sina-ext' ),
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
					'transform_effects' => 'rotateY',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform:hover .sina-transform-content' => 'transform: rotateY({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'rotateZ_hover',
			[
				'label' => __( 'Rotate Z', 'sina-ext' ),
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
					'transform_effects' => 'rotateZ',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform:hover .sina-transform-content' => 'transform: rotateZ({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'skewX_hover',
			[
				'label' => __( 'Skew X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '15',
				],
				'condition' => [
					'transform_effects' => 'skewX',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform:hover .sina-transform-content' => 'transform: skewX({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'skewY_hover',
			[
				'label' => __( 'Skew Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -60,
						'max' => 60,
					],
				],
				'default' => [
					'size' => '15',
				],
				'condition' => [
					'transform_effects' => 'skewY',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform:hover .sina-transform-content' => 'transform: skewY({{SIZE}}deg);',
				],
			]
		);
		$this->add_responsive_control(
			'translateX_hover',
			[
				'label' => __( 'Translate X', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '10',
				],
				'condition' => [
					'transform_effects' => 'translate',
				],
			]
		);
		$this->add_responsive_control(
			'translateY_hover',
			[
				'label' => __( 'Translate Y', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '10',
				],
				'condition' => [
					'transform_effects' => 'translate',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'transform: translate({{SIZE}}{{UNIT}});',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-transform-content:hover' => 'transform: translate({{translateX_hover.SIZE || 0}}px, {{translateY_hover.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-transform-content:hover' => 'transform: translate({{translateX_hover_tablet.SIZE || 0}}px, {{translateY_hover_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-transform-content:hover' => 'transform: translate({{translateX_hover_mobile.SIZE || 0}}px, {{translateY_hover_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'transform_filters_hover',
				'selector' => '{{WRAPPER}} .sina-transform:hover .sina-transform-content',
				'condition' => [
					'empty_space!' => 'yes',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'transform_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-transform:hover .sina-transform-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'transform_border_hover',
				'selector' => '{{WRAPPER}} .sina-transform:hover .sina-transform-content',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'transform_shadow_hover',
				'selector' => '{{WRAPPER}} .sina-transform:hover .sina-transform-content',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'transform_radius',
			[
				'label' => __('Border Radius', 'sina-ext'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' , '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-transform-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Transform Style
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-transform">
			<div class="sina-transform-content <?php echo esc_attr( $data['transform_overflow'] ); ?>">
				<?php
					if ( 'yes' == $data['save_templates'] && $data['template'] ) :
						$frontend = new Frontend;
						echo $frontend->get_builder_content( $data['template'], true );
					elseif ( $data['image']['url'] ) :
						?>
						<img src="<?php echo esc_url( $data['image']['url'] ); ?>">
				<?php endif; ?>
			</div><!-- .sina-transform-content -->
		</div><!-- .sina-transform -->
		<?php
	}


	protected function _content_template() {

	}
}