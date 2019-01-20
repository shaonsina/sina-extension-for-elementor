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


		$this->end_controls_section();
		// End Tab Content
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-posts-tab">
			<div class="sina-pt-btns">
				<button class="sina-pt-btn sina-pt-parent-btn sina-button" data-filter="#all">All</button>
				<button class="sina-pt-btn sina-pt-parent-btn sina-button" data-filter="#one">One</button>
				<button class="sina-pt-btn sina-pt-parent-btn sina-button" data-filter="#two">Two</button>
			</div>

			<div class="sina-pt-content">
				<div class="sina-pt-item active" id="all">
					<div class="sina-pt-content sina-pt-content-right">
						<div class="sina-pt-btns">
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#blog1">Blog1</button>
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#blog2">Blog2</button>
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#blog3">Blog3</button>
						</div>

						<div class="sina-pt-content-content">
							<div class="sina-pt-item active" id="blog1">
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="blog2">
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="blog3">
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="sina-pt-item" id="one">
					<div class="sina-pt-content sina-pt-content-right">
						<div class="sina-pt-btns">
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#item1">Item1</button>
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#item2">Item2</button>
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#item3">Item3</button>
						</div>

						<div class="sina-pt-content-content">
							<div class="sina-pt-item active" id="item1">
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="item2">
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="item3">
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="sina-pt-item" id="two">
					<div class="sina-pt-content sina-pt-content-right">
						<div class="sina-pt-btns">
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#post1">Post1</button>
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#post2">Post2</button>
							<button class="sina-pt-btn sina-pt-child-btn sina-button" data-filter="#post3">Post3</button>
						</div>

						<div class="sina-pt-content-content">
							<div class="sina-pt-item active" id="post1">
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
								<p>This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph. This is first tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="post2">
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
								<p>This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph. This is second tab's paragraph.</p>
							</div>
							<div class="sina-pt-item" id="post3">
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
								<p>This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph. This is third tab's paragraph.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .sina-posts-tab -->
		<?php
	}


	protected function _content_template() {

	}
}