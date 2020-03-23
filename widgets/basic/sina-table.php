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
				'label' => __( 'Table', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
				'label' => __('Add Header Column', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $thead->get_controls(),
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
				'label' => __('Add Row', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $tbody->get_controls(),
				'prevent_empty' => false,
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

		$this->add_control(
			'note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'NOTICE: If you using data from the external source,  make sure here is no row or cell except the header row.', 'sina-ext' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);

		$this->end_controls_section();
		// End Table Header
		// =================


		// Start Table Settings
		// =====================
		$this->start_controls_section(
			'table_settings',
			[
				'label' => __( 'Table Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'data_table',
			[
				'label' => __( 'Data Table', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => __('Whether this table use as a data table or not?', 'sina-ext'),
			]
		);
		$this->add_control(
			'data_export',
			[
				'label' => __( 'Data Export', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'data_table' => 'yes',
				],
				'default' => 'yes',
			]
		);
		$this->add_control(
			'data_searching',
			[
				'label' => __( 'Data Searching', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'data_table' => 'yes',
				],
				'default' => 'yes',
			]
		);
		$this->add_control(
			'data_sorting',
			[
				'label' => __( 'Data Sorting', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'data_table' => 'yes',
				],
				'default' => 'yes',
			]
		);
		$this->add_control(
			'data_info',
			[
				'label' => __( 'Data Info', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'data_table' => 'yes',
				],
				'default' => 'yes',
			]
		);
		$this->add_control(
			'data_paging',
			[
				'label' => __( 'Pagination', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'data_table' => 'yes',
				],
				'default' => 'yes',
			]
		);
		$this->add_control(
			'data_paging_type',
			[
				'label' => __( 'Pagination Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'numbers' => __( 'Numbers Only', 'sina-ext' ),
					'simple' => __( 'Prev & Next Only', 'sina-ext' ),
					'simple_numbers' => __( 'Prev, Next & Numbers', 'sina-ext' ),
					'first_last_numbers' => __( 'First, Last & Numbers', 'sina-ext' ),
					'full' => __( 'First, Last, Prev & Next', 'sina-ext' ),
					'full_numbers' => __( 'All', 'sina-ext' ),
				],
				'default' => 'simple_numbers',
				'condition' => [
					'data_table' => 'yes',
					'data_paging' => 'yes',
				],
			]
		);
		$this->add_control(
			'data_source',
			[
				'label' => __( 'Data Source', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'sina-ext' ),
					'external' => __( 'External', 'sina-ext' ),
				],
				'condition' => [
					'data_table' => 'yes',
				],
				'default' => 'none',
			]
		);
		$this->add_control(
			'external_source',
			[
				'label' => __( 'Source Link', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter Link', 'sina-ext'),
				'description' => __('The source link must have the data in JSON format!', 'sina-ext'),
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'data_table' => 'yes',
					'data_source' => 'external',
				],
			]
		);

		$this->end_controls_section();
		// End Table Settigs
		// ===================


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
					'top' => '15',
					'right' => '20',
					'bottom' => '15',
					'left' => '20',
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
					'top' => '15',
					'right' => '20',
					'bottom' => '15',
					'left' => '20',
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


		// Start Table Export Style
		// =========================
		$this->start_controls_section(
			'export_buttons_style',
			[
				'label' => __( 'Export Buttons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'data_table' => 'yes',
					'data_export' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'export_btns_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '400',
					],
					'font_size'   => [
						'default' => [
							'size' => '15',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '22',
						],
					],
				],
				'selector' => '{{WRAPPER}} .dt-button',
			]
		);

		$this->start_controls_tabs( 'export_buttons' );

		$this->start_controls_tab(
			'export_btns_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'export_btns_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbb',
				'selectors' => [
					'{{WRAPPER}} .dt-button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'export_btns_bg',
			[
				'label' => __( 'Background Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dt-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'export_btns_border',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'color' => [
						'default' => '#ddd',
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
				'selector' => '{{WRAPPER}} .dt-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'export_btns_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'export_btns_hover_color',
			[
				'label' => __( 'Hover Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .dt-button:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'export_btns_hover_bg',
			[
				'label' => __( 'Background Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dt-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'export_btns_hovr_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .dt-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'export_btns_gap',
			[
				'label' => __( 'Bottom Gap', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '20',
					'unit' => 'px'
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .dt-button' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'export_btns_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '14',
					'bottom' => '8',
					'left' => '14',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .dt-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'export_btns_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .dt-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'export_btns_alignment',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .dt-buttons' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Table Export Style
		// =======================


		// Start Table Accent Style
		// =========================
		$this->start_controls_section(
			'accent_style',
			[
				'label' => __( 'Accent', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'data_table' => 'yes',
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
			'accent_color',
			[
				'label' => __( 'Accent Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
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
				'default' => '#ddd',
				'selectors' => [
					'{{WRAPPER}} .dataTables_filter input, {{WRAPPER}} .dataTables_length select' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_heading',
			[
				'label' => __( 'Pagination', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'data_table' => 'yes',
					'data_paging' => 'yes',
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
				'condition' => [
					'data_table' => 'yes',
					'data_paging' => 'yes',
				],
				'selector' => '{{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button, {{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button.current',
			]
		);
		$this->add_control(
			'pagi_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#bbb',
				'condition' => [
					'data_table' => 'yes',
					'data_paging' => 'yes',
				],
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
				'condition' => [
					'data_table' => 'yes',
					'data_paging' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button:hover, {{WRAPPER}} .dataTables_wrapper .dataTables_paginate .paginate_button.current' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Table Accent Style
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$table_class = ('yes' == $data['data_table']) ? 'sina-data-table' : '';

		$table_head = [];
		foreach ($data['header_content'] as $content) {
			$table_head[] = [
				'data' => $content['header_text']
			];
		}

		$external_source = ( 'external' == $data['data_source'] && $data['external_source'] ) ? $data['external_source'] : '';

		$table_info = [
			'head' 		=> $table_head,
			'export' 	=> $data['data_export'],
			'ordering' 	=> $data['data_sorting'],
			'searching' => $data['data_searching'],
			'paging' 	=> $data['data_paging'],
			'pagingType' => $data['data_paging_type'],
			'info' 		=> $data['data_info'],
			'external_source' => $external_source,
		];

		$rows = [];
		$tid = 0;
		if ( !empty( $data['body_content'] ) ) {
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
		}
		?>
		<div class="sina-table"
		data-table-info='<?php echo json_encode( $table_info ); ?>'>
			<table class="<?php echo esc_attr( $table_class ); ?>">
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
		?>
		<#
			var tableClass = ('yes' == settings.data_table) ? 'sina-data-table' : '';

			var tableHead = [];
			_.each( settings.header_content, function( content, key ) {
				tableHead.push({ 'data' : content.header_text });
			});

			var external_source = ( 'external' == settings.data_source && settings.external_source ) ? settings.external_source : '';

			var tableInfo = {
				'head' : tableHead,
				'export' : settings.data_export,
				'ordering' : settings.data_sorting,
				'searching' : settings.data_searching,
				'paging' : settings.data_paging,
				'pagingType' : settings.data_paging_type,
				'info' : settings.data_info,
				'external_source' : external_source,
			}
			tableInfo = JSON.stringify(tableInfo);

			var rows = [];
			var tid = 0;
			if( settings.body_content.length > 0) {
				_.each( settings.body_content, function( content, key ) {
					if ('row' == content.content_type) {
						tid = content._id;
						rows[ tid ] = [];
					} else if ('head' == content.content_type && rows[ tid ] !== 'undefined') {
						rows[ tid ].push({
							type : 'th',
							id : content._id,
							row_span : content.row_span,
							col_span : content.col_span,
							cell_content : content.cell_content,
							icon : content.content_icon,
							icon_align : content.content_icon_align,

						});
					} else if ('cell' == content.content_type && rows[ tid ] !== 'undefined') {
						rows[ tid ].push({
							type : 'td',
							id : content._id,
							row_span : content.row_span,
							col_span : content.col_span,
							cell_content : content.cell_content,
							icon : content.content_icon,
							icon_align : content.content_icon_align,

						});
					}
				});
			}

			rows.reverse();
		#>
		<div class="sina-table"
		data-table-info='{{{tableInfo}}}'>
			<table class="{{{tableClass}}}">
				<# if (settings.header_content.length > 0) { #>
					<thead>
						<tr>
							<# _.each( settings.header_content, function( content, index ) { #>
								<th colspan="{{{content.header_col_span}}}"
									class="elementor-repeater-item-{{{content._id}}}">
									<# if (content.header_icon && content.header_icon_align == 'left') { #>
										<i class="{{{content.header_icon}}} sina-icon-left"></i>
									<# } #>

									{{{content.header_text}}}

									<# if (content.header_icon && content.header_icon_align == 'right') { #>
										<i class="{{{content.header_icon}}} sina-icon-right"></i>
									<# } #>
								</th>
							<# }); #>
						</tr>
					</thead>
				<# } #>

				<tbody>
					<# for (d in rows) { #>
						<tr class="elementor-repeater-item-{{{d}}}">
							<# _.each( rows[d], function( content, index ) { #>
								<{{{content.type}}}
								rowspan="{{{content.row_span}}}"
								colspan="{{{content.col_span}}}"
								class="elementor-repeater-item-{{{content.id}}}" >

								<# if (content.icon && content.icon_align == 'left') { #>
									<i class="{{{content.icon}}} sina-icon-left"></i>
								<# } #>

								{{{content.cell_content}}}

								<# if (content.icon && content.icon_align == 'right') { #>
									<i class="{{{content.icon}}} sina-icon-right"></i>
								<# } #>

								</{{{content.type}}}>
							<# }); #>
						</tr>
					<# }; #>
				</tbody>
			</table>
		</div><!-- .sina-table -->
		<?php
	}
}