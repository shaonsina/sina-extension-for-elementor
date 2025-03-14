<?php

/**
 * Breadcrumbs Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Breadcrumbs_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'Sina_breadcrumbs';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Breadcrumbs', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-arrow-right';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina breadcrumbs' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_style_depends() {
		return [
			'sina-widgets',
		];
	}

	public function get_icon_list() {
		return [
			'fa fa-angle-double-left' => 'angle-double-left',
			'fa fa-angle-double-right' => 'angle-double-right',
			'fa fa-angle-left' => 'angle-left',
			'fa fa-angle-right' => 'angle-right',
			'fa fa-arrow-left' => 'arrow-left',
			'fa fa-arrow-right' => 'arrow-right',
			'fa fa-caret-left' => 'caret-left',
			'fa fa-caret-right' => 'caret-right',
			'fa fa-chevron-left' => 'chevron-left',
			'fa fa-chevron-right' => 'chevron-right',

			'eicon-chevron-left' => 'eicon-chevron-left',
			'eicon-chevron-right' => 'eicon-chevron-right',
			'eicon-angle-left' => 'eicon-angle-left',
			'eicon-angle-right' => 'eicon-angle-right',
			'eicon-arrow-left' => 'eicon-arrow-left',
			'eicon-arrow-right' => 'eicon-arrow-right',
			'eicon-caret-left' => 'eicon-caret-left',
			'eicon-caret-right' => 'eicon-caret-right',
			'eicon-chevron-double-left' => 'eicon-chevron-double-left',
			'eicon-chevron-double-right' => 'eicon-chevron-double-right',
			'eicon-long-arrow-left' => 'eicon-long-arrow-left',
			'eicon-long-arrow-right' => 'eicon-long-arrow-right',
		];
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 3.7.0
	 */
	protected function register_controls() {
		// Start Breadcrumbs Content
		// ==========================
			$this->start_controls_section(
				'breadcrumbs_content',
				[
					'label' => esc_html__( 'Breadcrumbs', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'home',
					[
						'label' => esc_html__( 'Show Home', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'home_text',
					[
						'label' => esc_html__( 'Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'condition' => [
							'home' => 'yes',
						],
						'default' => 'Home',
					]
				);
				$this->add_control(
					'separator',
					[
						'label' => esc_html__( 'Separator', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'icon' => esc_html__( 'Icon', 'sina-ext' ),
							'text' => esc_html__( 'Text', 'sina-ext' ),
						],
						'default' => 'icon',
					]
				);
				$this->add_control(
					'separator_icon',
					[
						'label' => esc_html__( 'Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $this->get_icon_list(),
						'condition' => [
							'separator' => 'icon',
						],
						'default' => 'eicon-arrow-right',
					]
				);
				$this->add_control(
					'separator_text',
					[
						'label' => esc_html__( 'Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXT,
						'condition' => [
							'separator' => 'text',
						],
						'default' => '»',
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
						'selectors' => [
							'{{WRAPPER}} .sina-breadcrumbs' => 'text-align: {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Breadcrumbs Content
		// ========================


		// Start Link Style
		// =================
			$this->start_controls_section(
				'link_style',
				[
					'label' => esc_html__( 'Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-breadcrumbs a', 'link', '{{WRAPPER}} .sina-breadcrumbs a' );
			$this->end_controls_section();
		// End Link Style
		// ===============

		// Start Separator Style
		// ========================
			$this->start_controls_section(
				'separator_style',
				[
					'label' => esc_html__( 'Separator', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' => 'separator_typography',
						'selector' => '{{WRAPPER}} .sina-breadcrumb-separator',
					]
				);
				$this->add_control(
					'separator_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'default' => '#222',
						'selectors' => [
							'{{WRAPPER}} .sina-breadcrumb-separator' => 'color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();
		// End Separator Style
		// ======================

		// Start Current Style
		// ====================
			$this->start_controls_section(
				'current_style',
				[
					'label' => esc_html__( 'Current', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::breadcrumb( $this, '{{WRAPPER}} .sina-breadcrumb-current', 'current' );
			$this->end_controls_section();
		// End Current Style
		// ==================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$output = '<ul class="sina-breadcrumbs">';
		$breadcrumbs = [];

		if ( 'yes' == $data['home'] ) {
			$breadcrumbs[] = [
				'title' => $data['home_text'],
				'url' => esc_url( home_url() ),
				'class' => 'sina-breadcrumbs-link',
			];
		}

		if ( !is_front_page() ) {
			if ( is_home() && 'yes' == $data['home'] ) {
				$breadcrumbs[] = [
					'title' => get_the_title( get_option('page_for_posts') ),
					'url' => '',
					'class' => '',
				];
			} elseif ( is_single() ) {
				$category = get_the_category();
				if ( $category ) {
					$parent_cats = get_ancestors( $category[0]->term_id, 'category' );
					$parent_cats = array_reverse( $parent_cats );

					foreach ( $parent_cats as $cat_id ) {
						$cat = get_category( $cat_id );
						$breadcrumbs[] = [
							'title' => $cat->name,
							'url' => esc_url( get_category_link($cat_id) ),
							'class' => '',
						];
					}

					$breadcrumbs[] = [
						'title' => $category[0]->name,
						'url' => esc_url( get_category_link( $category[0]->term_id ) ),
						'class' => '',
					];
				}

				$breadcrumbs[] = [
					'title' => get_the_title(),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_page() && !is_front_page() ) {
				$parents = get_post_ancestors( get_the_ID() );

				foreach ( array_reverse($parents) as $parent ) {
					$breadcrumbs[] = [
						'title' => get_the_title( $parent ),
						'url' => esc_url( get_permalink($parent) ),
						'class' => '',
					];
				}

				$breadcrumbs[] = [
					'title' => get_the_title(),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_category() ) {
				$breadcrumbs[] = [
					'title' => single_cat_title( '', false ),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_tag() ) {
				$breadcrumbs[] = [
					'title' => single_tag_title( '', false ),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_author() ) {
				$breadcrumbs[] = [
					'title' => get_the_author(),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_search() ) {
				$breadcrumbs[] = [
					'title' => esc_html__( 'Search results for: ', 'sina-ext' ).get_search_query(),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_404() ) {
				$breadcrumbs[] = [
					'title' => esc_html__( '404 not found', 'sina-ext' ),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			} elseif ( is_archive() ) {
				$breadcrumbs[] = [
					'title' => post_type_archive_title( '', false ),
					'url' => '',
					'class' => 'sina-breadcrumb-current',
				];
			}
		}

		foreach ( $breadcrumbs as $index => $breadcrumb ) {
			$output .= '<li class="' . esc_attr($breadcrumb['class']) . '">';

			if ( 'yes' == $data['home'] && 0 == $index ) {
				$output .= '<i class="fa fa-home"></i>';
			}

			if ( $breadcrumb['url'] ) {
				$output .= '<a href="'.esc_url($breadcrumb['url']).'"><span>'.wp_kses_post($breadcrumb['title']).'</span></a>';
			} else {
				$output .= '<span>'.wp_kses_post($breadcrumb['title']).'</span>';
			}
			$output .= '</li>';

			if ( $index < count($breadcrumbs) - 1 ) {
				$output .= '<li class="sina-breadcrumb-separator">';

				if ( 'icon' == $data['separator'] ) {
					$output .= '<i class="'.$data['separator_icon'].'"></i>';
				} else {
					$output .= $data['separator_text'];
				}
				$output .= '</li>';
			}
		}
		$output .= '</ul>';
		
		echo $output;
	}


	protected function content_template() {

	}
}
