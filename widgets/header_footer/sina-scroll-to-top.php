<?php

/**
 * Scroll to Top Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Scroll_To_Top_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_scroll_to_top';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Scroll Top', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-arrow-up';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-header-footer' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina scroll to top', 'sina scroll top', 'sina header', 'sina footer' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_script_depends() {
		return [
			'sina-widgets',
		];
	}

	public function get_icon_list() {
		return [
			'fa fa-angle-double-up' => 'angle-double-up',
			'fa fa-angle-up' => 'angle-up',
			'fa fa-arrow-up' => 'arrow-up',
			'fa fa-chevron-up' => 'chevron-up',
			'eicon-arrow-up' => 'eicon-arrow-up',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.7.0
	 * @access protected
	 */
	protected function register_controls() {
		$selector = '{{WRAPPER}} .sina-scroll-top';
		// Start Scroll Top
		// =================
			$this->start_controls_section(
				'scroll_top_content',
				[
					'label' => esc_html__( 'Scroll to Top', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'scroll_icon',
					[
						'label' => esc_html__( 'Select Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_icon_list(),
						'default' => 'eicon-arrow-up',
					]
				);
				$this->add_control(
					'position',
					[
						'label' => esc_html__( 'Position', 'sina-ext' ),
						'type' => Controls_Manager::CHOOSE,
						'options' => [
							'left' => [
								'title' => esc_html__( 'Left', 'sina-ext' ),
								'icon' => 'eicon-h-align-left',
							],
							'right' => [
								'title' => esc_html__( 'Right', 'sina-ext' ),
								'icon' => 'eicon-h-align-right',
							],
						],
						'default' => 'right',
					]
				);
				$this->add_control(
					'bottom_spacing',
					[
						'label' => esc_html__( 'Bottom Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 30,
						],
						'selectors' => [
							$selector => 'bottom: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'horizontal_spacing',
					[
						'label' => esc_html__( 'Left/Right Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em', '%' ],
						'range' => [
							'px' => [
								'max' => 500,
							],
							'em' => [
								'max' => 50,
							],
						],
						'default' => [
							'unit' => 'px',
							'size' => 30,
						],
						'selectors' => [
							$selector => '{{position.VALUE || "right"}}: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_control(
					'z_index',
					[
						'label' => esc_html__( 'Z-Index', 'sina-ext' ),
						'type' => Controls_Manager::NUMBER,
						'default' => 9999,
						'step' => -1,
						'min' => 1,
						'max' => 999999,
						'selectors' => [
							$selector => 'z-index: {{SIZE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Scroll Top
		// ===============


		// Start Scroll Top Style
		// =======================
			$this->start_controls_section(
				'scroll_top_style',
				[
					'label' => esc_html__( 'Scroll Top', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::icon_style( $this, $selector, 'scroll_top_icon' );
			$this->end_controls_section();
		// End Scroll Top Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-scroll-top sina-fixed">
			<?php if ($data['scroll_icon']): ?>				
				<i class="<?php echo esc_attr( $data['scroll_icon'] ); ?>"></i>
			<?php endif ?>
		</div><!-- .sina-scroll-top -->
		<?php
	}


	protected function content_template() {

	}
}