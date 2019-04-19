<?php

/**
 * Product Zoomer Widget.
 *
 * @since 1.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Product_Zoomer_Widget extends Widget_Base {

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
		return __( 'Sina Product Zoomer', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.1.0
	 */
	public function get_icon() {
		return 'fa fa-search-plus';
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
		return [ 'sina product zoomer', 'sina zoomer', 'sina' ];
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
			'xzoom',
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
	protected function _register_controls() {
		// Start Product Zoomer Content
		// =============================
		$this->start_controls_section(
			'product_content',
			[
				'label' => __( 'Product Images', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'thumbs',
			[
				'label' => __( 'Show Preview', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __('Title', 'sina-ext'),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'description' => __( 'This title will be show only item header', 'sina-ext' ),
				'default' => __('Image Title', 'sina-ext'),
			]
		);
		$repeater->add_control(
			'original_image',
			[
				'label' => __( 'Original Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);
		$repeater->add_control(
			'preview_image',
			[
				'label' => __( 'Thumb Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);
		$repeater->add_control(
			'thumb_image',
			[
				'label' => __( 'Preview Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);

		$this->add_control(
			'product_imgs',
			[
				'label' => __('Add Images', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Car One', 'sina-ext'),
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
						'title' => __('Car two', 'sina-ext'),
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
						'title' => __('Car Three', 'sina-ext'),
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
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Nice Car',
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Price: $100',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-image-link', 'sina-ext' ),
				'default' => [
					'url' => '',
				],
			]
		);
		$this->add_control(
			'position',
			[
				'label' => __( 'Zoomer Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'lens' => __( 'Lens', 'sina-ext' ),
					'top' => __( 'Top', 'sina-ext' ),
					'right' => __( 'Right', 'sina-ext' ),
					'bottom' => __( 'Bottom', 'sina-ext' ),
					'left' => __( 'Left', 'sina-ext' ),
				],
				'default' => 'lens',
			]
		);
		$this->add_control(
			'lens_shape',
			[
				'label' => __( 'Lens Shape', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'sina-ext' ),
					'box' => __( 'Box', 'sina-ext' ),
				],
				'condition' => [
					'position' => 'lens',
				],
				'default' => 'circle',
			]
		);

		$this->end_controls_section();
		// End Product Zoomer Content
		// ===========================


		// Start Product Title Style
		// ===========================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
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
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-product-title' => 'text-align: {{VALUE}};',
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
				'label' => __( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
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
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .sina-product-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Product Desc Style
		// =========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-product-zoomer"
		data-position="<?php echo esc_attr( $data['position'] ) ?>"
		data-shape="<?php echo esc_attr( $data['lens_shape'] ) ?>">
			<h2 class="sina-product-title">
				<?php if ( $data['link']['url'] ): ?>
					<a href="<?php echo esc_url( $data['link']['url'] ); ?>">
						<?php echo esc_html( $data['title'] ); ?>
					</a>
				<?php else: ?>
					<?php echo esc_html( $data['title'] ); ?>
				<?php endif; ?>
			</h2>
			<p class="sina-product-desc"><?php echo esc_html( $data['desc'] ); ?></p>

			<img class="xzoom" src="<?php echo esc_url( $data['product_imgs'][0]['preview_image']['url'] ); ?>" data-xoriginal="<?php echo esc_url( $data['product_imgs'][0]['original_image']['url'] ); ?>" alt="<?php echo esc_attr( $data['title'] ) ?>">

			<?php if ( 'yes' == $data['thumbs'] ): ?>
				<div class="xzoom-thumbs">
					<?php foreach ( $data['product_imgs'] as $img ) : ?>
						<div class="xzoom-thumb-item"
						style="width: <?php echo esc_attr( 100 / count( $data['product_imgs'] ) ); ?>%;"
						data-link="<?php echo esc_url( $img['original_image']['url'] ); ?>">
							<?php if ( $img['preview_image']['url'] && $img['thumb_image']['url']): ?>
								<img class="xzoom-gallery"
								src="<?php echo esc_url( $img['thumb_image']['url'] ); ?>"
								data-xpreview="<?php echo esc_url( $img['preview_image']['url'] ); ?>"  alt="<?php echo esc_attr( $data['title'] ) ?>">
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div><!-- .sina-image-zoomer -->
		<?php
	}


	protected function _content_template() {

	}
}