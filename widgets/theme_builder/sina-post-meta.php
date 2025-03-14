<?php

/**
 * Post Meta Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Post_Meta_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_post_meta';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Post Meta', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-meta-data';
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
		return Sina_Common_Data::widget_show_in_panel();
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina post meta', 'sina post data', 'sina post info', 'sina theme builder' ];
	}

	public function get_icon_list() {
		return [
			'fa fa-calendar' => 'calendar',
			'fa fa-calendar-o' => 'calendar-o',
			'fa fa-clock-o' => 'clock-o',
			'fa fa-user' => 'user',
			'fa fa-user-o' => 'user-o',
			'fa fa-user-circle-o' => 'user-circle-o',
			'fa fa-user-circle' => 'user-circle',
			'fa fa-folder' => 'folder',
			'fa fa-folder-o' => 'folder-o',
			'fa fa-folder-open' => 'folder-open',
			'fa fa-folder-open-o' => 'folder-open-o',
			'fa fa-tags' => 'tags',
			'fa fa-comment-o' => 'comment-o',
			'fa fa-comments-o' => 'comments-o',
			'fa fa-comment' => 'comment',
			'fa fa-comments' => 'comments',

			'eicon-calendar' => 'eicon-calendar',
			'eicon-clock' => 'eicon-clock',
			'eicon-clock-o' => 'eicon-clock-o',
			'eicon-user-circle-o' => 'eicon-user-circle-o',
			'eicon-folder-o' => 'eicon-folder-o',
			'eicon-folder' => 'eicon-folder',
			'eicon-tags' => 'eicon-tags',
			'eicon-comments' => 'eicon-comments',
		];
	}

	protected function get_taxonomies() {
		$taxonomies = get_taxonomies(
			[
				'show_in_nav_menus' => true,
			],
			'objects'
		);

		$options = [
			'' => esc_html__( 'Select', 'sina-ext' ),
		];

		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
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
		$icon_list = $this->get_icon_list();
		// Start Post Meta
		// ================
			$this->start_controls_section(
				'post_meta_content',
				[
					'label' => esc_html__( 'Post Meta', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$repeater = new Repeater();
				$repeater->add_control(
					'icon',
					[
						'label' => esc_html__( 'Icon', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::ICON,
						'include' => $icon_list,
						'default' => 'eicon-calendar',
					]
				);
				$repeater->add_control(
					'meta',
					[
						'label' => esc_html__( 'Select Meta', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'date' => esc_html__( 'Date', 'sina-ext' ),
							'time' => esc_html__( 'Time', 'sina-ext' ),
							'author' => esc_html__( 'Author', 'sina-ext' ),
							'terms' => esc_html__( 'Terms', 'sina-ext' ),
							'comments' => esc_html__( 'Comments', 'sina-ext' ),
						],
						'default' => 'date',
					]
				);
				$repeater->add_control(
					'avatar',
					[
						'label' => esc_html__( 'Avatar', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'icon' => '',
							'meta' => 'author',
						],
					]
				);
				$repeater->add_control(
					'taxonomy',
					[
						'label' => esc_html__( 'Taxonomy', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::SELECT2,
						'options' => $this->get_taxonomies(),
						'default' => [],
						'condition' => [
							'meta' => 'terms',
						],
					]
				);
				$this->add_control(
					'meta_content',
					[
						'label' => esc_html__( 'Meta Content', 'sina-ext' ),
						'type' => Controls_Manager::REPEATER,
						'fields' => $repeater->get_controls(),
						'default' => [
							[
								'icon' => 'eicon-calendar',
								'meta' => 'date',
							],
							[
								'icon' => 'eicon-clock-o',
								'meta' => 'time',
							],
							[
								'icon' => 'eicon-user-circle-o',
								'meta' => 'author',
							],
							[
								'icon' => 'eicon-comments',
								'meta' => 'comments',
							],
						],
						'title_field' => '{{{ meta }}}',
					]
				);

			$this->end_controls_section();
		// End Post Meta
		// ==============


		// Start Meta Style
		// =================
			$this->start_controls_section(
				'meta_style',
				[
					'label' => esc_html__( 'Meta', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::post_meta( $this, '{{WRAPPER}} .sina-post-meta li', 'meta' );
			$this->end_controls_section();
		// End Meta Style
		// ===============

		// Start Link Style
		// =================
			$this->start_controls_section(
				'link_style',
				[
					'label' => esc_html__( 'Link', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::link_style( $this, '{{WRAPPER}} .sina-post-meta a', 'link' );
			$this->end_controls_section();
		// End Link Style
		// ===============

		// Start Icon Style
		// =================
			$selector = '{{WRAPPER}} .sina-post-meta i';
			$this->start_controls_section(
				'icon_style',
				[
					'label' => esc_html__( 'Icon', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_control(
					'icon_color',
					[
						'label' => esc_html__( 'Color', 'sina-ext' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							$selector => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'icon_margin',
					[
						'label' => esc_html__( 'Spacing', 'sina-ext' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px', 'em' ],
						'default' => [
							'unit' => 'px',
							'size' => 5,
						],
						'selectors' => [
							$selector => 'margin-right: {{SIZE}}{{UNIT}};',
							'.rtl '.$selector => 'margin-right: auto; margin-left: {{SIZE}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();
		// End Icon Style
		// ===============

		// Start Avatar Style
		// ===================
			$this->start_controls_section(
				'avatar_style',
				[
					'label' => esc_html__( 'Avatar', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
				]
			);
			Sina_Common_Data::post_avatar( $this, '{{WRAPPER}} .sina-post-meta .avatar' );
			$this->end_controls_section();
		// End Avatar Style
		// =================
	}


	protected function render() {
		Sina_Common_Data::switch_to_last_post();
		$data = $this->get_settings_for_display();
		?>
		<ul class="sina-post-meta">
			<?php
			foreach ($data['meta_content'] as $key => $value):
				switch ($value['meta']):
					case 'date':
						?>
						<li>
							<?php if ($value['icon']): ?>
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							<?php endif; ?>
							<?php echo get_the_date(); ?>
						</li>
						<?php
						break;
					case 'time':
						?>
						<li>
							<?php if ($value['icon']): ?>
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							<?php endif; ?>
							<?php the_time(); ?>
						</li>
						<?php
						break;
					case 'author':
						?>
						<li>
							<?php if ($value['icon']): ?>
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							<?php elseif ($value['avatar']): ?>
								<?php echo get_avatar( get_the_author_meta( "ID" ), $data['avatar_size']['size'] ); ?>
							<?php endif; ?>
							<?php the_author_posts_link(); ?>
						</li>
						<?php
						break;
					case 'terms':
						$terms = wp_get_post_terms( get_the_ID(), $value['taxonomy'] );
						$i = 0;
						?>
						<li>
							<?php if ($value['icon']): ?>
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							<?php endif; ?>
							<?php
								foreach ( $terms as $term ):
									$comma = (0 < $i) ? ', ' : '';
									echo $comma.'<a href="'.esc_url( get_term_link($term) ).'">'.esc_html($term->name).'</a>';
									$i++;
								endforeach 
							?>
						</li>
						<?php
						break;
					case 'comments':
						$comments_num = (int) get_comments_number();
						?>
						<li>
							<?php if ($value['icon']): ?>
								<i class="<?php echo esc_attr( $value['icon'] ); ?>"></i>
							<?php endif; ?>
							<?php if ( 0 == $comments_num ): ?>
								<?php echo esc_html__( 'No Comments', 'sina-ext' ) ?>
							<?php elseif ( 1 == $comments_num ): ?>
								<?php echo esc_html__( '1 Comment', 'sina-ext' ) ?>
							<?php else: ?>
								<?php echo esc_html__( $comments_num.' Comments', 'sina-ext' ) ?>
							<?php endif; ?>
						</li>
						<?php
						break;
				endswitch;
			endforeach;
			?>
		</ul><!-- .sina-post-meta -->
		<?php
	}


	protected function content_template() {

	}
}