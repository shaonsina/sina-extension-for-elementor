<?php
/*
view.getID()


For size default value
'default' => [
	'size' => '10',
],
For padding-margin Default Value
'default' => [
	'top' => '0',
	'right' => '0',
	'bottom' => '15',
	'left' => '0',
	'isLinked' => false,
],
For box shadow default value
'fields_options' => [
	'box_shadow_type' => [ 
		'default' =>'yes' 
	],
	'box_shadow' => [
		'default' => [
			'horizontal' => '0',
			'vertical' => '10',
			'blur' => '6',
			'color' => 'rgba(0,0,0,0.1)'
		]
	]
],
For Border Default Value
'fields_options' => [
	'border' => [
		'default' => 'solid',
	],
	'color' => [
		'default' => '#1085e4',
	],
	'width' => [
		'default' => [
			'top' => '1',
			'right' => '1',
			'bottom' => '1',
			'left' => '1',
			'isLinked' => true,
		]
	],
],
For Typography Default value
'fields_options' => [
	'typography' => [ 
		'default' =>'custom', 
	],
	'font_weight' => [
		'default' => '600',
	],
	'font_size'   => [
		'default' => [
			'size' => '24',
		],
	],
	'line_height'   => [
		'default' => [
			'unit' => 'px',
			'size' => '24',
		],
	],
	'text_transform' => [
		'default' => 'uppercase',
	],
],

For Background default value
'fields_options' => [
	'background' => [ 
		'default' =>'gradient', 
	],
	'gradient_type' => [
		'default' => 'linear',
	],
	'gradient_angle' => [
		'default' => [
			'unit' => 'deg',
			'size' => -35,
		],
	],
	'color' => [
		'default' => '#00e',
	],
	'color_b' => [
		'default' => '#e0e',
	],
],

For Responsive Default value
'desktop_default' => [
	'size' => 600,
],
'tablet_default' => [
	'size' => 500,
],
'mobile_default' => [
	'size' => 400,
],

'range' => [
	'px' => [
		'max' => 1000,
	],
	'em' => [
		'max' => 50,
	],
],


$this->add_control(
	'icon_color',
	[
		'label' => __( 'Color', 'sina-ext' ),
		'type' => Controls_Manager::COLOR,
		'default' => '#FFFFFF',
		'selectors' => [
			'{{WRAPPER}} {{CURRENT_ITEM}} > a' => 'color: {{VALUE}};',
		],
	]
);
That is major release of this plugin. So, please review your site after updated.
Mailchimp field padding issue fixed.

Would it take more time to load more than one CSS lower-size file or will it take a longer time to load a more sized CSS file?
*/




$desc_key = $this->get_repeater_setting_key( 'desc', 'accordion', $index );

$this->add_render_attribute( $desc_key, 'class', 'sina-accordion-desc' );
$this->add_inline_editing_attributes( $desc_key );

echo $this->get_render_attribute_string( $desc_key );
?>
<div class="sina-banner-slider owl-carousel"
data-autoplay="{{{settings.autoplay}}}"
data-pause="{{{settings.pause}}}"
data-nav="{{{settings.nav}}}"
data-dots="{{{settings.dots}}}"
data-mouse-drag="{{{settings.mouse_drag}}}"
data-touch-drag="{{{settings.touch_drag}}}"
data-loop="{{{settings.loop}}}"
data-speed="{{{settings.slide_speed}}}"
data-part-anim="{{{settings.part_anim}}}"
data-delay="{{{settings.delay}}}">

<#
	var pbtnTooltip = settings.pbtn_tooltip_text ? 'sina-tooltip' : '';
	var sbtnTooltip = settings.sbtn_tooltip_text ? 'sina-tooltip' : '';

	_.each( settings.slides, function( slide, index ) {
		var invisible = '';
		if (settings.part_anim) {
			invisible = 'sina-anim-invisible';
		}

		var titleKey = view.getRepeaterSettingKey('title', 'slides', index);
		var subTitleKey = view.getRepeaterSettingKey('subTitle', 'slides', index);
		var descKey = view.getRepeaterSettingKey('desc', 'slides', index);

		view.addRenderAttribute(titleKey, {
			'class' : 'sina-banner-title ' + invisible,
			'data-animation' : 'animated ' + slide.title_anim,
		});
		view.addInlineEditingAttributes( titleKey );

		view.addRenderAttribute(subTitleKey, {
			'class' : 'sina-banner-subtitle ' + invisible,
			'data-animation' : 'animated ' + slide.subtitle_anim,
		});
		view.addInlineEditingAttributes( subTitleKey );

		view.addRenderAttribute(descKey, {
			'class' : 'sina-banner-desc ' + invisible,
			'data-animation' : 'animated ' + slide.desc_anim,
		});
		view.addInlineEditingAttributes( descKey );
		#>
		<div class="sina-slider-content sina-bg-cover" style="background-image: url({{{slide.image.url}}});">

			<# if ('yes' == settings.overlay) { #>
				<div class="sina-overlay"></div>
			<# } #>

			<div class="sina-banner-container elementor-repeater-item-{{{slide._id}}}">
				<# if (slide.title) {
					var titleSpan = slide.title_span ? '<span>' + slide.title_span + '</span>' : '';
					#>

					<{{{slide.title_tag}}} {{{ view.getRenderAttributeString( titleKey ) }}}>{{{slide.title + titleSpan}}}</{{{slide.title_tag}}}>
				<# } #>

				<# if (slide.subtitle) { #>
					<{{{slide.subtitle_tag}}} {{{view.getRenderAttributeString( subTitleKey )}}}>{{{slide.subtitle}}}</{{{slide.subtitle_tag}}}>
				<# } #>

				<# if (slide.desc) { #>
					<div {{{ view.getRenderAttributeString( descKey ) }}}>{{{slide.desc}}}</div>
				<# } #>

				<# if (settings.pbtn_text || settings.sbtn_text) { #>
					<div class="sina-banner-btns {{{invisible}}}"
					data-animation="animated {{{slide.buttons_anim}}}">
						<# if (settings.pbtn_text) { #>
							<a class="sina-banner-pbtn {{{pbtnTooltip + ' ' + settings.pbtn_effect + ' ' + settings.pbtn_bg_layer_effects}}}"
							<# if (settings.pbtn_tooltip_text) { #>
								data-toggle="tooltip" 
								title="{{{settings.pbtn_tooltip_text}}}" 
							<# } #>
							href="{{{settings.pbtn_link.url}}}">
								<# if (settings.pbtn_icon && 'left' == settings.pbtn_icon_align) { #>
									<i class="{{{settings.pbtn_icon}}} sina-icon-left"></i>
								<# } #>

								{{{settings.pbtn_text}}}

								<# if (settings.pbtn_icon && 'right' == settings.pbtn_icon_align) { #>
									<i class="{{{settings.pbtn_icon}}} sina-icon-right"></i>
								<# } #>
							</a>
						<# } #>

						<# if (settings.sbtn_text) { #>
							<a class="sina-banner-sbtn {{{sbtnTooltip + ' ' + settings.sbtn_effect + ' ' + settings.sbtn_bg_layer_effects}}}"
							<# if (settings.sbtn_tooltip_text) { #>
								data-toggle="tooltip" 
								title="{{{settings.sbtn_tooltip_text}}}" 
							<# } #>
							href="{{{settings.sbtn_link.url}}}">
								<# if (settings.sbtn_icon && 'left' == settings.sbtn_icon_align) { #>
									<i class="{{{settings.sbtn_icon}}} sina-icon-left"></i>
								<# } #>

								{{{settings.sbtn_text}}}

								<# if (settings.sbtn_icon && 'right' == settings.sbtn_icon_align) { #>
									<i class="{{{settings.sbtn_icon}}} sina-icon-right"></i>
								<# } #>
							</a>
						<# } #>
					</div>
				<# } #>
			</div>
		</div>
	<# }); #>
</div><!-- .sina-banner-slider -->
<?php



/**
 * Starter Widget.
 *
 * @since 3.0.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Starter_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 3.0.0
	 */
	public function get_name() {
		return 'sina_';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.0.0
	 */
	public function get_title() {
		return esc_html__( 'Sina ', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.0.0
	 */
	public function get_icon() {
		return 'fa fa-search-plus';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.0.0
	 */
	public function get_categories() {
		return [ 'sina-extension' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.0.0
	 */
	public function get_keywords() {
		return [ 'sina ' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.0.0
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
	 * @since 3.0.0
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
	 * @since 3.0.0
	 */
	protected function _register_controls() {
		// Start 
		// ===================
		$this->start_controls_section(
			'_content',
			[
				'label' => esc_html__( ' Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End 
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		?>
		<div class="sina-">
		</div><!-- .sina- -->
		<?php
	}


	protected function _content_template() {

	}
}