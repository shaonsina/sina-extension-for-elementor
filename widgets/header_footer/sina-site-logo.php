<?php

/**
 * Site Logo Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Site_Logo_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_site_logo';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Site Logo', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-site-logo';
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
		return [ 'sina site logo', 'sina logo', 'sina header', 'sina footer' ];
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
		// Start Site Logo
		// ================
			$this->start_controls_section(
				'site_logo_content',
				[
					'label' => esc_html__( 'Site Logo', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'logo',
					[
						'label' => esc_html__( 'Logo', 'sina-ext' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => SINA_EXT_URL .'assets/img/choose-logo.jpg',
						],
					]
				);
				if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
					$this->add_control(
						'sticky_logo',
						[
							'label' => esc_html__( 'Sticky Logo', 'sina-ext' ),
							'type' => Controls_Manager::MEDIA,
							'description' => esc_html__( 'Use same dimention', 'sina-ext' ),
							'default' => [
								'url' => SINA_EXT_URL .'assets/img/choose-logo.jpg',
							],
						]
					);
				}
				$this->add_control(
					'is_link',
					[
						'label' => esc_html__( 'Link', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'dynamic' => esc_html__( 'Dynamic', 'sina-ext' ),
							'custom' => esc_html__( 'Custom', 'sina-ext' ),
						],
						'default' => 'dynamic',
					]
				);
				$this->add_control(
					'link',
					[
						'label' => esc_html__( 'Custom Link', 'sina-ext' ),
						'type' => Controls_Manager::URL,
						'placeholder' => 'https://your-link.com',
						'default' => [
							'url' => '#',
						],
						'condition' => [
							'is_link' => 'custom',
						]
					]
				);

			$this->end_controls_section();
		// End Site Logo
		// ==============


		// Start Logo Style
		// =================
			$selector = '.elementor-element-{{ID}} .sina-site-logo';
			$this->start_controls_section(
				'site_logo_style',
				[
					'label' => esc_html__( 'Logo', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_responsive_control(
					'logo_width',
					[
						'label' => esc_html__( 'Width', 'sina-ext' ),
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
						'selectors' => [
							$selector.' img' => 'width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'logo_height',
					[
						'label' => esc_html__( 'Height', 'sina-ext' ),
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
						'selectors' => [
							$selector.' img' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'logo_radius',
					[
						'label' => esc_html__( 'Radius', 'sina-ext' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em', '%' ],
						'selectors' => [
							$selector.' a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		// End Logo Style
		// ===============
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ('dynamic' == $data['is_link']) {
			$link = home_url( '/' );
		} elseif ( 'custom' == $data['is_link'] ) {
			$link = $data['link']['url'];
		}
		$img_alt = get_bloginfo( 'name' );
		?>
		<div class="sina-site-logo">
			<a class="sina-logo-wrap"
				href="<?php echo esc_url( $link ); ?>"
				<?php if ('custom' == $data['is_link']): ?>
					<?php if ( 'on' == $data['link']['is_external'] ): ?>
						target="_blank"
					<?php endif; ?>
					<?php if ( 'on' == $data['link']['nofollow'] ): ?>
						rel="nofollow"
					<?php endif; ?>
				<?php endif ?>>

				<?php if ($data['logo']['url']):?>
					<img class="sina-logo" src="<?php echo esc_url( $data['logo']['url'] ); ?>" alt="<?php echo esc_attr($img_alt); ?>">
				<?php endif ?>

				<?php if ($data['sticky_logo']['url']): ?>
					<img class="sina-sticky-logo" src="<?php echo esc_url( $data['sticky_logo']['url'] ); ?>" alt="<?php echo esc_attr($img_alt); ?>">
				<?php endif ?>
			</a>
		</div><!-- .sina-site-logo -->
		<?php
	}


	protected function content_template() {

	}
}