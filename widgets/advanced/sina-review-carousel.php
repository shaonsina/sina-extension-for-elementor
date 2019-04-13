<?php

/**
 * Review Carousel Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Review_Carousel_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_review_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Review Carousel', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-comment-o';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina client', 'sina review', 'sina testimonial' ];
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
	protected function _register_controls() {
		// Start Review Content
		// =====================
		$this->start_controls_section(
			'review_content',
			[
				'label' => __( 'Review', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'sina-ext' ),
					'middle' => __( 'Middle', 'sina-ext' ),
					'bottom' => __( 'Bottom', 'sina-ext' ),
				],
				'default' => 'top',
			]
		);
		$this->add_control(
			'review',
			[
				'label' => __( 'Add Image', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'image',
						'label' => __( 'Choose Image', 'sina-ext' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
						],
					],
					[
						'name' => 'name',
						'label' => __( 'Name', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => __( 'Enter Name', 'sina-ext' ),
						'default' => 'Jhon Doe',
					],
					[
						'name' => 'position',
						'label' => __( 'Position', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => __( 'Enter Position', 'sina-ext' ),
						'default' => 'CEO',
					],
					[
						'name' => 'company',
						'label' => __( 'Organization', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'placeholder' => __( 'Enter Organization', 'sina-ext' ),
						'default' => 'Google',
					],
					[
						'name' => 'comment',
						'label' => __( 'Comment', 'sina-ext' ),
						'type' => Controls_Manager::TEXTAREA,
						'placeholder' => __( 'Enter Comment', 'sina-ext' ),
						'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At tempora cumque delectus nam obcaecati consectetur ad dolorum neque dolores nemo!',
					],
				],
				'default' => [
					[
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/review1.jpg',
						],
						'name' => __( 'Jhin Stalker', 'sina-ext' ),
						'position' => __( 'CEO', 'sina-ext' ),
						'company' => __( 'Google', 'sina-ext' ),
						'comment' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At tempora cumque delectus nam obcaecati consectetur ad dolorum neque dolores nemo!', 'sina-ext' ),
					],
					[
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/review2.jpg',
						],
						'name' => __( 'Jhon Doe', 'sina-ext' ),
						'position' => __( 'Web Developer', 'sina-ext' ),
						'company' => __( 'Facebook', 'sina-ext' ),
						'comment' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At tempora cumque delectus nam obcaecati consectetur ad dolorum neque dolores nemo!', 'sina-ext' ),
					],
					[
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/review3.jpg',
						],
						'name' => __( 'Jhan Stalker', 'sina-ext' ),
						'position' => __( 'Graphic Designer', 'sina-ext' ),
						'company' => __( 'Behance', 'sina-ext' ),
						'comment' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. At tempora cumque delectus nam obcaecati consectetur ad dolorum neque dolores nemo!', 'sina-ext' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
		// End Review Content
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
			'dots',
			[
				'label' => __( 'Dots', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dots_color',
			[
				'label' => __( 'Dots Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'dots!' => '',
				],
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .owl-dot' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .sina-review-carousel .owl-dot.active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_control(
			'nav',
			[
				'label' => __( 'Navigation', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nav_bg',
			[
				'label' => __( 'Navigation Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'nav!' => '',
				],
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .owl-prev, {{WRAPPER}} .sina-review-carousel .owl-next' => 'background-color: {{VALUE}}'
				]
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
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .owl-prev, {{WRAPPER}} .sina-review-carousel .owl-next' => 'color: {{VALUE}}'
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
				'min' => 500,
				'max' => 15000,
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Speed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
				'step' => 100,
				'min' => 100,
				'max' => 5000,
			]
		);

		$this->end_controls_section();
		// End Carousel Content
		// =====================


		// Start Image Style
		// =====================
		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => __( 'Image Padding', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-review-carousel .owl-item .sina-review-face' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .owl-item .sina-review-face' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-review-carousel .owl-item .sina-review-face',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-review-carousel .owl-item .sina-review-face',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		// End Image Style
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section(
			'name_style',
			[
				'label' => __( 'Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-name' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-name',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'name_shadow',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-name',
			]
		);
		$this->add_responsive_control(
			'name_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Name Style
		// =====================


		// Start Positin Style
		// =====================
		$this->start_controls_section(
			'position_style',
			[
				'label' => __( 'Position', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-position' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-position',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'position_shadow',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-position',
			]
		);
		$this->add_responsive_control(
			'position_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Company Style
		// =====================
		$this->start_controls_section(
			'company_style',
			[
				'label' => __( 'Company', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'company_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-company' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'company_typography',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-company',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'company_shadow',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-company',
			]
		);
		$this->add_responsive_control(
			'company_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-company' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Company Style
		// =====================


		// Start Comment Style
		// =====================
		$this->start_controls_section(
			'comment_style',
			[
				'label' => __( 'Comment', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'comment_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-comment' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'comment_typography',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-comment',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'comment_shadow',
				'selector' => '{{WRAPPER}} .sina-review-carousel .sina-review-comment',
			]
		);
		$this->add_responsive_control(
			'comment_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-review-carousel .sina-review-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Company Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-review-carousel owl-carousel"
		data-autoplay="<?php echo esc_attr( $data['autoplay'] ); ?>"
		data-pause="<?php echo esc_attr( $data['pause'] ); ?>"
		data-nav="<?php echo esc_attr( $data['nav'] ); ?>"
		data-dots="<?php echo esc_attr( $data['dots'] ); ?>"
		data-mouse-drag="<?php echo esc_attr( $data['mouse_drag'] ); ?>"
		data-touch-drag="<?php echo esc_attr( $data['touch_drag'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>">
		<?php
			foreach ($data['review'] as $index => $item) :
				$name_key = $this->get_repeater_setting_key( 'name', 'review', $index );
				$position_key = $this->get_repeater_setting_key( 'position', 'review', $index );
				$company_key = $this->get_repeater_setting_key( 'company', 'review', $index );
				$comment_key = $this->get_repeater_setting_key( 'comment', 'review', $index );

				$this->add_render_attribute( $name_key, 'class', 'sina-review-name' );
				$this->add_inline_editing_attributes( $name_key );

				$this->add_render_attribute( $position_key, 'class', 'sina-review-position' );
				$this->add_inline_editing_attributes( $position_key );

				$this->add_render_attribute( $company_key, 'class', 'sina-review-company' );
				$this->add_inline_editing_attributes( $company_key );

				$this->add_render_attribute( $comment_key, 'class', 'sina-review-comment' );
				$this->add_inline_editing_attributes( $comment_key );
			?>
			<div class="sina-review-item">
				<?php if ( 'top' == $data['image_position'] ): ?>
					<div class="sina-review-member">
						<?php if ( $item['image']['url'] ): ?>
							<img src="<?php echo esc_url( $item['image']['url'] ); ?>" class="sina-review-face" alt="<?php echo esc_attr($item['name']); ?>">
						<?php endif; ?>

						<?php if ($item['name']): ?>
							<h5 <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html($item['name']); ?></h5>
						<?php endif; ?>

						<?php if ($item['position']): ?>
							<p <?php echo $this->get_render_attribute_string( $position_key ); ?>><?php echo esc_html($item['position']); ?></p>
						<?php endif; ?>

						<?php if ($item['company']): ?>
							<p <?php echo $this->get_render_attribute_string( $company_key ); ?>><?php echo esc_html($item['company']); ?></p>
						<?php endif; ?>
					</div>

					<?php if ($item['comment']): ?>
						<div <?php echo $this->get_render_attribute_string( $comment_key ); ?>>
							<?php echo esc_html($item['comment']); ?>
						</div>
					<?php endif; ?>
				<?php elseif ( 'middle' == $data['image_position'] ) : ?>
					<?php if ($item['comment']): ?>
						<div <?php echo $this->get_render_attribute_string( $comment_key ); ?>>
							<?php echo esc_html($item['comment']); ?>
						</div>
					<?php endif; ?>

					<div class="sina-review-member">
						<?php if ( $item['image']['url'] ): ?>
							<img src="<?php echo esc_url( $item['image']['url'] ); ?>" class="sina-review-face" alt="<?php echo esc_attr($item['name']); ?>">
						<?php endif; ?>

						<?php if ($item['name']): ?>
							<h5 <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html($item['name']); ?></h5>
						<?php endif; ?>

						<?php if ($item['position']): ?>
							<p <?php echo $this->get_render_attribute_string( $position_key ); ?>><?php echo esc_html($item['position']); ?></p>
						<?php endif; ?>

						<?php if ($item['company']): ?>
							<p <?php echo $this->get_render_attribute_string( $company_key ); ?>><?php echo esc_html($item['company']); ?></p>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<?php if ($item['comment']): ?>
						<div <?php echo $this->get_render_attribute_string( $comment_key ); ?>>
							<?php echo esc_html($item['comment']); ?>
						</div>
					<?php endif; ?>

					<div class="sina-review-member">
						<?php if ($item['name']): ?>
							<h5 <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html($item['name']); ?></h5>
						<?php endif; ?>

						<?php if ($item['position']): ?>
							<p <?php echo $this->get_render_attribute_string( $position_key ); ?>><?php echo esc_html($item['position']); ?></p>
						<?php endif; ?>

						<?php if ($item['company']): ?>
							<p <?php echo $this->get_render_attribute_string( $company_key ); ?>><?php echo esc_html($item['company']); ?></p>
						<?php endif; ?>

						<?php if ( $item['image']['url'] ): ?>
							<img src="<?php echo esc_url( $item['image']['url'] ); ?>" class="sina-review-face" alt="<?php echo esc_attr($item['name']); ?>">
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
		</div><!-- .sina-review-carousel -->
		<?php
	}


	protected function _content_template() {
		
	}
}