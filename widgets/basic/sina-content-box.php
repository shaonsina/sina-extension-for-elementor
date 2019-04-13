<?php

/**
 * Content Box Widget.
 *
 * @since 1.0.2
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
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
		return [ 'sina content box', 'sina icon box', 'sina box' ];
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
			'icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-android',
				'condition' => [
					'save_templates' => '',
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
				'default' => __( 'Apps Development', 'sina-ext' ),
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
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.', 'sina-ext' ),
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
					'px' => '1.1',
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
					'px' => '10',
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
				'selectors' => [
					'{{WRAPPER}} .sina-content-box .sina-content-box-icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sina-content-box .sina-content-box-icon i',
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box .sina-content-box-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box .sina-content-box-desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'background',
			[
				'label' => __( 'Box Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => __( 'Icon Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-icon i' => 'border-color: {{VALUE}}'
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'desc_hover_color',
			[
				'label' => __( 'Description Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover .sina-content-box-desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'save_templates' => '',
				],
			]
		);
		$this->add_control(
			'hover_background',
			[
				'label' => __( 'Box Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_hover_border',
			[
				'label' => __( 'Box Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-content-box:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
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
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
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
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
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
				'label' => __( 'Icon', 'sina-ext' ),
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
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box .sina-content-box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-content-box .sina-content-box-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box .sina-content-box-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .sina-content-box .sina-content-box-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box .sina-content-box-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-content-box .sina-content-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .sina-content-box .sina-content-box-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-content-box .sina-content-box-desc',
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

		$this->add_control(
			'ribbon_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f8f8f8',
				'selectors' => [
					'{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'ribbon_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#61ce70',
				'selectors' => [
					'{{WRAPPER}} .sina-ribbon-right, {{WRAPPER}} .sina-ribbon-left' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
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

		$this->end_controls_section();
		// End Ribbon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$this->add_render_attribute( 'title', 'class', 'sina-content-box-title' );
		$this->add_inline_editing_attributes( 'title' );

		$this->add_render_attribute( 'desc', 'class', 'sina-content-box-desc' );
		$this->add_inline_editing_attributes( 'desc' );

		if ( 'sina-content-box-move' == $data['effects'] ):
			?>
			<style type="text/css">
				[data-id="<?php echo $this->get_id(); ?>"] .sina-content-box:hover{
					transform: translate(<?php echo esc_html( $data['translateX']['size'].'px' ); ?>, <?php echo esc_html( $data['translateY']['size'].'px' ); ?>);
				}
			</style>
		<?php endif; ?>

		<div class="sina-content-box <?php echo esc_attr( $data['effects'] ); ?>" style="">
			<?php if ( $data['ribbon_title'] && $data['ribbon_position'] ): ?>
				<div class="<?php echo esc_attr( $data['ribbon_position'] ); ?>">
					<?php echo esc_html( $data['ribbon_title'] ); ?>
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
					<?php endif; ?>

					<div class="sina-content-box-content">
						<?php if ( $data['title'] ): ?>
							<h3 <?php echo $this->get_render_attribute_string( 'title' ); ?>>
								<?php echo esc_html( $data['title'] ); ?>
							</h3>
						<?php endif; ?>

						<?php if ( $data['desc'] ): ?>
							<div <?php echo $this->get_render_attribute_string( 'desc' ); ?>>
								<?php echo esc_html( $data['desc'] ); ?>
							</div>
						<?php endif; ?>
					</div>
			<?php endif; ?>
		</div><!-- .sina-content-box -->
		<?php
	}


	protected function _content_template() {

	}
}