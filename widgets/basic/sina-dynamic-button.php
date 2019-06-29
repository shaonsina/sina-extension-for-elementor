<?php

/**
 * Dynamic Button Widget.
 *
 * @since 2.3.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Dynamic_Button_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.3.0
	 */
	public function get_name() {
		return 'sina_dynamic_button';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.3.0
	 */
	public function get_title() {
		return __( 'Sina Dynamic Button', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.3.0
	 */
	public function get_icon() {
		return 'eicon-button';
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
		return [ 'sina button', 'sina gradient button', 'sina dynamic button', 'sina advance button' ];
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
		// Start Buttons Content
		// ======================
		$this->start_controls_section(
			'button_content',
			[
				'label' => __( 'Button Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'default' => 'Click Here',
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => __( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
				'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
			]
		);
		$this->add_control(
			'btn_icon',
			[
				'label' => __( 'Icon', 'sina-ext' ),
				'type' => Controls_Manager::ICON,
			]
		);
		$this->add_control(
			'btn_icon_align',
			[
				'label' => __( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => __( 'Left', 'sina-ext' ),
					'right' => __( 'Right', 'sina-ext' ),
				],
				'default' => 'left',
				'condition' => [
					'btn_icon!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_space',
			[
				'label' => __( 'Icon Spacing', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => '5',
				],
				'condition' => [
					'btn_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-dbtn .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-dbtn .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Content
		// ===================


		// Start Button Style
		// ===================
		$this->start_controls_section(
			'button_style',
			[
				'label' => __( 'Button Style', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sina-gb',
			]
		);

		$this->end_controls_section();
		// End Button Style
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-dynamic-button">
			<a href="<?php echo esc_url( $data['btn_link'] ); ?>" class="sina-dbtn">
				<?php if ( $data['btn_icon'] && $data['btn_icon_align'] == 'left' ): ?>
					<i class="<?php echo esc_attr($data['btn_icon']); ?> sina-icon-left"></i>
				<?php endif; ?>
				<?php printf('%s', $data['btn_text']); ?>
				<?php if ( $data['btn_icon'] && $data['btn_icon_align'] == 'right' ): ?>
					<i class="<?php echo esc_attr($data['btn_icon']); ?> sina-icon-right"></i>
				<?php endif; ?>
			</a>
		</div><!-- .sina-dynamic-button -->
		<?php
	}


	protected function _content_template() {

	}
}