<?php

/**
 * Portfolio Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Plugin;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Portfolio_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_portfolio';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Portfolio', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
		return [ 'sina portfolio', 'sina work' ];
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
			'magnific-popup',
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
			'magnific-popup',
			'imagesLoaded',
			'isotope',
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
		// Start Portfolio Content
		// ========================
		$this->start_controls_section(
			'portfolio_content',
			[
				'label' => __( 'Portfolio', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'columns',
			[
				'label' => __( 'Number of Column', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pf-item-2' => __( '2', 'sina-ext' ),
					'sina-pf-item-3' => __( '3', 'sina-ext' ),
					'sina-pf-item-4' => __( '4', 'sina-ext' ),
					'sina-pf-item-5' => __( '5', 'sina-ext' ),
					'sina-pf-item-6' => __( '6', 'sina-ext' ),
					'masonry' => __( 'Masonry', 'sina-ext' ),
				],
				'default' => 'sina-pf-item-3',
			]
		);
		$this->add_control(
			'effects',
			[
				'label' => __( 'Effects', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'sina-pf-effect-fade' => __( 'Fade', 'sina-ext' ),
					'sina-pf-effect-zoom' => __( 'Zoom', 'sina-ext' ),
					'sina-pf-effect-move' => __( 'Fade & Buttons Move', 'sina-ext' ),
					'sina-pf-effect-zoom sina-pf-effect-move' => __( 'Zoom & Buttons Move', 'sina-ext' ),
				],
				'default' => 'sina-pf-effect-move',
			]
		);

		$this->add_control(
			'portfolio',
			[
				'label' => __( 'Add Image', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'item_name',
						'label' => __( 'Item Name', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::TEXT,
						'placeholder' => __( 'Enter Item Name', 'sina-ext' ),
						'default' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
					],
					[
						'name' => 'category',
						'label' => __( 'Category', 'sina-ext' ),
						'label_block' => true,
						'type' => Controls_Manager::TEXT,
						'description' => __( 'Multiple categories must be comma separated.', 'sina-ext' ),
						'default' => __( 'Web Design', 'sina-ext' ),
					],
					[
						'name' => 'image',
						'label' => __( 'Choose Image', 'sina-ext' ),
						'type' => Controls_Manager::MEDIA,
						'default' => [
							'url' => SINA_EXT_URL .'assets/img/choose-img.jpg',
						],
					],
					[
						'name' => 'size',
						'label' => __( 'Size', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'sina-pf-item-11' => __( '1 Column 1 Row', 'sina-ext' ),
							'sina-pf-item-12' => __( '1 Column 2 Row', 'sina-ext' ),
							'sina-pf-item-21' => __( '2 Column 1 Row', 'sina-ext' ),
							'sina-pf-item-22' => __( '2 Column 2 Row', 'sina-ext' ),
							'sina-pf-item-31' => __( '3 Column 1 Row', 'sina-ext' ),
							'sina-pf-item-32' => __( '3 Column 2 Row', 'sina-ext' ),
							'sina-pf-item-33' => __( '3 Column 3 Row', 'sina-ext' ),
						],
						'description' => __( 'Size will work if the <strong>"number of columns"</strong> is <strong>"Masonry"</strong> selected', 'sina-ext' ),
						'default' => 'sina-pf-item-22',
					],
					[
						'name' => 'link',
						'label' => __( 'Link', 'sina-ext' ),
						'type' => Controls_Manager::URL,
						'placeholder' => __( 'https://your-link.com', 'sina-ext' ),
						'default' => [
							'url' => '#',
						],
					],
				],
				'default' => [
					[
						'item_name' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
						'category' => __( 'Graphic Design', 'sina-ext' ),
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio1.jpg',
						]
					],
					[
						'item_name' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
						'category' => __( 'Web Design', 'sina-ext' ),
						'size' => 'sina-pf-item-22',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio2.jpg',
						]
					],
					[
						'item_name' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
						'category' => __( 'Graphic Design', 'sina-ext' ),
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio3.jpg',
						]
					],
					[
						'item_name' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
						'category' => __( 'Photography', 'sina-ext' ),
						'size' => 'sina-pf-item-22',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio4.jpg',
						]
					],
					[
						'item_name' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
						'category' => __( 'Web Design', 'sina-ext' ),
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio5.jpg',
						]
					],
					[
						'item_name' => __( 'Lorem ipsum dolor sit amet', 'sina-ext' ),
						'category' => __( 'Photography', 'sina-ext' ),
						'size' => 'sina-pf-item-11',
						'image' => [
							'url' => SINA_EXT_URL .'assets/img/portfolio6.jpg',
						]
					],
				],
				'title_field' => '{{{ item_name }}}',
			]
		);

		$this->end_controls_section();
		// End Portfolio Content
		// ========================


		// Start Menu Style
		// =====================
		$this->start_controls_section(
			'menu_style',
			[
				'label' => __( 'Menu Buttons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .sina-portfolio-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'btn_shadow',
				'selector' => '{{WRAPPER}} .sina-portfolio-btn',
			]
		);

		$this->start_controls_tabs( 'btn_tabs' );

		$this->start_controls_tab(
			'btn_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'btn_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'btn_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'selector' => '{{WRAPPER}} .sina-portfolio-btn',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_shadow',
				'selector' => '{{WRAPPER}} .sina-portfolio-btn',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'btn_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'hover_btn_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn:hover' => 'border-color: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_btn_shadow',
				'selector' => '{{WRAPPER}} .sina-portfolio-btn:hover',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'menu_btn_gap',
			[
				'label' => __( 'Gap From Items', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btns' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'menu_btn_margin',
			[
				'label' => __( 'Margin', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Menu Style
		// =====================


		// Start Items Style
		// =====================
		$this->start_controls_section(
			'item_style',
			[
				'label' => __( 'Items & Overlay', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'note',
			[
				'label' => 'If you want to change the <strong>Height</strong> or <strong>Padding</strong> then the page need to <strong>Refresh</strong> for seeing the actual result',
				'type' => Controls_Manager::RAW_HTML,
				'separator' => 'after',
			]
		);
		$this->add_control(
			'overlay',
			[
				'label' => __( 'Overlay Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_responsive_control(
			'items_height',
			[
				'label' => __( 'Height', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 800,
					],
				],
				'condition' => [
					'columns!' => 'masonry',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'items_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'items_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Items Style
		// =====================


		// Start Icons Style
		// =====================
		$this->start_controls_section(
			'icons_style',
			[
				'label' => __( 'Icons', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icons_tabs' );

		$this->start_controls_tab(
			'icons_normal',
			[
				'label' => __( 'Normal', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icons_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icons_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icons_border',
				'selector' => '{{WRAPPER}} .sina-portfolio-overlay i',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icons_hover',
			[
				'label' => __( 'Hover', 'sina-ext' ),
			]
		);

		$this->add_control(
			'icons_hover_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i:hover' => 'color: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icons_hover_bg',
			[
				'label' => __( 'Background', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i:hover' => 'background: {{VALUE}}'
				],
			]
		);
		$this->add_control(
			'icons_hover_border',
			[
				'label' => __( 'Border Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i:hover' => 'border-color: {{VALUE}}'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icons_gap',
			[
				'label' => __( 'Icons Gap', 'sina-ext' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-zoom' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icons_radius',
			[
				'label' => __( 'Radius', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icons_padding',
			[
				'label' => __( 'Padding', 'sina-ext' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [
					'px' => [
						'max' => 50,
						'step' => 1,
					],
					'em' => [
						'max' => 20,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sina-portfolio-overlay i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		// End Icons Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-portfolio <?php echo esc_attr( 'sina-pf-'.$this->get_id() ); ?>"
		data-layout="<?php echo esc_attr( $data['columns'] ); ?>">
			<div class="sina-portfolio-btns">
				<button class="sina-portfolio-btn sina-button is-checked" data-filter="*">All</button>
				<?php
					$categories = sina_get_portfolio_cat( $data['portfolio'] );
					foreach ( $categories as $cat ) :
						?>
						<button class="sina-portfolio-btn sina-button" data-filter=".<?php echo esc_attr( $cat ); ?>">
							<?php echo esc_html( str_replace( '_', ' ', trim( $cat, '_') ) ); ?>
						</button>
				<?php endforeach; ?>

			</div>

			<div class="sina-portfolio-grid">
			<?php
				foreach ( $data['portfolio'] as $item ) :
					$category = strtolower( str_replace( ' ', '_', $item['category'] ) );
					$category =  str_replace( ',', ' ', $category );

					if ( 'masonry' == $data['columns'] ) {
						$size_class = $item['size'];
					} else{
						$size_class = $data['columns'];
					}
				?>
				<?php if ( $item['image']['url'] ): ?>
					<div class="sina-portfolio-item <?php echo esc_attr( $category .' '. $size_class ); ?>">
						<div class="sina-portfolio-item-inner"
							style="background-image: url(<?php echo esc_url( $item['image']['url'] ); ?>);">
							<div class="sina-portfolio-overlay sina-overlay <?php echo esc_attr( $data['effects'] ); ?>">
								<div class="sina-portfolio-icons">
									<a title="<?php echo esc_attr( $item['item_name'] ); ?>" href="#" data-mfp-src="<?php echo esc_url( $item['image']['url'] ); ?>" class="sina-portfolio-zoom">
										<i class="fa fa-search-plus"></i>
									</a>
									<a href="<?php echo esc_url( $item['link']['url'] ); ?>"
									<?php if ( 'on' == $item['link']['is_external'] ): ?>
										target="_blank" 
									<?php endif; ?>
									<?php if ( 'on' == $item['link']['nofollow'] ): ?>
										rel="nofollow" 
									<?php endif; ?> class="sina-portfolio-link">
										<i class="fa fa-link"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			</div>
		</div><!-- .sina-portfolio -->
		<?php
		if ( Plugin::instance()->editor->is_edit_mode() ) {
			$this->render_editor_script();
		}
	}


	protected function render_editor_script() {
		?>
		<script type="text/javascript">
		jQuery( document ).ready(function( $ ) {
			var sinaPFClass = '.sina-pf-'+'<?php echo $this->get_id(); ?>',
				$this = $(sinaPFClass),
				$isoGrid = $this.children('.sina-portfolio-grid'),
				$btns = $this.children('.sina-portfolio-btns'),
				layout = $this.data('layout');

			$this.imagesLoaded( function() {
				if ( 'masonry' == layout ) {
					var $grid = $isoGrid.isotope({
						itemSelector: '.sina-portfolio-item',
						percentPosition: true,
						masonry: {
							columnWidth: '.sina-portfolio-item',
						}
					});
				} else{
					var $grid = $isoGrid.isotope({
						itemSelector: '.sina-portfolio-item',
						layoutMode: 'fitRows'
					});

				}

				$btns.on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({filter: filterValue});
				});

				$btns.each(function (i, btns) {
					var btns = $(btns);

					btns.on('click', '.sina-portfolio-btn', function () {
						btns.find('.is-checked').removeClass('is-checked');
						$(this).addClass('is-checked');
					});
				});

			});

			$this.find('.sina-portfolio-zoom').magnificPopup({
				type: 'image',
				gallery: {
					enabled: true
				},
			});

		});
		</script>
		<?php
	}


	protected function _content_template() {

	}
}