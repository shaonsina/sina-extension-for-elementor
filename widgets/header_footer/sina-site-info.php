<?php

/**
 * Site Info Widget.
 *
 * @since 3.7.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Site_Info_Widget extends Widget_Base{

	/**
	 * Get widget name.
	 *
	 * @since 3.7.0
	 */
	public function get_name() {
		return 'sina_site_info';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.7.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Site Info', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.7.0
	 */
	public function get_icon() {
		return 'eicon-site-title';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.7.0
	 */
	public function get_categories() {
		return [ 'sina-header-footer' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.7.0
	 */
	public function get_keywords() {
		return [ 'sina site info', 'sina site title', 'sina site tagline', 'sina site copyright', 'sina header', 'sina footer' ];
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
		$get_extenders 	= get_option( 'sina_extenders' );
		// Start Site Info
		// ================
			$this->start_controls_section(
				'site_info_content',
				[
					'label' => esc_html__( 'Site Info', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_CONTENT,
				]
			);

				$this->add_control(
					'site_info_title',
					[
						'label' => esc_html__( 'Show Site Title', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'site_info_tagline',
					[
						'label' => esc_html__( 'Show Site Tagline', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'yes',
					]
				);
				$this->add_control(
					'site_info_copyright',
					[
						'label' => esc_html__( 'Show Site Copyright', 'sina-ext' ),
						'type' => Controls_Manager::SWITCHER,
					]
				);
				$this->add_control(
					'site_info_copyright_text',
					[
						'label' => esc_html__( 'Copyright Text', 'sina-ext' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '© {{current_year}} {{site_link}} All Rights Reserved',
						'condition' => [
							'site_info_copyright' => 'yes',
						]
					]
				);
				$this->add_control(
					'site_info_is_link',
					[
						'label' => esc_html__( 'Link', 'sina-ext' ),
						'type' => Controls_Manager::SELECT,
						'options' => [
							'' => esc_html__( 'none', 'sina-ext' ),
							'dynamic' => esc_html__( 'Dynamic', 'sina-ext' ),
							'custom' => esc_html__( 'Custom', 'sina-ext' ),
						],
						'default' => 'dynamic',
					]
				);
				$this->add_control(
					'site_info_link',
					[
						'label' => esc_html__( 'Custom Link', 'sina-ext' ),
						'type' => Controls_Manager::URL,
						'placeholder' => 'https://your-link.com',
						'default' => [
							'url' => '#',
						],
						'condition' => [
							'site_info_is_link' => 'custom',
						]
					]
				);

			$this->end_controls_section();
		// End Site Info
		// ==============


		// Start Site Title Style
		// =======================
			$this->start_controls_section(
				'site_info_title_style',
				[
					'label' => esc_html__( 'Title', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'site_info_title' => 'yes',
					]
				]
			);
			Sina_Common_Data::site_info( $this, '.elementor-element-{{ID}} .sina-site-info-title', 'site_info_title', true );
			$this->end_controls_section();
		// End Site Title Style
		// =====================

		// Start Site Tagline Style
		// =========================
			$this->start_controls_section(
				'site_info_tagline_style',
				[
					'label' => esc_html__( 'Tagline', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'site_info_tagline' => 'yes',
					]
				]
			);
			Sina_Common_Data::site_info( $this, '.elementor-element-{{ID}} .sina-site-info-tagline', 'site_info_tagline' );
			$this->end_controls_section();
		// End Site Tagline Style
		// =======================

		// Start Site Copyright Style
		// ===========================
			$this->start_controls_section(
				'site_info_copyright_style',
				[
					'label' => esc_html__( 'Copyright', 'sina-ext' ),
					'tab' => Controls_Manager::TAB_STYLE,
					'condition' => [
						'site_info_copyright' => 'yes',
					]
				]
			);
			Sina_Common_Data::site_info( $this, '.elementor-element-{{ID}} .sina-site-info-copyright', 'site_info_copyright', true );
			$this->end_controls_section();
		// End Site Copyright Style
		// =========================

		if (!empty($get_extenders) && isset($get_extenders['sticky'])) {
			// Start Site Sticky Title Style
			// ==============================
				$this->start_controls_section(
					'site_info_sticky_title_style',
					[
						'label' => esc_html__( 'Sticky Title', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
						'condition' => [
							'site_info_title' => 'yes',
						]
					]
				);
				Sina_Common_Data::site_info( $this, '.sina-pro-sticked .elementor-element-{{ID}} .sina-site-info-title', 'site_info_sticky_title', true );
				$this->end_controls_section();
			// End Site Sticky Title Style
			// ============================

			// Start Site Sticky Tagline Style
			// ================================
				$this->start_controls_section(
					'site_info_sticky_tagline_style',
					[
						'label' => esc_html__( 'Sticky Tagline', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
						'condition' => [
							'site_info_tagline' => 'yes',
						]
					]
				);
				Sina_Common_Data::site_info( $this, '.sina-pro-sticked .elementor-element-{{ID}} .sina-site-info-tagline', 'site_info_sticky_tagline' );
				$this->end_controls_section();
			// End Site Sticky Tagline Style
			// ==============================

			// Start Site Sticky Copyright Style
			// ==================================
				$this->start_controls_section(
					'site_info_sticky_copyright_style',
					[
						'label' => esc_html__( 'Sticky Copyright', 'sina-ext' ),
						'tab' => Controls_Manager::TAB_STYLE,
						'condition' => [
							'site_info_copyright' => 'yes',
						]
					]
				);
				Sina_Common_Data::site_info( $this, '.sina-pro-sticked .elementor-element-{{ID}} .sina-site-info-copyright', 'site_info_sticky_copyright', true );
				$this->end_controls_section();
			// End Site Sticky Copyright Style
			// ================================
		}
	}


	protected function render() {
		$data = $this->get_settings_for_display();

		if ('dynamic' == $data['site_info_is_link']) {
			$link = home_url( '/' );
		} elseif ( 'custom' == $data['site_info_is_link'] ) {
			$link = $data['site_info_link']['url'];
		}
		?>
		<div class="sina-site-info"">
			<?php if ('yes' == $data['site_info_title']): ?>
				<h1 class="sina-site-info-title"><?php echo $this->get_site_link($data, $link); ?></h1>
			<?php endif; ?>

			<?php if ('yes' == $data['site_info_tagline']): ?>
				<p class="sina-site-info-tagline"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>

			<?php if ('yes' == $data['site_info_copyright']):
				$copyright = str_replace('{{current_year}}', date('Y'), $data['site_info_copyright_text']);
				$copyright = str_replace('{{site_link}}', $this->get_site_link($data, $link), $copyright);
				?>
				<p class="sina-site-info-copyright">
					<?php printf( '%s', $copyright ); ?>
				</p>
			<?php endif; ?>
		</div><!-- .sina-site-info -->
		<?php
	}


	private function get_site_link($data, $link) {
		if ($data['site_info_is_link']) {
			ob_start();
			?>
			<a href="<?php echo esc_url( $link ); ?>"
				<?php if ('custom' == $data['site_info_is_link']): ?>
					<?php if ( 'on' == $data['site_info_link']['is_external'] ): ?>
						target="_blank"
					<?php endif; ?>
					<?php if ( 'on' == $data['site_info_link']['nofollow'] ): ?>
						rel="nofollow"
					<?php endif; ?>
				<?php endif ?>
				><?php bloginfo( 'name' ); ?>
			</a>
			<?php
			return ob_get_clean();
		} else{
			return get_bloginfo( 'name' );
		}
	}


	protected function content_template() {

	}
}