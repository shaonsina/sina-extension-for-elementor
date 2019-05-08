<?php
/**
 * Transform Widget.
 *
 * @since 2.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Frontend;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Transform_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.1.0
	 */
	public function get_name() {
		return 'sina_transform';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.0
	 */
	public function get_title() {
		return __( 'Sina Transform', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.0
	 */
	public function get_icon() {
		return 'eicon-exchange';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.1.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 */
	public function get_keywords() {
		return [ 'sina transform', 'sina content transform', 'content transform' ];
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
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 2.1.0
	 */
	protected function _register_controls() {
		// Start Transform Content
		// =========================
		$this->start_controls_section(
			'transform_content',
			[
				'label' => __( 'Transform Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'save_templates',
			[
				'label' => __( 'Use Save Templates', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'template',
			[
				'label' => __( 'Choose Template', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => sina_get_page_templates(),
				'condition' => [
					'save_templates!' => '',
				],
				'description' => __('NOTE: Don\'t try to edit after insertion template. If you need to change the style or layout then you try to change the main template then save and then insert', 'sina-ext'),
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'save_templates' => '',
				],
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
				],
			]
		);

		$this->end_controls_section();
		// End Transform Content
		// =======================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		// fw_print( $data );
		?>
		<div class="sina-transform">
			<?php
				if ( 'yes' == $data['save_templates'] && $data['template'] ) :
					$frontend = new Frontend;
					echo $frontend->get_builder_content( $data['template'], true );
				elseif ( $data['image']['url'] ) :
					?>
					<img class="sina-transform-img" src="<?php echo esc_url( $data['image']['url'] ); ?>">
			<?php endif; ?>
		</div><!-- .sina-transform -->
		<?php
	}


	protected function _content_template() {

	}
}