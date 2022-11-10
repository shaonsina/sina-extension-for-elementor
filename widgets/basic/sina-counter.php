<?php

/**
 * Counter Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Control_Media;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Counter_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_counter';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Counter', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-counter';
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
		return [ 'sina counter', 'sina number', 'sina timer' ];
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
			'icofont',
			'font-awesome',
			'elementor-icons',
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
			'jquery-numerator',
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
	protected function register_controls() {
		// Start Counter Content
		// =====================
		$this->start_controls_section(
			'counter_content',
			[
				'label' => esc_html__( 'Counter', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon_format',
			[
				'label' => esc_html__( 'Icon Format', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'icon' => [
						'title' => esc_html__( 'Icon', 'sina-ext' ),
						'icon' => 'eicon-star',
					],
					'image' => [
						'title' => esc_html__( 'Image', 'sina-ext' ),
						'icon' => 'eicon-image-bold',
					],
				],
				'default' => 'icon',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-user',
				'condition' => [
					'icon_format' => 'icon',
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => esc_html__( 'Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'icon_format' => 'image',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Satisfied Customers',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title_position',
			[
				'label' => esc_html__( 'Title Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'middle' => esc_html__( 'Middle', 'sina-ext' ),
					'bottom' => esc_html__( 'Bottom', 'sina-ext' ),
				],
				'condition' => [
					'title!' => '',
				],
				'default' => 'bottom',
			]
		);
		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Prefix', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'prefix_space',
			[
				'label' => esc_html__( 'Prefix Space', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => -20,
					],
				],
				'condition' => [
					'prefix!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-prefix' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Suffix', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'suffix_space',
			[
				'label' => esc_html__( 'Suffix space', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range' => [
					'px' => [
						'min' => -20,
					],
				],
				'condition' => [
					'suffix!' => ''
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-suffix' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'delimiter',
			[
				'label' => esc_html__( 'Thousand Delimiter', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					',' => esc_html__( 'Comma', 'sina-ext' ),
					'.' => esc_html__( 'Dot', 'sina-ext' ),
					'|' => esc_html__( 'Pipe', 'sina-ext' ),
					' ' => esc_html__( 'Space', 'sina-ext' ),
				],
				'default' => ',',
			]
		);
		$this->add_control(
			'start_number',
			[
				'label' => esc_html__( 'Start Number', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'step' => 1,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'stop_number',
			[
				'label' => esc_html__( 'Stop Number', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 500,
				'step' => 1,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => esc_html__( 'Counting Duration', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
			]
		);
		$this->add_responsive_control(
			'alignment',
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-counter' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Counter Content
		// =====================


		// Start Title Style
		// =====================
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0a0',
				'selectors' => [
					'{{WRAPPER}} .sina-counter-title' => 'color: {{VALUE}};',
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
					'font_size'   => [
						'default' => [
							'size' => '32',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '40',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-counter-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-counter-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Number Style
		// =====================
		$this->start_controls_section(
			'number_style',
			[
				'label' => esc_html__( 'Number', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-counter-number-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '50',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '70',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-counter-number-wrap',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'number_shadow',
				'selector' => '{{WRAPPER}} .sina-counter-number-wrap',
			]
		);
		$this->add_responsive_control(
			'number_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-number-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon or Image', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_format!' => ''
				]
			]
		);

		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'icon_color',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#d300d0',
					],
				],
				'condition' => [
					'icon_format' => 'icon'
				],
				'selector' => '{{WRAPPER}} .sina-counter-icon i',
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'default' => [
					'size' => '40'
				],
				'condition' => [
					'icon_format' => 'icon'
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 30,
					],
				],
				'default'=> [
					'unit' => 'px',
					'size' => '100',
				],
				'condition' => [
					'icon_format' => 'image',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-icon img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'condition' => [
					'icon_format' => 'icon'
				],
				'selector' => '{{WRAPPER}} .sina-counter-icon i',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .sina-counter-icon i, {{WRAPPER}} .sina-counter-icon img',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sina-counter-icon i, {{WRAPPER}} .sina-counter-icon img',
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-icon i, {{WRAPPER}} .sina-counter-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => true,
				],
				'condition' => [
					'icon_format' => 'icon'
				],
				'selectors' => [
					'{{WRAPPER}} .sina-counter-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$img_alt = $data['title'] ? $data['title'] : Control_Media::get_image_alt( $data['image'] );
		?>
		<div class="sina-counter">
			<?php if ( 'icon' == $data['icon_format'] ): ?>
				<div class="sina-counter-icon">
					<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
				</div>
			<?php elseif( 'image' == $data['icon_format'] ): ?>
				<div class="sina-counter-icon">
					<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $img_alt ) ?>">
				</div>
			<?php endif; ?>

			<?php if ( $data['title'] && 'middle' == $data['title_position']): ?>
				<?php printf( '<h3 class="sina-counter-title">%1$s</h3>', $data['title'] ); ?>
			<?php endif; ?>

			<?php if ( $data['start_number'] && $data['stop_number'] ): ?>
				<div class="sina-counter-number-wrap">
					<?php if ( $data['prefix']): ?>
						<span class="sina-counter-prefix"><?php printf( '%s', $data['prefix'] ); ?></span>
					<?php endif; ?>

					<span class="sina-counter-number"
					data-duration="<?php echo esc_attr($data['speed']); ?>"
					data-to-value="<?php echo esc_attr($data['stop_number']); ?>"
					data-delimiter="<?php echo esc_attr($data['delimiter']); ?>">
						<?php printf( '%s', $data['start_number'] ); ?>
					</span>

					<?php if ( $data['suffix']): ?>
						<span class="sina-counter-suffix">
							<?php printf( '%s', $data['suffix'] ); ?>
						</span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $data['title'] && 'bottom' == $data['title_position'] ): ?>
				<?php printf( '<h3 class="sina-counter-title">%1$s</h3>', $data['title'] ); ?>
			<?php endif; ?>
		</div><!-- .sina-counter -->
		<?php
	}


	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'title', 'class', 'sina-counter-title' );
		view.addInlineEditingAttributes( 'title' );
		#>
		<div class="sina-counter">
			<# if ( 'icon' == settings.icon_format ) { #>
				<div class="sina-counter-icon">
					<i class="{{{settings.icon}}}"></i>
				</div>
			<# } else if( 'image' == settings.icon_format ) { #>
				<div class="sina-counter-icon">
					<img src="{{{settings.image.url}}}">
				</div>
			<# } #>

			<# if (settings.title && 'middle' == settings.title_position) { #>
				<div {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title}}}</div>
			<# } #>

			<# if ( settings.start_number && settings.stop_number ) { #>
				<div class="sina-counter-number-wrap">
					<# if (settings.prefix) { #>
						<span class="sina-counter-prefix">{{{settings.prefix}}}</span>
					<# } #>

					<span class="sina-counter-number" 
					data-duration="{{{settings.speed}}}"
					data-to-value="{{{settings.stop_number}}}"
					data-delimiter="{{{settings.delimiter}}}">
						{{{settings.start_number}}}
					</span>

					<# if (settings.suffix) { #>
						<span class="sina-counter-suffix">{{{settings.suffix}}}</span>
					<# } #>
				</div>
			<# } #>

			<# if (settings.title && 'bottom' == settings.title_position) { #>
				<div {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title}}}</div>
			<# } #>
		</div>
		<?php
	}
}