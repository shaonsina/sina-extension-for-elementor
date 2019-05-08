<?php
/**
 * Posts Carousel Widget.
 *
 * @since 2.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Posts_Carousel_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.1.0
	 */
	public function get_name() {
		return 'sina_posts_carousel';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.0
	 */
	public function get_title() {
		return __( 'Sina Posts Carousel', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.0
	 */
	public function get_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.1.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 */
	public function get_keywords() {
		return [ 'sina posts carousel', 'sina carousel' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 2.1.0
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
	 * @since 2.1.0
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
	 * @since 2.1.0
	 */
	protected function _register_controls() {
		// Start Posts Content
		// ====================
		$this->start_controls_section(
			'posts_content',
			[
				'label' => __( 'Posts Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End Posts Content
		// ==================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-posts-carousel">
		</div><!-- .sina-posts-carousel -->
		<?php
	}


	protected function _content_template() {

	}
}