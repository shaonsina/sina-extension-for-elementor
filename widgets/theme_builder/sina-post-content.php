<?php

/**
 * Post Content Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Content_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_content';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Content', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-post-content';
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
		return [ 'sina post content', 'sina theme builder' ];
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
		// Start Content Style
		// ==================
			$this->start_controls_section(
				'post_content_style',
				[
					'label' => esc_html__( 'Content', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::site_info( $this, '{{WRAPPER}} .sina-post-content', 'post_content' );
			$this->end_controls_section();
		// End Content Style
		// ================
	}


	protected function render() {
		Sina_Common_Data::switch_to_last_post();
		?>
		<div class="sina-post-content"><?php the_content(); ?></div><!-- .sina-post-content -->
		<?php
	}


	protected function content_template() {

	}
}