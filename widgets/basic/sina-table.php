<?php
/**
 * Table Widget.
 *
 * @since 2.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Table_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 2.1.0
	 */
	public function get_name() {
		return 'sina_table';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.0
	 */
	public function get_title() {
		return __( 'Sina Table', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.0
	 */
	public function get_icon() {
		return 'eicon-table';
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
		return [ 'sina table', 'data table' ];
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
		// Start Table Header
		// ====================
		$this->start_controls_section(
			'table_header',
			[
				'label' => __( 'Table Header', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$thead = new Repeater();

		$thead->add_control(
			'header_text',
			[
				'label' => __( 'Header Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => __('Enter Text', 'sina-ext'),
				'default' => __('WordPress', 'sina-ext'),
			]
		);
		$this->add_control(
			'header_content',
			[
				'label' => __('Add Item', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $thead->get_controls(),
				'prevent_empty' => false,
				'default' => [
					[
						'header_text' => __('WordPress', 'sina-ext'),
					],
				],
				'title_field' => '{{{ header_text }}}',
			]
		);

		$this->end_controls_section();
		// End Table Header
		// ==================

		// Start Table Body
		// ====================
		$this->start_controls_section(
			'table_body',
			[
				'label' => __( 'Table Body', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$tbody = new Repeater();

		$tbody->add_control(
			'content_type',
			[
				'label' => __( 'Content Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'row' => __( 'Row', 'sina-ext' ),
					'cell' => __( 'Cell', 'sina-ext' ),
					'head' => __( 'Head', 'sina-ext' ),
				],
				'default' => 'row',
			]
		);

		$tbody->add_control(
			'row_span',
			[
				'label' => __( 'Row Span', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 1,
				'condition' => [
					'content_type' => ['cell', 'head'],
				],
			]
		);
		$tbody->add_control(
			'col_span',
			[
				'label' => __( 'Column Span', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
				'min' => 1,
				'condition' => [
					'content_type' => ['cell', 'head'],
				],
			]
		);
		$this->add_control(
			'body_content',
			[
				'label' => __('Add Item', 'sina-ext'),
				'type' => Controls_Manager::REPEATER,
				'fields' => $tbody->get_controls(),
				'default' => [
					[
						'row_span' => __('1', 'sina-ext'),
						'col_span' => __('1', 'sina-ext'),
					],
				],
				'title_field' => '{{{ content_type }}}',
			]
		);

		$this->end_controls_section();
		// End Table Body
		// ==================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-table">
			<table>
				<caption>List of users</caption>
				<thead>
					<tr>
						<th>fine</th>
						<th>fine</th>
						<th>fine</th>
						<th>fine</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>nice</th>
						<td>nice</td>
						<td>nice</td>
						<td>nice</td>
						<td>nice</td>
					</tr>
					<tr>
						<th>nice</th>
						<td>nice</td>
						<td>nice</td>
						<td>nice</td>
						<td>nice</td>
					</tr>
				</tbody>
			</table>
		</div><!-- .sina-table -->
		<?php
	}


	protected function _content_template() {

	}
}