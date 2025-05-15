<?php
namespace Sina_Extension\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Settings Class for settings panel
 *
 * @since 3.0.0
 */
class Sina_Ext_Settings{
	/**
	 * Instance
	 *
	 * @since 3.1.13
	 * @var Sina_Ext_Settings The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * SINA WIDGETS and SINA EXTENDERS Constant
	 *
	 * @since 3.7.0
	 */
	public $sina_widgets = [];
	public $sina_extenders = [];

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.1.13
	 * @return Sina_Ext_Settings An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->sina_widgets = [
			'header_footer' => [
				'nav-menu'				=> esc_html__( 'Sina Nav Menu', 'sina-ext' ),
				'site-logo'				=> esc_html__( 'Sina Site Logo', 'sina-ext' ),
				'site-info'				=> esc_html__( 'Sina Site Info', 'sina-ext' ),
				'direct-contact'		=> esc_html__( 'Sina Direct Contact', 'sina-ext' ),
				'search'				=> esc_html__( 'Sina Search', 'sina-ext' ),
				'quick-links'			=> esc_html__( 'Sina Quick Links', 'sina-ext' ),
				'scroll-to-top'			=> esc_html__( 'Sina Scroll to Top', 'sina-ext' ),
				'woo-cart'				=> esc_html__( 'Sina Woo Cart', 'sina-ext' ),
			],
			'theme_builder' => [
				'post-title'				=> esc_html__( 'Sina Post Title', 'sina-ext' ),
				'post-content'				=> esc_html__( 'Sina Post Content', 'sina-ext' ),
				'post-featured-image'		=> esc_html__( 'Sina Post Featured Image', 'sina-ext' ),
				'post-excerpt'				=> esc_html__( 'Sina Post Excerpt', 'sina-ext' ),
				'post-meta'					=> esc_html__( 'Sina Post Meta', 'sina-ext' ),
				'post-navigation'			=> esc_html__( 'Sina Post Navigation', 'sina-ext' ),
				'post-comments'				=> esc_html__( 'Sina Post Comments', 'sina-ext' ),
				'archive-title'				=> esc_html__( 'Sina Archive Title', 'sina-ext' ),
				'author-profile'			=> esc_html__( 'Sina Author Profile', 'sina-ext' ),
				'posts'						=> esc_html__( 'Sina Posts', 'sina-ext' ),
			],
			'basic' => [
				'accordion' 			=> esc_html__( 'Sina Accordion', 'sina-ext' ),
				'breadcrumbs' 			=> esc_html__( 'Sina Breadcrumbs', 'sina-ext' ),
				'content-box' 			=> esc_html__( 'Sina Content Box', 'sina-ext' ),
				'counter' 				=> esc_html__( 'Sina Counter', 'sina-ext' ),
				'dynamic-button'		=> esc_html__( 'Sina Dynamic Button', 'sina-ext' ),
				'fancytext' 			=> esc_html__( 'Sina Fancy Text', 'sina-ext' ),
				'flip-box' 				=> esc_html__( 'Sina Flip Box', 'sina-ext' ),
				'google-map' 			=> esc_html__( 'Sina Google Map', 'sina-ext' ),
				'image-differ'			=> esc_html__( 'Sina Image Differ', 'sina-ext' ),
				'piechart' 				=> esc_html__( 'Sina Piechart', 'sina-ext' ),
				'pricing' 				=> esc_html__( 'Sina Pricing', 'sina-ext' ),
				'progressbar' 			=> esc_html__( 'Sina Progressbar', 'sina-ext' ),
				'social-icons'			=> esc_html__( 'Sina Social Icons', 'sina-ext' ),
				'table'			 		=> esc_html__( 'Sina Table', 'sina-ext' ),
				'team' 					=> esc_html__( 'Sina Team', 'sina-ext' ),
				'title'					=> esc_html__( 'Sina Title', 'sina-ext' ),
				'transform'				=> esc_html__( 'Sina Transform', 'sina-ext' ),
				'user-counter' 			=> esc_html__( 'Sina User Counter', 'sina-ext' ),
				'video' 				=> esc_html__( 'Sina Video', 'sina-ext' ),
				'visit-counter' 		=> esc_html__( 'Sina Visit Counter', 'sina-ext' ),
			],
			'advanced' => [
				'banner-slider' 		=> esc_html__( 'Sina Banner Slider', 'sina-ext' ),
				'blogpost' 				=> esc_html__( 'Sina Blog Post', 'sina-ext' ),
				'brand-carousel' 		=> esc_html__( 'Sina Brand Carousel', 'sina-ext' ),
				'contact-form' 			=> esc_html__( 'Sina Contact Form', 'sina-ext' ),
				'content-slider'		=> esc_html__( 'Sina Content Slider', 'sina-ext' ),
				'countdown' 			=> esc_html__( 'Sina Countdown', 'sina-ext' ),
				'facebook-feed'			=> esc_html__( 'Sina Facebook Feed', 'sina-ext' ),
				'login-form' 			=> esc_html__( 'Sina Login Form', 'sina-ext' ),
				'mailchimp-subscribe' 	=> esc_html__( 'Sina MailChimp Subscribe', 'sina-ext' ),
				'modal-box'			 	=> esc_html__( 'Sina Modal Box', 'sina-ext' ),
				'news-ticker' 			=> esc_html__( 'Sina News Ticker', 'sina-ext' ),
				'particle-layer' 		=> esc_html__( 'Sina Particle Layer', 'sina-ext' ),
				'portfolio' 			=> esc_html__( 'Sina Portfolio', 'sina-ext' ),
				'posts-carousel'		=> esc_html__( 'Sina Posts Carousel', 'sina-ext' ),
				'posts-tab' 			=> esc_html__( 'Sina Posts Tab', 'sina-ext' ),
				'product-zoomer' 		=> esc_html__( 'Sina Product Zoomer', 'sina-ext' ),
				'review-carousel' 		=> esc_html__( 'Sina Review Carousel', 'sina-ext' ),
				'search-form' 			=> esc_html__( 'Sina Search Form', 'sina-ext' ),
				'twitter-feed'			=> esc_html__( 'Sina Twitter Feed', 'sina-ext' ),
			],
			'pro' => [
				'chart'					=> esc_html__( 'Sina Pro Chart', 'sina-ext' ),
				'facebook-feed-carousel'=> esc_html__( 'Sina Pro Facebook Feed Carousel',  'sina-ext' ),
				'hover-image'			=> esc_html__( 'Sina Pro Hover Image', 'sina-ext' ),
				'image-accordion'		=> esc_html__( 'Sina Pro Image Accordion', 'sina-ext' ),
				'image-marker'			=> esc_html__( 'Sina Pro Image Marker', 'sina-ext' ),
				'image-scroller'		=> esc_html__( 'Sina Pro Image Scroller', 'sina-ext' ),
				'instant-search'		=> esc_html__( 'Sina Pro Instant Search', 'sina-ext' ),
				'lost-password-form'	=> esc_html__( 'Sina Pro Lost Password Form', 'sina-ext' ),
				'lottie-animation'		=> esc_html__( 'Sina Pro Lottie Animation', 'sina-ext' ),
				'offcanvas-bar'			=> esc_html__( 'Sina Pro Offcanvas Bar', 'sina-ext' ),
				'posts-gallery'			=> esc_html__( 'Sina Pro Posts Gallery', 'sina-ext' ),
				'posts-on-scroll'		=> esc_html__( 'Sina Pro Posts on Scroll', 'sina-ext' ),
				'register-form'			=> esc_html__( 'Sina Pro Register Form', 'sina-ext' ),
				'section-navigation'	=> esc_html__( 'Sina Pro Section Navigation', 'sina-ext' ),
				'source-code'			=> esc_html__( 'Sina Pro Source Code', 'sina-ext' ),
				'tab' 					=> esc_html__( 'Sina Pro Tab', 'sina-ext' ),
				'team-carousel'			=> esc_html__( 'Sina Pro Team Carousel', 'sina-ext' ),
				'testimonial'			=> esc_html__( 'Sina Pro Testimonial', 'sina-ext' ),
				'thumb-carousel'		=> esc_html__( 'Sina Pro Thumb Carousel', 'sina-ext' ),
				'tilt-box'				=> esc_html__( 'Sina Pro Tilt Box', 'sina-ext' ),
				'toggle-content'		=> esc_html__( 'Sina Pro Toggle Content', 'sina-ext' ),
				'twitter-feed-carousel'	=> esc_html__( 'Sina Pro Twitter Feed Carousel',  'sina-ext' ),
				'video-gallery'			=> esc_html__( 'Sina Pro Video Gallery', 'sina-ext' ),
			],
			'wooCommerce' => [
				'shop-box-grid'			=> esc_html__( 'Sina Pro Shop Box Grid',  'sina-ext' ),
				'shop-list-grid'		=> esc_html__( 'Sina Pro Shop List Grid',  'sina-ext' ),
				'shop-thumb-grid'		=> esc_html__( 'Sina Pro Shop Thumb Grid',  'sina-ext' ),
				'shop-box-carousel'		=> esc_html__( 'Sina Pro Shop Box Carousel',  'sina-ext' ),
				'shop-list-carousel'	=> esc_html__( 'Sina Pro Shop List Carousel',  'sina-ext' ),
				'shop-thumb-carousel'	=> esc_html__( 'Sina Pro Shop Thumb Carousel',  'sina-ext' ),
				'product-filter-vertical'=> esc_html__( 'Sina Pro Product Filter Vertical',  'sina-ext' ),
				'product-filter-horizontal'=> esc_html__( 'Sina Pro Product Filter Horizontal',  'sina-ext' ),
				'cart'					=> esc_html__( 'Sina Pro Cart',  'sina-ext' ),
				'checkout'				=> esc_html__( 'Sina Pro Checkout',  'sina-ext' ),
			],
		];

		$this->sina_extenders = [
			'pro' => [
				'sticky'				=> esc_html__( 'Sina Pro Sticky', 'sina-ext' ),
				'masker'				=> esc_html__( 'Sina Pro Masker', 'sina-ext' ),
				'parallax'				=> esc_html__( 'Sina Pro Parallax', 'sina-ext' ),
				'section-particles'		=> esc_html__( 'Sina Pro Section Particles', 'sina-ext' ),
				'clips-animation'		=> esc_html__( 'Sina Pro Clips Animation', 'sina-ext' ),
				'colors-animation'		=> esc_html__( 'Sina Pro Colors Animation', 'sina-ext' ),
				'grid-animation'		=> esc_html__( 'Sina Pro Grid Animation',  'sina-ext' ),
				'water-ripples'			=> esc_html__( 'Sina Pro Water Ripples', 'sina-ext' ),
				'conditional-publish'	=> esc_html__( 'Sina Pro Conditional Publish', 'sina-ext' ),
				'content-protection'	=> esc_html__( 'Sina Pro Content Protection', 'sina-ext' ),
				'preloader'				=> esc_html__( 'Sina Pro Preloader', 'sina-ext' ),
				'preloader'				=> esc_html__( 'Sina Pro Preloader', 'sina-ext' ),
				'reading-progressbar'	=> esc_html__( 'Sina Pro Reading Progressbar', 'sina-ext' ),
			],
		];

		add_action( 'admin_menu', [$this, 'add_menu'] );
		add_action( 'admin_menu', [$this, 'add_submenu'] );
		add_action( 'admin_init', [$this, 'settings_group'] );
		add_action( 'admin_enqueue_scripts', [$this, 'admin_scripts'] );
	}

	public function add_menu() {
		$menu_icon = (defined('SINA_EXT_PRO_URL') && file_exists(SINA_EXT_PRO_URL .'assets/img/menu-icon.png')) ? SINA_EXT_PRO_URL .'assets/img/menu-icon.png' : SINA_EXT_URL . 'admin/assets/img/menu-icon.png';
		add_menu_page(
			esc_html__('Sina Extension', 'sina-ext'),
			esc_html__('Sina Extension', 'sina-ext'),
			'manage_options',
			'sina_ext',
			[$this, 'page_content'],
			$menu_icon,
			58
		);
	}

	public function add_submenu() {
		add_submenu_page(
			'sina_ext',
			esc_html__('Settings', 'sina-ext'),
			esc_html__('Settings', 'sina-ext'),
			'manage_options',
			'sina_ext',
			[$this, 'page_content']
		);
		add_submenu_page(
			'sina_ext',
			esc_html__( 'Theme Builder', 'sina-ext' ),
			esc_html__( 'Theme Builder', 'sina-ext' ),
			'manage_options',
			'edit.php?post_type=sina-ext-template',
			null
		);
		add_submenu_page(
			'sina_ext',
			esc_html__('Products', 'sina-ext'),
			esc_html__('Products', 'sina-ext'),
			'manage_options',
			'products',
			[$this, 'products_page']
		);
	}

	public function admin_scripts( $hook ) {
		if ( 'toplevel_page_sina_ext' == $hook || 'sina-extension_page_products' == $hook || 'sina-extension_page_sina_ext_pro_update' == $hook ) {
			// CSS Files
			wp_enqueue_style( 'sina-admin', SINA_EXT_URL .'admin/assets/css/sina-admin.min.css', [], SINA_EXT_VERSION );

			// JS Files
			if ( !defined('SINA_EXT_PRO_VERSION') ) {
				wp_enqueue_script( 'sweetalert2', SINA_EXT_URL .'admin/assets/js/sweetalert2.min.js', ['jquery'], SINA_EXT_VERSION );
			}
			wp_enqueue_script( 'sina-admin', SINA_EXT_URL .'admin/assets/js/sina-admin.min.js', ['jquery'], SINA_EXT_VERSION );
		}
	}

	public function settings_group() {
		register_setting( 'sina_settings_group', 'sina_map_apikey' );
		register_setting( 'sina_settings_group', 'sina_mailchimp' );
		register_setting( 'sina_settings_group', 'sina_widgets' );
		register_setting( 'sina_settings_group', 'sina_templates_option' );
		register_setting( 'sina_settings_group', 'sina_extenders' );
		register_setting( 'sina_settings_group', 'sina_ext_pro_recaptcha_key' );
		register_setting( 'sina_settings_group', 'sina_ext_pro_recaptcha_secret_key' );
		register_setting( 'sina_settings_group', 'sina_ext_after_logout_url' );

		add_settings_section( 'sina_api_section', '', '', 'sina_ext_settings' );
		add_settings_field( 'sina_google_map_key', esc_html__('Google Map API Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_map_apikey'] );
		add_settings_field( 'sina_mailchimp_key', esc_html__('MailChimp API Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_mailchimp', 'index' => 'apikey' ] );
		add_settings_field( 'sina_mailchimp_list_id', esc_html__('MailChimp List Id', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_mailchimp', 'index' => 'list_id' ] );
		add_settings_field( 'sina_ext_pro_recaptcha_key', esc_html__('Google Recaptcha Site Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_ext_pro_recaptcha_key'] );
		add_settings_field( 'sina_ext_pro_recaptcha_secret_key', esc_html__('Google Recaptcha Secret Key', 'sina-ext'), [$this, 'password_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_ext_pro_recaptcha_secret_key'] );
		add_settings_field( 'sina_ext_after_logout_url', esc_html__('After Logout Redirect URL', 'sina-ext'), [$this, 'url_field'], 'sina_ext_settings', 'sina_api_section', ['key' => 'sina_ext_after_logout_url'] );


		$templates = get_option( 'sina_templates_option' );
		add_settings_section( 'sina_templates_section', '', '', 'sina_ext_templates' );
		add_settings_field( 'sina_ext_templates_only', esc_html__('Sina Templates', 'sina-ext'), [$this, 'templates_option'], 'sina_ext_templates', 'sina_templates_section', ['temps' => 'templates_only', 'get_temps' => $templates] );

		$get_widgets = get_option( 'sina_widgets' );
		$set_widgets = SINA_WIDGETS;
		if ( defined('SINA_EXT_PRO_WIDGETS') ) {
			$set_widgets = array_merge(SINA_WIDGETS, SINA_EXT_PRO_WIDGETS);
		}
		foreach ( $set_widgets as $cat => $widgets ) {
			$section = 'sina_'.$cat.'_widgets_section';
			$page = 'sina_widgets_'.$cat;
			add_settings_section( $section, '', '', $page );

			foreach ($widgets as $widget => $trans) {
				add_settings_field( 'sina_'.str_replace('-', '_', $widget), '', [$this, 'widgets_switcher'], $page, $section, ['widget' => $widget, 'translate' => $trans, 'cat' => $cat, 'get_widgets' => $get_widgets]  );
			}
		}

		// Extenders section
		$get_extenders = get_option( 'sina_extenders' );
		$set_extenders = SINA_EXTENDERS;
		if ( defined('SINA_EXT_PRO_EXTENDERS') ) {
			$set_extenders = array_merge(SINA_EXTENDERS, SINA_EXT_PRO_EXTENDERS);
		}
		add_settings_section( 'sina_extenders_section', '', '', 'sina_extenders' );
		foreach ($set_extenders as $type => $extenders) {
			foreach ($extenders as $extender => $translate) {
				add_settings_field( 'sina_ext'.str_replace('-', '_', $extender), '', [$this, 'extenders_switcher'], 'sina_extenders', 'sina_extenders_section', ['extender' => $extender, 'translate' => $translate, 'type' => $type, 'get_extenders' => $get_extenders]  );
			}
		}
	}

	public function products_page() {
		require SINA_EXT_ADMIN.'partials/products.php';
	}

	public function page_content() {
		require SINA_EXT_ADMIN.'partials/page-content.php';
	}

	public function url_field($field) {
		$data = get_option( $field['key'] );
		$key  = $field['key'];

		if ( is_array($data) ) {
			$data = $data[ $field['index'] ];
			$key = $key.'['. $field['index'] .']';
		}
		$data = sanitize_url( $data );
		printf('<input class="regular-text" type="text" name="%s" value="%s">', $key, $data);
	}

	public function password_field($field) {
		$data = get_option( $field['key'] );
		$key  = $field['key'];

		if ( is_array($data) ) {
			$data = $data[ $field['index'] ];
			$key = $key.'['. $field['index'] .']';
		}
		$data = sanitize_text_field( $data );
		printf('<input class="regular-text" type="password" name="%s" value="%s">', $key, sina_ext_remove_pass_chars($data));
	}

	public function templates_option($data) {
		$get_temps 	= $data['get_temps'];
		$temps 		= $data['temps'];
		$name 		= 'sina-'.$temps;
		$label 		= esc_html__('Sina Templates', 'sina-ext');
		$pro 		= '';
		$checked	= isset($get_temps[ $temps ]) ? 'checked' : '';
		$key		= 'sina_templates_option['.$temps.']';
		require SINA_EXT_ADMIN.'partials/switch.php';
	}

	public function widgets_switcher($data) {
		$widgets 	= $data['get_widgets'];
		$widget 	= $data['widget'];
		$cat 		= $data['cat'];
		$name 		= 'sina-'.$widget;
		$pro 		= ( !defined('SINA_EXT_PRO_VERSION') && ('pro' == $cat || 'wooCommerce' == $cat) ) ? 'sina-ext-pro' : '';
		$checked	= isset($widgets[ $cat ][ $widget ]) ? 'checked' : '';
		$key 		= 'sina_widgets['.$cat.']['. $widget .']';
		$translated = $this->sina_widgets;

		if ( isset($translated[$cat][$widget]) ) {
			$label 	= $translated[$cat][$widget];
		} else{
			$label 	= $data['translate'];
		}

		require SINA_EXT_ADMIN.'partials/switch.php';
	}

	public function extenders_switcher($data) {
		$extender 	= $data['extender'];
		$key 		= 'sina_extenders['.$extender.']';
		$pro 		= ( !defined('SINA_EXT_PRO_VERSION') && 'pro' == $data['type'] ) ? 'sina-ext-pro' : '';
		$checked 	= isset($data[ 'get_extenders' ][ $extender ]) ? 'checked' : '';
		$name 		= 'sina-'.$extender;
		$translated = $this->sina_extenders;

		if ( isset($translated[ $data['type'] ][$extender]) ) {
			$label 	= $translated[ $data['type'] ][$extender];
		} else{
			$label 	= $data['translate'];
		}

		require SINA_EXT_ADMIN.'partials/switch.php';
	}
}