<?php 

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function sina_ajax_contact(){
	if ( check_ajax_referer( 'sina_contact', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_contact' ) ) {

		$email = sanitize_email( $_POST['email'] );
		$name = sanitize_text_field( $_POST['name'] );
		$subject = sanitize_text_field( $_POST['subject'] );
		$message = sanitize_textarea_field( $_POST['message'] );
		$admin_email = get_option('admin_email');
		$err = '';

		if ( '' == $name) {
			$err = __( 'Name can\'t be empty!', 'sina-ext' );
		} elseif ( strlen($name) < 3 ) {
			$err = __( 'Name too short! Must be contain 3-20 characters.', 'sina-ext' );
		} elseif ( strlen($name) > 32 ) {
			$err = __( 'Name too large! Must be contain 3-20 characters.', 'sina-ext' );
		} elseif ( preg_match("/^[a-zA-Z][ a-z0-9]{2,19}$/", $name) ) {
			$name = $name;
		} else {
			$err = __( 'Special character(s) not allowed in your name!', 'sina-ext' );
		}

		if ( '' == $err ) {
			if ( '' == $email) {
				$err = __( 'Invalid email!', 'sina-ext' );
			}
		}

		if ( '' == $err ) {
			if ( '' == $subject) {
				$err = __( 'Subject can\'t be empty!', 'sina-ext' );
			} elseif ( strlen($subject) < 3 ) {
				$err = __( 'Subject too short! Must be contain 3-200 characters.', 'sina-ext' );
			} elseif ( strlen($subject) > 200 ) {
				$err = __( 'Subject too large! Must be contain 3-200 characters.', 'sina-ext' );
			} elseif ( $subject ) {
				$subject = $subject;
			} else{
				$err = __( 'Invalid subject!', 'sina-ext' );
			}
		}

		if ( '' == $err ) {
			if ( '' == $message) {
				$err = __( 'Message can\'t be empty!', 'sina-ext' );
			} elseif ( strlen($message) < 3 ) {
				$err = __( 'Message too short! Must be contain 3-2000 characters.', 'sina-ext' );
			} elseif ( strlen($message) > 2000 ) {
				$err = 'Message too large! Must be contain 3-2000 characters.';
			} elseif ( $message ) {
				$message = $message;
			} else{
				$err = __( 'Invalid message!', 'sina-ext' );
			}

			if ( '' == $err ) {
				wp_mail( $email, $subject, $message, "From: {$admin_email}\r\n" );
			}
		}
		echo esc_html( $err );
	}
	die();
}
add_action( 'wp_ajax_sina_contact', 'sina_ajax_contact' );
add_action( 'wp_ajax_nopriv_sina_contact', 'sina_ajax_contact' );


function sina_ajax_load_more_posts() {
	if ( check_ajax_referer( 'sina_load_more_posts', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_load_more_posts' ) ) {

		$default = [
			'cat'				=> sanitize_text_field( $_POST['categories'] ),
			'posts_per_page'	=> (int) sanitize_text_field( $_POST['posts_num'] ),
			'offset'			=> (int) sanitize_text_field( $_POST['offset'] ),
			'has_password'		=> false,
			'post_status'		=> 'publish',
			'post__not_in'		=> get_option( 'sticky_posts' ),
		];
		$columns = sanitize_text_field( $_POST['columns'] );
		$excerpt = sanitize_text_field( $_POST['excerpt'] );
		$content_length = (int) sanitize_text_field( $_POST['content_length'] );
		$posts_meta = sanitize_text_field( $_POST['posts_meta'] );

		// Post Query
		$post_query = new WP_Query( $default );

		if ( $post_query->have_posts() ) {
			?>
			<div class="sina-ajax-posts">
			<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
					<div class="sina-bp-col <?php echo esc_attr( $columns ) ?>">
						<div class="sina-bp">
							<?php if ( has_post_thumbnail() ): ?>
								<div class="sina-bg-thumb">
									<?php the_post_thumbnail(); ?>
								</div>
							<?php endif; ?>
							<div class="sina-bp-content">
								<h2 class="sina-bp-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="sina-bp-text">
									<?php
										if ( has_excerpt() && 'yes' == $excerpt ):
											$excerpt = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_excerpt() );
											echo wp_kses_post( wp_trim_words( $excerpt, $content_length ) );
										else:
											$content = preg_replace( '/'. get_shortcode_regex() .'/', '', get_the_content() );
											echo wp_kses_post( wp_trim_words( $content, $content_length ) );
										endif;
									?>
								</div>
								<?php if ( 'yes' == $posts_meta ): ?>
									<div class="sina-bp-meta">
										<?php _e('by', 'sina-ext'); ?>
										<?php the_author_posts_link(); ?>
										|
										<?php echo esc_html( get_the_date() ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
			<?php endwhile; wp_reset_query(); ?>
			</div>
			<?php
		}
	}
	die();
}
add_action( 'wp_ajax_sina_load_more_posts', 'sina_ajax_load_more_posts' );
add_action( 'wp_ajax_nopriv_sina_load_more_posts', 'sina_ajax_load_more_posts' );


function sina_ajax_user_counter() {
	if ( check_ajax_referer( 'sina_user_counter', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_user_counter' ) ) {
		$roles = explode( ',', sanitize_text_field( $_POST['roles'] ) );

		$users = count_users();
		$users = $users['avail_roles'];

		$count = 0;
		if ( !empty($roles) ) {
			foreach ($roles as $role) {
				$count += isset($users[$role]) ? $users[$role] : 0;
			}
		}
		echo esc_html( $count );
	}
	die();
}
add_action( 'wp_ajax_sina_user_counter', 'sina_ajax_user_counter' );
add_action( 'wp_ajax_nopriv_sina_user_counter', 'sina_ajax_user_counter' );


function sina_ajax_visit_counter() {
	if ( check_ajax_referer( 'sina_visit_counter', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_visit_counter' ) ) {

		$page = (int) sanitize_text_field( $_POST['page'] );
		if ( $page > 0 ) {
			$visit_data = get_post_meta( $page, 'sina_visit_counter', true);

			$data = $visit_data['sina_visit_today'] . '|' . $visit_data['sina_visit_yesterday'];
			echo esc_html( $data );
		}
	}
	die();
}
add_action( 'wp_ajax_sina_visit_counter', 'sina_ajax_visit_counter' );
add_action( 'wp_ajax_nopriv_sina_visit_counter', 'sina_ajax_visit_counter' );