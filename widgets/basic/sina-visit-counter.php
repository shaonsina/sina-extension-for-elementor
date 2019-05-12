<?php

/**
 * Visit Counter Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Visit_Counter_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_visit_counter';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Visit Counter', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'fa fa-eye';
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
		return [ 'sina visit counter', 'sina visitor counter', 'visitor', 'sina' ];
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
		// Start Visit Counter
		// ====================
		$this->start_controls_section(
			'vc_content',
			[
				'label' => __( 'Visitor Count', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'today',
			[
				'label' => __( 'Today Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter text', 'sina-ext' ),
				'default' => __( 'Today\'s visit', 'sina-ext' ),
			]
		);
		$this->add_control(
			'yesterday',
			[
				'label' => __( 'Yesterday Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter text', 'sina-ext' ),
				'default' => __( 'Yesterday\'s visit', 'sina-ext' ),
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
					'{{WRAPPER}} .sina-visit-counter' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		// End Visit Counter
		// ===================


		// Start Text Style
		// ============================
		$this->start_controls_section(
			'text_style',
			[
				'label' => __( 'Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-visit-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
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
				'selector' => '{{WRAPPER}} .sina-visit-text',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'shadow',
				'selector' => '{{WRAPPER}} .sina-visit-text',
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
				'label' => __( 'Number', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-visit-number' => 'color: {{VALUE}};',
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
							'size' => '32',
						],
					],
					'line_height'   => [
						'default' => [
							'size' => '40',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-visit-number',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'number_shadow',
				'selector' => '{{WRAPPER}} .sina-visit-number',
			]
		);

		$this->end_controls_section();
		// End Number Style
		// ===========================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$page_id = get_the_ID();
		$today = date( "Y-m-d" );

		$visit_data = get_post_meta( $page_id, 'sina_visit_counter', true);

		if ( !Plugin::instance()->editor->is_edit_mode() ) {
			if ( isset( $visit_data['sina_visit_date'] ) ) {
				$diff = date_diff( date_create( $today ), date_create( $visit_data['sina_visit_date'] ) );

				if ( 0 == $diff->days ) {
					$visit_data['sina_visit_today']++;
				} else {
					if ( 1 == $diff->days ) {
						$visit_data['sina_visit_yesterday'] = $visit_data['sina_visit_today'];
					} else{
						$visit_data['sina_visit_yesterday'] = 0;
					}
					$visit_today = 1;
					$visit_data['sina_visit_today'] = $visit_today;
					$visit_data['sina_visit_date'] = $today;
				}
				update_post_meta( $page_id, 'sina_visit_counter', $visit_data);

			} else{
				$visit_info = [
					'sina_visit_today' => 0,
					'sina_visit_yesterday' => 0,
					'sina_visit_date' => $today,
				];
				add_post_meta( $page_id, 'sina_visit_counter', $visit_info );
			}
		}

		$this->add_render_attribute( 'today', 'class', 'sina-visit-text' );
		$this->add_inline_editing_attributes( 'today' );

		$this->add_render_attribute( 'yesterday', 'class', 'sina-visit-text' );
		$this->add_inline_editing_attributes( 'yesterday' );
		?>
		<div class="sina-visit-counter" data-page="<?php echo esc_attr( $page_id ); ?>">
			<?php wp_nonce_field( 'sina_visit_counter', 'sina_visit_counter_nonce' ); ?>
			<?php if ( $data['yesterday'] ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'yesterday' ); ?>><?php echo esc_html( $data['yesterday'] ); ?></h3>
					<span class="sina-visit-number sina-visit-yesterday">
					<?php
						if ( isset($visit_data['sina_visit_yesterday']) ) :
							echo esc_html( $visit_data['sina_visit_yesterday'] );
						endif;
					?>
					</span>
			<?php endif; ?>

			<?php if ( $data['today'] ): ?>
				<h3 <?php echo $this->get_render_attribute_string( 'today' ); ?>><?php echo esc_html( $data['today'] ); ?></h3>
					<span class="sina-visit-number sina-visit-today">
						<?php
							if ( isset($visit_data['sina_visit_today']) ) :
								echo esc_html( $visit_data['sina_visit_today'] );
							endif;
						?>
					</span>
			<?php endif; ?>
		</div><!-- .sina-visit-counter -->
		<?php
	}


	protected function _content_template() {

	}
}