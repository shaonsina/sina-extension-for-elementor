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
use \Elementor\Group_Control_Background;
use \Sina_Extension\Sina_Ext_Gradient_Text;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Title_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Title', 'sina-ext' );
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
	protected function register_controls() {
		// Start Title Content
		// ====================
		$this->start_controls_section(
			'title_content',
			[
				'label' => esc_html__( 'Title Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'separator',
			[
				'label' => esc_html__( 'Separator', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'sina-ext' ),
					'' => esc_html__( 'Solid', 'sina-ext' ),
					'sina-separator-solid-dot' => esc_html__( 'Solid and Dot', 'sina-ext' ),
				],
				'default' => 'none',
			]
		);
		$this->add_control(
			'separator_position',
			[
				'label' => esc_html__( 'Separator Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before_title' => esc_html__( 'Before Title', 'sina-ext' ),
					'after_title' => esc_html__( 'After Title', 'sina-ext' ),
				],
				'condition' => [
					'separator!' => 'none',
				],
				'default' => 'after_title',
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Welcome to get start your business.',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title_span',
			[
				'label' => esc_html__( 'Highlight Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Highlight Text', 'sina-ext' ),
				'description' => esc_html__( 'You can use SPAN TAG for multi-color title.', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( 'Select Tag', 'sina-ext' ),
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
				'label' => esc_html__( 'Sub Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Sub Title', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( 'Select Tag', 'sina-ext' ),
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
				'label' => esc_html__( 'Description', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter Description', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
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
					'justify' => [
						'title' => esc_html__( 'Justify', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-title' => 'text-align: {{VALUE}};',
				],
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
				'label' => esc_html__( 'Title', 'sina-ext' ),
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
						'title' => esc_html__( 'Justify', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-title, .sina-separator-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
					],
					'em' => [
						'min' => -10,
					],
				],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '15',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Title Span', 'sina-ext' ),
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
				'selector' => '{{WRAPPER}} .sina-title-title > span, {{WRAPPER}} .sina-title-title > span *',
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
				'selector' => '{{WRAPPER}} .sina-title-title > span, {{WRAPPER}} .sina-title-title > span *',
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
				'label' => esc_html__( 'Sub Title', 'sina-ext' ),
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
			'subtitle_alignment',
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
						'title' => esc_html__( 'Justify', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-subtitle' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '0',
					'right' => '0',
					'bottom' => '5',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => esc_html__( 'Description', 'sina-ext' ),
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
				'label' => esc_html__( 'Color', 'sina-ext' ),
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
						'title' => esc_html__( 'Justify', 'sina-ext' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-title-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Desc Style
		// ================


		// Start Separator Style
		// ======================
		$this->start_controls_section(
			'separator_style',
			[
				'label' => esc_html__( 'Separator', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'separator!' => 'none',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'separator_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-separator',
			]
		);
		$this->add_control(
			'separator_dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'separator' => 'sina-separator-solid-dot',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-separator.sina-separator-solid-dot:before, {{WRAPPER}} .sina-separator.sina-separator-solid-dot:after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'separator_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 2000,
					],
					'em' => [
						'min' => -10,
						'max' => 100,
					],
				],
				'default' => [
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-separator' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'separator_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => '4',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-separator' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'separator_alignment',
			[
				'label' => esc_html__( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'sina-ext' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'sina-ext' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'sina-ext' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-separator-wrap' => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'separator_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-separator, {{WRAPPER}} .sina-separator.sina-separator-solid-dot:before, {{WRAPPER}} .sina-separator.sina-separator-solid-dot:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'separator_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-separator-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Separator Style
		// ====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$title_span = $data['title_span'] ? '<span>'.$data['title_span'].'</span>' : '';
		?>
		<div class="sina-title">
			<?php if ( 'none' != $data['separator'] && 'before_title' == $data['separator_position'] ): ?>
				<div class="sina-separator-wrap sina-flex">
					<div class="sina-separator <?php echo esc_attr( $data['separator'] ); ?>"></div>
				</div>
			<?php endif; ?>

			<?php if ( $data['title'] ): ?>
				<?php printf( '<%1$s class="sina-title-title">%2$s%3$s</%1$s>', sina_ext_html_tags( $data['title_tag'] ), $data['title'], $title_span ); ?>
			<?php endif; ?>

			<?php if ( 'none' != $data['separator'] && 'after_title' == $data['separator_position'] ): ?>
				<div class="sina-separator-wrap sina-flex">
					<div class="sina-separator <?php echo esc_attr( $data['separator'] ); ?>"></div>
				</div>
			<?php endif; ?>

			<?php if ( $data['subtitle'] ): ?>
				<?php printf( '<%1$s class="sina-title-subtitle">%2$s</%1$s>', sina_ext_html_tags( $data['subtitle_tag'] ), $data['subtitle'] ); ?>
			<?php endif; ?>

			<?php if ( $data['desc'] ): ?>
				<?php printf( '<div class="sina-title-desc">%1$s</div>', $data['desc'] ); ?>
			<?php endif; ?>
		</div><!-- .sina-title -->
		<?php
	}


	protected function content_template() {
		?>
		<div class="sina-title">
			<#
				var titleSpan = settings.title_span ? '<span>' + settings.title_span + '</span>' : '';

				view.addRenderAttribute( 'title', 'class', 'sina-title-title' );
				view.addInlineEditingAttributes( 'title' );

				view.addRenderAttribute( 'subtitle', 'class', 'sina-title-subtitle' );
				view.addInlineEditingAttributes( 'subtitle' );

				view.addRenderAttribute( 'desc', 'class', 'sina-title-desc' );
				view.addInlineEditingAttributes( 'desc' );

				if ( 'none' != settings.separator && 'before_title' == settings.separator_position ) {
					#>
					<div class="sina-separator-wrap sina-flex">
						<div class="sina-separator {{{settings.separator}}}"></div>
					</div>
					<#
				}

				if (settings.title) {
					#>
					<{{{settings.title_tag}}} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title + titleSpan}}}</{{{settings.title_tag}}}>
					<#
				}

				if ( 'none' !=  settings.separator && 'after_title' == settings.separator_position ) {
					#>
					<div class="sina-separator-wrap sina-flex">
						<div class="sina-separator {{{settings.separator}}}"></div>
					</div>
					<#
				}

				if (settings.subtitle) {
					#>
					<{{{settings.subtitle_tag}}} {{{ view.getRenderAttributeString( 'subtitle' ) }}}>{{{settings.subtitle}}}</{{{settings.subtitle_tag}}}>
					<#
				}

				if (settings.desc) {
					#>
					<div {{{ view.getRenderAttributeString( 'desc' ) }}}>{{{settings.desc}}}</div>
				<# } #>
		</div><!-- .sina-title -->
		<?php
	}
}