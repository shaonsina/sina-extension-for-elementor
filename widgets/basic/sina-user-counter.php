<?php

/**
 * User Counter Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_User_Counter_Widget extends Widget_Base {

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
		return __( 'Sina User Counter', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-user';
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
		return [ 'sina user counter', 'user', 'sina' ];
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
	protected function _register_controls() {
		// Start User Counter Content
		// ============================
		$this->start_controls_section(
			'uc_content',
			[
				'label' => __( 'User Count', 'sina-ext' ),
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
				'label' => __( 'Prefix Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter prefix text', 'sina-ext' ),
				'default' => __( 'Already registered', 'sina-ext' ),
			]
		);
		$this->add_control(
			'suffix',
			[
				'label' => __( 'Suffix Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter suffix text', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End User Counter Content
		// ==========================


		// Start Prefix & Suffix Style
		// ============================
		$this->start_controls_section(
			'prefix_suffix_style',
			[
				'label' => __( 'Prefix & Suffix Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'sina-ext' ),
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
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .sina-uc-text',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'shadow',
				'selector' => '{{WRAPPER}} .sina-uc-text',
			]
		);

		$this->end_controls_section();
		// End Prefix & Suffix Style
		// ===========================


		// Start Number Style
		// ============================
		$this->start_controls_section(
			'number_style',
			[
				'label' => __( 'Number', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
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
		<div class="sina-user-counter" data-roles="<?php echo esc_attr( $data_roles ); ?>">
			<?php wp_nonce_field( 'sina_user_counter', 'sina_user_counter_nonce' ); ?>
			<?php if ( $data['prefix'] ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'prefix' ); ?>><?php echo esc_html( $data['prefix'] ); ?></h3>
			<?php endif; ?>
			<span class="sina-uc-number"><?php echo esc_html( $count ); ?></span>
			<?php if ( $data['suffix'] ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'suffix' ); ?>><?php echo esc_html( $data['suffix'] ); ?></h3>
			<?php endif; ?>
		</div><!-- .sina-user-counter -->
		<?php
	}


	protected function _content_template() {

	}
}