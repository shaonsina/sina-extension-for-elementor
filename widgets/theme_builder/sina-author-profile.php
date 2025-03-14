<?php

/**
 * Author Profile Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Author_Profile_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_author_profile';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Author Profile', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-theme-builder' ];
	}

	public function show_in_panel() {
		return Sina_Common_Data::widget_show_in_panel(['single', 'archive']);
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina author profile', 'sina author box', 'sina theme builder' ];
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
		// Start Author Profile
		// =====================
			$this->start_controls_section(
				'author_profile_content',
				[
					'label' => esc_html__( 'Author Profile', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

			$this->add_control(
				'note',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( 'NOTICE: The Author Profile will be visible on Frontend correctly.', 'sina-ext' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				]
			);

			$repeater = new Repeater();
			$repeater->add_control(
				'content',
				[
					'label' => esc_html__( 'Select Content', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'avatar' => esc_html__( 'Avatar', 'sina-ext' ),
						'name' => esc_html__( 'Name', 'sina-ext' ),
						'bio' => esc_html__( 'Bio', 'sina-ext' ),
						'website' => esc_html__( 'Website Link', 'sina-ext' ),
					],
					'default' => 'date',
				]
			);
			$repeater->add_control(
				'html_tag',
				[
					'label' => esc_html__( 'HTML Tag', 'sina-ext' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
					],
					'condition' => [
						'content' => 'name',
					],
					'default' => 'h3',
				]
			);
			$this->add_control(
				'author_content',
				[
					'label' => esc_html__( 'Author Content', 'sina-ext' ),
					'type' => Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'content' => 'avatar',
						],
						[
							'content' => 'name',
						],
						[
							'content' => 'bio',
						],
					],
					'title_field' => '{{{ content }}}',
				]
			);
			$this->add_responsive_control(
				'alignment',
				[
					'label' => esc_html__( 'Alignment', 'sina-ext' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'sina-ext' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'sina-ext' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'sina-ext' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'default' => 'center',
					'selectors' => [
						'{{WRAPPER}} .sina-author-profile' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->end_controls_section();
		// End Author Profile
		// ===================


		// Start Avatar Style
		// ===================
			$this->start_controls_section(
				'avatar_style',
				[
					'label' => esc_html__( 'Avatar', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::post_avatar( $this, '{{WRAPPER}} .sina-author-profile .avatar', 'avatar', 60 );
			$this->end_controls_section();
		// End Avatar Style
		// =================

		// Start Author Name Style
		// ========================
			$place = get_post_meta( get_the_ID(), 'sina-ext-template-meta_type', true );
			$this->start_controls_section(
				'name_style',
				[
					'label' => esc_html__( 'Name', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			if ('archive' == $place) {
				Sina_Common_Data::site_info( $this, '{{WRAPPER}} .sina-ap-name', 'name', true );
			} else{
				Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-ap-name a', 'name' );
			}
			$this->end_controls_section();
		// End Author Name Style
		// ======================

		// Start Author Bio Style
		// =======================
			$this->start_controls_section(
				'bio_style',
				[
					'label' => esc_html__( 'Bio', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::breadcrumb( $this, '{{WRAPPER}} .sina-ap-desc', 'desc' );
			$this->add_responsive_control(
				'desc_alignment',
				[
					'label' => esc_html__( 'Alignment', 'sina-ext' ),
					'type' => Controls_Manager::CHOOSE,
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'sina-ext' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'sina-ext' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'sina-ext' ),
							'icon' => 'eicon-text-align-right',
						],
						'justify' => [
							'title' => esc_html__( 'Justify', 'sina-ext' ),
							'icon' => 'eicon-text-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .sina-ap-desc' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->end_controls_section();
		// End Author Bio Style
		// =====================

		// Start Website Link Style
		// =========================
			$this->start_controls_section(
				'website_link_style',
				[
					'label' => esc_html__( 'Website Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-ap-website', 'website_link' );
			$this->end_controls_section();
		// End Website Link Style
		// =======================
	}


	protected function render() {
		// Sina_Common_Data::switch_to_last_post(); //Not used
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-author-profile">
			<?php
			$author_id = get_the_author_meta( "ID" );
			foreach ($data['author_content'] as $key => $value):
				switch ($value['content']):
					case 'avatar':
						echo get_avatar( $author_id, $data['avatar_size']['size'] );
						break;
					case 'name':
						$f_name = get_the_author_meta('first_name');
						$l_name = get_the_author_meta('last_name');
						$d_name = get_the_author_meta('display_name');
						$name 	= ($f_name || $l_name) ? $f_name .' '. $l_name : $d_name;
						if ( is_archive() ):
							printf( '<%1$s class="sina-ap-name">%2$s</%1$s>', sina_ext_escape_tags($value['html_tag']), esc_html($name) );
						else:
							printf( '<%1$s class="sina-ap-name"><a href="%2$s">%3$s</a></%1$s>', sina_ext_escape_tags($value['html_tag']), get_author_posts_url($author_id), esc_html($name) );
						endif;
						break;
					case 'bio':
						$desc = get_the_author_meta('description');
						printf( '<div class="sina-ap-desc">%1$s</div>', $desc );
						break;
					case 'website':
						$url = get_the_author_meta('url');
						printf( '<a class="sina-ap-website" href="%1$s">%2$s</a>', esc_url($url), esc_html__('Website', 'sina-ext') );
						break;
				endswitch;
			endforeach;
			?>
		</div><!-- .sina-author-profile -->
		<?php
	}


	protected function content_template() {

	}
}