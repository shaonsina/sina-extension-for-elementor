<?php

/**
 * Blog Post Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Blogpost_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Blog Post', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-pencil';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina posts', 'sina blog', 'sina blogpost', 'sina blog posts' ];
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
			'icofont',
			'font-awesome',
			'elementor-icons',
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
	protected function register_controls() {
		// Start Blogpost Content
		// =====================
		$this->start_controls_section(
			'blog_content',
			[
				'label' => esc_html__( 'Blog Post', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => esc_html__( 'Layout Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'sina-ext' ),
					'custom' => esc_html__( 'Custom', 'sina-ext' ),
				],
				'default' => 'default',
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'grid' => esc_html__( 'Grid', 'sina-ext' ),
					'list' => esc_html__( 'List', 'sina-ext' ),
				],
				'default' => 'grid',
			]
		);
		$this->add_control(
			'custom_columns',
			[
				'label' => esc_html__( 'Custom Column', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'You have to enter a series of comma-separated values. That series represents your custom grid. Possible values: 3,4,5,6,7,8,9,12.', 'sina-ext' ),
				'default' => '6,6,4,4,4',
				'condition' => [
					'layout_type' => 'custom',
				],
			]
		);
		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Number of Column', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( '1', 'sina-ext' ),
					'2' => esc_html__( '2', 'sina-ext' ),
					'3' => esc_html__( '3', 'sina-ext' ),
					'4' => esc_html__( '4', 'sina-ext' ),
				],
				'condition' => [
					'layout_type' => 'default',
				],
				'default' => '3',
			]
		);
		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'sina-ext' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_category_ids(),
			]
		);
		$this->add_control(
			'tags',
			[
				'label' => esc_html__( 'Tags', 'sina-ext' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_tag_ids(),
			]
		);
		Sina_Common_Data::posts_content($this);
		$this->add_control(
			'is_thumb',
			[
				'label' => esc_html__( 'Feature Image', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'default' => 'yes',
				'condition' => [
					'layout' => 'grid',
				],
			]
		);
		$this->add_control(
			'thumb_right',
			[
				'label' => esc_html__( 'Thumb Right', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'layout' => 'list',
				],
			]
		);
		$this->add_control(
			'posts_cats',
			[
				'label' => esc_html__( 'Show Categories', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'posts_meta',
			[
				'label' => esc_html__( 'Show Meta', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'posts_avatar',
			[
				'label' => esc_html__( 'Show Avatar', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'posts_meta!' => '',
				],
			]
		);
		$this->add_control(
			'posts_text',
			[
				'label' => esc_html__( ' Show Content', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'posts_text' => 'yes',
				],
			]
		);
		$this->add_control(
			'content_length',
			[
				'label' => esc_html__( 'Content Length (Word)', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 2000,
				'default' => 50,
				'condition' => [
					'posts_text' => 'yes',
				],
			]
		);
		$this->add_control(
			'pagination',
			[
				'label' => esc_html__( 'Show Pagination', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'loadmore' => '',
				],
			]
		);
		$this->add_control(
			'loadmore',
			[
				'label' => esc_html__( 'Show Load More', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'pagination' => '',
				],
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Load More Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Label', 'sina-ext' ),
				'condition' => [
					'loadmore!' => '',
				],
				'default' => 'Load More',
			]
		);

		$this->end_controls_section();
		// End Blogpost Content
		// =====================


		// Start Read More Content
		// ========================
		$this->start_controls_section(
			'read_more_content',
			[
				'label' => esc_html__( 'Read More', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-read-more', '', 'read_more', false);

		$this->end_controls_section();
		// End Read More Content
		// ======================


		// Start Post Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Post', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'note',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'NOTICE: If you change the <strong>Dimension</strong> then the page need to <strong>Refresh</strong> for seeing the actual result.', 'sina-ext' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$this->add_control(
			'effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-hover-move' => esc_html__( 'Move', 'sina-ext' ),
					'sina-hover-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'' => esc_html__( 'None', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'scale',
			[
				'label' => esc_html__( 'Scale', 'sina-ext' ),
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
					'effects' => 'sina-hover-zoom',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-col.sina-hover-zoom:hover' => 'transform: scale({{SIZE}});',
				],
			]
		);
		$this->add_control(
			'move',
			[
				'label' => esc_html__( 'Move', 'sina-ext' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'effects' => 'sina-hover-move',
				],
			]
		);

		$this->start_popover();
		$this->add_responsive_control(
			'translateX',
			[
				'label' => esc_html__( 'Horizontal', 'sina-ext' ),
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
				'tablet_default' => [
					'size' => '0',
				],
				'mobile_default' => [
					'size' => '0',
				],
				'condition' => [
					'effects' => 'sina-hover-move',
				],
			]
		);
		$this->add_responsive_control(
			'translateY',
			[
				'label' => esc_html__( 'Vertical', 'sina-ext' ),
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
				'tablet_default' => [
					'size' => '-10',
				],
				'mobile_default' => [
					'size' => '-10',
				],
				'condition' => [
					'effects' => 'sina-hover-move',
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .sina-bp-col:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-bp-col:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-bp-col:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();


		$this->start_controls_tabs( 'post_tabs' );

		$this->start_controls_tab(
			'post_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-bp',
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
				'selector' => '{{WRAPPER}} .sina-bp',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-bp:hover',
			]
		);
		$this->add_control(
			'box_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-bp:hover',
			]
		);

		$this->add_control(
			'post_hover_title_heading',
			[
				'label' => esc_html__( 'Title Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'post_hover_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_hover_title_shadow',
				'selector' => '{{WRAPPER}} .sina-bp:hover .sina-bp-title a',
			]
		);

		$this->add_control(
			'post_hover_cats_heading',
			[
				'label' => esc_html__( 'Categories Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_cats!' => '',
				],
			]
		);
		$this->add_control(
			'post_cats_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_cats!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-cats, {{WRAPPER}} .sina-bp:hover .sina-bp-cats a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_cats_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_cats!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-cats' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_cats_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'posts_cats!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-cats, {{WRAPPER}} .sina-bp-cats a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'post_hover_content_heading',
			[
				'label' => esc_html__( 'Content Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'post_hover_content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'post_hover_content_shadow',
				'selector' => '{{WRAPPER}} .sina-bp:hover .sina-bp-content',
			]
		);
		$this->add_control(
			'post_hover_content_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'post_hover_btn_heading',
			[
				'label' => esc_html__( 'Button', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'post_hover_btn_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-bp:hover .sina-read-more',
			]
		);
		$this->add_control(
			'post_hover_btn_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-read-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_hover_btn_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-read-more' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'post_hover_meta_heading',
			[
				'label' => esc_html__( 'Meta Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'post_hover_meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'post_hover_link_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-bp' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justify', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-content' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'overlay',
			[
				'label' => esc_html__( 'Overlay Background', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.4)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-bg-thumb .sina-overlay',
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-bp');

		$this->end_controls_section();
		// End Post Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'thumb_width',
			[
				'label' => esc_html__( 'Thumb Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '40',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-list .sina-bg-thumb' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'thumb_height',
			[
				'label' => esc_html__( 'Thumb Height (px)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 200,
				],
				'tablet_default' => [
					'size' => 250,
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-list .sina-bg-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__( 'Content Width (%)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '60',
				],
				'tablet_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'mobile_default' => [
					'unit' => '%',
					'size' => '100',
				],
				'condition' => [
					'layout' => 'list',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-list .sina-bp-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'is_content_height',
			[
				'label' => esc_html__( 'Use content Height', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'layout' => 'list',
				],
			]
		);
		$this->add_responsive_control(
			'content_height',
			[
				'label' => esc_html__( 'Content Height (px)', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 200,
				],
				'tablet_default' => [
					'size' => 250,
				],
				'condition' => [
					'layout' => 'list',
					'is_content_height' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-list .sina-pb-inner-content' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
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
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_shadow',
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
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'line_height'   => [
						'default' => [
							'size' => '32',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-bp-title, {{WRAPPER}} .sina-bp-title a',
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-bp-title a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp .sina-bp-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-bp .sina-bp-title a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Cats Style
		// =====================
		$this->start_controls_section(
			'cats_style',
			[
				'label' => esc_html__( 'Categories', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_cats!' => '',
				],
			]
		);

		$this->add_control(
			'cats_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => esc_html__( 'Before Title', 'sina-ext' ),
					'after' => esc_html__( 'After Title', 'sina-ext' ),
				],
				'default' => 'after',
			]
		);
		$this->add_control(
			'cats_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-folder-open-o',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cats_typography',
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
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-bp-cats, {{WRAPPER}} .sina-bp-cats a',
			]
		);
		$this->add_control(
			'cats_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-cats, {{WRAPPER}} .sina-bp-cats a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'cats_bg',
			[
				'label' => esc_html__( 'Background Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp-cats' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cats_border',
				'selector' => '{{WRAPPER}} .sina-bp-cats',
			]
		);
		$this->add_responsive_control(
			'cats_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-cats' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cats_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-cats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'cats_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-cats' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Cats Style
		// =====================


		// Start Read More Style
		// ========================
		$this->start_controls_section(
			'read_more_style',
			[
				'label' => esc_html__( 'Read More', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'read_more_text!' => '',
				],
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-bp .sina-read-more' );
		$this->add_responsive_control(
			'read_more_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-read-more, {{WRAPPER}} .sina-read-more:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '20',
					'bottom' => '10',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'read_more_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '25',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-read-more', 'read_btn_bg_layer');

		$this->end_controls_section();
		// End Read More Style
		// =====================


		// Start Meta Style
		// =====================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'Meta', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_meta!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
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
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-bp-meta, {{WRAPPER}} .sina-bp-meta a',
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'link_tabs' );

		$this->start_controls_tab(
			'link_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'link_hover_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'avatar_style',
			[
				'label' => esc_html__( 'Avatar styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'posts_avatar!' => '',
				],
			]
		);

		$this->add_control(
			'avatar_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default' => [
					'size' => '32',
				],
				'condition' => [
					'posts_avatar!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'avatar_gap',
			[
				'label' => esc_html__( 'Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '8',
				],
				'condition' => [
					'posts_avatar!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta .avatar' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-bp-meta .avatar' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'avatar_bshadow',
				'selector' => '{{WRAPPER}} .sina-bp-meta .avatar',
				'condition' => [
					'posts_avatar!' => '',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'avatar_border',
				'selector' => '{{WRAPPER}} .sina-bp-meta .avatar',
				'condition' => [
					'posts_avatar!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'avatar_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '16',
					'right' => '16',
					'bottom' => '16',
					'left' => '16',
					'isLinked' => true,
				],
				'condition' => [
					'posts_avatar!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta .avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'meta_border',
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
							'right' => '0',
							'bottom' => '0',
							'left' => '0',
							'isLinked' => false,
						]
					],
				],
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .sina-bp-meta',
			]
		);
		$this->add_responsive_control(
			'meta_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '12',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
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
				'label' => esc_html__( 'Pagination', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pagination!' => '',
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
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers',
			]
		);

		$this->start_controls_tabs( 'pagi_link_tabs' );

		$this->start_controls_tab(
			'pagi_link_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagi_link_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_bshadow',
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pagi_link_border',
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
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagi_link_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagi_link_hover_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_link_hover_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers:hover' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_hover_bshadow',
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers:hover',
			]
		);
		$this->add_control(
			'pagi_link_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers:hover',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagi_link_current',
			[
				'label' => esc_html__( 'Current', 'sina-ext' ),
			]
		);
		$this->add_control(
			'pagi_link_current_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers.current' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pagi_link_current_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers.current' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'pagi_current_tshadow',
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers.current',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'pagi_current_bshadow',
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers.current',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'pagi_link_current_border',
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
				'selector' => '{{WRAPPER}} .sina-bp-pagination .page-numbers.current',
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'pagi_gap',
			[
				'label' => esc_html__( 'Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '40',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '38',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_link_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '12',
					'bottom' => '8',
					'left' => '12',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_link_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '2',
					'bottom' => '4',
					'left' => '2',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-pagination .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pagi_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
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
				'label' => esc_html__( 'Load More Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'loadmore!' => '',
				],
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-load-more-btn', 'load_btn' );
		$this->add_responsive_control(
			'load_btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-load-more-btn, {{WRAPPER}} .sina-load-more-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '40',
					'right' => '0',
					'bottom' => '20',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-load-more-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'load_btn_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-load-more' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-load-more-btn', 'load_btn_bg_layer');

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

		$new_offset = (int)$data['offset'] + ( ( $paged - 1 ) * (int)$data['posts_num'] );
		$category	= $data['categories'];
		$tags		= $data['tags'];

		$default	= [
			'category__in'		=> $category,
			'tag__in'			=> $tags,
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
			$offset = $new_offset + (int)$data['posts_num'];
			$content_length = $data['content_length'];

			$posts_data = [
				'posts_num'=> $data['posts_num'],
				'offset'=> $offset,
				'total_posts'=> $post_query->found_posts,
				'layout'=> $data['layout'],
				'columns'=> $data['columns'],
				'layout_type'=> $data['layout_type'],
				'custom_columns'=> $data['custom_columns'],
				'categories'=> $category,
				'tags'=> $tags,
				'order_by'=> $data['order_by'],
				'sort'=> $data['sort'],
				'posts_text'=> $data['posts_text'],
				'excerpt'=> $data['excerpt'],
				'content_length'=> $content_length,
				'posts_meta'=> $data['posts_meta'],
				'thumb_right'=> $data['thumb_right'],
				'is_thumb'=> $data['is_thumb'],
				'read_more_effect'=> $data['read_more_effect'],
				'read_more_text'=> $data['read_more_text'],
				'read_more_icon'=> $data['read_more_icon'],
				'read_more_icon_align'=> $data['read_more_icon_align'],
				'effects' => $data['effects'],
				'cats_position' => $data['cats_position'],
				'cats_icon' => $data['cats_icon'],
				'posts_avatar' => $data['posts_avatar'],
				'avatar_size' => $data['avatar_size'],
				'read_btn_bg_layer_effects' => $data['read_btn_bg_layer_effects'],
				'bg_layer_effects' => $data['bg_layer_effects'],
			];
			?>
			<div class="sina-blogpost <?php echo esc_attr( 'sina-bp-'.$this->get_id() ); ?>"
			data-uid="<?php echo esc_attr( $this->get_id() ); ?>"
			data-offset="<?php echo esc_attr( $offset ); ?>"
			data-posts-data='<?php echo json_encode( $posts_data ); ?>'>
				<div class="sina-bp-grid">
					<div class="sina-bp-grid-sizer"></div>
					<?php include SINA_EXT_LAYOUT.'/blogpost/'.$data['layout'].'.php'; ?>
					<?php wp_reset_query(); ?>
				</div>

				<?php if ( 'yes' == $data['loadmore'] && $data['btn_text'] && ($data['posts_num'] + $new_offset) < $post_query->found_posts ): ?>
					<div class="sina-load-more">
						<button class="sina-button sina-load-more-btn <?php echo esc_attr( $data['load_btn_bg_layer_effects'] ); ?>">
							<?php printf( '%s', $data['btn_text'] ); ?>
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
				<h3><?php echo esc_html__('No Posts found', 'sina-ext'); ?></h3>
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
				$isoGrid = $this.children('.sina-bp-grid');

			$this.imagesLoaded( function() {
				$isoGrid.isotope({
					itemSelector: '.sina-bp-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-bp-grid-sizer',
					}
				});
			});
		});
		</script>
		<?php
	}


	protected function content_template() {

	}
}