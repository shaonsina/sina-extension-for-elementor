<?php 

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue CSS files
 *
 * @since 1.0.0
 */
function sina_widget_styles() {
	wp_enqueue_style( 'owl-carousel', SINA_EXT_URL .'assets/css/owl.carousel.min.css', [], '2.3.4' );
	wp_enqueue_style( 'magnific-popup', SINA_EXT_URL .'assets/css/magnific-popup.min.css', [], '1.1.0' );
	wp_enqueue_style( 'sina-widgets', SINA_EXT_URL .'assets/css/sina-widgets.css', [], SINA_EXT_VERSION );
}

/**
 * Enqueue JS files
 *
 * @since 1.0.0
 */
function sina_widget_scripts() {
	$apikey = get_option( 'sina_map_apikey', true );
	$ajax_url = admin_url('admin-ajax.php');

	wp_register_script( 'imagesLoaded', SINA_EXT_URL .'assets/js/imagesloaded.pkgd.min.js', [], '4.1.4', true );
	wp_register_script( 'typed', SINA_EXT_URL .'assets/js/typed.min.js', ['jquery'], SINA_EXT_VERSION, true );
	wp_register_script( 'jquery-owl', SINA_EXT_URL .'assets/js/owl.carousel.min.js', ['jquery'], '2.3.4', true );
	wp_register_script( 'jquery-particle', SINA_EXT_URL .'assets/js/sina-particles.min.js', ['jquery'], '1.0', true );
	wp_register_script( 'magnific-popup', SINA_EXT_URL .'assets/js/jquery.magnific-popup.min.js', ['jquery'], '1.1.0', true );
	wp_register_script( 'countdown', SINA_EXT_URL .'assets/js/jquery.countdown.min.js', ['jquery'], '2.2.0', true );
	wp_register_script( 'easypiechart', SINA_EXT_URL .'assets/js/jquery.easypiechart.min.js', ['jquery'], '2.1.7', true );
	wp_register_script( 'isotope', SINA_EXT_URL .'assets/js/isotope.min.js', ['jquery', 'imagesLoaded', 'magnific-popup'], '3.0.6', true );
	wp_register_script( 'xzoom', SINA_EXT_URL .'assets/js/xzoom.min.js', ['jquery'], '1.0.14', true );

	if ( $apikey ) {
		wp_register_script( 'sina-google-map', '//maps.google.com/maps/api/js?key='. $apikey, [], SINA_EXT_VERSION, true );
	}
	wp_register_script( 'sina-widgets', SINA_EXT_URL .'assets/js/sina-widgets.js', ['jquery'], SINA_EXT_VERSION, true );
	wp_localize_script( 'sina-widgets', 'sinaAjax', ['ajaxURL' => $ajax_url] );
}
