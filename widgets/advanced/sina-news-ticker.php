<?php

/**
 * News Ticker Widget.
 *
 * @since 1.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_News_Ticker_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.1.0
	 */
	public function get_name() {
		return 'sina_news_ticker';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.1.0
	 */
	public function get_title() {
		return __( 'Sina News Ticker', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.1.0
	 */
	public function get_icon() {
		return 'fa fa-text-width';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 1.1.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.1.0
	 */
	public function get_keywords() {
		return [ 'sina news ticker', 'sina posts ticker', 'sina post', 'sina blog post', 'sina news scroll', 'sina posts scroll' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 1.1.0
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
	 * @since 1.1.0
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
	 * @since 1.1.0
	 */
	protected function _register_controls() {
		// Start Ticker Content
		// =====================
		$this->start_controls_section(
			'ticker_content',
			[
				'label' => __( 'Ticker Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'categories',
			[
				'label' => esc_html__( 'Categories', 'sina-ext' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => sina_get_categories(),        
			]
		);
		Sina_Common_Data::posts_content($this);
		$this->end_controls_section();
		// End Ticker Content
		// ===================


		// Start Ticker Settings
		// ======================
		$this->start_controls_section(
			'ticker_settings',
			[
				'label' => __( 'Ticker Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'label_text',
			[
				'label' => __( 'Label Text', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Latest News',
			]
		);
		$this->add_control(
			'label_position',
			[
				'label' => __( 'Label Position', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' =>[
					'left' => __( 'Left', 'sina-ext' ),
					'right' => __( 'Right', 'sina-ext' ),
					'both' => __( 'Both', 'sina-ext' ),
				],
				'condition' => [
					'label_text!' => '',
				],
				'default' => 'both',
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause On Hover', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'show_time',
			[
				'label' => __( 'Time', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Scroll Speed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'default' => 15,
			]
		);

		$this->end_controls_section();
		// End Ticker Settings
		// ====================


		// Start Label Style
		// =====================
		$this->start_controls_section(
			'label_style',
			[
				'label' => __( 'Label', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size' => [
						'default' => [
							'size' => '16',
						],
					],
					'line_height' => [
						'default' => [
							'size' => '24',
						],
					],
					'text_transform' => [
						'default' => 'uppercase',
					],
				],
				'selector' => '{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'label_shadow',
				'selector' => '{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'label_BG',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label',
			]
		);
		$this->add_responsive_control(
			'label_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'label_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '15',
					'right' => '20',
					'bottom' => '15',
					'left' => '20',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End label Style
		// =================


		// Start Headline Style
		// =====================
		$this->start_controls_section(
			'headline_style',
			[
				'label' => __( 'Headline', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'headline_tabs' );

		$this->start_controls_tab(
			'headline_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);
		$this->add_control(
			'headline_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .sina-news a' => 'color: {{VALUE}}'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'headline_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);
		$this->add_control(
			'headline_hover_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .sina-news a:hover, {{WRAPPER}} .sina-news a:focus' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'headline_typography',
				'fields_options' => [
					'typography' => [ 
						'default' =>'custom', 
					],
					'font_size'   => [
						'default' => [
							'size' => '14',
						],
					],
				],
				'selector' => '{{WRAPPER}} .sina-news a',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'headline_shadow',
				'selector' => '{{WRAPPER}} .sina-news a',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'headline_BG',
				'label' => __( 'Background', 'sina-ext' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [
					'background' => [ 
						'default' =>'classic', 
					],
					'color' => [
						'default' => '#f8f8f8',
					],
				],
				'selector' => '{{WRAPPER}} .sina-news-ticker',
			]
		);
		$this->add_responsive_control(
			'headline_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-news-ticker' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'headline_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
					'top' => '18',
					'right' => '18',
					'bottom' => '18',
					'left' => '18',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .sina-news a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Headline Style
		// ====================


		// Start Time Style
		// =====================
		$this->start_controls_section(
			'time_style',
			[
				'label' => __( 'Time', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_time' => 'yes',
				],
			]
		);

		$this->add_control(
			'time_color',
			[
				'label' => __( 'Text Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-news a span' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'time_typography',
				'selector' => '{{WRAPPER}} .sina-news a span',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'time_shadow',
				'selector' => '{{WRAPPER}} .sina-news a span',
			]
		);

		$this->end_controls_section();
		// End Time Style
		// ================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} else if ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;
		}

		$new_offset = $data['offset'] + ( ( $paged - 1 ) * $data['posts_num'] );
		$category	= !empty($data['categories']) ? implode( ',', $data['categories'] ) : '';
		$default	= [
			'category_name'		=> $category,
			'orderby'			=> [ $data['order_by'] => $data['sort'] ],
			'posts_per_page'	=> $data['posts_num'],
			'paged'				=> $paged,
			'offset'			=> $new_offset,
			'has_password'		=> false,
			'post_status'		=> 'publish',
			'post__not_in'		=> get_option( 'sticky_posts' ),
		];
		// Post Query
		$post_query = new WP_Query( $default );
		?>
		<div class="sina-news-ticker"
		data-pause="<?php echo esc_attr( $data['pause_on_hover'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>">
			<?php if ( $data['label_text'] && ('left' == $data['label_position'] || 'both' == $data['label_position']) ): ?>
				<div class="sina-nt-left-label"><?php printf( '%s', $data['label_text'] ); ?></div>
			<?php endif; ?>

			<div class="sina-news-wrapper">
				<div class="sina-news-container">
					<div class="sina-news-content">
						<?php if ( $post_query->have_posts() ) : ?>
							<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
								<div class="sina-news">
									<a href="<?php the_permalink(); ?>">
										<?php if( 'yes' == $data['show_time'] ): ?>
											<span><?php the_time(); ?></span>
										<?php endif; ?>
										<?php the_title(); ?>
									</a>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
						<?php else: ?>
							<div class="sina-news">
								<a><?php _e($data['label_text']. ' not published yet', 'sina-ext'); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<?php if ( $data['label_text'] && 'both' == $data['label_position'] ): ?>
				<div class="sina-nt-right-label sina-nt-label-both"><?php printf( '%s', $data['label_text'] ); ?></div>
			<?php elseif ( $data['label_text'] && 'right' == $data['label_position'] ): ?>
				<div class="sina-nt-right-label"><?php printf( '%s', $data['label_text'] ); ?></div>
			<?php endif ?>
		</div><!-- .sina-news-ticker -->
		<?php
	}


	protected function _content_template() {

	}
}