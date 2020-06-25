<?php

/**
 * Facebook Feed Widget.
 *
 * @since 3.3.0
 */

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
use \Sina_Extension\Sina_Ext_Gradient_Text;


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Sina_Facebook_Feed_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @since 3.3.0
	 */
	public function get_name() {
		return 'sina_facebook_feed';
	}

	/**
	 * Get widget title.
	 *
	 * @since 3.3.0
	 */
	public function get_title() {
		return esc_html__( 'Sina Facebook Feed', 'sina-ext' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 3.3.0
	 */
	public function get_icon() {
		return 'eicon-facebook-comments';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 3.3.0
	 */
	public function get_categories() {
		return [ 'sina-ext-advanced' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 3.3.0
	 */
	public function get_keywords() {
		return [ 'sina facebook feed', 'sina facebook post', 'sina facebook page' ];
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve the list of styles the widget belongs to.
	 *
	 * @since 3.3.0
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
	 * @since 3.3.0
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
	 * @since 3.3.0
	 * @access protected
	 */
	protected function _register_controls() {
		// Start Feed Content
		// ===================
		$this->start_controls_section(
			'feed_content',
			[
				'label' => esc_html__( 'Feed Content', 'sina-ext' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();
		// End Feed Content
		// =================
	}


	protected function render() {
		$data = $this->get_settings_for_display();
		$data['page_id'] = '120432114814310';
		$facebook_data = wp_remote_get( "https://graph.facebook.com/v7.0/120432114814310/posts?fields=status_type,created_time,from,message,story,full_picture,permalink_url,attachments.limit(1){type,media_type,title,description,unshimmed_url},comments.summary(total_count),reactions.summary(total_count)&access_token=EAAv9UUM5ZCcABAGXKFiNHNNPUpYoaArBt5aCWYXxaORWzUtsbKORb0mY4OxztV4BWH7sbQqj3d7lmRQ6aQKlSlnwSHCAsmLj16997R3ZCxd2eQmGgvSLBP0perJWgUdn8NOYSZBZAQT9uYWsn7EcZAzfjGnIsupZACqNFVhHxc6z6zGLvq1uARwhXRSgdmbUdORTgooFnZA5wZDZD" );

		$facebook_data = json_decode( $facebook_data['body'], true );
		$facebook_data = isset($facebook_data['data']) ? $facebook_data['data'] : [];
		?>
		<div class="sina-facebook-feed">
			<?php foreach ( $facebook_data as $key => $post ): ?>
				<div class="sina-fb-post">
					<?php
						$likes 	= isset($post['reactions']) ? $post['reactions']['summary']['total_count'] : 0;
						$comnts = isset($post['comments']) ? $post['comments']['summary']['total_count'] : 0;
						if ( true && isset( $post['attachments']['data'][0] ) ):
							$post_data = $post['attachments']['data'][0];
							if ( 'photo' == $post_data['media_type'] || 'video' == $post_data['media_type'] ):
								if ( isset($post['full_picture']) ):
									?>
									<div class="sina-fb-thumb">
										<?php if ( 'photo' == $post_data['media_type'] ): ?>
											<a href="<?php echo esc_url( $post['permalink_url'] ) ?>">
												<img src="<?php echo esc_url( $post['full_picture'] ); ?>">
											</a>
										<?php else: ?>
											<img src="<?php echo esc_url( $post['full_picture'] ); ?>">
											<a class="sina-fb-video"
											href="<?php echo esc_url( $post_data['unshimmed_url'] ) ?>">
												<i class="fa fa-play far fa-play-circle"></i>
											</a>
										<?php endif ?>
									</div>
									<?php
								endif;
							endif;
								if ( isset($post_data['title']) ):
									?>
									<h3 class="sina-fb-title">
										<a href="<?php echo esc_url( $post['permalink_url'] ) ?>">
										<?php echo esc_html( $post_data['title'] ); ?>
										</a>
									</h3>
									<?php
								endif;
						endif;
					?>
					<div class="sina-fb-page-name">
						<a href="<?php echo esc_url( 'https://www.facebook.com/'. $data['page_id'] ); ?>"
						target="_blank">
							<img width="32px" height="32px" src="<?php echo esc_url( 'https://graph.facebook.com/v7.0/'. $data['page_id'] .'/picture' ); ?>" alt="<?php echo esc_attr( $post['from']['name'] ); ?>">
							<?php echo esc_html( $post['from']['name'] ); ?>
						</a>
					</div>
					<div class="sina-fb-post-meta clearfix">
						<div class="sina-fb-post-time">
							<i class="fa fa-clock-o far fa-clock"></i> <?php echo esc_html( date( "d M Y", strtotime( $post['created_time'] ) ) ); ?>
						</div>
						<div class="sina-fb-post-info">
							<span class="sina-fb-post-comments">
								<i class="far fa-comments fa fa-comments-o"></i>
								<?php echo esc_html($comnts); ?>
							</span>
							<span class="sina-fb-post-likes">
								<i class="far fa-thumbs-up fa fa-thumbs-o-up"></i>
								<?php echo esc_html($comnts); ?>
							</span>
						</div>
					</div>


					<?php if ( isset($post['message']) ): ?>
						<div class="sina-fb-content"><?php echo wp_trim_words( $post['message'], 10 ); ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach ?>
		</div><!-- .sina-facebook-feed -->
		<?php
	}


	protected function _content_template() {

	}
}