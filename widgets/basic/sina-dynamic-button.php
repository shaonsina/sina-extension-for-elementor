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
			'btn_type',
			[
				'label' => __( 'Button Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'static' => __( 'Static', 'sina-ext' ),
					'page' => __( 'Page', 'sina-ext' ),
					'taxonomy' => __( 'Taxonomy', 'sina-ext' ),
				],
				'default' => 'static',
			]
		);
		$this->add_control(
			'btn_page',
			[
				'label' => __( 'Select Page', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_lists(),
				'condition' => [
					'btn_type' => 'page',
				]
			]
		);
		$taxonomy_lists = sina_get_taxonomy_lists();
		$this->add_control(
			'btn_taxonomy',
			[
				'label' => __( 'Select Taxonomy', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => $taxonomy_lists,
				'default' => 'category',
				'condition' => [
					'btn_type' => 'taxonomy',
				]
			]
		);
		foreach ( $taxonomy_lists as $tax_name => $tax_val) {
			$this->add_control(
				'btn_'.$tax_name,
				[
					'label' => __( 'Select '.$tax_val, 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'options' => sina_get_term_lists($tax_name),
					'condition' => [
						'btn_type' => 'taxonomy',
						'btn_taxonomy' => $tax_name,
					]
				]
			);
		}
		$this->add_control(
			'btn_text',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Label', 'sina-ext' ),
				'default' => 'Click Here',
				'condition' => [
					'btn_type' => 'static',
				]
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
				'condition' => [
					'btn_type' => 'static',
				]
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
					'{{WRAPPER}} .sina-dynamic-btn .sina-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sina-dynamic-btn .sina-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'css_id',
			[
				'label' => __( 'CSS ID', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter ID', 'sina-ext' ),
				'description' => __( 'Make sure this ID unique', 'sina-ext' ),
				'condition' => [
					'btn_type' => 'static',
				]
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
		Sina_Common_Data::button_style( $this, '.sina-dynamic-btn' );
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => true,
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-dynamic-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '12',
					'right' => '25',
					'bottom' => '12',
					'left' => '25',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-dynamic-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selectors' => [
					'{{WRAPPER}} .sina-dynamic-button' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Button Style
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$btn_text = $data['btn_text'];
		if ( 'page' == $data['btn_type'] ) {
			$btn_text = get_the_title( $data['btn_page'] );
			$btn_link = get_page_link( $data['btn_page'] );
		} elseif ( 'taxonomy' == $data['btn_type'] && $data['btn_'.$data['btn_taxonomy']] ) {
			$term_id = (int)$data['btn_'.$data['btn_taxonomy']];
			$btn_text = get_term( $term_id )->name;
			$btn_link = get_term_link( $term_id );
		} else{
			$btn_link = $data['btn_link']['url'];
		}
		?>
		<div class="sina-dynamic-button">
			<a  class="sina-dynamic-btn" href="<?php echo esc_url( $btn_link ); ?>"
				<?php if ( $data['css_id'] ): ?>
					id="<?php echo esc_attr( $data['css_id'] ); ?>"
				<?php endif; ?>
				<?php if ('static' == $data['btn_type'] && 'on' == $data['btn_link']['is_external']): ?>
					target="_blank" 
				<?php endif; ?>
				<?php if ('static' == $data['btn_type'] && 'on' == $data['btn_link']['nofollow']): ?>
					rel="nofollow" 
				<?php endif; ?>>
				<?php if ( $data['btn_icon'] && $data['btn_icon_align'] == 'left' ): ?>
					<i class="<?php echo esc_attr($data['btn_icon']); ?> sina-icon-left"></i>
				<?php endif; ?>
				<?php printf('%s', $btn_text); ?>
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