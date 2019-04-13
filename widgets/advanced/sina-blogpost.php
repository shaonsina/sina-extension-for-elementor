<?php

/**
 * Blog Post Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Blogpost_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_blogpost';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Blog Post', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-edit';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina post', 'sina blog', 'sina blogpost' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.0.0
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
	 * @since 1.0.0
	 */
	public function get_script_depends() {
		return [
			'imagesLoaded',
			'isotope',
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Blogpost Content
		// =====================
		$this->start_controls_section(
			'blog_content',
			[
				'label' => __( 'Blog Post', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Number of Columns', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-bp-item-2' => __( '2', 'sina-ext' ),
					'sina-bp-item-3' => __( '3', 'sina-ext' ),
					'sina-bp-item-4' => __( '4', 'sina-ext' ),
				],
				'default' => 'sina-bp-item-3',
			]
		);
		$this->add_control(
			'posts_num',
			[
				'label' => __( 'Number of Posts', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 1,
				'max' => 50,
				'default' => 6,
			]
		);
		$this->add_control(
			'offset',
			[
				'label' => __( 'Number of Offset', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 50,
				'default' => 0,
			]
		);
		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'sina-ext' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_categories(),
			]
		);
		$this->add_control(
			'order_by',
			[
				'label' => __( 'Order by', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'date' => __( 'Date', 'sina-ext' ),
					'title' => __( 'Title', 'sina-ext' ),
					'author' => __( 'Author', 'sina-ext' ),
					'modified' => __( 'Modified', 'sina-ext' ),
					'comment_count' => __( 'Comments', 'sina-ext' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'sort',
			[
				'label' => __( 'Sort', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => __( 'ASC', 'sina-ext' ),
					'DESC' => __( 'DESC', 'sina-ext' ),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'content_length',
			[
				'label' => __( 'Content Word', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 10,
				'max' => 2000,
				'default' => 50,
			]
		);
		$this->add_control(
			'excerpt',
			[
				'label' => __( 'Excerpt', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'posts_meta',
			[
				'label' => __( 'Meta', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagination',
			[
				'label' => __( 'Pagination', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
				'condition' => [
					'loadmore' => '',
				],
			]
		);
		$this->add_control(
			'loadmore',
			[
				'label' => __( 'Load More', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'sina-ext' ),
				'label_off' => __( 'No', 'sina-ext' ),
				'condition' => [
					'pagination' => '',
				],
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'condition' => [
					'loadmore!' => '',
				],
				'default' => __( 'Load More', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Blogpost Content
		// =====================


		// Start Post Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Post', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'note',
			[
				'label' => 'If you want to change the <strong>Padding</strong> or <strong>Border</strong> then the page need to <strong>Refresh</strong> for seeing the actual result',
				'type' => Controls_Manager::RAW_HTML,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'background',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'overlay_bg',
			[
				'label' => __( 'Overlay Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.2)',
				'selectors' => [
					'{{WRAPPER}} .sina-bg-thumb .sina-overlay' => 'background: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-bp',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-bp',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-bp-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Post Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => __( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .sina-bp-content',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .sina-bp-content',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// =====================


		// Start Title Style
		// =====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .sina-bp-title, {{WRAPPER}} .sina-bp-title a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-bp-title a',
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-title a:hover, {{WRAPPER}} .sina-bp-title a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Meta Style
		// =====================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => __( 'Meta', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_meta!' => '',
				],
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'link_tabs' );

		$this->start_controls_tab(
			'link_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => __( 'Link Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'link_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'link_hover_color',
			[
				'label' => __( 'Link Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta a:hover, {{WRAPPER}} .sina-bp-meta a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'meta_border',
				'selector' => '{{WRAPPER}} .sina-bp-meta',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'meta_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Meta Style
		// =====================


		// Start Pagination Style
		// =======================
		$this->start_controls_section(
			'pagination_style',
			[
				'label' => __( 'Pagination', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'pagi_link_tabs' );

		$this->start_controls_tab(
			'pagi_link_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagi_link_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_link_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pagi_link_border',
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagi_link_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagi_link_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers:hover, {{WRAPPER}} .sina-bp-pagination .page-numbers:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_link_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers:hover, {{WRAPPER}} .sina-bp-pagination .page-numbers:focus' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_link_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers:hover, {{WRAPPER}} .sina-bp-pagination .page-numbers:focus',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagi_link_current',
			[
				'label' => __( 'Current', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagi_link_current_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_link_current_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers.current' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pagi_link_current_border',
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers.current',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'pagi_gap',
			[
				'label' => __( 'Gap From Posts', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_link_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_link_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_link_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_alignment',
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
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Pagination Style
		// =====================


		// Start Load button Style
		// ===========================
		$this->start_controls_section(
			'load_btn_style',
			[
				'label' => __( 'Load More Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'loadmore!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'load_btn_typography',
				'selector' => '{{WRAPPER}} .sina-load-more-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'load_btn_tshadow',
				'selector' => '{{WRAPPER}} .sina-load-more-btn',
			]
		);

		$this->start_controls_tabs( 'load_btn_tabs' );

		$this->start_controls_tab(
			'load_btn_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'load_btn_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'load_btn_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'load_btn_shadow',
				'selector' => '{{WRAPPER}} .sina-load-more-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'load_btn_border',
				'selector' => '{{WRAPPER}} .sina-load-more-btn',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'load_btn_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'load_btn_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'load_btn_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'load_btn_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-load-more-btn:hover',
			]
		);
		$this->add_control(
			'load_btn_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'load_btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_btn_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_btn_alignment',
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
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Load Button Style
		// ==========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$new_offset = $data['offset'] + ( ( $paged - 1 ) * $data['posts_num'] );
		$category	= !empty($data['categories']) ? implode( ',', $data['categories'] ) : '';
		$default	= [
			'category_name'		=> $category,
			'orderby'			=> [ $data['order_by'] => $data['sort'] ],
			'posts_per_page'	=> $data['posts_num'],
			'paged'				=> $paged,
			'offset'			=> $new_offset,
			'has_password'		=> false,
			'post_status'		=> 'publish',
			'post__not_in'		=> get_option( 'sticky_posts' ),
		];

		// Post Query
		$post_query = new WP_Query( $default );

		if ( $post_query->have_posts() ) :
			?>
			<div class="sina-blogpost <?php echo esc_attr( 'sina-bp-'.$this->get_id() ); ?>"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>"
			data-columns="<?php echo esc_attr( $data['columns'] ); ?>"
			data-categories="<?php echo esc_attr( $category ); ?>"
			data-posts-num="<?php echo esc_attr( $data['posts_num'] ); ?>"
			data-total-posts="<?php echo esc_attr( $post_query->found_posts ); ?>"
			data-posts-meta="<?php echo esc_attr( $data['posts_meta'] ); ?>"
			data-content-length="<?php echo esc_attr( $data['content_length'] ); ?>"
			data-offset="<?php echo esc_attr( $new_offset + $data['posts_num'] ); ?>"
			data-excerpt="<?php echo esc_attr( $data['excerpt'] ); ?>">
				<div class="sina-bp-grid">
					<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
						<div class="sina-bp-col <?php echo esc_attr( $data['columns'] ) ?>">
							<div class="sina-bp">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="sina-bg-thumb">
										<?php the_post_thumbnail(); ?>
										<div class="sina-overlay">
											<a href="<?php the_permalink(); ?>"></a>
										</div>
									</div>
								<?php endif; ?>
								<div class="sina-bp-content">
									<h2 class="sina-bp-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<div class="sina-bp-text">
										<?php
											if ( has_excerpt() &&  'yes' == $data['excerpt'] ):
												$excerpt = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_excerpt() );
												echo wp_kses_post( wp_trim_words( $excerpt, $data['content_length'] ) );
											else:
												$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
												echo wp_kses_post( wp_trim_words( $content, $data['content_length'] ) );
											endif;
										?>
									</div>
									<?php if ( 'yes' == $data['posts_meta'] ): ?>
										<div class="sina-bp-meta">
											<?php _e('by', 'sina-ext'); ?>
											<?php the_author_posts_link(); ?>
											|
											<?php echo esc_html( get_the_date() ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endwhile; wp_reset_query(); ?>
				</div>

				<?php if ( 'yes' == $data['loadmore'] && $data['btn_text'] && ($data['posts_num'] + $new_offset) < $post_query->found_posts ): ?>
					<div class="sina-load-more">
						<button class="sina-load-more-btn">
							<?php echo esc_html( $data['btn_text'] ); ?>
						</button>
					</div>
				<?php endif; ?>

				<?php if ( 'yes' == $data['pagination'] ): ?>
					<div class="sina-bp-pagination">
						<?php
							$paginate = paginate_links( [
								'total'		=> $post_query->max_num_pages,
								'current'	=> $paged,
								'prev_next'	=> false,
							] );
							echo str_replace('span', 'a', $paginate);
						?>
					</div>
				<?php endif; ?>
				<?php wp_nonce_field( 'sina_load_more_posts', 'sina_load_more_posts'.$this->get_id() ); ?>
			</div><!-- .sina-blogpost -->
			<?php
		else:
			?>
				<h3><?php _e('No Posts found', 'sina-ext'); ?></h3>
			<?php
		endif;
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->render_editor_script();
		}
	}


	protected function render_editor_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var sinaBPClass = '.sina-bp-'+'<?php echo $this->get_id(); ?>',
				$this = $(sinaBPClass),
				$isoGrid = $this.children('.sina-bp-row');

			$this.imagesLoaded( function() {
				$isoGrid.isotope({
					itemSelector: '.sina-bp-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-bp-col',
					}
				});
			});

			var items = $this.data('items'),
				btn = $this.find('.sina-load-more-btn');
		});
		</script>
		<?php
	}


	protected function _content_template() {

	}
}