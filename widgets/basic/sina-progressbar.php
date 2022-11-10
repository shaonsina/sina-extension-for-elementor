<?php

/**
 * Progressbar Widget.
 *
 * @since 1.0.0
 */


use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Progressbar_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Progressbar', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-skill-bar';
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
		// Start Progressbars Content
		// ===========================
		$this->start_controls_section(
			'progressbars_content',
			[
				'label' => esc_html__( 'Progressbar', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Enter Title', 'sina-ext'),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Web Development',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'sina-ext' ),
					'right' => esc_html__( 'Right', 'sina-ext' ),
				],
				'default' => 'left',
				'condition' => [
					'icon!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-title .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-bar-title .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'.rtl {{WRAPPER}} .sina-bar-title .sina-icon-right' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
					'.rtl {{WRAPPER}} .sina-bar-title .sina-icon-left' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_control(
			'percentage',
			[
				'label' => esc_html__( 'Value', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'default' => 90,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'max_value',
			[
				'label' => esc_html__( 'Max Value', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'default' => 100,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter prefix', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter suffix', 'sina-ext' ),
				'default' => '%',
				'dynamic' => [
					'active' => true,
				],
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
				'label' => esc_html__( 'Progressbar', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'bars_height',
			[
				'label' => esc_html__('Height', 'sina-ext'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'default' => [
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-bg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'bar_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fafafa',
					],
				],
				'selector' => '{{WRAPPER}} .sina-bar-bg',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'bar_shadow',
				'selector' => '{{WRAPPER}} .sina-bar-bg',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'bars_border',
				'selector' => '{{WRAPPER}} .sina-bar-bg',
			]
		);
		$this->add_responsive_control(
			'bars_border_radius',
			[
				'label' => esc_html__('Border Radius', 'sina-ext'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-bg, {{WRAPPER}} .sina-bar-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'track',
			[
				'label' => esc_html__( 'Track Style', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'track_bg',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-bar-content',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'track_shadow',
				'selector' => '{{WRAPPER}} .sina-bar-content',
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
				'label' => esc_html__('Title', 'sina-ext'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Text Color', 'sina-ext'),
				'type' => Controls_Manager::COLOR,
				'default'=> '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-bar-title' => 'color: {{VALUE}};',
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
							'size' => '16',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '24',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-bar-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_tshadow',
				'selector' => '{{WRAPPER}} .sina-bar-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Bottom Margin', 'sina-ext'),
				'type' => Controls_Manager::SLIDER,
				'default'=> [
					'size' => '5',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_align',
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
				'selectors' => [
					'{{WRAPPER}} .sina-bar-title' => 'text-align: {{VALUE}};',
				],
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
				'label' => esc_html__('Percentage', 'sina-ext'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bar_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-bar-percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'percentage_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '12',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-bar-percent',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'percentage_tshadow',
				'selector' => '{{WRAPPER}} .sina-bar-percent',
			]
		);
		$this->add_responsive_control(
			'percentage_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-bar-percent' => 'padding: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'percentage_align',
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
		$percent = 100;
		if ( $data['percentage'] && $data['max_value']) {
			$percent = round( $data['percentage'] / $data['max_value'] * 100 );
		}
		?>
		<div class="sina-progressbars">
			<?php if ( $data['title'] ): ?>
				<h3 class="sina-bar-title">
					<?php if ( $data['icon'] && 'left' == $data['icon_align'] ): ?>
						<i class="<?php echo esc_attr( $data['icon']); ?> sina-icon-left"></i>
					<?php endif ?>
					<?php printf( '%1$s', $data['title'] ); ?>
					<?php if ( $data['icon'] && 'right' == $data['icon_align'] ): ?>
						<i class="<?php echo esc_attr( $data['icon']); ?> sina-icon-right"></i>
					<?php endif ?>
				</h3>
			<?php endif; ?>

			<div class="sina-bar-bg">
				<div class="sina-bar-content sina-flex" data-percentage="<?php echo esc_attr( $percent ); ?>">
					<span class="sina-bar-percent">
							<?php printf( '%s', $data['prefix'].$data['percentage'].$data['suffix'] ); ?>
					</span>
				</div>
			</div>
		</div><!-- .sina-progressbars -->
		<?php
	}


	protected function content_template() {
		?>
		<div class="sina-progressbars">
			<# if (settings.title) { #>
			<h3 class="sina-bar-title">
				<# if (settings.icon && 'left' == settings.icon_align) { #>
					<i class="{{{settings.icon}}} sina-icon-left"></i>
				<# } #>

				{{{settings.title}}}

				<# if (settings.icon && 'right' == settings.icon_align) { #>
					<i class="{{{settings.icon}}} sina-icon-right"></i>
				<# } #>
			</h3>
			<# } #>

			<#
			var percent = 100;
			if ( settings.percentage && settings.max_value ) {
				percent = Math.round( settings.percentage / settings.max_value * 100 );
			}
			#>
			<div class="sina-bar-bg">
				<div class="sina-bar-content sina-flex"
				data-percentage="{{{percent}}}">
					<span class="sina-bar-percent">
						{{{settings.prefix + settings.percentage + settings.suffix}}}
					</span>
				</div>
			</div>
		</div><!-- .sina-progressbars -->
		<?php
	}
}