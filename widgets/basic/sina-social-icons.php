<?php
/**
 * Social Icons Widget.
 *
 * @since 2.3.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Social_Icons_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.3.0
	 */
	public function get_name() {
		return 'sina_social_icons';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.3.0
	 */
	public function get_title() {
		return __( 'Sina Social Icons', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.3.0
	 */
	public function get_icon() {
		return 'eicon-social-icons';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.3.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.3.0
	 */
	public function get_keywords() {
		return [ 'sina social icons', 'sina icons', 'sina socials' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.3.0
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
	 * @since 2.3.0
	 */
	protected function _register_controls() {
		// Start Social Icons
		// ===================
		$this->start_controls_section(
			'social_content',
			[
				'label' => __( 'Social Icons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-facebook',
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => __( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
			]
		);
		$repeater->add_control(
			'social_name',
			[
				'label' => __( 'Name', 'sina-ext' ),
				'description' => __( 'This name will be show in the item header', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Facebook',
			]
		);

		$repeater->start_controls_tabs( 'icon_tabs' );

		$repeater->start_controls_tab(
			'icon_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$repeater->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a i' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'icon_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a i' => 'background: {{VALUE}};',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a i',
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a i',
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'icon_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$repeater->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a i:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$repeater->add_control(
			'icon_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#055394',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a i:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$repeater->add_control(
			'icon_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} a i:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_hover_shadow',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a i:hover',
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'social_icons',
			[
				'label' => __( 'Add Social Icon', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon' => 'fa fa-facebook',
						'link' => [
							'url' => 'https://facebook.com',
						],
						'social_name' => 'Facebook',
					],
					[
						'icon' => 'fa fa-twitter',
						'link' => [
							'url' => 'https://twitter.com',
						],
						'social_name' => 'Twitter',
					],
					[
						'icon' => 'fa fa-linkedin',
						'link' => [
							'url' => 'https://linkedin.com',
						],
						'social_name' => 'Linkedin',
					],
				],
				'title_field' => '{{{ social_name }}}',
			]
		);

		$this->end_controls_section();
		// End Social Icons
		// =================


		// Start Social Icons
		// ===================
		$this->start_controls_section(
			'social_style',
			[
				'label' => __( 'Social Icons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'display',
			[
				'label' => __( 'Display', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'inline-block' => __( 'Inline', 'sina-ext' ),
					'block' => __( 'Block', 'sina-ext' ),
				],
				'default' => 'inline-block',
				'selectors' => [
					'{{WRAPPER}} .sina-social li' => 'display: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'font_size',
			[
				'label' => __( 'Font Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '14',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-social li i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-social li i' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'font_line_height',
			[
				'label' => __( 'Line Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'default' => [
					'unit' => 'px',
					'size' => '40',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-social li i' => 'line-height: {{SIZE}}{{UNIT}};',
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-social li i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-social li a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
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
					'{{WRAPPER}} .sina-social' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Social Icons
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-social-icons">
			<ul class="sina-social">
				<?php
					foreach ($data['social_icons'] as $index => $icon):
					?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $icon[ '_id' ] ); ?>">
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
		</div><!-- .sina-social-icons -->
		<?php
	}


	protected function _content_template() {

	}
}