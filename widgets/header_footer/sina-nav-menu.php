<?php

/**
 * Nav Menu Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Nav_Menu_Widget extends Widget_Base{
	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_nav_menu';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Nav Menu', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-header-footer' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina nav menu', 'sina navigation', 'sina menu' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_script_depends() {
		return [
			'sina-widgets',
		];
	}

	public function get_menu_list(){
		$list = [];
		$menus = wp_get_nav_menus();
		foreach($menus as $menu){
			$list[$menu->slug] = $menu->name;
		}

		return $list;
	}

	public function get_icon_list() {
		return [
			'icofont icofont-arrow-down' => 'Arrow Down',
			'icofont icofont-arrow-left' => 'Arrow Left',
			'icofont icofont-arrow-right' => 'Arrow Right',
			'icofont icofont-arrow-up' => 'Arrow Up',
			'icofont icofont-caret-down' => 'Caret Down',
			'icofont icofont-caret-left' => 'Caret Left',
			'icofont icofont-caret-right' => 'Caret Right',
			'icofont icofont-caret-up' => 'Caret Up',
			'icofont icofont-rounded-down' => 'Rounded Down',
			'icofont icofont-rounded-left' => 'Rounded Left',
			'icofont icofont-rounded-right' => 'Rounded Right',
			'icofont icofont-rounded-up' => 'Rounded Up',
			'icofont icofont-simple-down' => 'Simple Down',
			'icofont icofont-simple-left' => 'Simple Left',
			'icofont icofont-simple-right' => 'Simple Right',
			'icofont icofont-simple-up' => 'Simple Up',
			'icofont icofont-swoosh-down' => 'Swoosh Down',
			'icofont icofont-swoosh-left' => 'Swoosh Left',
			'icofont icofont-swoosh-right' => 'Swoosh Right',
			'icofont icofont-swoosh-up' => 'Swoosh Up',
			'icofont icofont-double-left' => 'Double Left',
			'icofont icofont-double-right' => 'Double Right',
			'icofont icofont-rounded-double-left' => 'Rounded Double Left',
			'icofont icofont-rounded-double-right' => 'Rounded Double Right',
			'icofont icofont-plus' => 'Plus',
			'icofont icofont-minus' => 'Minus',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.7.0
	 * @access protected
	 */
	protected function register_controls() {
		$get_extenders 	= get_option( 'sina_extenders' );
		$submenu_icons = $this->get_icon_list();
		// Start Nav Menu
		// ===============
			$this->start_controls_section(
				'nav_menu_content',
				[
					'label' => esc_html__( 'Nav Menu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'nav_menu',
				[
					'label' => esc_html__( 'Select Menu', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'options' => $this->get_menu_list(),
				]
			);
			if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
				$this->add_control(
					'nav_menu_sticky',
					[
						'label' => esc_html__( 'Sticky Menu', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
					]
				);
			}
			$this->add_control(
				'submenu_open_icon',
				[
					'label' => esc_html__( 'Submenu Open Icon', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'include' => $submenu_icons,
					'default' => 'icofont icofont-rounded-up',
				]
			);
			$this->add_control(
				'submenu_close_icon',
				[
					'label' => esc_html__( 'Submenu Close Icon', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'include' => $submenu_icons,
					'default' => 'icofont icofont-rounded-down',
				]
			);
			$this->add_control(
				'submenu_anim_in',
				[
					'label' => esc_html__( 'Submenu Animation In', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'default' => 'fadeInLeft',
					'options' => Sina_Common_Data::animation(),
				]
			);
			$this->add_control(
				'submenu_anim_out',
				[
					'label' => esc_html__( 'Submenu Animation Out', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,
					'default' => 'fadeOut',
					'options' => Sina_Common_Data::animation_out(),
				]
			);

			$this->end_controls_section();
		// End Nav Menu
		// =============

		// Start Mobile Menu
		// ==================
			$this->start_controls_section(
				'mobile_menu_content',
				[
					'label' => esc_html__( 'Tablet and Mobile Menu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'mobile_submenu_open_icon',
				[
					'label' => esc_html__( 'Submenu Open Icon', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'include' => $submenu_icons,
					'default' => 'icofont icofont-rounded-down',
				]
			);
			$this->add_control(
				'mobile_submenu_close_icon',
				[
					'label' => esc_html__( 'Submenu Close Icon', 'sina-ext' ),
					'label_block' => true,
					'type' => Controls_Manager::ICON,
					'include' => $submenu_icons,
					'default' => 'icofont icofont-rounded-right',
				]
			);

			$this->end_controls_section();
		// End Mobile Menu
		// ================


		// Start Menu Style
		// =================
			$this->start_controls_section(
				'menu_item_style',
				[
					'label' => esc_html__( 'Menu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::menu_item_style( $this, '.sina-ext-menu > li > a' );

				$this->add_responsive_control(
					'menu_item_width',
					[
						'label' => esc_html__( 'Min Width', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'separator' => 'before',
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu > li > a' => 'min-width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'menu_item_radius',
					[
						'label' => esc_html__( 'Radius', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'menu_item_padding',
					[
						'label' => esc_html__( 'Padding', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'default' => [
							'top' => '13',
							'right' => '15',
							'bottom' => '13',
							'left' => '15',
							'isLinked' => false,
						],
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'menu_item_alignment',
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
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu > li > a' => 'text-align: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'submenu_indicator_style',
					[
						'label' => esc_html__( 'Submenu Indicator', 'sina-ext' ),
						'type' => Controls_Manager::HEADING,
						'separator' => 'before',
					]
				);

				$this->add_responsive_control(
					'submenu_indicator_size',
					[
						'label' => esc_html__( 'Font Size', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '16',
						],
						'separator' => 'before',
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu .menu-item-has-children > a:before' => 'font-size: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'submenu_indicator_space',
					[
						'label' => esc_html__( 'Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'default' => [
							'size' => '6',
						],
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu .menu-item-has-children > a:before' => 'right: {{SIZE}}{{UNIT}};',
							'body.rtl .elementor-element-{{ID}} .sina-ext-menu .menu-item-has-children > a:before' => 'right: inherit;',
							'.rtl .elementor-element-{{ID}} .sina-ext-menu .menu-item-has-children > a:before' => 'left: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'submenu_indicator_padding',
					[
						'label' => esc_html__( 'Submenu Item Padding', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'default' => [
							'top' => '13',
							'right' => '30',
							'bottom' => '13',
							'left' => '15',
							'isLinked' => false,
						],
						'selectors' => [
							'.elementor-element-{{ID}} .sina-ext-menu > .menu-item-has-children > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		// End Menu Style
		// ===============

		// Start Sticky Menu Style
		// ========================
			if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
				Sina_Common_Data::sticky_menu_item_style( $this, '.sina-ext-menu > li > a' );
			}
		// End Sticky Menu Style
		// ======================

		// Start Submenu Wrap Style
		// =========================
			$this->start_controls_section(
				'submenu_style',
				[
					'label' => esc_html__( 'Submenu Wrapper', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_responsive_control(
				'submenu_width',
				[
					'label' => esc_html__( 'Width', 'sina-ext' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px', 'em', '%' ],
					'range' => [
						'px' => [
							'max' => 1000,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 200,
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'submenu_top',
				[
					'label' => esc_html__( 'Top Spacing', 'sina-ext' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 0,
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu' => 'top: calc(100% + {{SIZE}}{{UNIT}});',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'submenu_shadow',
					'selector' => '.elementor-element-{{ID}} .sina-ext-menu .sub-menu',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'submenu_border',
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
					'selector' => '.elementor-element-{{ID}} .sina-ext-menu .sub-menu',
				]
			);
			$this->add_responsive_control(
				'submenu_radius',
				[
					'label' => esc_html__( 'Radius', 'sina-ext' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'top' => '0',
						'right' => '0',
						'bottom' => '10',
						'left' => '10',
						'isLinked' => false,
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu li:first-of-type > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0px 0px;',
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu li:last-of-type > a' => 'border-radius: 0px 0px {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu .sub-menu li:first-of-type > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0px 0px;',
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu .sub-menu li:last-of-type > a' => 'border-radius: 0px 0px {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();
		// End Submenu Wrap Style
		// =======================

		// Start Submenu Style
		// ====================
			$this->start_controls_section(
				'submenu_item_style',
				[
					'label' => esc_html__( 'Submenu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			Sina_Common_Data::menu_item_style( $this, '.sina-ext-menu .sub-menu li > a', 'submenu_item', 'desktop' );

			$this->add_responsive_control(
				'submenu_item_padding',
				[
					'label' => esc_html__( 'Padding', 'sina-ext' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'default' => [
						'top' => '13',
						'right' => '15',
						'bottom' => '13',
						'left' => '15',
						'isLinked' => false,
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'submenu_item_alignment',
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
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-menu .sub-menu li > a' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();
		// End Submenu Style
		// ==================

		// Start Mobile Menu Style
		// ========================
			$this->start_controls_section(
				'mobile_menu_item_style',
				[
					'label' => esc_html__( 'Tablet and Mobile Menu', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::menu_item_style( $this, '.show .sina-ext-menu li a', 'mobile_menu_item', 'mobile' );
			$this->end_controls_section();
		// End Mobile Menu Style
		// ======================

		// Start Menu Toggle Style
		// ========================
			$this->start_controls_section(
				'mobile_menu_toggle_style',
				[
					'label' => esc_html__( 'Menu Toggle', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->add_control(
				'mobile_menu_toggle_color',
				[
					'label' => esc_html__( 'Color', 'sina-ext' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#222',
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-nav-toggle' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'mobile_menu_toggle_background',
				[
					'label' => esc_html__( 'Background', 'sina-ext' ),
					'type' => Controls_Manager::COLOR,
					'default' => '#00000000',
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-nav-toggle' => 'background: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'mobile_menu_toggle_size',
				[
					'label' => esc_html__( 'Size', 'sina-ext' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'default' => [
						'unit' => 'px',
						'size' => 24,
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-nav-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'mobile_menu_toggle_spacing',
				[
					'label' => esc_html__( 'Spacing', 'sina-ext' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => -200,
							'max' => 200,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 16,
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-nav-toggle' => 'left: {{SIZE}}{{UNIT}};',
						'body.rtl .elementor-element-{{ID}} .sina-ext-nav-toggle' => 'right: {{SIZE}}{{UNIT}};',
						'.rtl .elementor-element-{{ID}} .sina-ext-nav-toggle' => 'left: inherit;',
					],
				]
			);
			$this->add_responsive_control(
				'mobile_menu_toggle_top',
				[
					'label' => esc_html__( 'Top', 'sina-ext' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => -1000,
							'max' => 1000,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => '-13',
					],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-nav-toggle' => 'top: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'mobile_menu_toggle_border',
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'color' => [
							'default' => '#fff',
						],
						'width' => [
							'default' => [
								'top' => '0',
								'right' => '0',
								'bottom' => '0',
								'left' => '0',
								'isLinked' => true,
							]
						],
					],
					'selector' => '.elementor-element-{{ID}} .sina-ext-nav-toggle',
				]
			);
			$this->add_responsive_control(
				'mobile_menu_toggle_padding',
				[
					'label' => esc_html__( 'Padding', 'sina-ext' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', ],
					'selectors' => [
						'.elementor-element-{{ID}} .sina-ext-nav-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_section();
		// End Menu Toggle Style
		// ======================
	}


	protected function render() {
		$data 			= $this->get_settings_for_display();
		$uid = $this->get_id();
		$anim = [
			'fadeInLeft',
			'fadeInRight',
			'fadeOutLeft',
			'fadeOutRight',
		];
		$anim_in = in_array($data['submenu_anim_in'], $anim) ? 'sina-ext-menu-'.$data['submenu_anim_in'] : $data['submenu_anim_in'];
		$anim_out = in_array($data['submenu_anim_out'], $anim) ? 'sina-ext-menu-'.$data['submenu_anim_out'] : $data['submenu_anim_out'];
		$args 			= [
			'menu'				=> $data['nav_menu'],
			'fallback_cb'		=> 'wp_page_menu',
			'container_class'	=> 'sina-ext-nav-collapse',
			'items_wrap'		=> '<ul class="sina-ext-menu" data-in="'.$anim_in.'" data-out="'.$anim_out.'">%3$s</ul>',
		];
		$menu_list_icons = [
			'icofont icofont-arrow-down' => '"\ea5b"',
			'icofont icofont-arrow-left' => '"\ea5c"',
			'icofont icofont-arrow-right' => '"\ea5d"',
			'icofont icofont-arrow-up' => '"\ea5e"',
			'icofont icofont-caret-down' => '"\ea67"',
			'icofont icofont-caret-left' => '"\ea68"',
			'icofont icofont-caret-right' => '"\ea69"',
			'icofont icofont-caret-up' => '"\ea6a"',
			'icofont icofont-rounded-down' => '"\ea99"',
			'icofont icofont-rounded-left' => '"\ea9d"',
			'icofont icofont-rounded-right' => '"\eaa0"',
			'icofont icofont-rounded-up' => '"\eaa1"',
			'icofont icofont-simple-down' => '"\eab2"',
			'icofont icofont-simple-left' => '"\eab5"',
			'icofont icofont-simple-right' => '"\eab8"',
			'icofont icofont-simple-up' => '"\eab9"',
			'icofont icofont-swoosh-down' => '"\eac2"',
			'icofont icofont-swoosh-left' => '"\eac3"',
			'icofont icofont-swoosh-right' => '"\eac4"',
			'icofont icofont-swoosh-up' => '"\eac5"',
			'icofont icofont-double-left' => '"\ea7b"',
			'icofont icofont-double-right' => '"\ea7c"',
			'icofont icofont-rounded-double-left' => '"\ea97"',
			'icofont icofont-rounded-double-right' => '"\ea98"',
			'icofont icofont-plus' => '"\efc2"',
			'icofont icofont-minus' => '"\ef9a"',
		];
		?>
		<style type="text/css">

			<?php echo '.elementor-element-'.$uid; ?> .sina-ext-menu .menu-item-has-children > a:before{content: <?php echo $menu_list_icons[ $data['submenu_close_icon'] ] ?>;}
			<?php echo '.elementor-element-'.$uid; ?> .sina-ext-menu .menu-item-has-children.open > a:before{content: <?php echo $menu_list_icons[ $data['submenu_open_icon'] ] ?>;}
			@media (max-width: 1024px) {
				<?php echo '.elementor-element-'.$uid; ?> .sina-ext-menu .menu-item-has-children > a:before{content: <?php echo $menu_list_icons[ $data['mobile_submenu_close_icon'] ] ?>;}
				<?php echo '.elementor-element-'.$uid; ?> .sina-ext-menu .menu-item-has-children.open > a:before{content: <?php echo $menu_list_icons[ $data['mobile_submenu_open_icon'] ] ?>;}
			}
		</style>
		<nav class="sina-ext-nav sina-ext-nav-mobile-sidebar">
			<button type="button" class="sina-ext-nav-toggle"
			data-open="eicon-menu-bar"
			data-close="eicon-close">
				<i class="toggle-icon eicon-menu-bar"></i>
			</button>
			<?php wp_nav_menu( $args ); ?>
		</nav><!-- .sina-ext-nav -->
		<?php
	}


	protected function content_template() {

	}
}