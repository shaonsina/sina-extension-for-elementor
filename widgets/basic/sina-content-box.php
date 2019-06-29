<?php

/**
 * Content Box Widget.
 *
 * @since 1.0.2
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Frontend;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Content_Box_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.2
	 */
	public function get_name() {
		return 'sina_content_box';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.2
	 */
	public function get_title() {
		return __( 'Sina Content Box', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.2
	 */
	public function get_icon() {
		return 'eicon-icon-box';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.2
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.2
	 */
	public function get_keywords() {
		return [ 'sina content box', 'sina icon box', 'sina image box', 'sina box' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.2
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
	 * @since 1.0.2
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Box Content
		// =====================
		$this->start_controls_section(
			'box_content',
			[
				'label' => __( 'Box', 'sina-ext' ),
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
			'ribbon_title',
			[
				'label' => __( 'Ribbon Title', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'ribbon_position',
			[
				'label' => __( 'Ribbon Position', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'sina-ribbon-left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'eicon-h-align-left',
					],
					'sina-ribbon-right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'ribbon_title!' => '',
				],
				'default' => 'sina-ribbon-right',
			]
		);
		$this->add_control(
			'icon_format',
			[
				'label' => __( 'Icon Format', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'sina-ext' ),
						'icon' => 'fa fa-star',
					],
					'image' => [
						'title' => __( 'Image', 'sina-ext' ),
						'icon' => 'fa fa-image',
					],
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-amazon',
				'condition' => [
					'save_templates' => '',
					'icon_format' => 'icon',
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'save_templates' => '',
					'icon_format' => 'image',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Apps Development',
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Description', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.',
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$this->end_controls_section();
		// End Box Content
		// =====================


		// Start Box Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => __( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-content-box-move' => __( 'Move', 'sina-ext' ),
					'sina-content-box-zoom' => __( 'Zoom', 'sina-ext' ),
					'' => __( 'None', 'sina-ext' ),
				],
				'default' => 'sina-content-box-zoom',
			]
		);
		$this->add_control(
			'scale',
			[
				'label' => __( 'Scale', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 0.1,
						'min' => 0.1,
						'max' => 5,
					],
				],
				'default' => [
					'size' => '1.1',
				],
				'condition' => [
					'effects' => 'sina-content-box-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box.sina-content-box-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'translateY',
			[
				'label' => __( 'Vertical', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '-10',
				],
				'condition' => [
					'effects' => 'sina-content-box-move',
				],
			]
		);
		$this->add_control(
			'translateX',
			[
				'label' => __( 'Horizontal', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 1,
						'min' => -100,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '0',
				],
				'condition' => [
					'effects' => 'sina-content-box-move',
				],
			]
		);

		$this->start_controls_tabs( 'box_tabs' );

		$this->start_controls_tab(
			'box_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'condition' => [
					'save_templates' => '',
				],
				'selector' => '{{WRAPPER}} .sina-content-box-icon i, {{WRAPPER}} .sina-content-box-icon img',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-title, {{WRAPPER}} .sina-content-box-title > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fff',
					],
				],
				'selector' => '{{WRAPPER}} .sina-content-box',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#eee',
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
				'selector' => '{{WRAPPER}} .sina-content-box',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => __( 'Icon Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon i, {{WRAPPER}} .sina-content-box:hover .sina-content-box-icon img' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-title, {{WRAPPER}} .sina-content-box:hover .sina-content-box-title > a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'desc_hover_color',
			[
				'label' => __( 'Description Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'save_templates' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-content-box:hover',
			]
		);
		$this->add_control(
			'box_hover_border',
			[
				'label' => __( 'Box Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'fields_options' => [
					'box_shadow_type' => [ 
						'default' =>'yes' 
					],
					'box_shadow' => [
						'default' => [
							'horizontal' => '0',
							'vertical' => '10',
							'blur' => '10',
							'color' => 'rgba(0,0,0,0.1)'
						]
					]
				],
				'selector' => '{{WRAPPER}} .sina-content-box:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '30',
					'bottom' => '30',
					'left' => '30',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Icon Or Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
				],
				'default'=> [
					'unit' => 'px',
					'size' => '38',
				],
				'condition' => [
					'icon_format' => 'icon',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => __( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 300,
					],
					'em' => [
						'max' => 30,
					],
				],
				'default'=> [
					'unit' => 'px',
					'size' => '100',
				],
				'condition' => [
					'icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon i, {{WRAPPER}} .sina-content-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-icon i, {{WRAPPER}} .sina-content-box-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// =====================


		// Start Title Style
		// =====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
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
					'transform'   => [
						'default' => [
							'size' => 'uppercase',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-content-box-title, {{WRAPPER}} .sina-content-box-title > a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box-title, {{WRAPPER}} .sina-content-box-title > a',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Desc Style
		// =====================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'save_templates' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .sina-content-box-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box-desc',
			]
		);

		$this->end_controls_section();
		// End Desc Style
		// =====================


		// Start Ribbon Style
		// =====================
		$this->start_controls_section(
			'ribbon_style',
			[
				'label' => __( 'Ribbon', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'ribbon_title!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'ribbon_shadow',
				'selector' => '{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left',
			]
		);
		$this->add_control(
			'ribbon_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f8f8f8',
				'selectors' => [
					'{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ribbon_bg',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#61ce70',
					],
				],
				'selector' => '{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left',
			]
		);

		$this->end_controls_section();
		// End Ribbon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ( 'sina-content-box-move' == $data['effects'] ):
			?>
			<style type="text/css">
				[data-id="<?php echo $this->get_id(); ?>"] .sina-content-box:hover{
					transform: translate(<?php echo esc_attr( $data['translateX']['size'].'px' ); ?>, <?php echo esc_attr( $data['translateY']['size'].'px' ); ?>);
				}
			</style>
		<?php endif; ?>

		<div class="sina-content-box <?php echo esc_attr( $data['effects'] ); ?>">
			<?php if ( $data['ribbon_title'] && $data['ribbon_position'] ): ?>
				<div class="<?php echo esc_attr( $data['ribbon_position'] ); ?>">
					<?php printf( '%s', $data['ribbon_title'] ); ?>
				</div>
			<?php endif; ?>

			<?php
				if ( 'yes' == $data['save_templates'] && $data['template'] ) :
					$frontend = new Frontend;
					echo $frontend->get_builder_content( $data['template'], true );
				else:
					?>
					<?php if ( $data['icon'] ): ?>
						<div class="sina-content-box-icon">
							<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
						</div>
					<?php elseif( $data['image'] ): ?>
						<div class="sina-content-box-icon">
							<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $data['title'] ) ?>">
						</div>
					<?php endif; ?>

					<div class="sina-content-box-content">
						<?php if ( $data['title'] ): ?>
							<h3 class="sina-content-box-title">
								<?php if ( $data['link']['url'] ): ?>
									<a href="<?php echo esc_url( $data['link']['url'] ); ?>"
										<?php if ( 'on' == $data['link']['is_external'] ): ?>
											target="_blank" 
										<?php endif; ?>
										<?php if ( 'on' == $data['link']['nofollow'] ): ?>
											rel="nofollow" 
										<?php endif; ?>>
										<?php printf( '%1$s', $data['title'] ); ?>
									</a>
								<?php else: ?>
									<?php printf( '%1$s', $data['title'] ); ?>
								<?php endif; ?>
							</h3>
						<?php endif; ?>

						<?php if ( $data['desc'] ): ?>
							<?php printf( '<div class="sina-content-box-desc">%1$s</div>', $data['desc'] ); ?>
						<?php endif; ?>
					</div>
			<?php endif; ?>
		</div><!-- .sina-content-box -->
		<?php
	}


	protected function _content_template() {

	}
}