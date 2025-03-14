<?php

/**
 * Post Excerpt Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Excerpt_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_excerpt';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Excerpt', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-post-excerpt';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-theme-builder' ];
	}

	public function show_in_panel() {
		return Sina_Common_Data::widget_show_in_panel();
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina post excerpt', 'sina theme builder' ];
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
		// Start Post Excerpt
		// ===================
			$this->start_controls_section(
				'post_excerpt_content',
				[
					'label' => esc_html__( 'Post Excerpt', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'length',
					[
						'label' => esc_html__( 'Content Length (Word)', 'sina-ext' ),
						'type' => Controls_Manager::NUMBER,
						'max' => 5000,
						'default' => 100,
					]
				);

			$this->end_controls_section();
		// End Post Excerpt
		// =================


		// Start Excerpt Style
		// ====================
			$this->start_controls_section(
				'post_excerpt_style',
				[
					'label' => esc_html__( 'Excerpt', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::site_info( $this, '{{WRAPPER}} .sina-post-excerpt', 'post_excerpt' );
			$this->end_controls_section();
		// End Excerpt Style
		// ==================
	}


	protected function render() {
		Sina_Common_Data::switch_to_last_post();
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-post-excerpt"><?php echo wp_trim_words( get_the_excerpt(), $data['length'] ); ?></div><!-- .sina-post-excerpt -->
		<?php
	}


	protected function content_template() {

	}
}