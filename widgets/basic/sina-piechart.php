<?php

/**
 * Piechart Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Piechart_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_piechart';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Piechart', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-counter-circle';
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
		return [ 'sina piechart', 'sina chart' ];
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
			'easypiechart',
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
		// Start piecharts Content
		// =========================
		$this->start_controls_section(
			'piecharts_content',
			[
				'label' => __( 'Piechart', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter title', 'sina-ext' ),
				'default' => 'Web Development',
			]
		);
		$this->add_control(
			'value',
			[
				'label' => __( 'Value', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'step' => 1,
				'default' => 75,
			]
		);
		$this->add_control(
			'max_value',
			[
				'label' => __( 'Max Value', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'step' => 1,
				'default' => 100,
			]
		);
		$this->add_control(
			'prefix',
			[
				'label' => __( 'Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter prefix', 'sina-ext' ),
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => __( 'Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter suffix', 'sina-ext' ),
				'default' => '%',
			]
		);
		$this->add_control(
			'size',
			[
				'label' => __( 'Size', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 50,
				'max' => 500,
				'step' => 1,
				'default' => 250,
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Animation Duration', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
			]
		);

		$this->end_controls_section();
		// End piecharts Content
		// =======================


		// Start Chart Style
		// =====================
		$this->start_controls_section(
			'chart_style',
			[
				'label' => __( 'Chart', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => __('Bar Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
			]
		);
		$this->add_control(
			'bar_width',
			[
				'label' => __('Bar Width', 'sina-ext'),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
				'min' => 5,
				'step' => 1,
			]
		);
		$this->add_control(
			'bar_cap',
			[
				'label' => __( 'Bar Cap', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'round' => __( 'Round', 'sina-ext' ),
					'square' => __( 'Square', 'sina-ext' ),
				],
				'default' => 'square',
			]
		);
		$this->add_control(
			'track_color',
			[
				'label' => __('Track Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
			]
		);
		$this->add_control(
			'track_width',
			[
				'label' => __('Track Width', 'sina-ext'),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
				'min' => 5,
				'step' => 1,
			]
		);
		$this->add_control(
			'scale_color',
			[
				'label' => __('Scale Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
			]
		);

		$this->end_controls_section();
		// End Chart Style
		// =====================


		// Start Title Style
		// =====================
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
				'label' => __('Text Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-piechart-title' => 'color: {{VALUE}};',
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
							'size' => '16',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-piechart-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-piechart-title',
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Value Style
		// ========================
		$this->start_controls_section(
			'value_style',
			[
				'label' => __( 'Value', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'value_color',
			[
				'label' => __('Text Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-piechart-percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'value_typography',
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
							'size' => '50',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-piechart-percent',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'value_shadow',
				'selector' => '{{WRAPPER}} .sina-piechart-percent',
			]
		);

		$this->end_controls_section();
		// End Value Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$percent = round( $data['value'] / $data['max_value'] * 100 );

		$this->add_render_attribute( 'title', 'class', 'sina-piechart-title' );
		$this->add_inline_editing_attributes( 'title' );
		?>
		<div class="sina-piechart sina-flex" style="width: <?php echo esc_attr( $data['size'] ); ?>px; height: <?php echo esc_attr( $data['size'] ); ?>px;">
			<div class="sina-piechart-wrap"
			data-track="<?php echo esc_attr( $data['track_color'] ); ?>"
			data-track-width="<?php echo esc_attr( $data['track_width'] ); ?>"
			data-bar="<?php echo esc_attr( $data['bar_color'] ); ?>"
			data-line="<?php echo esc_attr( $data['bar_width'] ); ?>"
			data-cap="<?php echo esc_attr( $data['bar_cap'] ); ?>"
			data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
			data-scale="<?php echo esc_attr( $data['scale_color'] ); ?>"
			data-size="<?php echo esc_attr( $data['size'] ); ?>"
			data-percent="<?php echo esc_attr( $percent ); ?>">
			</div>
			<div class="sina-piechart-content" style="padding: <?php echo esc_attr( $data['bar_width']+10 .'px' ) ?>;">
				<span class="sina-piechart-percent">
					<?php echo esc_html( $data['prefix'].$data['value'].$data['suffix'] ); ?>
				</span>
				<div <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_html( $data['title'] ); ?></div>
			</div>
		</div><!-- .sina-piechart -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'title', 'class', 'sina-piechart-title' );
		view.addInlineEditingAttributes( 'title' );
		#>
		<div class="sina-piechart sina-flex" style="width: {{{settings.size}}}px; height: {{{settings.size}}}px;">
			<div class="sina-piechart-wrap" data-track="{{{settings.track_color}}}" data-track-width="{{{settings.track_width}}}" data-bar="{{{settings.bar_color}}}" data-line="{{{settings.bar_width}}}" data-cap="{{{settings.bar_cap}}}" data-speed="{{{settings.speed}}}" data-scale="{{{settings.scale_color}}}" data-size="{{{settings.size}}}" data-percent="{{{Math.round(settings.value / settings.max_value * 100)}}}">
			</div>
			<div class="sina-piechart-content" style="padding: {{{settings.bar_width + 10}}}px;">
				<span class="sina-piechart-percent">{{{settings.prefix + settings.value + settings.suffix}}}</span>
				<div {{{ view.getRenderAttributeString( 'title' ) }}}>{{{settings.title}}}</div>
			</div>
		</div>
		<?php
	}
}