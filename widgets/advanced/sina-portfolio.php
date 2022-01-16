<?php

/**
 * Portfolio Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Portfolio_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_portfolio';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Portfolio', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-gallery-justified';
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
		return [ 'sina portfolio', 'sina work', 'sina gallery', 'sina filter' ];
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
			'venobox',
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
			'venobox',
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
		// Start Portfolio Content
		// ========================
		$this->start_controls_section(
			'portfolio_content',
			[
				'label' => esc_html__( 'Portfolio', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => esc_html__( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pf-effect-fade' => esc_html__( 'Fade', 'sina-ext' ),
					'sina-pf-effect-zoom' => esc_html__( 'Zoom', 'sina-ext' ),
					'sina-pf-effect-move' => esc_html__( 'Fade & Move', 'sina-ext' ),
					'sina-pf-effect-zoom sina-pf-effect-move' => esc_html__( 'Zoom & Move', 'sina-ext' ),
				],
				'default' => 'sina-pf-effect-move',
			]
		);
		$this->add_control(
			'columns',
			[
				'label' => esc_html__( 'Number of Column', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pf-item-2' => esc_html__( '2', 'sina-ext' ),
					'sina-pf-item-3' => esc_html__( '3', 'sina-ext' ),
					'sina-pf-item-4' => esc_html__( '4', 'sina-ext' ),
					'sina-pf-item-5' => esc_html__( '5', 'sina-ext' ),
					'sina-pf-item-6' => esc_html__( '6', 'sina-ext' ),
					'masonry' => esc_html__( 'Masonry', 'sina-ext' ),
				],
				'default' => 'sina-pf-item-3',
			]
		);
		$this->add_control(
			'reset_text',
			[
				'label' => esc_html__( 'Reset Text', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Reset Text', 'sina-ext' ),
				'default' => 'all',
			]
		);
		$this->add_control(
			'show_content',
			[
				'label' => esc_html__( 'Show Content', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'sina-ext' ),
				'label_off' => esc_html__( 'No', 'sina-ext' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_name',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'default' => 'Short Description',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'item_desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'category',
			[
				'label' => esc_html__( 'Category', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'description' => esc_html__( 'Multiple category must be comma separated!', 'sina-ext' ),
				'default' => 'Web Design',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pf-item-11' => esc_html__( '1 Column 1 Row', 'sina-ext' ),
					'sina-pf-item-12' => esc_html__( '1 Column 2 Row', 'sina-ext' ),
					'sina-pf-item-21' => esc_html__( '2 Column 1 Row', 'sina-ext' ),
					'sina-pf-item-22' => esc_html__( '2 Column 2 Row', 'sina-ext' ),
					'sina-pf-item-31' => esc_html__( '3 Column 1 Row', 'sina-ext' ),
					'sina-pf-item-32' => esc_html__( '3 Column 2 Row', 'sina-ext' ),
					'sina-pf-item-33' => esc_html__( '3 Column 3 Row', 'sina-ext' ),
				],
				'description' => __( 'Size will work if the <strong>"number of columns"</strong> is <strong>"Masonry"</strong> selected', 'sina-ext' ),
				'default' => 'sina-pf-item-22',
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '#',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'portfolio',
			[
				'label' => esc_html__( 'Add Item', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'category' => 'Graphic Design',
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio1.jpg',
						]
					],
					[
						'category' => 'Web Design',
						'size' => 'sina-pf-item-22',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio2.jpg',
						]
					],
					[
						'category' => 'Graphic Design',
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio3.jpg',
						]
					],
					[
						'category' => 'Photography',
						'size' => 'sina-pf-item-22',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio4.jpg',
						]
					],
					[
						'category' => 'Web Design',
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio5.jpg',
						]
					],
					[
						'category' => 'Photography',
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio6.jpg',
						]
					],
				],
				'title_field' => '{{{ item_name }}}',
			]
		);

		$this->end_controls_section();
		// End Portfolio Content
		// ========================


		// Start Menu Style
		// =====================
		$this->start_controls_section(
			'menu_style',
			[
				'label' => esc_html__( 'Menu Buttons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-portfolio-btn' );
		$this->add_responsive_control(
			'menu_btn_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_gap',
			[
				'label' => esc_html__( 'Gap From Items', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' =>[
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btns' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn, {{WRAPPER}} .sina-portfolio-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '15',
					'bottom' => '10',
					'left' => '15',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '6',
					'right' => '6',
					'bottom' => '6',
					'left' => '6',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_alignment',
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
					'{{WRAPPER}} .sina-portfolio-btns' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-button', 'btn_bg_layer');

		$this->end_controls_section();
		// End Menu Style
		// =====================


		// Start Items Style
		// =====================
		$this->start_controls_section(
			'item_style',
			[
				'label' => esc_html__( 'Items', 'sina-ext' ),
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
		$this->add_responsive_control(
			'items_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 800,
					],
				],
				'mobile_default' => [
					'size' => 300,
				],
				'condition' => [
					'columns!' => 'masonry',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'items_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-item-inner, {{WRAPPER}} .sina-portfolio-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'items_padding',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'overlay',
			[
				'label' => esc_html__( 'Overlay Styles', 'sina-ext' ),
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
						'default' => 'rgba(0,0,0,0.8)',
					],
				],
				'selector' => '{{WRAPPER}} .sina-portfolio-overlay',
			]
		);

		$this->end_controls_section();
		// End Items Style
		// =====================


		// Start Content Style
		// ====================
		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_styles',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
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
				'selector' => '{{WRAPPER}} .sina-portfolio-title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-title' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '10',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'desc_styles',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
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
							'size' => '22',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-portfolio-desc',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-desc' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '30',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '20',
					'right' => '25',
					'bottom' => '20',
					'left' => '25',
					'isLinked' => false,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sina-portfolio-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Content Style
		// ====================


		// Start Icons Style
		// =====================
		$this->start_controls_section(
			'icons_style',
			[
				'label' => esc_html__( 'Icons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icons_tabs' );

		$this->start_controls_tab(
			'icons_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icons_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icons_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icons_border',
				'selector' => '{{WRAPPER}} .sina-portfolio-overlay i',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icons_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icons_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icons_hover_bg',
			[
				'label' => esc_html__( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icons_hover_border',
			[
				'label' => esc_html__( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icons_gap',
			[
				'label' => esc_html__( 'Icons Gap', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '20',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-zoom' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-portfolio-zoom' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_responsive_control(
			'icons_size',
			[
				'label' => esc_html__( 'Icon Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '16',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icons_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '44',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icons_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'size' => '44',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'zoom_btn_radius',
			[
				'label' => esc_html__( 'Zoom button radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-zoom i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'link_btn_radius',
			[
				'label' => esc_html__( 'Link button radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-link i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icons Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-portfolio <?php echo esc_attr( 'sina-pf-'.$this->get_id() ); ?>"
		data-layout="<?php echo esc_attr( $data['columns'] ); ?>">
			<div class="sina-portfolio-btns">
				<button class="sina-portfolio-btn sina-button is-checked <?php echo esc_attr( $data['btn_bg_layer_effects'] ); ?>" data-filter="*"><?php printf('%s', $data['reset_text']); ?></button>
				<?php
					$categories = sina_get_portfolio_cat( $data['portfolio'] );
					foreach ( $categories as $cat ) :
						?>
						<button class="sina-button sina-portfolio-btn <?php echo esc_attr( $data['btn_bg_layer_effects'] ); ?>" data-filter=".<?php echo esc_attr( $cat ); ?>">
							<?php printf( '%s', str_replace( '_', ' ', trim( $cat, '_') ) ); ?>
						</button>
				<?php endforeach; ?>
			</div>

			<div class="sina-portfolio-grid">
			<?php
				foreach ( $data['portfolio'] as $index => $item ) :
					$category = strtolower( str_replace( ' ', '_', $item['category'] ) );
					$category =  str_replace( ',', ' ', $category );

					if ( 'masonry' == $data['columns'] ) {
						$size_class = $item['size'];
					} else{
						$size_class = $data['columns'];
					}

					$title_key = $this->get_repeater_setting_key( 'title', 'portfolio', $index );
					$desc_key = $this->get_repeater_setting_key( 'desc', 'portfolio', $index );

					$this->add_render_attribute( $title_key, 'class', 'sina-portfolio-title' );
					$this->add_inline_editing_attributes( $title_key );

					$this->add_render_attribute( $desc_key, 'class', 'sina-portfolio-desc' );
					$this->add_inline_editing_attributes( $desc_key );
				?>
				<?php if ( $item['image']['url'] ): ?>
					<div class="sina-portfolio-item <?php echo esc_attr( $category .' '. $size_class ); ?>">
						<div class="sina-portfolio-item-inner sina-bg-cover"
							style="background-image: url(<?php echo esc_url( $item['image']['url'] ); ?>);">
							<div class="sina-portfolio-overlay sina-overlay sina-flex <?php echo esc_attr( $data['effects'] ); ?>">
								<div class="sina-portfolio-icons sina-flex">
									<div class="sina-portfolio-content">
										<?php if ( 'yes' == $data['show_content'] ): ?>
											<?php if ($item['item_name']): ?>
												<?php printf('<h3 %2$s>%1$s</h3>', $item['item_name'], $this->get_render_attribute_string( $title_key )); ?>
											<?php endif; ?>
											<?php if ($item['item_desc']): ?>
												<?php printf('<div %2$s>%1$s</div>', $item['item_desc'], $this->get_render_attribute_string( $desc_key )); ?>
											<?php endif; ?>
										<?php endif ?>

										<div class="btns-wrap">
											<a title="<?php echo esc_attr( $item['item_name'] ); ?>" href="<?php echo esc_url( $item['image']['url'] ); ?>" class="sina-portfolio-zoom" data-gall="<?php echo esc_attr( 'sina-pf-'.$this->get_id() ); ?>">
												<i class="fa fa-search-plus"></i>
											</a>
											<a href="<?php echo esc_url( $item['link']['url'] ); ?>"
											<?php if ( 'on' == $item['link']['is_external'] ): ?>
												target="_blank" 
											<?php endif; ?>
											<?php if ( 'on' == $item['link']['nofollow'] ): ?>
												rel="nofollow" 
											<?php endif; ?> class="sina-portfolio-link">
												<i class="fa fa-link"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div><!-- .sina-portfolio -->
		<?php
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->render_editor_script();
		}
	}


	protected function render_editor_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var sinaPFClass = '.sina-pf-'+'<?php echo $this->get_id(); ?>',
				$this = $(sinaPFClass),
				$isoGrid = $this.children('.sina-portfolio-grid'),
				$btns = $this.children('.sina-portfolio-btns'),
				layout = $this.data('layout');

			$this.imagesLoaded( function() {
				if ( 'masonry' == layout ) {
					var $grid = $isoGrid.isotope({
						itemSelector: '.sina-portfolio-item',
						percentPosition: true,
						masonry: {
							columnWidth: '.sina-portfolio-item',
						}
					});
				} else{
					var $grid = $isoGrid.isotope({
						itemSelector: '.sina-portfolio-item',
						layoutMode: 'fitRows'
					});

				}

				$btns.on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({filter: filterValue});
				});

				$btns.each(function (i, btns) {
					var btns = $(btns);

					btns.on('click', '.sina-portfolio-btn', function () {
						btns.find('.is-checked').removeClass('is-checked');
						$(this).addClass('is-checked');
					});
				});

			});

			$this.find('.sina-portfolio-zoom').venobox();

		});
		</script>
		<?php
	}


	protected function content_template() {

	}
}