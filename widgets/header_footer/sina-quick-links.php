<?php

/**
 * Quick Links Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Quick_Links_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_quick_links';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Quick Links', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-editor-list-ul';
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
		return [ 'sina quick links', 'sina menu', 'sina quick menu', 'sina header', 'sina footer' ];
	}

	public function get_menu_list(){
		$list = [];
		$menus = wp_get_nav_menus();
		foreach($menus as $menu){
			$list[$menu->slug] = $menu->name;
		}

		return $list;
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
		// Start Quick Links
		// ==================
			$this->start_controls_section(
				'quick_links_content',
				[
					'label' => esc_html__( 'Quick Links', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'quick_links',
					[
						'label' => esc_html__( 'Select Menu', 'sina-ext' ),
						'description' => esc_html__( 'Dropdown isn\'t support', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => $this->get_menu_list(),
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
						'selectors' => [
							'.elementor-element-{{ID}} .sina-quick-links a' => 'text-align: {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Quick Links
		// ================


		// Start Quick Links Style
		// ========================
			$this->start_controls_section(
				'quick_links_style',
				[
					'label' => esc_html__( 'Links', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '.elementor-element-{{ID}} .sina-quick-links a', 'quick_links', '.elementor-element-{{ID}} .sina-quick-links li' );
			$this->end_controls_section();
		// End Quick Links Style
		// ======================

		if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
			// Start Quick Links Style
			// ========================
				$this->start_controls_section(
					'sticky_quick_links_style',
					[
						'label' => esc_html__( 'Sticky Links', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
					]
				);
				Sina_Common_Data::link_style( $this, '.sina-pro-sticked .elementor-element-{{ID}} .sina-quick-links a', 'sticky_quick_links' );
				$this->end_controls_section();
			// End Quick Links Style
			// ======================
		}
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$args 			= [
			'menu'			=> $data['quick_links'],
			'fallback_cb'	=> 'wp_page_menu',
		];
		?>
		<div class="sina-quick-links">
			<?php wp_nav_menu( $args ); ?>
		</div><!-- .sina-quick-links -->
		<?php
	}


	protected function content_template() {

	}
}