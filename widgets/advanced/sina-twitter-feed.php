<?php

/**
 * Twitter Feed Widget.
 *
 * @since 3.3.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Twitter_Feed_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.3.0
	 */
	public function get_name() {
		return 'sina_twitter_feed';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.3.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Twitter Feed', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.3.0
	 */
	public function get_icon() {
		return 'eicon-twitter-feed';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.3.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.3.0
	 */
	public function get_keywords() {
		return [ 'sina twitter feed', 'sina twitter post', 'sina twitter page' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.3.0
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
	 * @since 3.3.0
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
	 * @since 3.3.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start Feed Content
		// ===================
		$this->start_controls_section(
			'feed_content',
			[
				'label' => esc_html__( 'Feed Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'account_name',
			[
				'label' => esc_html__( 'Account Name', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter account name', 'sina-ext' ),
				'description' => esc_html__('Use @ in front of your account name.', 'sina-ext'),
				'default' => '@Sina_Extra',
			]
		);
		$this->add_control(
			'consumer_key',
			[
				'label' => esc_html__( 'Consumer Key', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter consumer key', 'sina-ext' ),
				'description' => '<a href="https://apps.twitter.com/app/" target="_blank">'.esc_html__('Get Consumer Key', 'sina-ext').'</a>',
			]
		);
		$this->add_control(
			'consumer_secret_key',
			[
				'label' => esc_html__( 'Consumer Secret Key', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter consumer secret key', 'sina-ext' ),
				'description' => '<a href="https://apps.twitter.com/app/" target="_blank">'.esc_html__('Get Consumer Secret Key', 'sina-ext').'</a>',
			]
		);
		$this->add_control(
			'feeds_num',
			[
				'label' => esc_html__( 'Number of Feed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 1,
				'max' => 50,
				'default' => 3,
			]
		);
		$this->add_control(
			'feeds_offset',
			[
				'label' => esc_html__( 'Number of Offset', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 0,
				'max' => 50,
				'default' => 0,
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
				'default' => 15,
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
				'default' => '3',
			]
		);
		$this->add_control(
			'sort_by',
			[
				'label' => esc_html__( 'Sort By', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'newest' => esc_html__( 'Newest', 'sina-ext' ),
					'oldest' => esc_html__( 'Oldest', 'sina-ext' ),
				],
				'default' => 'newest',
			]
		);

		$this->end_controls_section();
		// End Feed Content
		// =================


		// Start Read More Content
		// ========================
		$this->start_controls_section(
			'read_more_content',
			[
				'label' => esc_html__( 'Read More', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		Sina_Common_Data::button_content( $this, '.sina-read-more', 'Read More', 'read_more', false);

		$this->end_controls_section();
		// End Read More Content
		// ======================


		// Start Feed Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Feed', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-feed.sina-hover-zoom:hover' => 'transform: scale({{SIZE}});',
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
					'(desktop){{WRAPPER}} .sina-feed:hover' => 'transform: translate({{translateX.SIZE || 0}}px, {{translateY.SIZE || 0}}px);',
					'(tablet){{WRAPPER}} .sina-feed:hover' => 'transform: translate({{translateX_tablet.SIZE || 0}}px, {{translateY_tablet.SIZE || 0}}px);',
					'(mobile){{WRAPPER}} .sina-feed:hover' => 'transform: translate({{translateX_mobile.SIZE || 0}}px, {{translateY_mobile.SIZE || 0}}px);',
				],
			]
		);
		$this->end_popover();


		$this->start_controls_tabs( 'feed_tabs' );

		$this->start_controls_tab(
			'feed_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-feed',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-feed',
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
				'selector' => '{{WRAPPER}} .sina-feed',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'feed_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-feed:hover',
			]
		);
		$this->add_control(
			'box_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-feed:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-feed:hover',
			]
		);

		$this->add_control(
			'feed_hover_page_name_heading',
			[
				'label' => esc_html__( 'Account Name Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'feed_hover_page_name_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-feed:hover .sina-feed-page-name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'feed_hover_content_heading',
			[
				'label' => esc_html__( 'Content Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'feed_hover_content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-feed:hover .sina-feed-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'feed_hover_meta_heading',
			[
				'label' => esc_html__( 'Meta Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'feed_hover_meta_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-feed:hover .sina-feed-meta' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .sina-feed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '15',
					'right' => '15',
					'bottom' => '15',
					'left' => '15',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-feed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-feed-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-feed' => 'text-align: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .sina-feed-thumb .sina-overlay',
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-feed');

		$this->end_controls_section();
		// End Feed Style
		// =================


		// Start Account Name Style
		// ======================
		$this->start_controls_section(
			'page_name_style',
			[
				'label' => esc_html__( 'Account Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'page_name_typography',
				'selector' => '{{WRAPPER}} .sina-feed-page-name a',
			]
		);

		$this->start_controls_tabs( 'page_name_tabs' );

		$this->start_controls_tab(
			'page_name_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'page_name_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-feed-page-name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'page_name_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'page_name_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-feed-page-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'page_name_heading',
			[
				'label' => esc_html__( 'Thumb Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'page_name_logo',
			[
				'label' => esc_html__( 'Thumb Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 16,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '32',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-feed-page-name img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'page_name_thumb_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-feed-page-name img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'page_name_thumb_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '5',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-feed-page-name img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Account Name Style
		// ====================


		// Start Content Style
		// =====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-feed-content' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .sina-feed-content',
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
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-feed-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// =====================


		// Start Meta Style
		// =====================
		$this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'Meta', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
				'selector' => '{{WRAPPER}} .sina-feed-meta',
			]
		);
		$this->add_control(
			'meta_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-feed-meta' => 'color: {{VALUE}};',
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
					'bottom' => '15',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-feed-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Meta Style
		// ================


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
		Sina_Common_Data::button_style( $this, '.sina-feed .sina-read-more' );
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
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$access_key = base64_encode( $data['consumer_key'] .':'. $data['consumer_secret_key'] );
		$response = wp_remote_post( 'https://api.twitter.com/oauth2/token', [
			'method' => 'POST',
			'httpversion' => '1.1',
			'blocking' => true,
			'headers' => [
				'Authorization' => 'Basic ' . $access_key,
				'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
			],
			'body' => ['grant_type' => 'client_credentials'],
		] );

		if ( !is_wp_error( $response ) ) {
			$body = json_decode( $response['body'], true );
			if ( isset($body['access_token']) ) {
				$twitter_data = wp_remote_get( 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$data['account_name'].'&count=999&tweet_mode=extended', [
					'httpversion' => '1.1',
					'blocking' => true,
					'headers' => [
						'Authorization' => 'Bearer '.$body['access_token'],
					],
				] );
				if ( !is_wp_error( $twitter_data ) ) {
					$twitter_data = json_decode( $twitter_data['body'], true );
					$twitter_data = empty($twitter_data) ? [] : $twitter_data;

					if ( 'oldest' == $data['sort_by']) {
						$twitter_data = array_reverse($twitter_data);
					}
					$twitter_data = array_slice($twitter_data, $data['feeds_offset'], $data['feeds_num']);
					?>
					<div class="sina-social-feed sina-twitter-feed clearfix <?php echo esc_attr( 'sina-twitter-feed-'.$this->get_id() ); ?>">
						<div class="sina-feed-grid">
							<div class="sina-twitter-feed-grid-sizer"></div>
							<?php foreach ( $twitter_data as $key => $feed ):
								$link = isset($feed['user']['screen_name']) ? 'https://twitter.com/'.$feed['user']['screen_name'].'/status/'.$feed['id_str'] : 'https://twitter.com/'. $data['account_name'];
								?>
								<div class="sina-feed-col sina-feed-col-<?php echo esc_attr($data['columns']) ?>">
									<div class="sina-feed <?php echo esc_attr($data['effects'].' '.$data['bg_layer_effects']); ?>">
										<div class="sina-feed-page-name">
											<a href="<?php echo esc_url( 'https://twitter.com/'. $data['account_name'] ); ?>"
											target="_blank">
												<img src="<?php echo esc_url($feed['user']['profile_image_url_https']); ?>" alt="<?php echo esc_attr( $feed['user']['name'] ); ?>">
												<?php echo esc_html( $feed['user']['name'] ); ?>
											</a>
										</div>
										<div class="sina-feed-meta clearfix">
											<div class="sina-feed-time">
												<i class="fa fa-clock-o far fa-clock"></i> <?php echo esc_html( date( "d M Y", strtotime( $feed['created_at'] ) ) ); ?>
											</div>
										</div>
										<?php
											if ( isset( $feed['extended_entities']['media'][0] ) ):
												$feed_data = $feed['extended_entities']['media'][0];
												if ( 'photo' == $feed_data['type'] && isset($feed_data['media_url_https']) ):
													?>
													<div class="sina-feed-thumb">
														<img src="<?php echo esc_url( $feed_data['media_url_https'] ); ?>">
														<div class="sina-overlay">
															<a href="<?php echo esc_url($link); ?>"></a>
														</div>
													</div>
													<?php
												endif;
											endif;
										?>
										<div class="sina-feed-content">
											<div class="sina-feed-content-inner">
												<?php echo wp_trim_words( $feed['full_text'], $data['content_length'] ); ?>
											</div>

											<?php if ( $data['read_more_text'] ): ?>
												<div class="sina-btn-wrapper">
													<a href="<?php echo esc_url($link); ?>"
														class="sina-read-more <?php echo esc_attr( $data['read_more_effect'].' '.$data['read_btn_bg_layer_effects'] ); ?>">
														<?php Sina_Common_Data::button_html($data, 'read_more'); ?>
													</a>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div><!-- .sina-twitter-feed -->
					<?php
				}
			}
		}
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->render_editor_script();
		}
	}


	protected function render_editor_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var sinaFeedClass = '.sina-twitter-feed-'+'<?php echo $this->get_id(); ?>',
				$this = $(sinaFeedClass),
				$isoGrid = $this.children('.sina-feed-grid');

			$this.imagesLoaded( function() {
				$isoGrid.isotope({
					itemSelector: '.sina-feed-col',
					percentPosition: true,
					masonry: {
						columnWidth: '.sina-twitter-feed-grid-sizer',
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