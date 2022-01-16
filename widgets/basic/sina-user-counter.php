<?php

/**
 * User Counter Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_User_Counter_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_user_counter';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina User Counter', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-number-field';
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
		return [ 'sina user counter', 'sina counter' ];
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
	protected function register_controls() {
		// Start User Counter
		// ====================
		$this->start_controls_section(
			'uc_content',
			[
				'label' => esc_html__( 'User Counter', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'roles',
			[
				'label' => esc_html__( 'Select Roles', 'sina-ext' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_user_roles(),
			]
		);
		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Prefix Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter prefix text', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'default' => 'Already registered',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Suffix Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter suffix text', 'sina-ext' ),
				'description' => esc_html__( 'You can use HTML.', 'sina-ext' ),
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_responsive_control(
			'display',
			[
				'label' => esc_html__( 'Display', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'block' => esc_html__( 'Block', 'sina-ext' ),
					'inline-block' => esc_html__( 'Inline', 'sina-ext' ),
				],
				'default' => 'block',
				'selectors' => [
					'{{WRAPPER}} .sina-uc-number, {{WRAPPER}} .sina-uc-text' => 'display: {{VALUE}};',
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
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .sina-user-counter' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End User Counter
		// =================


		// Start Text Style
		// ============================
		$this->start_controls_section(
			'text_style',
			[
				'label' => esc_html__( 'Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-uc-text' => 'color: {{VALUE}};',
				],
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
				],
				'selector' => '{{WRAPPER}} .sina-uc-text',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .sina-uc-text',
			]
		);

		$this->end_controls_section();
		// End Text Style
		// ===========================


		// Start Number Style
		// ============================
		$this->start_controls_section(
			'number_style',
			[
				'label' => esc_html__( 'Number', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-uc-number' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
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
				],
				'selector' => '{{WRAPPER}} .sina-uc-number',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'number_shadow',
				'selector' => '{{WRAPPER}} .sina-uc-number',
			]
		);
		$this->add_responsive_control(
			'number_margin',
			[
				'label' => esc_html__( 'Margin', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-uc-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Number Style
		// ===========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$roles = count_users();
		$roles = $roles['avail_roles'];
		$data_roles = '';

		$count = 0;

		if ( !empty($data['roles']) ) {
			foreach ($data['roles'] as $role) {
				$count += isset($roles[$role]) ? $roles[$role] : 0;
			}
			$data_roles = implode(',', $data['roles']);
		}

		$this->add_render_attribute( 'prefix', 'class', 'sina-uc-text' );
		$this->add_inline_editing_attributes( 'prefix' );

		$this->add_render_attribute( 'suffix', 'class', 'sina-uc-text' );
		$this->add_inline_editing_attributes( 'suffix' );
		?>
		<div class="sina-user-counter"
		data-roles="<?php echo esc_attr( $data_roles ); ?>">
			<?php wp_nonce_field( 'sina_user_counter', 'sina_user_counter_nonce' ); ?>
			<?php if ( $data['prefix'] ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'prefix' ); ?>><?php printf( $data['prefix'] ); ?></h3>
			<?php endif; ?>
			<span class="sina-uc-number"><?php printf( '%s', $count ); ?></span>
			<?php if ( $data['suffix'] ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'suffix' ); ?>><?php printf( $data['suffix'] ); ?></h3>
			<?php endif; ?>
		</div><!-- .sina-user-counter -->
		<?php
	}


	protected function content_template() {

	}
}