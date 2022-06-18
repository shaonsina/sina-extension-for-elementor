<?php
namespace Sina_Extension;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Css_Filter;

/**
 * Sina_Ext_Controls Class for extends controls
 *
 * @since 3.0.1
 */
class Sina_Ext_Controls{
	/**
	 * Instance
	 *
	 * @since 3.1.13
	 * @var Sina_Ext_Controls The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 3.1.13
	 * @return Sina_Ext_Controls An Instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->controls_files();

		add_action('elementor/controls/register', [$this, 'controls'], 15 );
		add_action('elementor/element/common/_section_style/before_section_end', [$this, 'register_controls']);
	}

	private function controls_files(){
		require_once SINA_EXT_INC .'controls/icon.php';
		require_once SINA_EXT_INC .'controls/gradient-text.php';
	}

	public function controls( $manager ) {
		$manager->unregister( $manager::ICON );
		$manager->register( new \Sina_Extension\Sina_Ext_Icon());
		$manager->add_group_control( Sina_Ext_Gradient_Text::get_type(), new \Sina_Extension\Sina_Ext_Gradient_Text());
	}

	public function register_controls($elems) {
		$elems->add_control(
			'sina_is_morphing_animation',
			[
				'label' => '<strong>'.esc_html__( 'Sina Morphing Animation', 'sina-ext' ).'</strong>',
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);
		$elems->add_control(
			'sina_is_morphing_pattern',
			[
				'label' => esc_html__( 'Morphing Pattern', 'sina-ext' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Pattern 1', 'sina-ext' ),
					'pattern-2' => esc_html__( 'Pattern 2', 'sina-ext' ),
					'pattern-3' => esc_html__( 'Pattern 3', 'sina-ext' ),
					'pattern-4' => esc_html__( 'Pattern 4', 'sina-ext' ),
				],
				'prefix_class' => 'sina-morphing-anim-',
				'default' => 'yes',
				'condition' => [
					'sina_is_morphing_animation' => 'yes',
				],
			]
		);
	}
}