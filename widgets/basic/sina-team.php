<?php

/**
 * Team Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Team_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_team';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Team', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-group';
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
		return [ 'sina team', 'sina member' ];
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
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Team Content
		// =====================
		$this->start_controls_section(
			'team_content',
			[
				'label' => __( 'Member', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'effects',
			[
				'label' => __( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-team-move' => __( 'Move', 'sina-ext' ),
					'sina-team-zoom' => __( 'Zoom', 'sina-ext' ),
					'sina-team-zoom sina-team-move' => __( 'Move & Zoom', 'sina-ext' ),
					'' => __( 'None', 'sina-ext' ),
				],
				'default' => 'sina-team-move',
			]
		);
		$this->add_control(
			'name',
			[
				'label' => __( 'Name', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Name', 'sina-ext' ),
				'default' => __( 'Jhon Doe', 'sina-ext' ),
			]
		);
		$this->add_control(
			'position',
			[
				'label' => __( 'Position', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Position', 'sina-ext' ),
				'default' => __( 'CEO', 'sina-ext' ),
			]
		);
		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'sina-ext' ),
				'lable_block' => true,
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Description', 'sina-ext' ),
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, autem amet. Labore eos cum at, et illo ducimus.', 'sina-ext' ),
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/team.jpg',
				],
			]
		);
		$this->add_control(
			'social_icons',
			[
				'label' => __( 'Add Social Icon', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'icon',
						'label' => __( 'Icon', 'sina-ext' ),
						'type' => Controls_Manager::ICON,
						'default' => 'fa fa-facebook',
					],
					[
						'name' => 'link',
						'label' => __( 'Link', 'sina-ext' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
					],
					[
						'name' => 'social_name',
						'label' => __( 'Name', 'sina-ext' ),
						'description' => __( 'This name will be show in the item header', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Facebook', 'sina-ext' ),
					],
				],
				'default' => [
					[
						'icon' => 'fa fa-facebook',
						'link' => [
							'url' => 'https://facebook.com',
						],
						'social_name' => __( 'Facebook', 'sina-ext' ),
					],
					[
						'name' => 'fa fa-twitter',
						'link' => [
							'url' => 'https://twitter.com',
						],
						'social_name' => __( 'Twitter', 'sina-ext' ),
					],
					[
						'name' => 'fa fa-linkedin',
						'link' => [
							'url' => 'https://linkedin.com',
						],
						'social_name' => __( 'Linkedin', 'sina-ext' ),
					],
				],
				'title_field' => '{{{ social_name }}}',
			]
		);


		$this->end_controls_section();
		// End Team Content
		// =====================


		// Start Box Style
		// =====================
		$this->start_controls_section(
			'box_style',
			[
				'label' => __( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-team',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Overlay Style
		// =====================
		$this->start_controls_section(
			'overlay_style',
			[
				'label' => __( 'Overlay', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(31,140,231,0.9)',
				'selectors' => [
					'{{WRAPPER}} .sina-team-overlay' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'overlay_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '60',
					'right' => '20',
					'bottom' => '20',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-team-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Overlay Style
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section(
			'name_style',
			[
				'label' => __( 'Name', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-team-name' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
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
				],
				'selector' => '{{WRAPPER}} .sina-team-name',
			]
		);

		$this->end_controls_section();
		// End Name Style
		// =====================


		// Start Position Style
		// =====================
		$this->start_controls_section(
			'position_style',
			[
				'label' => __( 'Position', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-team-position' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'position_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_weight' => [
						'default' => '600',
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-team-position',
			]
		);

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Description Style
		// =========================
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
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-team-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .sina-team-desc',
			]
		);

		$this->end_controls_section();
		// End Description Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __( 'Social Icon', 'sina-ext' ),
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

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li i' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sina-team-social li i',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li i:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li i:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li i:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-team-social li i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icon Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		if ( $data['image']['url'] ):
			$this->add_render_attribute( 'name', 'class', 'sina-team-name' );
			$this->add_inline_editing_attributes( 'name' );

			$this->add_render_attribute( 'position', 'class', 'sina-team-position' );
			$this->add_inline_editing_attributes( 'position' );

			$this->add_render_attribute( 'desc', 'class', 'sina-team-desc' );
			$this->add_inline_editing_attributes( 'desc' );
			?>
			<div class="sina-team <?php echo esc_attr( $data['effects'] ); ?>">
				<img src="<?php echo esc_url( $data['image']['url'] ); ?>" alt="<?php echo esc_attr( $data['name'] ); ?>">
				<div class="sina-team-overlay sina-overlay">
					<?php if ( $data['name'] ): ?>
						<h5 <?php echo $this->get_render_attribute_string( 'name' ); ?>>
							<?php echo esc_html( $data['name'] ); ?>
						</h5>
					<?php endif; ?>

					<?php if ( $data['position'] ): ?>
						<h6 <?php echo $this->get_render_attribute_string( 'position' ); ?>>
							<?php echo esc_html( $data['position'] ); ?>
						</h6>
					<?php endif; ?>

					<?php if ( $data['desc'] ): ?>
						<div <?php echo $this->get_render_attribute_string( 'desc' ); ?>>
							<?php echo esc_html( $data['desc'] ); ?>
						</div>
					<?php endif; ?>

					<ul class="sina-team-social">
						<?php
							foreach ($data['social_icons'] as $index => $icon):
							?>
							<li>
								<a href="<?php echo esc_url( $icon['link']['url'] ); ?>"
								<?php if ( 'on' == $icon['link']['is_external'] ): ?>
									target="_blank" 
								<?php endif; ?>
								<?php if ( 'on' == $icon['link']['nofollow'] ): ?>
									rel="nofollow" 
								<?php endif; ?>>
									<i class="<?php echo esc_attr( $icon['icon'] ); ?>"></i>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div><!-- .sina-team -->
		<?php
		endif;
	}


	protected function _content_template() {
		?>
		<#
		view.addRenderAttribute( 'name', 'class', 'sina-team-name' );
		view.addInlineEditingAttributes( 'name' );

		view.addRenderAttribute( 'position', 'class', 'sina-team-position' );
		view.addInlineEditingAttributes( 'position' );

		view.addRenderAttribute( 'desc', 'class', 'sina-team-desc' );
		view.addInlineEditingAttributes( 'desc' );
		#>
		<div class="sina-team {{{settings.effects}}}">
			<img src="{{{settings.image.url}}}" alt="{{{settings.name}}}">
			<div class="sina-team-overlay sina-overlay">
				<# if ( settings.name ) { #>
					<h5 {{{ view.getRenderAttributeString( 'name' ) }}}>{{{settings.name}}}</h5>
				<# } #>

				<# if ( settings.position ) { #>
					<h6 {{{ view.getRenderAttributeString( 'position' ) }}}>{{{settings.position}}}</h6>
				<# } #>

				<# if ( settings.desc ) { #>
					<div {{{ view.getRenderAttributeString( 'desc' ) }}}>{{{settings.desc}}}</div>
				<# } #>

				<ul class="sina-team-social">
					<# _.each( settings.social_icons, function( item, index ) { #>
						<li>
							<a href="{{{item.link.url}}}">
								<i class="{{{item.icon}}}"></i>
							</a>
						</li>
					<# }); #>
				</ul>
			</div>
		</div>
		<?php
	}
}