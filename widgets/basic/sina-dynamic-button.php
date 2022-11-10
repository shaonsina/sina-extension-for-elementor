<?php

/**
 * Dynamic Button Widget.
 *
 * @since 2.3.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Dynamic_Button_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Dynamic Button', 'sina-ext' );
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
			'icofont',
			'font-awesome',
			'elementor-icons',
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
	protected function register_controls() {
		// Start Buttons Content
		// ======================
		$this->start_controls_section(
			'button_content',
			[
				'label' => esc_html__( 'Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'btn_effect',
			[
				'label' => esc_html__( 'Icon Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'sina-ext' ),
					'sina-anim-right-move' => esc_html__( 'Icon Right Move', 'sina-ext' ),
					'sina-anim-right-moving' => esc_html__( 'Icon Right Moving', 'sina-ext' ),
					'sina-anim-right-bouncing' => esc_html__( 'Icon Right Bouncing', 'sina-ext' ),
					'sina-anim-left-move' => esc_html__( 'Icon Left Move', 'sina-ext' ),
					'sina-anim-left-moving' => esc_html__( 'Icon Left Moving', 'sina-ext' ),
					'sina-anim-left-bouncing' => esc_html__( 'Icon Left Bouncing', 'sina-ext' ),
					'sina-anim-zooming' => esc_html__( 'Icon Zooming', 'sina-ext' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'btn_type',
			[
				'label' => esc_html__( 'Button Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'static' => esc_html__( 'Static', 'sina-ext' ),
					'page' => esc_html__( 'Page', 'sina-ext' ),
					'taxonomy' => esc_html__( 'Taxonomy', 'sina-ext' ),
				],
				'default' => 'static',
			]
		);
		$this->add_control(
			'btn_page',
			[
				'label' => esc_html__( 'Select Page', 'sina-ext' ),
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
				'label' => esc_html__( 'Select Taxonomy', 'sina-ext' ),
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
					'label' => esc_html__( 'Select '.$tax_val, 'sina-ext' ),
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
				'label' => esc_html__( 'Label', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Label', 'sina-ext' ),
				'default' => 'Click Here',
				'condition' => [
					'btn_type' => 'static',
				]
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Link', 'sina-ext' ),
				'type' => Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
				'placeholder' => 'https://your-link.com',
				'condition' => [
					'btn_type' => 'static',
				]
			]
		);
		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Icon', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::ICON,
			]
		);
		$this->add_control(
			'btn_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'sina-ext' ),
					'right' => esc_html__( 'Right', 'sina-ext' ),
				],
				'default' => 'right',
				'condition' => [
					'btn_icon!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_space',
			[
				'label' => esc_html__( 'Icon Spacing', 'sina-ext' ),
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
					'.rtl {{WRAPPER}} .sina-dynamic-btn .sina-icon-right' => 'margin-right: {{SIZE}}{{UNIT}}; margin-left: auto;',
					'.rtl {{WRAPPER}} .sina-dynamic-btn .sina-icon-left' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: auto;',
				],
			]
		);
		$this->add_control(
			'css_class',
			[
				'label' => esc_html__( 'CSS CLASS', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter CLASS', 'sina-ext' ),
			]
		);
		$this->add_control(
			'css_id',
			[
				'label' => esc_html__( 'CSS ID', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter ID', 'sina-ext' ),
				'description' => esc_html__( 'Make sure this ID unique', 'sina-ext' ),
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
				'label' => esc_html__( 'Button', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		Sina_Common_Data::button_style( $this, '.sina-dynamic-btn' );
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Min Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-dynamic-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-dynamic-btn, {{WRAPPER}} .sina-dynamic-btn:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-dynamic-button' => 'text-align: {{VALUE}};',
				],
			]
		);
		Sina_Common_Data::BG_hover_effects($this, '.sina-dynamic-btn');

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
		$data['btn_text'] = $btn_text;
		?>
		<div class="sina-dynamic-button">
			<a  class="sina-dynamic-btn <?php echo esc_attr($data['css_class'].' '.$data['btn_effect'].' '.$data['bg_layer_effects']); ?>" href="<?php echo esc_url( $btn_link ); ?>"
				<?php if ( $data['css_id'] ): ?>
					id="<?php echo esc_attr( $data['css_id'] ); ?>"
				<?php endif; ?>
				<?php if ('static' == $data['btn_type'] && 'on' == $data['btn_link']['is_external']): ?>
					target="_blank" 
				<?php endif; ?>
				<?php if ('static' == $data['btn_type'] && 'on' == $data['btn_link']['nofollow']): ?>
					rel="nofollow" 
				<?php endif; ?>>
					<?php Sina_Common_Data::button_html($data); ?>
			</a>
		</div><!-- .sina-dynamic-button -->
		<?php
	}


	protected function content_template() {

	}
}