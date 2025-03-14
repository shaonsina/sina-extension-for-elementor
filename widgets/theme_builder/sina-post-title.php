<?php

/**
 * Post Title Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Title_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_title';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Title', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-post-title';
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
		return [ 'sina post title', 'sina theme builder' ];
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
		// Start Post Title
		// =================
			$this->start_controls_section(
				'post_title_content',
				[
					'label' => esc_html__( 'Post Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'before_text',
					[
						'label' => esc_html__( 'Before Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
					]
				);
				$this->add_control(
					'after_text',
					[
						'label' => esc_html__( 'After Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
					]
				);
				$this->add_control(
					'html_tag',
					[
						'label' => esc_html__( 'HTML Tag', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'h1' => 'H1',
							'h2' => 'H2',
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
						],
						'default' => 'h2',
					]
				);

			$this->end_controls_section();
		// End Post Title
		// ===============


		// Start Title Style
		// ==================
			$this->start_controls_section(
				'post_title_style',
				[
					'label' => esc_html__( 'Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::site_info( $this, '{{WRAPPER}} .sina-post-title', 'post_title' );
			$this->end_controls_section();
		// End Title Style
		// ================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		Sina_Common_Data::switch_to_last_post();
		?>
		<<?php echo sina_ext_escape_tags($data['html_tag']); ?> class="sina-post-title"><?php the_title( $data['before_text'], $data['after_text'] ); ?></<?php echo sina_ext_escape_tags($data['html_tag']); ?>><!-- .sina-post-title -->
		<?php
	}


	protected function content_template() {

	}
}