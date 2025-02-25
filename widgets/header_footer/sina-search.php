<?php

/**
 * Search Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Search_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_search';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Search', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-search-bold';
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
		return [ 'sina search', 'sina header', 'sina footer' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.7.0
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
	 * @since 3.7.0
	 */
	public function get_script_depends() {
		return [
			'sina-widgets',
		];
	}

	public function get_icon_list() {
		return [
			'icofont icofont-ui-search' => 'icofont-ui-search',
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
		// Start Search
		// =============
			$this->start_controls_section(
				'search_content',
				[
					'label' => esc_html__( 'Search', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'icon',
					[
						'label' => esc_html__( 'Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_icon_list(),
						'default' => 'icofont icofont-ui-search',
					]
				);

			$this->end_controls_section();
		// End Search
		// ===========


		// Start Icon Style
		// =================
			$selector = '.elementor-element-{{ID}} .sina-search';
			$this->start_controls_section(
				'icon_style',
				[
					'label' => esc_html__( 'Icon', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

			$this->end_controls_section();
		// End Icon Style
		// ===============

		if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
			
		}
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-search">
			<div class="sina-search-overlay"></div>

		</div><!-- .sina-search -->
		<?php
	}


	protected function content_template() {

	}
}