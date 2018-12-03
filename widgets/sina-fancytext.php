<?php

/**
 * Fancytext Widget.
 *
 * @since 1.0.0
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Fancytext_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 1.0.0
	 */
	public function get_name() {
		return 'sina_fancytext';
	}

	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 */
	public function get_title() {
		return __( 'Sina Fancy Text', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 1.0.0
	 */
	public function get_icon() {
		return 'eicon-animation-text';
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
		return [ 'sina fancy text', 'sina slide text' ];
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
			'typed',
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
		// Start Fancytext Content
		// =====================
		$this->start_controls_section(
			'fancytext_content',
			[
				'label' => __( 'Fancy Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fancy_text',
			[
				'label' => __( 'Fancy Text', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'fancy_items',
						'label' => __( 'Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => __('Fancy text', 'sina-ext'),
					],
				],
				'default' => [
					[
						'fancy_items' => __( 'first text', 'sina-ext' ),
					],
					[
						'fancy_items' => __( 'second text', 'sina-ext' ),
					],
					[
						'fancy_items' => __( 'third text', 'sina-ext' ),
					],
					[
						'fancy_items' => __( 'fourth text', 'sina-ext' ),
					],
				],
				'title_field' => '{{{ fancy_items }}}',
			]
		);
		$this->add_control(
			'fancy_prefix',
			[
				'label' => __( 'Prefix', 'sina-ext' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter prefix text', 'sina-ext' ),
				'default' => __( 'Prefix text ', 'sina-ext' ),
			]
		);
		$this->add_control(
			'fancy_suffix',
			[
				'label' => __( 'Suffix', 'sina-ext' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter suffix text', 'sina-ext' ),
				'default' => __( ' Suffix text', 'sina-ext' ),
			]
		);

		$this->end_controls_section();
		// End Fancytext Content
		// =======================


		// Start Fancy Settings
		// ======================
		$this->start_controls_section(
			'fancy_settings',
			[
				'label' => __( 'Fancy Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'display',
			[
				'label' => __( 'Display', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'inline' => __( 'Inline', 'sina-ext' ),
					'block' => __( 'Block', 'sina-ext' ),
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => 'inline-block',
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext-prefix, {{WRAPPER}} .sina-fancytext-suffix' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'sina-ext' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'sina-ext' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'sina-ext' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'sina-ext' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'justify', 'sina-ext' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'animation_type',
			[
				'label' => __( 'Animation Type', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'default' => 'typing',
				'options' => [
					'typing' => __( 'Typing', 'sina-ext' ),
					'fadeIn' => __( 'Fade', 'sina-ext' ),
					'fadeInUp' => __( 'Fade Up', 'sina-ext' ),
					'fadeInDown' => __( 'Fade Down', 'sina-ext' ),
					'fadeInLeft' => __( 'Fade Left', 'sina-ext' ),
					'fadeInRight' => __( 'Fade Right', 'sina-ext' ),
					'zoomIn' => __('Zoom In', 'sina-ext'),
					'zoomInLeft' => __('Zoom In Left', 'sina-ext'),
					'zoomInRight' => __('Zoom In Right', 'sina-ext'),
					'bounceIn' => __('Bounce In', 'sina-ext'),
					'slideInDown' => __('Slide In Down', 'sina-ext'),
					'slideInLeft' => __('Slide In Left', 'sina-ext'),
					'slideInRight' => __('Slide In Right', 'sina-ext'),
					'slideInUp' => __('Slide In Up', 'sina-ext'),
					'lightSpeedIn' => __('Light Speed In', 'sina-ext'),
					'swing' => __( 'Swing', 'sina-ext' ),
					'bounce' => __('Bounce', 'sina-ext'),
					'flash' => __('Flash', 'sina-ext'),
					'pulse' => __('Pulse', 'sina-ext'),
					'rubberBand' => __('Rubber Band', 'sina-ext'),
					'shake' => __('Shake', 'sina-ext'),
					'headShake' => __('Head Shake', 'sina-ext'),
					'swing' => __('Swing', 'sina-ext'),
					'tada' => __('Tada', 'sina-ext'),
					'wobble' => __('Wobble', 'sina-ext'),
					'jello' => __('Jello', 'sina-ext'),
				],
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => __( 'Delay', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => '2000'
			]
		);
		$this->add_control(
			'typing_speed',
			[
				'label' => __( 'Typing Speed', 'sina-ext' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => '100',
				'condition' => [
					'animation_type' => 'typing',
				],
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Loop', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'animation_type' => 'typing',
				],
				'default' => 'yes',
			]
		);
		$this->add_control(
			'cursor',
			[
				'label' => __( 'Cursor', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'sina-ext' ),
				'label_off' => __( 'Hide', 'sina-ext' ),
				'default' => 'yes',
				'condition' => [
					'animation_type' => 'typing',
				],
			]
		);
		$this->add_control(
			'cursor_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'condition' => [
					'cursor' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext .typed-cursor' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'tag',
			[
				'label' => __( 'Selct Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => __( 'H1', 'sina-ext' ),
					'h2' => __( 'H2', 'sina-ext' ),
					'h3' => __( 'H3', 'sina-ext' ),
					'h4' => __( 'H4', 'sina-ext' ),
					'h5' => __( 'H5', 'sina-ext' ),
					'h6' => __( 'H6', 'sina-ext' ),
					'p' => __( 'p', 'sina-ext' ),
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();
		// End Fancy Settings
		// ====================


		// Start Fancy Style
		// =====================
		$this->start_controls_section(
			'fancy_style',
			[
				'label' => __( 'Fancy Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'fancy_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#1085e4',
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext-strings, {{WRAPPER}} .typed-cursor' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'fancy_typography',
				'selector' => '{{WRAPPER}} .sina-fancytext-strings, {{WRAPPER}} .typed-cursor',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'fancy_shadow',
				'selector' => '{{WRAPPER}} .sina-fancytext-strings',
			]
		);

		$this->end_controls_section();
		// End Fancy Style
		// =====================


		// Start Prefix Style
		// =====================
		$this->start_controls_section(
			'prefix_style',
			[
				'label' => __( 'Prefix Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fancy_prefix!' => ''
				],
			]
		);

		$this->add_control(
			'prefix_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#d300d0',
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext-prefix' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'prefix_typography',
				'selector' => '{{WRAPPER}} .sina-fancytext-prefix',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'prefix_shadow',
				'selector' => '{{WRAPPER}} .sina-fancytext-prefix',
			]
		);

		$this->end_controls_section();
		// End Prefix Style
		// =====================


		// Start Suffix Style
		// =====================
		$this->start_controls_section(
			'suffix_style',
			[
				'label' => __( 'Suffix Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fancy_suffix!' => ''
				],
			]
		);

		$this->add_control(
			'suffix_color',
			[
				'label' => __( 'Color', 'sina-ext' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#00aa00',
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext-suffix' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'suffix_typography',
				'selector' => '{{WRAPPER}} .sina-fancytext-suffix',
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'suffix_shadow',
				'selector' => '{{WRAPPER}} .sina-fancytext-suffix',
			]
		);

		$this->end_controls_section();
		// End Suffix Style
		// =====================
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		$fancy_text = '';
		foreach ($data['fancy_text'] as $text) {
			$fancy_text .= $text['fancy_items'].'@@';
		}

		$this->add_render_attribute( 'fancy_prefix', 'class', 'sina-fancytext-prefix' );
		$this->add_inline_editing_attributes( 'fancy_prefix' );

		$this->add_render_attribute( 'fancy_suffix', 'class', 'sina-fancytext-suffix' );
		$this->add_inline_editing_attributes( 'fancy_suffix' );
		?>
		<div class="sina-fancytext"
		data-fancy-text="<?php echo esc_attr( $fancy_text ); ?>"
		data-anim="<?php echo esc_attr( $data['animation_type'] ); ?>"
		data-speed="<?php echo esc_attr( $data['typing_speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>"
		data-cursor="<?php echo esc_attr( $data['cursor'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>">
			<<?php echo esc_html( $data['tag'] ); ?>>
			<?php
				if ( $data['fancy_prefix'] ) :
					?>
					<span <?php echo $this->get_render_attribute_string( 'fancy_prefix' ); ?>>
						<?php echo esc_html( $data['fancy_prefix'] ); ?>
					</span>
					<?php
				endif;

				if ( 'typing' == $data['animation_type'] ) :
					?>
					<span class="sina-fancytext-strings">
						<?php echo esc_html( $data['fancy_text'][0]['fancy_items'] ); ?>
					</span>
					<?php
				else :
					?>
					<span class="sina-fancytext-strings">
						<?php echo esc_html( rtrim($fancy_text, '@@') ); ?>
					</span>
					<?php
				endif;

				if ( $data['fancy_suffix'] ) :
					?>
					<span <?php echo $this->get_render_attribute_string( 'fancy_suffix' ); ?>>
						<?php echo esc_html( $data['fancy_suffix'] ); ?>
					</span>
					<?php
				endif;
			?>
			</<?php echo esc_html( $data['tag'] ); ?>>
		</div><!-- .sina-fancytext -->
		<?php
	}


	protected function _content_template() {
		?>
		<#
		if ( settings.fancy_prefix || settings.fancy_suffix || settings.fancy_text.length > 0 ) {
			var fancyText = '';
			_.each( settings.fancy_text, function( item, index ) {
				fancyText += item['fancy_items'] + '@@';
			});

			view.addRenderAttribute( 'fancy_prefix', 'class', 'sina-fancytext-prefix' );
			view.addInlineEditingAttributes( 'fancy_prefix' );

			view.addRenderAttribute( 'fancy_suffix', 'class', 'sina-fancytext-suffix' );
			view.addInlineEditingAttributes( 'fancy_suffix' );
			#>
			<div class="sina-fancytext" data-fancy-text="{{{fancyText.trim('@@')}}}" data-anim="{{{settings.animation_type}}}" data-speed="{{{settings.typing_speed}}}" data-delay="{{{settings.delay}}}" data-cursor="{{{settings.cursor}}}" data-loop="{{{settings.loop}}}">
				<{{{settings.tag}}}>

				<# if ( settings.fancy_prefix ) { #>
					<span {{{ view.getRenderAttributeString( 'fancy_prefix' ) }}}>{{{settings.fancy_prefix}}}</span>
				<# } #>

				<# if ( 'typing' == settings.animation_type ) { #>
					<span class="sina-fancytext-strings">
						{{{settings.fancy_text[0]['fancy_items']}}}
					</span>
				<# } else { #>
					<span class="sina-fancytext-strings">
						{{{fancyText.trim('@@')}}}
					</span>
				<# } #>

				<# if ( settings.fancy_suffix ) { #>
					<span {{{ view.getRenderAttributeString( 'fancy_suffix' ) }}}>{{{settings.fancy_suffix}}}</span>
				<# } #>
				</{{{settings.tag}}}>
			</div>
		<# } #>
		<?php
	}
}