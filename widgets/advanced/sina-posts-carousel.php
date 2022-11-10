<?php
/**
 * Posts Carousel Widget.
 *
 * @since 2.2.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Posts_Carousel_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 2.2.0
	 */
	public function get_name() {
		return 'sina_posts_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.2.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Posts Carousel', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.2.0
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.2.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.2.0
	 */
	public function get_keywords() {
		return [ 'sina posts carousel', 'sina carousel', 'sina slider', 'sina blog post', 'sina blogpost' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.2.0
	 */
	public function get_style_depends() {
		return [
			'icofont',
			'font-awesome',
			'elementor-icons',
			'owl-carousel',
			'animate-merge',
			'sina-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 2.2.0
	 */
	public function get_script_depends() {
		return [
			'jquery-owl',
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.2.0
	 */
	protected function register_controls() {
		// Start Posts Content
		// ====================
		$this->start_controls_section(
			'posts_content',
			[
				'label' => esc_html__( 'Posts Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'thumb' => esc_html__( 'Thumb', 'sina-ext' ),
					'grid' => esc_html__( 'Grid', 'sina-ext' ),
					'list' => esc_html__( 'List', 'sina-ext' ),
				],
				'default' => 'thumb',
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
					'layout!' => 'thumb',
					'posts_meta!' => '',
				],
			]
		);
		$this->add_control(
			'posts_text',
			[
				'label' => esc_html__( 'Show Content', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
			]
		);
		$this->add_control(
			'posts_excerpt',
			[
				'label' => esc_html__( 'Excerpt', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
				'condition' => [
					'posts_text' => 'yes',
				]
			]
		);
		$this->add_control(
			'posts_txt_len',
			[
				'label' => esc_html__( 'Content Length (Word)', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 500,
				'default' => 10,
				'condition' => [
					'posts_text' => 'yes',
				]
			]
		);

		$this->end_controls_section();
		// End Posts Content
		// ==================


		// Start Read More Content
		// ========================
		$this->start_controls_section(
			'read_more_content',
			[
				'label' => esc_html__( 'Read More', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout!' => 'thumb',
				],
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-read-more', '', 'read_more', false);

		$this->end_controls_section();
		// End Read More Content
		// ======================


		// Start Carousel Settings
		// ========================
		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => esc_html__( 'Carousel Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'show_item',
			[
				'label' => esc_html__( 'Show Item', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( '1', 'sina-ext' ),
					'2' => esc_html__( '2', 'sina-ext' ),
					'3' => esc_html__( '3', 'sina-ext' ),
					'4' => esc_html__( '4', 'sina-ext' ),
					'5' => esc_html__( '5', 'sina-ext' ),
					'6' => esc_html__( '6', 'sina-ext' ),
					'7' => esc_html__( '7', 'sina-ext' ),
					'8' => esc_html__( '8', 'sina-ext' ),
				],
				'default' => '2',
				'tablet_default' => '2',
				'mobile_default' => '1',
			]
		);
		Sina_Common_Data::carousel_content( $this );

		$this->end_controls_section();
		// End Carousel Settings
		// ======================


		// Start Thumb Layout Styles
		// Start Thumb Post Style
		// =======================
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Post', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'thumb',
				]
			]
		);

		$this->add_responsive_control(
			'box_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => 300,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pc-thumb' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-pc-thumb',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-pc-thumb',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-pc-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '40',
					'right' => '20',
					'bottom' => '40',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pc-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '15',
					'bottom' => '0',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-posts-carousel .owl-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'vertical_align',
			[
				'label' => esc_html__( 'Vertical Align', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'flex-end',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-thumb' => 'align-items: {{VALUE}};',
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-content' => 'text-align: {{VALUE}};',
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

		$this->start_controls_tabs( 'box_overlay_tabs' );

		$this->start_controls_tab(
			'box_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
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
				'selector' => '{{WRAPPER}} .sina-pc-thumb .sina-overlay',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_hover_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => 'rgba(0,0,0,0.6)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-pc-thumb:hover .sina-overlay',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Thumb Post Style
		// =====================
		// End Thumb Layout Styles


		// Start Grid & List Layout
		// Start Grid Post Style
		// ======================
		$this->start_controls_section(
			'grid_style',
			[
				'label' => esc_html__( 'Post', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
				],
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
			'zoom',
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
					'{{WRAPPER}} .sina-pc-col.sina-hover-zoom:hover' => 'transform: scale({{SIZE}});',
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
					'(desktop){{WRAPPER}} .sina-pc-col:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-pc-col:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-pc-col:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();


		$this->start_controls_tabs( 'grid_post_tabs' );

		$this->start_controls_tab(
			'grid_post_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-bp',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_box_shadow',
				'selector' => '{{WRAPPER}} .sina-bp',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_box_border',
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
			'grid_post_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-bp:hover',
			]
		);
		$this->add_control(
			'grid_box_hover_border',
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
				'name' => 'grid_box_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-bp:hover',
			]
		);

		$this->add_control(
			'grid_post_hover_title_heading',
			[
				'label' => esc_html__( 'Title Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'grid_post_hover_title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-pc-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'grid_post_hover_title_shadow',
				'selector' => '{{WRAPPER}} .sina-bp:hover .sina-pc-title a',
			]
		);

		$this->add_control(
			'grid_post_hover_cats_heading',
			[
				'label' => esc_html__( 'Categories Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'posts_cats!' => '',
				],
			]
		);
		$this->add_control(
			'grid_post_cats_color',
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
			'grid_post_cats_bg',
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
			'grid_post_cats_border',
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
			'grid_post_hover_content_heading',
			[
				'label' => esc_html__( 'Content Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'grid_post_hover_content_color',
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
				'name' => 'grid_post_hover_content_shadow',
				'selector' => '{{WRAPPER}} .sina-bp:hover .sina-bp-content',
			]
		);
		$this->add_control(
			'grid_post_hover_content_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-bp-content' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'grid_post_hover_btn_heading',
			[
				'label' => esc_html__( 'Button Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_post_hover_btn_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-bp:hover .sina-read-more',
			]
		);
		$this->add_control(
			'grid_post_hover_btn_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-read-more' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_post_hover_btn_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-read-more' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'grid_post_hover_meta_heading',
			[
				'label' => esc_html__( 'Meta Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'grid_post_hover_meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-pc-meta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'grid_post_hover_link_color',
			[
				'label' => esc_html__( 'Link Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-bp:hover .sina-pc-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'grid_box_radius',
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
			'grid_box_padding',
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
					'{{WRAPPER}} .sina-pc-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_alignment',
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
			'grid_overlay',
			[
				'label' => esc_html__( 'Overlay Background', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'grid_overlay_bg',
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
		// End Grid Post Style
		// =====================
		// End Grid & List Layout


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
				'selector' => '{{WRAPPER}} .sina-pc-title, {{WRAPPER}} .sina-pc-title a',
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
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-pc-title a',
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
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-bp .sina-pc-title a:hover, {{WRAPPER}} .sina-bp .sina-pc-title a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-bp .sina-pc-title a:hover',
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
					'{{WRAPPER}} .sina-pc-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'text_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'list_thumb_width',
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
			'list_thumb_height',
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
					'size' => 225,
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
			'list_content_width',
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
			'list_content_height',
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
					'size' => 225,
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
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
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
							'size' => '20',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-pc-text',
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-text, {{WRAPPER}} .sina-bp-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .sina-pc-text',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_content_border',
				'selector' => '{{WRAPPER}} .sina-bp-content',
				'condition' => [
					'layout!' => 'thumb',
					'is_content_height' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'grid_content_padding',
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
				'condition' => [
					'layout!' => 'thumb',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bp-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ===================


		// Start Grid Cats Style
		// =======================
		$this->start_controls_section(
			'grid_cats_style',
			[
				'label' => esc_html__( 'Categories', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_cats' => 'yes',
				],
			]
		);

		$this->add_control(
			'grid_cats_position',
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
			'grid_cats_icon',
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
				'name' => 'grid_cats_typography',
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
			'grid_cats_color',
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
			'grid_cats_bg',
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
				'name' => 'grid_cats_border',
				'selector' => '{{WRAPPER}} .sina-bp-cats',
			]
		);
		$this->add_responsive_control(
			'grid_cats_radius',
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
			'grid_cats_padding',
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
			'grid_cats_margin',
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
		// End Grid Cats Style
		// =====================


		// Start Meta Style
		// =====================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'Meta', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'posts_meta' => 'yes',
				]
			]
		);

		$this->add_control(
			'meta_position',
			[
				'label' => esc_html__( 'Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => esc_html__( 'Before Title', 'sina-ext' ),
					'after' => esc_html__( 'After Title', 'sina-ext' ),
				],
				'default' => 'after',
				'condition' => [
					'layout' => 'thumb',
				]
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
							'size' => '18',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-pc-meta, {{WRAPPER}} .sina-pc-meta a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'meta_shadow',
				'selector' => '{{WRAPPER}} .sina-pc-meta, {{WRAPPER}} .sina-pc-meta a',
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta' => 'color: {{VALUE}};',
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
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta a' => 'color: {{VALUE}};',
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
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta a:hover, {{WRAPPER}} .sina-pc-meta a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'meta_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '8',
					'right' => '0',
					'bottom' => '15',
					'left' => '0',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'grid_meta_padding',
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
				'condition' => [
					'layout!' => 'thumb',
					'posts_meta' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_meta_border',
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
				'condition' => [
					'layout!' => 'thumb',
					'posts_meta' => 'yes',
				],
				'selector' => '{{WRAPPER}} .sina-pc-meta',
			]
		);

		$this->end_controls_section();
		// End Meta Style
		// =====================


		// Start Grid Avatar Style
		// =========================
		$this->start_controls_section(
			'grid_avatar_style',
			[
				'label' => esc_html__( 'Avatar', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'thumb',
					'posts_avatar!' => '',
				],
			]
		);

		$this->add_control(
			'grid_avatar_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default' => [
					'size' => '32',
				],
			]
		);
		$this->add_responsive_control(
			'grid_avatar_gap',
			[
				'label' => esc_html__( 'Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '8',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta .avatar' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-pc-meta .avatar' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'grid_avatar_bshadow',
				'selector' => '{{WRAPPER}} .sina-pc-meta .avatar',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_avatar_border',
				'selector' => '{{WRAPPER}} .sina-pc-meta .avatar',
			]
		);
		$this->add_responsive_control(
			'grid_avatar_radius',
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
				'selectors' => [
					'{{WRAPPER}} .sina-pc-meta .avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Grid Avatar Style
		// =======================


		// Start Grid Read More Style
		// ===========================
		$this->start_controls_section(
			'grid_read_more_style',
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
			'grid_read_more_radius',
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
			'grid_read_more_padding',
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
			'grid_read_more_margin',
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
		// End Grid Read More Style
		// ==========================


		// Start Nav & Dots Style
		// ========================
		$this->start_controls_section(
			'nav_dots_style',
			[
				'label' => esc_html__( 'Nav & Dots', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'nav',
							'operator' => '!=',
							'value' => ''
						],
						[
							'name' => 'dots',
							'operator' => '!=',
							'value' => ''
						]
					]
				],
			]
		);
		Sina_Common_Data::nav_dots_style( $this, '.sina-posts-carousel' );

		$this->end_controls_section();
		// End Nav & Dots Style
		// ======================


		// Start Center Style
		// =====================
		$this->start_controls_section(
			'center_item_style',
			[
				'label' => esc_html__( 'Center Item', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'center!' => '',
				],
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
					'size' => '1',
				],
				'selectors' => [
					'{{WRAPPER}} .active.center.owl-item' => 'transform: scale({{SIZE}}); z-index: 2;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'center_item_border',
				'selector' => '{{WRAPPER}} .active.center  .sina-pc-thumb, {{WRAPPER}} .active.center  .sina-bp',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'center_item_shadow',
				'selector' => '{{WRAPPER}} .active.center  .sina-pc-thumb, {{WRAPPER}} .active.center  .sina-bp',
			]
		);

		$this->end_controls_section();
		// End Center Style
		// =====================
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

		$excerpt = $data['posts_excerpt'];
		$txt_len = $data['posts_txt_len'];
		// Post Query
		$post_query = new WP_Query( $default );
		if ( $post_query->have_posts() ) :
			$show_item_tablet = isset($data['show_item_tablet']) ? $data['show_item_tablet'] : $data['show_item'];
			$show_item_mobile = isset($data['show_item_mobile']) ? $data['show_item_mobile'] : $data['show_item'];
			?>
			<div class="sina-posts-carousel owl-carousel"
			data-item-lg="<?php echo esc_attr( $data['show_item'] ); ?>"
			data-item-md="<?php echo esc_attr( $show_item_tablet ); ?>"
			data-item-sm="<?php echo esc_attr( $show_item_mobile ); ?>"
			data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
			data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
			data-center="<?php echo esc_attr( $data['center'] ); ?>"
			data-slide-anim="<?php echo esc_attr( $data['slide_anim'] ); ?>"
			data-slide-anim-out="<?php echo esc_attr( $data['slide_anim_out'] ); ?>"
			data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
			data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
			data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
			data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
			data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
			data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
			data-delay="<?php echo esc_attr( $data['delay'] ); ?>">
				<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
					<?php include SINA_EXT_LAYOUT.'/posts-carousel/'.$data['layout'].'.php'; ?>
				<?php endwhile; wp_reset_query(); ?>
			</div><!-- .sina-posts-carousel -->
			<?php
		else:
			?>
				<h3><?php echo esc_html__('No Posts found', 'sina-ext'); ?></h3>
			<?php
		endif;
	}


	protected function content_template() {

	}
}