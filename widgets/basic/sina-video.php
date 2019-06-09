<?php

/**
 * Video Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Video_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_video';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Video', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-video-camera ';
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
		return [ 'sina video', 'sina media', 'sina youtube' ];
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
	        'magnific-popup',
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
	        'magnific-popup',
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
		// Start Video Content
		// =====================
		$this->start_controls_section(
			'video_content',
			[
				'label' => __( 'Video', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'video_link',
			[
				'label' => __( 'Video Link', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter video link', 'sina-ext' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Title', 'sina-ext' ),
				'default' => 'Watch video',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-play',
			]
		);

		$this->end_controls_section();
		// End Video Content
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
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-video-title' => 'color: {{VALUE}};',
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
					'text_transform' => [
						'default' => 'capitalize',
					],
				],
				'selector' => '{{WRAPPER}} .sina-video-title',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .sina-video-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '30',
					'right' => '0',
					'bottom' => '0',
					'left' => '0',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'label' => __( 'Icon', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_tabs' );

		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#eee',
					],
				],
				'selector' => '{{WRAPPER}} .sina-video-play',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-video-play' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .sina-video-play',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sina-video-play',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hover_background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-video-play:hover',
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-video-play:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_hover_shadow',
				'selector' => '{{WRAPPER}} .sina-video-play:hover',
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-video-play:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'font_size',
			[
				'label' => __( 'Font Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '32',
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-video-play' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'font_line_height',
			[
				'label' => __( 'Line Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-play' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'unit' => '%',
					'top' => '50',
					'right' => '50',
					'bottom' => '50',
					'left' => '50',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-video-play' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		$this->add_render_attribute( 'title', 'class', 'sina-video-title' );
		$this->add_inline_editing_attributes( 'title' );
		?>
		<div class="sina-video">
			<?php if ( $data['icon'] ): ?>
				<a class="sina-video-play" href="<?php echo esc_url( $data['video_link'] ); ?>">
					<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
				</a>
			<?php endif ?>

			<?php if ( $data['title'] ): ?>
				<h4 <?php echo $this->get_render_attribute_string( 'title' ); ?>>
					<?php echo esc_html( $data['title'] ); ?>
				</h4>
			<?php endif ?>
		</div><!-- .sina-video -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'title', 'class', 'sina-video-title' );
		view.addInlineEditingAttributes( 'title' );
		#>
		<div class="sina-video">
			<# if ( settings.icon ) { #>
				<a class="sina-video-play" href="{{{settings.video_link}}}">
					<i class="{{{settings.icon}}}"></i>
				</a>
			<# } #>

			<# if ( settings.title ) { #>
				<h4 {{{ view.getRenderAttributeString( 'title' ) }}}>
					{{{settings.title}}}
				</h4>
			<# } #>
		</div>
		<?php
	}
}