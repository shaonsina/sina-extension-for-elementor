<?php

/**
 * Posts Tab Widget.
 *
 * @since 1.2.0
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

class Sina_Posts_Tab_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.2.0
	 */
	public function get_name() {
		return 'sina_posts_tab';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.2.0
	 */
	public function get_title() {
		return __( 'Sina Posts Tab', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.2.0
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.2.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.2.0
	 */
	public function get_keywords() {
		return [ 'sina posts tab', 'sina tab' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.2.0
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
	 * @since 1.2.0
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
	 * @since 1.2.0
	 */
	protected function _register_controls() {
		// Start Tab Content
		// ===================
		$this->start_controls_section(
			'tab_content',
			[
				'label' => __( 'Tab Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'multi-tab',
			[
				'label' => __( 'Multi-tab', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();
		// End Tab Content
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-posts-tab">
			<div class="sina-pt-btns">
				<button class="sina-pt-btn sina-button" data-filter="#all">All</button>
				<button class="sina-pt-btn sina-button" data-filter="#fine">Fine</button>
				<button class="sina-pt-btn sina-button" data-filter="#nice">Nice</button>
			</div>

			<div class="sina-pt-content">
				<div class="sina-pt-item" id="all">
					<div class="sina-pt-content">
						<div class="sina-pt-btns">
							<button class="sina-pt-btn sina-button" data-filter="#najifa">Najifa</button>
							<button class="sina-pt-btn sina-button" data-filter="#nabila">Nabila</button>
							<button class="sina-pt-btn sina-button" data-filter="#dalim">Dalim</button>
						</div>

						<div class="sina-pt-content-content">
							<div class="sina-pt-item active" id="najifa">
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="nabila">
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="dalim">
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="sina-pt-item active" id="fine">
					<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
				</div>
				<div class="sina-pt-item" id="nice">
					<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
				</div>
			</div>
		</div><!-- .sina-posts-tab -->
		<?php
	}


	protected function _content_template() {

	}
}