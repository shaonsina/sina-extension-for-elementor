<?php

/**
 * Piechart Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;


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
				'description' => __( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Web Development',
			]
		);
		$this->add_control(
			'value',
			[
				'label' => __( 'Value', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'default' => 75,
			]
		);
		$this->add_control(
			'max_value',
			[
				'label' => __( 'Max Value', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
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
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'default' => [
					'size' => 250,
				],
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
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
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
				'default' => '#fafafa',
			]
		);
		$this->add_control(
			'track_width',
			[
				'label' => __('Track Width', 'sina-ext'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
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
			'title_position',
			[
				'label' => __( 'Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'sina-ext' ),
					'bottom' => __( 'Bottom', 'sina-ext' ),
				],
				'default' => 'bottom',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __('Text Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
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
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '0',
					'bottom' => '10',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-piechart-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'default' => '#222',
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
		$percent = 100;
		if ( $data['value'] && $data['max_value'] ) {
			$percent = round( $data['value'] / $data['max_value'] * 100 );
		}
		?>
		<div class="sina-piechart" style="width: <?php echo esc_attr( $data['size']['size'] ); ?>px; height: <?php echo esc_attr( $data['size']['size'] ); ?>px;">
			<div class="sina-piechart-wrap"
			data-track="<?php echo esc_attr( $data['track_color'] ); ?>"
			data-track-width="<?php echo esc_attr( $data['track_width']['size'] ); ?>"
			data-bar="<?php echo esc_attr( $data['bar_color'] ); ?>"
			data-line="<?php echo esc_attr( $data['bar_width']['size'] ); ?>"
			data-cap="<?php echo esc_attr( $data['bar_cap'] ); ?>"
			data-speed="<?php echo esc_attr( $data['speed'] ); ?>"
			data-scale="<?php echo esc_attr( $data['scale_color'] ); ?>"
			data-size="<?php echo esc_attr( $data['size']['size'] ); ?>"
			data-percent="<?php echo esc_attr( $percent ); ?>">
			</div>
			<div class="sina-piechart-content sina-flex">
				<div class="sina-piechart-center">
					<?php if ( 'bottom' == $data['title_position'] ): ?>
						<span class="sina-piechart-percent">
							<?php printf( '%s', $data['prefix'].$data['value'].$data['suffix'] ); ?>
						</span>
					<?php endif; ?>
					<?php if ( $data['title'] ): ?>
						<?php printf( '<h3 class="sina-piechart-title">%1$s</h3>', $data['title'] ); ?>
					<?php endif; ?>
					<?php if ( 'top' == $data['title_position'] ): ?>
						<span class="sina-piechart-percent">
							<?php printf( '%s', $data['prefix'].$data['value'].$data['suffix'] ); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .sina-piechart -->
		<?php
	}


	protected function _content_template() {

	}
}