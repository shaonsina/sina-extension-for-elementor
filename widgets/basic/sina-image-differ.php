<?php
/**
 * Image Differ Widget.
 *
 * @since 3.1.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Image_Differ_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 3.1.0
	 */
	public function get_name() {
		return 'sina_image_differ';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.1.0
	 */
	public function get_title() {
		return __( 'Sina Image Differ', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.1.0
	 */
	public function get_icon() {
		return 'eicon-post-navigation';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.1.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.1.0
	 */
	public function get_keywords() {
		return [ 'sina image differ', 'sina image comparison', 'sina image box' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.1.0
	 */
	public function get_style_depends() {
		return [
			'twentytwenty',
			'sina-widgets',
		];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve the list of scripts the widget belongs to.
	 *
	 * @since 3.1.0
	 */
	public function get_script_depends() {
		return [
			'jquery-event-move',
			'jquery-twentytwenty',
			'sina-widgets',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.1.0
	 */
	protected function _register_controls() {
		// Start Differ Content
		// =====================
		$this->start_controls_section(
			'differ_content',
			[
				'label' => __( 'Differ Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_image',
			[
				'label' => __( 'Before Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/car-original1.jpg',
				],
			]
		);
		$this->add_control(
			'after_image',
			[
				'label' => __( 'After Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/car-original2.jpg',
				],
			]
		);

		$this->end_controls_section();
		// End Differ Content
		// ===================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-image-differ">
			<div class="twentytwenty-container">
				<img src="<?php echo esc_url( $data['before_image']['url'] ); ?>" />
				<img src="<?php echo esc_url( $data['after_image']['url'] ); ?>" />
			</div>
		</div><!-- .sina-image-differ -->
		<?php
	}


	protected function _content_template() {

	}
}