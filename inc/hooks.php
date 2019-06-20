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
		$inbox = sanitize_text_field( $_POST['inbox'] );
		$err = '';

		if ( '' == $name) {
			$err = __( 'Name can\'t be empty!', 'sina-ext' );
		} elseif ( strlen($name) < 3 ) {
			$err = __( 'Name too short! Must be contain 3-20 characters.', 'sina-ext' );
		} elseif ( strlen($name) > 32 ) {
			$err = __( 'Name too large! Must be contain 3-20 characters.', 'sina-ext' );
		} elseif ( preg_match("/^[a-zA-Z][ a-zA-Z0-9]{2,19}$/", $name) ) {
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

			if ( '' == $err  && $inbox ) {
				$custom_email = get_option('sina_contact_email'.$inbox);
				wp_mail( $custom_email, $subject, $message, "From: {$email}\r\n" );
			} elseif ( '' == $err ) {
				$admin_email = get_option('admin_email');
				wp_mail( $admin_email, $subject, $message, "From: {$email}\r\n" );
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
		$thumb_right = sanitize_text_field( $_POST['thumb_right'] );
		$layout = sanitize_text_field( $_POST['layout'] );

		// Post Query
		$post_query = new WP_Query( $default );

		if ( $post_query->have_posts() ) {
			?>
			<div class="sina-ajax-posts">
				<?php if ( 'grid' == $layout || 'list' == $layout): ?>
					<?php include realpath( SINA_EXT_LAYOUT.'/blogpost/'.$layout.'.php' ); ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
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