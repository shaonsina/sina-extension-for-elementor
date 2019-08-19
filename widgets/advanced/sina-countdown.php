<?php

/**
 * Countdown Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Countdown_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_countdown';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Countdown', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-clock-o';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.0.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'sina countdown', 'sina count down', 'sina timer' ];
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
			'countdown',
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
		// Start Countdown Content
		// =====================
		$this->start_controls_section(
			'countdown_content',
			[
				'label' => __( 'Countdown', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'countdown_time',
			[
				'label'	=> __( 'Due Date', 'sina-ext' ),
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'format' => 'Ym/d H:m:s'
				],
				'default' => date( "Y/m/d H:m:s", strtotime("+ 1 Day") ),
			]
		);
		$this->add_control(
			'units',
			[
				'label' => __( 'Time Units', 'sina-ext' ),
				'type' => Controls_Manager::SELECT2,
				'options' => [
					'year' => __( 'Years', 'sina-ext' ),
					'month' => __( 'Month', 'sina-ext' ),
					'week' => __( 'Week', 'sina-ext' ),
					'day' => __( 'Day', 'sina-ext' ),
					'hour' => __( 'Hours', 'sina-ext' ),
					'minute' => __( 'Minutes', 'sina-ext' ),
					'second' => __( 'Second', 'sina-ext' ),
				],
				'default' => [
					'day',
					'hour',
					'minute',
					'second',
				],
				'multiple' => true,
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
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .sina-countdown' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_state',
			[
				'label' => __( 'Text', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'action',
			[
				'label' => __('Action', 'sina-ext'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text' => __('Message', 'sina-ext'),
					'url' => __('Redirection Link', 'sina-ext')
				],
				'description' => __('Choose whether if you want to set a message or a redirect link', 'sina-ext'),
				'default'		=> 'text'
			]
		);
		$this->add_control(
			'message',
			[
				'label'	=> __('Message', 'sina-ext'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => 'Countdown is finished!',
				'condition' => [
					'action' => 'text'
				]
			]
		);
		$this->add_control(
			'redirect',
			[
				'label'	=> __('Redirect To', 'sina-ext'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => [
					'action' => 'url'
				],
				'default' => get_permalink( 1 )
			]
		);

		$this->end_controls_section();
		// End Countdown Content
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

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '100',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '110',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-cd',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sina-cd',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sina-cd',
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '6',
					'right' => '6',
					'bottom' => '6',
					'left' => '6',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '6',
					'right' => '6',
					'bottom' => '6',
					'left' => '6',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Box Style
		// =====================


		// Start Digit Style
		// =====================
		$this->start_controls_section(
			'digit_style',
			[
				'label' => __( 'Digit', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'digit_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'digit_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '50',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '60',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-cd',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'digit_shadow',
				'selector' => '{{WRAPPER}} .sina-cd',
			]
		);

		$this->end_controls_section();
		// End Digit Style
		// =====================


		// Start Text Style
		// =====================
		$this->start_controls_section(
			'text_style',
			[
				'label' => __( 'Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'text_state!' => ''
				]
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'{{WRAPPER}} .sina-cd .sina-cd-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
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
				'selector' => '{{WRAPPER}} .sina-cd .sina-cd-text',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .sina-cd .sina-cd-text',
			]
		);

		$this->end_controls_section();
		// End Text Style
		// =====================


		// Start Message Style
		// =====================
		$this->start_controls_section(
			'message_style',
			[
				'label' => __( 'Message', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'message_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-cd-message' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'message_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '32',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '40',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-cd-message',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'message_shadow',
				'selector' => '{{WRAPPER}} .sina-cd-message',
			]
		);

		$this->end_controls_section();
		// End Message Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-countdown"
		data-time="<?php echo esc_attr( $data['countdown_time'] ); ?>"
		data-text="<?php echo esc_attr( $data['text_state'] ); ?>"
		data-link="<?php echo esc_attr( $data['redirect'] ); ?>"
		data-message="<?php echo esc_attr( $data['message'] ); ?>">
			<?php
			if( date_timestamp_get( date_create( $data['countdown_time'] ) ) > time() ) :
				foreach ($data['units'] as $value) :
				?>
					<div class="sina-cd">
						<div class="sina-cd-<?php echo esc_attr($value); ?>">00</div>
						<?php if ( 'yes' == $data['text_state'] ) : ?>
							<div class="sina-cd-text">
								<?php printf( '%s', ucfirst($value) ); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php
				endforeach;
			endif;
			?>
		</div><!-- .sina-countdown -->
		<?php
	}


	protected function _content_template() {

	}
}