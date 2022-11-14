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
use \Elementor\Repeater;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Countdown_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Countdown', 'sina-ext' );
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
			'icofont',
			'font-awesome',
			'elementor-icons',
			'sina-morphing-anim',
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
	protected function register_controls() {
		// Start Countdown Content
		// =====================
		$this->start_controls_section(
			'countdown_content',
			[
				'label' => esc_html__( 'Countdown', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'countdown_time',
			[
				'label'	=> esc_html__( 'Due Date', 'sina-ext' ),
				'type' => Controls_Manager::DATE_TIME,
				'picker_options' => [
					'format' => 'Ym/d H:m:s'
				],
				'default' => date( "Y/m/d H:m:s", strtotime("+ 1 Day") ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'unit',
			[
				'label' => esc_html__( 'Select Unit', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'year' => esc_html__( 'Years', 'sina-ext' ),
					'month' => esc_html__( 'Months', 'sina-ext' ),
					'week' => esc_html__( 'Weeks', 'sina-ext' ),
					'day' => esc_html__( 'Days', 'sina-ext' ),
					'hour' => esc_html__( 'Hours', 'sina-ext' ),
					'minute' => esc_html__( 'Minutes', 'sina-ext' ),
					'second' => esc_html__( 'Seconds', 'sina-ext' ),
				],
				'default' => 'day',
			]
		);

		$repeater->add_control(
			'unit_style',
			[
				'label' => esc_html__( 'Styles', 'sina-ext' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'unit_width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'unit_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'unit_digit_color',
			[
				'label' => esc_html__( 'Digit Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'unit_text_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sina-cd{{CURRENT_ITEM}} .sina-cd-text' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'unit_bg',
				'types' => ['classic'],
				'selector' => '{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'unit_shadow',
				'selector' => '{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'unit_border',
				'selector' => '{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}',
			]
		);
		$repeater->add_responsive_control(
			'unit_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'unit_padding',
			[
				'label' => esc_html__( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-cd{{CURRENT_ITEM}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'units',
			[
				'label' => esc_html__('Add Item', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'unit' => 'day',
					],
					[
						'unit' => 'hour',
					],
					[
						'unit' => 'minute',
					],
					[
						'unit' => 'second',
					],
				],
				'title_field' => '{{{ unit }}}',
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
				'label' => esc_html__( 'Text', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'action',
			[
				'label' => esc_html__('Action', 'sina-ext'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'text' => esc_html__('Message', 'sina-ext'),
					'url' => esc_html__('Redirection Link', 'sina-ext')
				],
				'description' => esc_html__('Choose whether if you want to set a message or a redirect link', 'sina-ext'),
				'default'		=> 'text'
			]
		);
		$this->add_control(
			'message',
			[
				'label'	=> esc_html__('Message', 'sina-ext'),
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
				'label'	=> esc_html__('Redirect To', 'sina-ext'),
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
				'label' => esc_html__( 'Box', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		Sina_Common_Data::morphing_animation( $this );

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'sina-ext' ),
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-cd' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
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
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
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
		$this->add_responsive_control(
			'box_radius',
			[
				'label' => esc_html__( 'Radius', 'sina-ext' ),
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
				'label' => esc_html__( 'Padding', 'sina-ext' ),
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
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
				'label' => esc_html__( 'Digit', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'digit_color',
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#fafafa',
					],
				],
				'selector' => '{{WRAPPER}} .sina-cd',
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
				'label' => esc_html__( 'Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'text_state!' => ''
				]
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
		$this->add_responsive_control(
			'text_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-cd .sina-cd-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'label' => esc_html__( 'Message', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'message_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
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
		$morphing_anim_box = ('yes' == $data['is_morphing_anim_icon'] && $data['morphing_pattern']) ? $data['morphing_pattern'] : '';
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
					<div class="sina-cd elementor-repeater-item-<?php echo esc_attr($value['_id'].' '.$morphing_anim_box); ?>">
						<div class="sina-cd-<?php echo esc_attr($value['unit']); ?>">00</div>
						<?php if ( 'yes' == $data['text_state'] ) : ?>
							<div class="sina-cd-text">
								<?php printf( '%s', $value['unit'] ); ?>
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


	protected function content_template() {

	}
}