<?php

/**
 * Brand Carousel Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Brand_Carousel_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_brand_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Brand Carousel', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-carousel';
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
		return [ 'sina brand', 'sina carousel', 'sina logo' ];
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
	    	'owl-carousel',
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
	    	'jquery-owl',
	        'sina-widgets-advanced',
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
	protected function _register_controls() {
		// Start Brand Content
		// =====================
		$this->start_controls_section(
			'brand_content',
			[
				'label' => __( 'Brand', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'brand',
			[
				'label' => __( 'Add Logo', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'brand_logo',
						'label' => __( 'Choose Logo', 'sina-ext' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
						],
					],
					[
						'name' => 'link',
						'label' => __( 'Brand Link', 'sina-ext' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
					],
					[
						'name' => 'title',
						'label' => __( 'Brand Name', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => __( 'Enter Name', 'sina-ext' ),
						'description' => __( 'This name will be show only item header', 'sina-ext' ),
						'default' => 'Youtube',
					],
				],
				'default' => [
					[
						'title' => __( 'Youtube', 'sina-ext' ),
						'brand_logo' => [
							'url' => SINA_EXT_URL .'assets/img/brand1.png',
						]
					],
					[
						'title' => __( 'Behance', 'sina-ext' ),
						'brand_logo' => [
							'url' => SINA_EXT_URL .'assets/img/brand2.png',
						]
					],
					[
						'title' => __( 'Vimeo', 'sina-ext' ),
						'brand_logo' => [
							'url' => SINA_EXT_URL .'assets/img/brand3.png',
						]
					],
					[
						'title' => __( 'Linkedin', 'sina-ext' ),
						'brand_logo' => [
							'url' => SINA_EXT_URL .'assets/img/brand4.png',
						]
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Brand Content
		// =====================


		// Start Carousel Settings
		// ========================
		$this->start_controls_section(
			'carousel_settings',
			[
				'label' => __( 'Carousel Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'pause',
			[
				'label' => __( 'Pause on Hover', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'mouse_drag',
			[
				'label' => __( 'Mouse Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'touch_drag',
			[
				'label' => __( 'Touch Drag', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Infinity Loop', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'sina-ext' ),
				'label_off' => __( 'Off', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nav_color',
			[
				'label' => __( 'Navigation Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-brand-carousel .owl-prev, {{WRAPPER}} .sina-brand-carousel .owl-next' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => __( 'Delay', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'step' => 100,
				'min' => 1000,
				'max' => 15000,
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Speed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1000,
				'step' => 100,
				'min' => 100,
				'max' => 5000,
			]
		);

		$this->end_controls_section();
		// End Carousel Content
		// =====================


		// Start Box Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Brand Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'logo_padding',
			[
				'label' => __( 'Logo Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-brand-item-inner a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Box Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-brand-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-brand-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'box_tabs' );

		$this->start_controls_tab(
			'box_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'box_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-brand-item-inner' => 'background-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-brand-item-inner',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-brand-item-inner',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'box_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-brand-item-inner:hover' => 'background-color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'hover_box_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-brand-item-inner:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_box_shadow',
				'selector' => '{{WRAPPER}} .sina-brand-item-inner:hover',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		// End Box Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-brand-carousel owl-carousel"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>">
			<?php foreach ($data['brand'] as $logo): ?>
				<?php if ( $logo['brand_logo']['url'] ): ?>
					<div class="sina-brand-item">
						<div class="sina-brand-item-inner">
							<a href="<?php echo esc_url( $logo['link']['url'] ); ?>"
								<?php if ( 'on' == $logo['link']['is_external'] ): ?>
									target="_blank" 
								<?php endif; ?>
								<?php if ( 'on' == $logo['link']['nofollow'] ): ?>
									rel="nofollow" 
								<?php endif; ?>>
								<img src="<?php echo esc_url( $logo['brand_logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo['title'] ); ?>">
							</a>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div><!-- .sina-brand-carousel -->
		<?php
	}


	protected function _content_template() {
		
	}
}