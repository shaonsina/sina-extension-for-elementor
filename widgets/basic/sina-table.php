<?php
/**
 * Table Widget.
 *
 * @since 2.1.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Table_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.1.0
	 */
	public function get_name() {
		return 'sina_table';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.0
	 */
	public function get_title() {
		return __( 'Sina Table', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.0
	 */
	public function get_icon() {
		return 'eicon-table';
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
		return [ 'sina table', 'data table' ];
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
			'data-table',
			'sina-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 3.1.2
	 */
	public function get_script_depends() {
		return [
			'data-table',
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
		// Start Table Header
		// ===================
		$this->start_controls_section(
			'table_header',
			[
				'label' => __( 'Header', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'sorting',
			[
				'label' => __( 'Sorting', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$thead = new Repeater();

		$thead->add_control(
			'header_col_span',
			[
				'label' => __( 'Column Span', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'default' => 1,
			]
		);
		$thead->add_control(
			'header_text',
			[
				'label' => __( 'Header Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter Text', 'sina-ext'),
				'default' => 'WordPress',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$thead->add_control(
			'header_icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$thead->add_control(
			'header_icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Before', 'sina-ext' ),
					'right' => __( 'After', 'sina-ext' ),
				],
				'default' => 'left',
				'condition' => [
					'header_icon!' => '',
				],
			]
		);

		$thead->start_controls_tabs( 'header_style_tabs' );

		$thead->start_controls_tab(
			'header_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$thead->add_control(
			'header_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table thead tr {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$thead->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} table thead tr {{CURRENT_ITEM}}',
			]
		);

		$thead->end_controls_tab();

		$thead->start_controls_tab(
			'header_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$thead->add_control(
			'header_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table thead tr {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$thead->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} table thead tr {{CURRENT_ITEM}}:hover',
			]
		);

		$thead->end_controls_tab();

		$thead->end_controls_tabs();

		$this->add_control(
			'header_content',
			[
				'label' => __('Add Item', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $thead->get_controls(),
				'prevent_empty' => false,
				'default' => [
					[
						'header_text' => 'ID',
					],
					[
						'header_text' => 'First Name',
					],
					[
						'header_text' => 'Last Name',
					],
					[
						'header_text' => 'Age',
					],
				],
				'title_field' => '{{{ header_text }}}',
			]
		);

		$this->end_controls_section();
		// End Table Header
		// =================


		// Start Table Body
		// =================
		$this->start_controls_section(
			'table_body',
			[
				'label' => __( 'Body', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$tbody = new Repeater();

		$tbody->add_control(
			'content_type',
			[
				'label' => __( 'Content Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'row' => __( 'Row', 'sina-ext' ),
					'cell' => __( 'Cell', 'sina-ext' ),
					'head' => __( 'Head', 'sina-ext' ),
				],
				'default' => 'row',
			]
		);
		$tbody->add_control(
			'row_span',
			[
				'label' => __( 'Row Span', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 1,
				'condition' => [
					'content_type' => ['cell', 'head'],
				],
			]
		);
		$tbody->add_control(
			'col_span',
			[
				'label' => __( 'Column Span', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 1,
				'condition' => [
					'content_type' => ['cell', 'head'],
				],
			]
		);
		$tbody->add_control(
			'cell_content',
			[
				'label' => __( 'Content', 'sina-ext' ),
				'type' => Controls_Manager::TEXTAREA,
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'condition' => [
					'content_type' => ['cell', 'head'],
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$tbody->add_control(
			'content_icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'condition' => [
					'content_type' => ['cell', 'head'],
				],
			]
		);
		$tbody->add_control(
			'content_icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Before', 'sina-ext' ),
					'right' => __( 'After', 'sina-ext' ),
				],
				'default' => 'left',
				'condition' => [
					'content_type' => ['cell', 'head'],
					'content_icon!' => '',
				],
			]
		);

		$tbody->start_controls_tabs( 'content_style_tabs' );

		$tbody->start_controls_tab(
			'content_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$tbody->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table tbody {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);
		$tbody->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} table tbody {{CURRENT_ITEM}}',
			]
		);

		$tbody->end_controls_tab();

		$tbody->start_controls_tab(
			'content_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$tbody->add_control(
			'content_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table tbody {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$tbody->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} table tbody {{CURRENT_ITEM}}:hover',
			]
		);

		$tbody->end_controls_tab();

		$tbody->end_controls_tabs();

		$this->add_control(
			'body_content',
			[
				'label' => __('Add Item', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $tbody->get_controls(),
				'default' => [
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'head',
						'row_span' => 1,
						'col_span' => 1,
						'cell_content' => '2019',
					],
					[
						'content_type' => 'cell',
						'row_span' => 1,
						'col_span' => 1,
						'cell_content' => 'Jhon',
					],
					[
						'content_type' => 'cell',
						'row_span' => 1,
						'col_span' => 1,
						'cell_content' => 'Doe',
					],
					[
						'content_type' => 'cell',
						'row_span' => 1,
						'col_span' => 1,
						'cell_content' => '28',
					],
				],
				'title_field' => '{{{ content_type }}}',
			]
		);

		$this->end_controls_section();
		// End Table Body
		// ===============


		// Start Table Header Style
		// =========================
		$this->start_controls_section(
			'table_header_style',
			[
				'label' => __( 'Header', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'header_icon_size',
			[
				'label' => __( 'Icon Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '16',
				],
				'selectors' => [
					'{{WRAPPER}} table thead th > i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'header_icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} table thead th > .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} table thead th > .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} table thead th',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'header_text_shadow',
				'selector' => '{{WRAPPER}} table thead th',
			]
		);

		$this->start_controls_tabs( 'header_tabs' );

		$this->start_controls_tab(
			'header_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'header_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} table thead tr' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} table thead tr',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'header_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#fafafa',
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
				'selector' => '{{WRAPPER}} table thead th',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'header_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'header_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table thead tr:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'header_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} table thead tr:hover',
			]
		);
		$this->add_control(
			'header_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table thead tr:hover th' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} table thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'header_alignment',
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
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} table thead th' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Table Header Style
		// =======================


		// Start Table Content Style
		// =========================
		$this->start_controls_section(
			'table_content_style',
			[
				'label' => __( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_icon_size',
			[
				'label' => __( 'Icon Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '14',
				],
				'selectors' => [
					'{{WRAPPER}} table tbody td > i, {{WRAPPER}} table tbody th > i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} table tbody td > .sina-icon-right, {{WRAPPER}} table tbody th > .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} table tbody td > .sina-icon-left, {{WRAPPER}} table tbody th > .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} table tbody tr',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_text_shadow',
				'selector' => '{{WRAPPER}} table tbody tr',
			]
		);

		$this->start_controls_tabs( 'content_tabs' );

		$this->start_controls_tab(
			'content_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} table tbody tr' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} table tbody tr',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#fafafa',
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
				'selector' => '{{WRAPPER}} table tbody td, {{WRAPPER}} table tbody th',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'content_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} table tbody tr:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(16, 133, 228, 0.2)',
					],
				],
				'selector' => '{{WRAPPER}} table tbody tr:hover',
			]
		);
		$this->add_control(
			'content_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table tbody tr:hover td, {{WRAPPER}} table tbody tr:hover th' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} table tbody td, {{WRAPPER}} table tbody th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_alignment',
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
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} table tbody td, {{WRAPPER}} table tbody th' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Table Content Style
		// =======================


		// Start Table Content Style
		// =========================
		$this->start_controls_section(
			'accent_style',
			[
				'label' => __( 'Accent', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'accent_color',
			[
				'label' => __( 'Accent Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbb',
				'selectors' => [
					'{{WRAPPER}} .dataTables_info, {{WRAPPER}} .dataTables_filter input, {{WRAPPER}} .dataTables_filter, {{WRAPPER}} .dataTables_length, {{WRAPPER}} .dataTables_length select' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'accent_border_color',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbb',
				'selectors' => [
					'{{WRAPPER}} .dataTables_filter input, {{WRAPPER}} .dataTables_length select' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'accent_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '18',
						],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
				],
				'selector' => '{{WRAPPER}} .dataTables_info, {{WRAPPER}} .dataTables_filter, {{WRAPPER}} .dataTables_length',
			]
		);

		$this->add_control(
			'pagination_heading',
			[
				'label' => __( 'Pagination', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'pagi_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbb',
				'selectors' => [
					'{{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_active_color',
			[
				'label' => __( 'Hover & Active Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button:hover, {{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button.current' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagi_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '18',
						],
					],
				],
				'selector' => '{{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button, {{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button.current',
			]
		);

		$this->end_controls_section();
		// End Table Content Style
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$sort_class = ('yes' == $data['sorting']) ? 'sina-data-table' : '';

		$rows = [];
		$tid = 0;
		foreach ($data['body_content'] as $key => $content) {
			if ( 'row' == $content['content_type'] ) {
				$tid = $content['_id'];
				$rows[ $tid ] = [];
			} elseif ( 'head' == $content['content_type'] && isset( $rows[ $tid ] ) ) {
				array_push($rows[ $tid ], [
					'type' => 'th',
					'id' => $content['_id'],
					'row_span' => $content['row_span'],
					'col_span' => $content['col_span'],
					'cell_content' => $content['cell_content'],
					'icon' => $content['content_icon'],
					'icon_align' => $content['content_icon_align'],
				]);
			} elseif ( 'cell' == $content['content_type'] && isset( $rows[ $tid ] ) ) {
				array_push($rows[ $tid ], [
					'type' => 'td',
					'id' => $content['_id'],
					'row_span' => $content['row_span'],
					'col_span' => $content['col_span'],
					'cell_content' => $content['cell_content'],
					'icon' => $content['content_icon'],
					'icon_align' => $content['content_icon_align'],
				]);
			}
		}
		?>
		<div class="sina-table">
			<table class="<?php echo esc_attr( $sort_class ); ?>">
				<?php if ( !empty( $data['header_content'] ) ): ?>
					<thead>
						<tr>
							<?php foreach ($data['header_content'] as $content): ?>
								<th colspan="<?php echo esc_attr( $content['header_col_span'] ); ?>"
									class="elementor-repeater-item-<?php echo esc_attr( $content['_id'] ); ?>">
									<?php if ( $content['header_icon'] && $content['header_icon_align'] == 'left' ): ?>
										<i class="<?php echo esc_attr($content['header_icon']); ?> sina-icon-left"></i>
									<?php endif; ?>
									<?php printf( '%s', $content['header_text'] ); ?>
									<?php if ( $content['header_icon'] && $content['header_icon_align'] == 'right' ): ?>
										<i class="<?php echo esc_attr($content['header_icon']); ?> sina-icon-right"></i>
									<?php endif; ?>
								</th>
							<?php endforeach; ?>
						</tr>
					</thead>
				<?php endif; ?>

				<tbody>
					<?php foreach ($rows as $key => $row) : ?>
						<tr class="elementor-repeater-item-<?php echo esc_attr( $key ); ?>">
							<?php foreach ($row as $content) : ?>
								<<?php printf( '%s', $content['type'] ); ?>
								rowspan="<?php echo esc_attr( $content['row_span'] ); ?>"
								colspan="<?php echo esc_attr( $content['col_span'] ); ?>"
								class="elementor-repeater-item-<?php echo esc_attr( $content['id'] ); ?>" >

								<?php if ( $content['icon'] && $content['icon_align'] == 'left' ): ?>
									<i class="<?php echo esc_attr($content['icon']); ?> sina-icon-left"></i>
								<?php endif; ?>
								<?php printf( '%s', $content['cell_content'] ); ?>
								<?php if ( $content['icon'] && $content['icon_align'] == 'right' ): ?>
									<i class="<?php echo esc_attr($content['icon']); ?> sina-icon-right"></i>
								<?php endif; ?>
								</<?php printf( '%s', $content['type'] ); ?>>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div><!-- .sina-table -->
		<?php
	}


	protected function _content_template() {

	}
}