<?php

/**
 * Product Zoomer Widget.
 *
 * @since 1.1.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Control_Media;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Product_Zoomer_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.1.0
	 */
	public function get_name() {
		return 'sina_product_zoomer';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.1.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Product Zoomer', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.1.0
	 */
	public function get_icon() {
		return 'eicon-zoom-in';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.1.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.1.0
	 */
	public function get_keywords() {
		return [ 'sina product zoomer', 'sina zoomer', 'sina product viewer' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.1.0
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
	 * @since 1.1.0
	 */
	public function get_script_depends() {
		return [
			'xzoom',
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 */
	protected function register_controls() {
		// Start Product Zoomer Content
		// =============================
		$this->start_controls_section(
			'product_content',
			[
				'label' => esc_html__( 'Product Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Product Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Nice Car',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Product Description', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Price: $100',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-image-link',
				'default' => [
					'url' => '',
				],
				'condition' => [
					'title!' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'content_position',
			[
				'label' => esc_html__( 'Content Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();
		// End Product Zoomer Content
		// ===========================


		// Start Product Images
		// ======================
		$this->start_controls_section(
			'product_images',
			[
				'label' => esc_html__( 'Product Images', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__('Title', 'sina-ext'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'This title will be show only item header', 'sina-ext' ),
				'default' => 'Image Title',
			]
		);
		$repeater->add_control(
			'original_image',
			[
				'label' => esc_html__( 'Original Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'preview_image',
			[
				'label' => esc_html__( 'Thumb Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$repeater->add_control(
			'thumb_image',
			[
				'label' => esc_html__( 'Preview Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'product_imgs',
			[
				'label' => esc_html__('Add Images', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Car One',
						'original_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-original1.jpg',
						],
						'preview_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-preview1.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-thumb1.jpg',
						]
					],
					[
						'title' => 'Car two',
						'original_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-original2.jpg',
						],
						'preview_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-preview2.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-thumb2.jpg',
						]
					],
					[
						'title' => 'Car Three',
						'original_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-original3.jpg',
						],
						'preview_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-preview3.jpg',
						],
						'thumb_image' => [
							'url' => SINA_EXT_URL .'assets/img/car-thumb3.jpg',
						]
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'thumbs',
			[
				'label' => esc_html__( 'Show Preview', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'position',
			[
				'label' => esc_html__( 'Zoomer Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'lens' => esc_html__( 'Lens', 'sina-ext' ),
					'top' => esc_html__( 'Top', 'sina-ext' ),
					'right' => esc_html__( 'Right', 'sina-ext' ),
					'bottom' => esc_html__( 'Bottom', 'sina-ext' ),
					'left' => esc_html__( 'Left', 'sina-ext' ),
				],
				'default' => 'lens',
			]
		);
		$this->add_control(
			'lens_shape',
			[
				'label' => esc_html__( 'Lens Shape', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'sina-ext' ),
					'box' => esc_html__( 'Box', 'sina-ext' ),
				],
				'condition' => [
					'position' => 'lens',
				],
				'default' => 'circle',
			]
		);

		$this->end_controls_section();
		// End Product Images
		// ====================


		// Start Product Title Style
		// ===========================
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-product-title, {{WRAPPER}} .sina-product-title a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '24',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '32',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-product-title, {{WRAPPER}} .sina-product-title a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-product-title, {{WRAPPER}} .sina-product-title a',
			]
		);
		$this->add_responsive_control(
			'title_alignment',
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
					'justify' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-product-title' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Product Title Style
		// =========================


		// Start Product Desc Style
		// ===========================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-product-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '16',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-product-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-product-desc',
			]
		);
		$this->add_responsive_control(
			'desc_alignment',
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
					'justify' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-product-desc' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-product-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Product Desc Style
		// =========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$original_img_alt = $data['title'] ? $data['title'] : Control_Media::get_image_alt( $data['product_imgs'][0]['original_image'] );
		?>
		<div class="sina-product-zoomer"
		data-position="<?php echo esc_attr( $data['position'] ) ?>"
		data-shape="<?php echo esc_attr( $data['lens_shape'] ) ?>">
			<?php if ( '' == $data['content_position'] ): ?>
				<?php if ( $data['title'] ): ?>
					<h3 class="sina-product-title">
						<?php if ( $data['link']['url'] ): ?>
							<a href="<?php echo esc_url( $data['link']['url'] ); ?>"
								<?php if ( 'on' == $data['link']['is_external'] ): ?>
									target="_blank" 
								<?php endif; ?>
								<?php if ( 'on' == $data['link']['nofollow'] ): ?>
									rel="nofollow" 
								<?php endif; ?>>
								<?php printf( '%1$s', $data['title'] ); ?>
							</a>
						<?php else: ?>
							<?php printf( '%1$s', $data['title'] ); ?>
						<?php endif; ?>
					</h3>
				<?php endif; ?>
				<?php if ( $data['desc'] ): ?>
					<?php printf( '<div class="sina-product-desc">%1$s</div>', $data['desc'] ); ?>
				<?php endif; ?>
			<?php endif; ?>

			<img class="xzoom" src="<?php echo esc_url( $data['product_imgs'][0]['preview_image']['url'] ); ?>" data-xoriginal="<?php echo esc_url( $data['product_imgs'][0]['original_image']['url'] ); ?>" alt="<?php echo esc_attr( $original_img_alt ) ?>">

			<?php if ( 'yes' == $data['thumbs'] ): ?>
				<div class="xzoom-thumbs clearfix">
					<?php foreach ( $data['product_imgs'] as $img ) :
						$thumb_img_alt = $data['title'] ? $data['title'] : Control_Media::get_image_alt( $img['thumb_image'] );
						?>
						<div class="xzoom-thumb-item"
						style="width: <?php echo esc_attr( 100 / count( $data['product_imgs'] ) ); ?>%;"
						data-link="<?php echo esc_url( $img['original_image']['url'] ); ?>">
							<?php if ( $img['preview_image']['url'] && $img['thumb_image']['url']): ?>
								<img class="xzoom-gallery"
								src="<?php echo esc_url( $img['thumb_image']['url'] ); ?>"
								data-xpreview="<?php echo esc_url( $img['preview_image']['url'] ); ?>"  alt="<?php echo esc_attr( $thumb_img_alt ) ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( 'yes' == $data['content_position'] ): ?>
				<?php if ( $data['title'] ): ?>
					<h3 class="sina-product-title">
						<?php if ( $data['link']['url'] ): ?>
							<a href="<?php echo esc_url( $data['link']['url'] ); ?>"
								<?php if ( 'on' == $data['link']['is_external'] ): ?>
									target="_blank" 
								<?php endif; ?>
								<?php if ( 'on' == $data['link']['nofollow'] ): ?>
									rel="nofollow" 
								<?php endif; ?>>
								<?php printf( '%1$s', $data['title'] ); ?>
							</a>
						<?php else: ?>
							<?php printf( '%1$s', $data['title'] ); ?>
						<?php endif; ?>
					</h3>
				<?php endif; ?>
				<?php if ( $data['desc'] ): ?>
					<?php printf( '<div class="sina-product-desc">%1$s</div>', $data['desc'] ); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div><!-- .sina-image-zoomer -->
		<?php
	}


	protected function content_template() {

	}
}