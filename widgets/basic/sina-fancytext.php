<?php

/**
 * Fancytext Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Repeater;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Fancytext_Widget extends Widget_Base{

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
		return esc_html__( 'Sina Fancy Text', 'sina-ext' );
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
			'animate-merge',
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
	protected function register_controls() {
		// Start Fancytext Content
		// =====================
		$this->start_controls_section(
			'fancytext_content',
			[
				'label' => esc_html__( 'Fancy Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'fancy_items',
			[
				'label' => esc_html__( 'Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => 'Fancy text',
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'fancy_text',
			[
				'label' => esc_html__( 'Fancy Text', 'sina-ext' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'fancy_items' => 'first text',
					],
					[
						'fancy_items' => 'second text',
					],
					[
						'fancy_items' => 'third text',
					],
					[
						'fancy_items' => 'fourth text',
					],
				],
				'title_field' => '{{{ fancy_items }}}',
			]
		);
		$this->add_control(
			'fancy_prefix',
			[
				'label' => esc_html__( 'Prefix Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter prefix text', 'sina-ext' ),
				'default' => 'Prefix text ',
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$this->add_control(
			'fancy_suffix',
			[
				'label' => esc_html__( 'Suffix Text', 'sina-ext' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter suffix text', 'sina-ext' ),
				'default' => ' Suffix text',
				'dynamic' => [
					'active' => true,
				],
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
				'label' => esc_html__( 'Fancy Settings', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'display',
			[
				'label' => esc_html__( 'Display', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'inline' => esc_html__( 'Inline', 'sina-ext' ),
					'block' => esc_html__( 'Block', 'sina-ext' ),
				],
				'default' => 'inline',
				'selectors' => [
					'{{WRAPPER}} .sina-fancytext-prefix, {{WRAPPER}} .sina-fancytext-suffix' => 'display: {{VALUE}};',
				],
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
					'{{WRAPPER}} .sina-fancytext' => 'text-align: {{VALUE}};',
				],
			]
		);
		$animation = Sina_Common_Data::animation();
		unset( $animation['none'] );
		$animation['typing'] = esc_html__( 'Typing', 'sina-ext' );

		$this->add_control(
			'animation_type',
			[
				'label' => esc_html__( 'Animation Type', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'typing',
				'options' => $animation,
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => esc_html__( 'Delay', 'sina-ext' ),
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
				'label' => esc_html__( 'Typing Speed', 'sina-ext' ),
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
				'label' => esc_html__( 'Loop', 'sina-ext' ),
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
				'label' => esc_html__( 'Cursor', 'sina-ext' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'sina-ext' ),
				'label_off' => esc_html__( 'Hide', 'sina-ext' ),
				'default' => 'yes',
				'condition' => [
					'animation_type' => 'typing',
				],
			]
		);
		$this->add_control(
			'cursor_color',
			[
				'label' => esc_html__( 'Cursor Color', 'sina-ext' ),
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
				'label' => esc_html__( 'Select Tag', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'p',
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
				'label' => esc_html__( 'Fancy Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'fancy_color',
				'fields_options' => [
					'color' => [
						'default' => '#1085e4',
					],
				],
				'selector' => '{{WRAPPER}} .sina-fancytext-strings, {{WRAPPER}} .sina-fancytext-strings > span.animated, {{WRAPPER}} .typed-cursor',
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
				'label' => esc_html__( 'Prefix Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fancy_prefix!' => ''
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
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'prefix_color',
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
				'label' => esc_html__( 'Suffix Text', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'fancy_suffix!' => ''
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
		$this->add_group_control(
			Sina_Ext_Gradient_Text::get_type(),
			[
				'name' => 'suffix_color',
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
		?>
		<div class="sina-fancytext"
		data-fancy-text="<?php echo esc_attr( $fancy_text ); ?>"
		data-anim="<?php echo esc_attr( $data['animation_type'] ); ?>"
		data-speed="<?php echo esc_attr( $data['typing_speed'] ); ?>"
		data-delay="<?php echo esc_attr( $data['delay'] ); ?>"
		data-cursor="<?php echo esc_attr( $data['cursor'] ); ?>"
		data-loop="<?php echo esc_attr( $data['loop'] ); ?>">
			<<?php printf( '%s', $data['tag'] ); ?>>
			<?php
				if ( $data['fancy_prefix'] ) :
					?>
					<span class="sina-fancytext-prefix">
						<?php printf( '%s', $data['fancy_prefix'] ); ?>
					</span>
					<?php
				endif;

				if ( 'typing' == $data['animation_type'] ) :
					?>
					<span class="sina-fancytext-strings">
						<?php printf( '%s', $data['fancy_text'][0]['fancy_items'] ); ?>
					</span>
					<?php
				else :
					?>
					<span class="sina-fancytext-strings">
						<?php printf( '%s', rtrim($fancy_text, '@@') ); ?>
					</span>
					<?php
				endif;

				if ( $data['fancy_suffix'] ) :
					?>
					<span class="sina-fancytext-suffix">
						<?php printf( '%s', $data['fancy_suffix'] ); ?>
					</span>
					<?php
				endif;
			?>
			</<?php printf( '%s', $data['tag'] ); ?>>
		</div><!-- .sina-fancytext -->
		<?php
	}


	protected function content_template() {
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
			<div class="sina-fancytext"
			data-fancy-text="{{{fancyText.trim('@@')}}}"
			data-anim="{{{settings.animation_type}}}"
			data-speed="{{{settings.typing_speed}}}"
			data-delay="{{{settings.delay}}}"
			data-cursor="{{{settings.cursor}}}"
			data-loop="{{{settings.loop}}}">
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