<?php

/**
 * Post Navigation Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Navigation_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_navigation';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Navigation', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-post-navigation';
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
		return [ 'sina post navigation', 'sina theme builder' ];
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

	public function get_icon_list() {
		return [
			'fa fa-angle-double-left' => 'angle-double-left',
			'fa fa-angle-double-right' => 'angle-double-right',
			'fa fa-angle-left' => 'angle-left',
			'fa fa-angle-right' => 'angle-right',
			'fa fa-arrow-left' => 'arrow-left',
			'fa fa-arrow-right' => 'arrow-right',
			'fa fa-caret-left' => 'caret-left',
			'fa fa-caret-right' => 'caret-right',
			'fa fa-chevron-left' => 'chevron-left',
			'fa fa-chevron-right' => 'chevron-right',

			'eicon-chevron-left' => 'eicon-chevron-left',
			'eicon-chevron-right' => 'eicon-chevron-right',
			'eicon-angle-left' => 'eicon-angle-left',
			'eicon-angle-right' => 'eicon-angle-right',
			'eicon-arrow-left' => 'eicon-arrow-left',
			'eicon-arrow-right' => 'eicon-arrow-right',
			'eicon-caret-left' => 'eicon-caret-left',
			'eicon-caret-right' => 'eicon-caret-right',
			'eicon-chevron-double-left' => 'eicon-chevron-double-left',
			'eicon-chevron-double-right' => 'eicon-chevron-double-right',
			'eicon-long-arrow-left' => 'eicon-long-arrow-left',
			'eicon-long-arrow-right' => 'eicon-long-arrow-right',
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
		$icon_list = $this->get_icon_list();
		// Start Post Navigation
		// ======================
			$this->start_controls_section(
				'post_nav_content',
				[
					'label' => esc_html__( 'Post Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'prev_text',
					[
						'label' => esc_html__( 'Previous Link Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Previous',
					]
				);
				$this->add_control(
					'prev_icon',
					[
						'label' => esc_html__( 'Previous Link Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $icon_list,
						'default' => 'eicon-arrow-left',
					]
				);
				$this->add_responsive_control(
					'prev_icon_spacing',
					[
						'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'condition' => [
							'prev_text!' => '',
							'prev_icon!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .sina-post-nav-prev i' => 'margin-right: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'next_text',
					[
						'label' => esc_html__( 'Next Link Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Next',
					]
				);
				$this->add_control(
					'next_icon',
					[
						'label' => esc_html__( 'Next Link Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $icon_list,
						'default' => 'eicon-arrow-right',
					]
				);
				$this->add_responsive_control(
					'next_icon_spacing',
					[
						'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px' ],
						'default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'condition' => [
							'prev_text!' => '',
							'prev_icon!' => '',
						],
						'selectors' => [
							'{{WRAPPER}} .sina-post-nav-next i' => 'margin-left: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'title',
					[
						'label' => esc_html__( 'Show Title', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'title_tag',
					[
						'label' => esc_html__( 'Title HTML Tag', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'h3' => 'H3',
							'h4' => 'H4',
							'h5' => 'H5',
							'h6' => 'H6',
						],
						'condition' => [
							'title' => 'yes',
						],
						'default' => 'h3',
					]
				);

			$this->end_controls_section();
		// End Post Navigation
		// ====================


		// Start Nav Button Style
		// =======================
			$this->start_controls_section(
				'post_nav_btn_style',
				[
					'label' => esc_html__( 'Previous / Next', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'conditions' => [
						'relation' => 'or',
						'terms' => [
							[
								'name' => 'prev_text',
								'operator' => '!=',
								'value' => ''
							],
							[
								'name' => 'next_text',
								'operator' => '!=',
								'value' => ''
							],
							[
								'name' => 'prev_icon',
								'operator' => '!=',
								'value' => ''
							],
							[
								'name' => 'next_icon',
								'operator' => '!=',
								'value' => ''
							]
						]
					],
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-post-navigation span', 'post_nav_btn', '{{WRAPPER}} .sina-post-navigation span' );
			$this->end_controls_section();
		// End Nav Button Style
		// =====================

		// Start Nav Title Style
		// ======================
			$this->start_controls_section(
				'post_nav_title_style',
				[
					'label' => esc_html__( 'Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'title' => 'yes',
					]
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-post-nav-title', 'post_nav_title' );
			$this->end_controls_section();
		// End Nav Title Style
		// ====================
	}


	protected function render() {
		Sina_Common_Data::switch_to_last_post();
		$data 		= $this->get_settings_for_display();
		$prev_post 	= get_previous_post();
		$next_post 	= get_next_post();
		?>
		<div class="sina-post-navigation clearfix">
			<?php if (!empty($prev_post)): ?>
				<a href="<?php echo esc_url( get_the_permalink( $prev_post->ID ) ); ?>" class="sina-post-nav-prev">
					<?php if ($data['prev_text'] || $data['prev_icon']): ?>
						<span>
							<?php if ($data['prev_icon']): ?>
								<i class="<?php echo esc_attr( $data['prev_icon'] ) ?>"></i>
							<?php endif; ?>

							<?php echo esc_html($data['prev_text']); ?>
						</span>
					<?php endif ?>

					<?php if ('yes' == $data['title']): ?>
						<<?php echo sina_ext_escape_tags($data['title_tag']); ?> class="sina-post-nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ) ?></<?php echo sina_ext_escape_tags($data['title_tag']); ?>>
					<?php endif ?>
				</a>
			<?php endif; ?>

			<?php if (!empty($next_post)): ?>
				<a href="<?php echo esc_url( get_the_permalink( $next_post->ID ) ); ?>" class="sina-post-nav-next">
					<?php if ($data['next_text'] || $data['prev_icon']): ?>
						<span>
							<?php echo esc_html($data['next_text']); ?>

							<?php if ($data['next_icon']): ?>
								<i class="<?php echo esc_attr( $data['next_icon'] ) ?>"></i>
							<?php endif; ?>
						</span>
					<?php endif ?>

					<?php if ('yes' == $data['title']): ?>
						<<?php echo sina_ext_escape_tags($data['title_tag']); ?> class="sina-post-nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ) ?></<?php echo sina_ext_escape_tags($data['title_tag']); ?>>
					<?php endif ?>
				</a>
			<?php endif; ?>
		</div><!-- .sina-post-navigation -->
		<?php
	}


	protected function content_template() {

	}
}