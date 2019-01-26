<?php

/**
 * News Ticker Widget.
 *
 * @since 1.1.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
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
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 1.1.0
	 */
	public function get_keywords() {
		return [ 'sina news ticker', 'sina ticker', 'sina' ];
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
			'news-ticker',
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
			'posts_num',
			[
				'label' => __( 'Number of Posts', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 1,
				'min' => 2,
				'max' => 50,
				'default' => 10,
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
				'default' => 'both',
			]
		);
		$this->add_control(
			'label_text',
			[
				'label' => __( 'Label Text', 'sina-ext' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Latest News', 'sina-ext' ),
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
			'speed',
			[
				'label' => __( 'Scroll Speed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'default' => 15,
			]
		);

		$this->end_controls_section();
		// End Ticker Content
		// ===================


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
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors' => [
					'{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'label_BG',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-nt-left-label, {{WRAPPER}} .sina-nt-right-label' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
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

		$this->add_control(
			'headline_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#222',
				'selectors' => [
					'{{WRAPPER}} .sina-news a, {{WRAPPER}} .sina-news a:hover, {{WRAPPER}} .sina-news a:focus' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'time_color',
			[
				'label' => __( 'Time Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-news a span' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'headline_BG',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#f8f8f8',
				'selectors' => [
					'{{WRAPPER}} .sina-news-ticker' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'headline_typography',
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
				'selectors' => [
					'{{WRAPPER}} .sina-news a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Headline Style
		// ====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$category	= !empty($data['categories']) ? implode( ',', $data['categories'] ) : '';
		$args = [
			'posts_per_page'	=> $data['posts_num'],
			'cat'				=> $category,
			'has_password'		=> false,
			'post_status'		=> 'publish',
		];
		// Post Query
		$post_query = new WP_Query( $args );
		?>
		<div class="sina-news-ticker"
		data-pause="<?php echo esc_attr( $data['pause_on_hover'] ); ?>"
		data-speed="<?php echo esc_attr( $data['speed'] ); ?>">
			<?php if ( 'left' == $data['label_position'] || 'both' == $data['label_position'] ): ?>
				<div class="sina-nt-left-label"><?php echo esc_html( $data['label_text'] ); ?></div>
			<?php endif; ?>

			<div class="sina-news-wrapper">
				<?php if ( $post_query->have_posts() ) : ?>
					<div class="sina-news-container">
						<div class="sina-news-content">
							<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
								<div class="sina-news">
									<a href="<?php the_permalink(); ?>"><span><?php the_time(); ?></span> <?php the_title(); ?></a>
								</div>
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
						</div>
					</div>
				<?php else: ?>
					<?php _e('News not published yet', 'sina-ext'); ?>
				<?php endif; ?>
			</div>

			<?php if ( 'both' == $data['label_position'] ): ?>
				<div class="sina-nt-right-label sina-nt-label-both"><?php echo esc_html( $data['label_text'] ); ?></div>
			<?php elseif ( 'right' == $data['label_position'] ): ?>
				<div class="sina-nt-right-label"><?php echo esc_html( $data['label_text'] ); ?></div>
			<?php endif ?>
		</div><!-- .sina-news-ticker -->
		<?php
	}


	protected function _content_template() {

	}
}