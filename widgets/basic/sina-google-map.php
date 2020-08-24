<?php

/**
 * Google Map Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Google_Map_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_google_map';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Google Map', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-google-maps';
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
		return [ 'sina map', 'sina google map', 'sina world map' ];
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
			'sina-google-map',
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
		// Start Map Content
		// =====================
		$this->start_controls_section(
			'map_content',
			[
				'label' => esc_html__( 'Map', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'map_api_url',
			[
				'label' => esc_html__( 'If you would like to change the API key', 'sina-ext' ).' <a target="_blank" href="admin.php?page=sina_ext_settings">click here</a>',
				'type' => Controls_Manager::RAW_HTML,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'lat',
			[
				'label' => esc_html__( 'Latitude', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => '23.810332',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'long',
			[
				'label' => esc_html__( 'Longitude', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => '90.412518',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'zoom',
			[
				'label' => esc_html__( 'Zoom', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => '1',
				'default' => '12',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'anim',
			[
				'label' => esc_html__( 'Animation', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'DROP' => esc_html__( 'Drop', 'sina-ext' ),
					'BOUNCE' => esc_html__( 'Bounce', 'sina-ext' ),
				],
				'default' => 'BOUNCE',
			]
		);
		$this->add_control(
			'marker',
			[
				'label' => esc_html__( 'Marker', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'custom_marker',
			[
				'label' => esc_html__( 'Choose Marker', 'sina-ext' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => SINA_EXT_URL .'assets/img/marker.png',
				],
				'condition' => [
					'marker!' => '',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->end_controls_section();
		// End Map Content
		// =====================


		// Start Map Style
		// =====================
		$this->start_controls_section(
			'map_style',
			[
				'label' => esc_html__( 'Map', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'map_height',
			[
				'label' => esc_html__( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
					'em' => [
						'max' => 50,
					],
				],
				'default' => [
					'size' => '400',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-google-map' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'map_tabs' );

		$this->start_controls_tab(
			'map_normal',
			[
				'label' => esc_html__( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'map_filters',
				'selector' => '{{WRAPPER}} .sina-google-map',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'map_hover',
			[
				'label' => esc_html__( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'map_filters_hover',
				'selector' => '{{WRAPPER}} .sina-google-map:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hover_transition',
			[
				'label' => esc_html__( 'Transition Duration', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0.5,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-google-map' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_section();
		// End Map Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div id="sina-google-map-<?php echo esc_attr( $this->get_id() ); ?>" class="sina-google-map"
		data-id="sina-google-map-<?php echo esc_attr( $this->get_id() ); ?>"
		data-anim="<?php echo esc_attr( $data['anim'] ) ?>"
		data-zoom="<?php echo esc_attr( $data['zoom'] ) ?>"
		data-lat="<?php echo esc_attr( $data['lat'] ) ?>"
		data-long="<?php echo esc_attr( $data['long'] ) ?>"
		data-marker="<?php echo esc_attr( $data['marker'] ) ?>"
		data-marker-link="<?php echo esc_attr( $data['custom_marker']['url'] ) ?>">
		</div><!-- .sina-google-map -->
		<?php
	}


	protected function _content_template() {
		?>
		<# var id = view.getID(); #>
		<div id="sina-google-map-{{{id}}}" class="sina-google-map"
		data-id="sina-google-map-{{{id}}}"
		data-anim="{{{settings.anim}}}"
		data-zoom="{{{settings.zoom}}}"
		data-lat="{{{settings.lat}}}"
		data-long="{{{settings.long}}}"
		data-marker="{{{settings.marker}}}"
		data-marker-link="{{{settings.custom_marker.url}}}">
		</div><!-- .sina-google-map -->
		<?php
	}
}