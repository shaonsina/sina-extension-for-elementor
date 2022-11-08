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
			'sina-google-map-styles',
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
	protected function register_controls() {
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
			'gmap_style',
			[
				'label' => esc_html__( 'Select Style', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style1' => esc_html__( 'Style1', 'sina-ext' ),
					'style2' => esc_html__( 'Style2', 'sina-ext' ),
					'style3' => esc_html__( 'Style3', 'sina-ext' ),
					'style4' => esc_html__( 'Style4', 'sina-ext' ),
					'style5' => esc_html__( 'Style5', 'sina-ext' ),
					'style6' => esc_html__( 'Style6', 'sina-ext' ),
					'style7' => esc_html__( 'Style7', 'sina-ext' ),
					'style8' => esc_html__( 'Style8', 'sina-ext' ),
					'style9' => esc_html__( 'Style9', 'sina-ext' ),
					'style10' => esc_html__( 'Style10', 'sina-ext' ),
					'style11' => esc_html__( 'Style11', 'sina-ext' ),
					'style12' => esc_html__( 'Style12', 'sina-ext' ),
					'style13' => esc_html__( 'Style13', 'sina-ext' ),
					'style14' => esc_html__( 'Style14', 'sina-ext' ),
					'style15' => esc_html__( 'Style15', 'sina-ext' ),
					'style16' => esc_html__( 'Style16', 'sina-ext' ),
					'style17' => esc_html__( 'Style17', 'sina-ext' ),
					'style18' => esc_html__( 'Style18', 'sina-ext' ),
					'style19' => esc_html__( 'Style19', 'sina-ext' ),
					'style20' => esc_html__( 'Style20', 'sina-ext' ),
					'style21' => esc_html__( 'Style21', 'sina-ext' ),
				],
				'default' => 'style1',
			]
		);
		$this->add_control(
			'default_ui',
			[
				'label' => esc_html__( 'Default UI', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'zoom_control',
			[
				'label' => esc_html__( 'Zoom Control', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'zoom_control_position',
			[
				'label' => esc_html__( 'Zoom Control Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'LEFT_TOP' => esc_html__( 'Left Top', 'sina-ext' ),
					'LEFT_CENTER' => esc_html__( 'Left Center', 'sina-ext' ),
					'LEFT_BOTTOM' => esc_html__( 'Left Bottom', 'sina-ext' ),
					'RIGHT_TOP' => esc_html__( 'Right Top', 'sina-ext' ),
					'RIGHT_CENTER' => esc_html__( 'Right Center', 'sina-ext' ),
					'RIGHT_BOTTOM' => esc_html__( 'Right Bottom', 'sina-ext' ),
					'TOP_LEFT' => esc_html__( 'Top Left', 'sina-ext' ),
					'TOP_CENTER' => esc_html__( 'Top Center', 'sina-ext' ),
					'TOP_RIGHT' => esc_html__( 'Top Right', 'sina-ext' ),
					'BOTTOM_LEFT' => esc_html__( 'Bottom Left', 'sina-ext' ),
					'BOTTOM_CENTER' => esc_html__( 'Bottom Center', 'sina-ext' ),
					'BOTTOM_RIGHT' => esc_html__( 'Bottom Right', 'sina-ext' ),
				],
				'default' => 'LEFT_BOTTOM',
				'condition' => [
					'zoom_control' => 'yes',
				],
			]
		);
		$this->add_control(
			'street_control',
			[
				'label' => esc_html__( 'Street View', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'street_control_position',
			[
				'label' => esc_html__( 'Street View Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'LEFT_TOP' => esc_html__( 'Left Top', 'sina-ext' ),
					'LEFT_CENTER' => esc_html__( 'Left Center', 'sina-ext' ),
					'LEFT_BOTTOM' => esc_html__( 'Left Bottom', 'sina-ext' ),
					'RIGHT_TOP' => esc_html__( 'Right Top', 'sina-ext' ),
					'RIGHT_CENTER' => esc_html__( 'Right Center', 'sina-ext' ),
					'RIGHT_BOTTOM' => esc_html__( 'Right Bottom', 'sina-ext' ),
					'TOP_LEFT' => esc_html__( 'Top Left', 'sina-ext' ),
					'TOP_CENTER' => esc_html__( 'Top Center', 'sina-ext' ),
					'TOP_RIGHT' => esc_html__( 'Top Right', 'sina-ext' ),
					'BOTTOM_LEFT' => esc_html__( 'Bottom Left', 'sina-ext' ),
					'BOTTOM_CENTER' => esc_html__( 'Bottom Center', 'sina-ext' ),
					'BOTTOM_RIGHT' => esc_html__( 'Bottom Right', 'sina-ext' ),
				],
				'default' => 'LEFT_BOTTOM',
				'condition' => [
					'street_control' => 'yes',
				],
			]
		);
		$this->add_control(
			'fullscreen_control',
			[
				'label' => esc_html__( 'Fullscreen', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'fullscreen_control_position',
			[
				'label' => esc_html__( 'Fullscreen Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'LEFT_TOP' => esc_html__( 'Left Top', 'sina-ext' ),
					'LEFT_CENTER' => esc_html__( 'Left Center', 'sina-ext' ),
					'LEFT_BOTTOM' => esc_html__( 'Left Bottom', 'sina-ext' ),
					'RIGHT_TOP' => esc_html__( 'Right Top', 'sina-ext' ),
					'RIGHT_CENTER' => esc_html__( 'Right Center', 'sina-ext' ),
					'RIGHT_BOTTOM' => esc_html__( 'Right Bottom', 'sina-ext' ),
					'TOP_LEFT' => esc_html__( 'Top Left', 'sina-ext' ),
					'TOP_CENTER' => esc_html__( 'Top Center', 'sina-ext' ),
					'TOP_RIGHT' => esc_html__( 'Top Right', 'sina-ext' ),
					'BOTTOM_LEFT' => esc_html__( 'Bottom Left', 'sina-ext' ),
					'BOTTOM_CENTER' => esc_html__( 'Bottom Center', 'sina-ext' ),
					'BOTTOM_RIGHT' => esc_html__( 'Bottom Right', 'sina-ext' ),
				],
				'default' => 'RIGHT_TOP',
				'condition' => [
					'fullscreen_control' => 'yes',
				],
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
		$custom_marker = isset($data['custom_marker']['url']) ? $data['custom_marker']['url'] : '';
		?>
		<div id="sina-google-map-<?php echo esc_attr( $this->get_id() ); ?>" class="sina-google-map"
		data-id="sina-google-map-<?php echo esc_attr( $this->get_id() ); ?>"
		data-anim="<?php echo esc_attr( $data['anim'] ) ?>"
		data-zoom="<?php echo esc_attr( $data['zoom'] ) ?>"
		data-lat="<?php echo esc_attr( $data['lat'] ) ?>"
		data-long="<?php echo esc_attr( $data['long'] ) ?>"
		data-defaultui="<?php echo esc_attr( $data['default_ui'] ) ?>"
		data-zoom-control="<?php echo esc_attr( $data['zoom_control'] ) ?>"
		data-zoom-position="<?php echo esc_attr( $data['zoom_control_position'] ) ?>"
		data-street-control="<?php echo esc_attr( $data['street_control'] ) ?>"
		data-street-position="<?php echo esc_attr( $data['street_control_position'] ) ?>"
		data-fullscreen-control="<?php echo esc_attr( $data['fullscreen_control'] ) ?>"
		data-fullscreen-position="<?php echo esc_attr( $data['fullscreen_control_position'] ) ?>"
		data-map-style="<?php echo esc_attr( $data['gmap_style'] ) ?>"
		data-marker="<?php echo esc_attr( $data['marker'] ) ?>"
		data-marker-link="<?php echo esc_attr( $custom_marker ) ?>">
		</div><!-- .sina-google-map -->
		<?php
	}


	protected function content_template() {
		?>
		<# var id = view.getID(); #>
		<div id="sina-google-map-{{{id}}}" class="sina-google-map"
		data-id="sina-google-map-{{{id}}}"
		data-anim="{{{settings.anim}}}"
		data-zoom="{{{settings.zoom}}}"
		data-lat="{{{settings.lat}}}"
		data-long="{{{settings.long}}}"
		data-defaultui="{{{settings.default_ui}}}"
		data-zoom-control="{{{settings.zoom_control}}}"
		data-zoom-position="{{{settings.zoom_control_position}}}"
		data-street-control="{{{settings.street_control}}}"
		data-street-position="{{{settings.street_control_position}}}"
		data-fullscreen-control="{{{settings.fullscreen_control}}}"
		data-fullscreen-position="{{{settings.fullscreen_control_position}}}"
		data-map-style="{{{settings.gmap_style}}}"
		data-marker="{{{settings.marker}}}"
		data-marker-link="{{{settings.custom_marker.url}}}">
		</div><!-- .sina-google-map -->
		<?php
	}
}