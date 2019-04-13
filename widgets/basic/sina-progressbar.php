<?php

/**
 * Progressbar Widget.
 *
 * @since 1.0.0
 */


use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Progressbar_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_progressbar';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Progressbar', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-tasks';
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
		return [ 'sina progressbar', 'sina bar' ];
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
		// Start Progressbars Content
		// ===========================
		$this->start_controls_section(
			'progressbars_content',
			[
				'label' => __( 'Progressbar', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'progressbars',
			[
				'label' => __('Add Bar', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'title',
						'label' => __('Title', 'sina-ext'),
						'type' => Controls_Manager::TEXT,
						'default' => __('Progressbars title', 'sina-ext'),
						'label_block' => true,
					],
					[
						'name' => 'percentage',
						'label' => __('Percentage', 'sina-ext'),
						'type' => Controls_Manager::NUMBER,
						'min' => 1,
						'max' => 100,
						'step' => 1,
						'default' => 30,
					],
					[
						'name' => 'bar_bg',
						'label' => __('Background', 'sina-ext'),
						'type' => Controls_Manager::COLOR,
						'default' => '#1085e4',
					],
					[
						'name' => 'bar_color',
						'label' => __('Percentage Color', 'sina-ext'),
						'type' => Controls_Manager::COLOR,
						'default' => '#eee',
					],
					[
						'name' => 'border_color',
						'label' => __('Border Color', 'sina-ext'),
						'type' => Controls_Manager::COLOR,
						'default' => 'rgba(0, 0, 0, 0)',
					],
				],
				'default' => [
					[
						'title' => __('Web Development', 'sina-ext'),
						'percentage' => 93,
						'bar_bg' => '#00aa00',
					],
					[
						'title' => __('Brand Marketing', 'sina-ext'),
						'percentage' => 77,
						'bar_bg' => '#d300d0',
					],
					[
						'title' => __('Graphic Design', 'sina-ext'),
						'percentage' => 53,
						'bar_bg' => '#1085e4',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Progressbars Content
		// ==========================


		// Start Progressbars Style
		// ==========================
		$this->start_controls_section(
			'progressbars_style',
			[
				'label' => __( 'Progressbar', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bars_bg',
			[
				'label' => __('Background', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default'=> '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-bar-bg' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bars_spacing',
			[
				'label' => __('Spacing', 'sina-ext'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bars_height',
			[
				'label' => __('Height', 'sina-ext'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 16,
				],
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 60,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-bg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bars_border_radius',
			[
				'label' => __('Border Radius', 'sina-ext'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-bg, {{WRAPPER}} .sina-bar-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Progressbars Style
		// =========================


		// Start Title Style
		// =====================

		$this->start_controls_section(
			'title_style',
			[
				'label' => __('Title', 'sina-ext'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __('Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default'=> '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-bar-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .sina-bar-title',
			]
		);

		$this->end_controls_section();
		// End Title Style
		// =====================


		// Start Percentage Style
		// =========================
		$this->start_controls_section(
			'percentage_style',
			[
				'label' => __('Percentage', 'sina-ext'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percentage_typography',
				'selector' => '{{WRAPPER}} .sina-bar-percent',
			]
		);

		$this->add_control(
			'percentage_align',
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-bar-percent' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Percentage Style
		// ======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-progressbars">
			<?php
				foreach ( $data['progressbars'] as $index => $bar ) :
					$title_key = $this->get_repeater_setting_key( 'title', 'progressbars', $index );

					$this->add_render_attribute( $title_key, 'class', 'sina-bar-title' );
					$this->add_inline_editing_attributes( $title_key );
				?>
				<div class="sina-bar">
					<div <?php echo $this->get_render_attribute_string( $title_key ); ?>>
						<?php echo esc_html( $bar['title'] ); ?>
					</div>
					<div class="sina-bar-bg" style="border-color: <?php echo esc_attr( $bar['border_color'] ); ?>;">
						<div class="sina-bar-content sina-flex" style="background: <?php echo esc_attr( $bar['bar_bg'] ) ?>; color: <?php echo esc_attr( $bar['bar_color'] ) ?>;" data-percentage="<?php echo esc_attr( $bar['percentage'] ); ?>">
							<span class="sina-bar-percent">
								<?php echo esc_html( $bar['percentage'] ); ?>
							</span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div><!-- .sina-progressbars -->
		<?php
	}


	protected function _content_template() {
		?>
		<div class="sina-progressbars">
		<#
			_.each( settings.progressbars, function( bar, index ) {
				var titleKey = view.getRepeaterSettingKey( 'title', 'progressbars', index );
				view.addRenderAttribute( titleKey, 'class', 'sina-bar-title' );
				view.addInlineEditingAttributes( titleKey );
			#>
			<div class="sina-bar">
				<div {{{ view.getRenderAttributeString( titleKey ) }}}>{{{ bar.title }}}</div>
				<div class="sina-bar-bg" style="border-color: {{{bar.border_color}}};">
					<div style="background: {{{bar.bar_bg}}}; color: {{{bar.bar_bg}}};" class="sina-bar-content sina-flex" data-percentage="{{{bar.percentage}}}">
						<span class="sina-bar-percent" style="color: {{{bar.bar_color}}}">{{{bar.percentage}}}%</span>
					</div>
				</div>
			</div>
		<# }); #>
		</div>
		<?php
	}
}