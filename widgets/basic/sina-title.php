<?php
/**
 * Title Widget.
 *
 * @since 2.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Sina_Extension\Sina_Ext_Gradient_Text;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Title_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.0.0
	 */
	public function get_name() {
		return 'sina_title';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.0.0
	 */
	public function get_title() {
		return __( 'Sina Title', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.0.0
	 */
	public function get_icon() {
		return 'eicon-font';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.0.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.0.0
	 */
	public function get_keywords() {
		return [ 'sina title', 'sina subtitle', 'sina heading', 'sina sub heading' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.0.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.0.0
	 */
	protected function _register_controls() {
		// Start Title Content
		// ====================
		$this->start_controls_section(
			'title_content',
			[
				'label' => __( 'Title Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Welcome to get start your business.',
			]
		);
		$this->add_control(
			'title_span',
			[
				'label' => __( 'Title Span', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title Span', 'sina-ext' ),
				'description' => __( 'You can use SPAN for multi-color title.', 'sina-ext' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Select Tag', 'sina-ext' ),
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
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Sub Title', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => __( 'Select Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				],
				'default' => 'h3',
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Description', 'sina-ext' ),
				'description' => __( 'You can use HTML.', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Title Content
		// ==================


		// Start Title Style
		// ====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => '',
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
							'size' => '32',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '42',
						],
					],
					'text_transform' => [
						'default' => 'none',
					],
				],
				'selector' => '{{WRAPPER}} .sina-title-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-title-title',
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_color',
				'selector' => '{{WRAPPER}} .sina-title-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '15',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
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
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-title-title' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =================


		// Start Title Span Style
		// =======================
		$this->start_controls_section(
			'title_span_style',
			[
				'label' => __( 'Title Span', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title_span!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_span_typography',
				'selector' => '{{WRAPPER}} .sina-title-title > span',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_span_shadow',
				'selector' => '{{WRAPPER}} .sina-title-title > span',
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'title_span_color',
				'selector' => '{{WRAPPER}} .sina-title-title > span',
			]
		);

		$this->end_controls_section();
		// End Title Span Style
		// =====================


		// Start Subtitle Style
		// =====================
		$this->start_controls_section(
			'subtitle_style',
			[
				'label' => __( 'Sub Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'subtitle!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
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
				'selector' => '{{WRAPPER}} .sina-title-subtitle',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_shadow',
				'selector' => '{{WRAPPER}} .sina-title-subtitle',
			]
		);
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'subtitle_color',
				'selector' => '{{WRAPPER}} .sina-title-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => __( 'Margin Bottom', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_alignment',
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
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-title-subtitle' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Subtitle Style
		// ===================


		// Start Desc Style
		// ==================
		$this->start_controls_section(
			'desc_style',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'desc!' => '',
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
				'selector' => '{{WRAPPER}} .sina-title-desc',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .sina-title-desc',
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-title-desc' => 'color: {{VALUE}};',
				],
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
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-title-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Desc Style
		// ================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$title_span = $data['title_span'] ? '<span>'.$data['title_span'].'</span>' : '';
		?>
		<div class="sina-title">
			<?php if ( $data['title'] ): ?>
				<?php printf( '<%1$s class="sina-title-title">%2$s%3$s</%1$s>', $data['title_tag'], $data['title'], $title_span ); ?>
			<?php endif; ?>

			<?php if ( $data['subtitle'] ): ?>
				<?php printf( '<%1$s class="sina-title-subtitle">%2$s</%1$s>', $data['subtitle_tag'], $data['subtitle'] ); ?>
			<?php endif; ?>

			<?php if ( $data['desc'] ): ?>
				<?php printf( '<div class="sina-title-desc">%1$s</div>', $data['desc'] ); ?>
			<?php endif; ?>
		</div><!-- .sina-title -->
		<?php
	}


	protected function _content_template() {

	}
}