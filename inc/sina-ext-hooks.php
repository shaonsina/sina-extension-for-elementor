<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Hooks Class for all widgets related hook functions
 *
 * @since 3.0.0
 */
Class Sina_Ext_Hooks{
	public static function mailchimp_subscribe() {
		if ( check_ajax_referer( 'sina_mc_subscribe', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_mc_subscribe' ) ) {

			$email = sanitize_email( $_POST['email'] );
			$fname = sanitize_text_field( $_POST['fname'] );
			$lname = sanitize_text_field( $_POST['lname'] );
			$phone = sanitize_text_field( $_POST['phone'] );
			$status = 'subscribed';
			$err = '';

			if ( '' == $fname) {
				$fname = $fname;
			} elseif ( strlen($fname) < 3 ) {
				$err = esc_html__( 'First name too short! Must be contain 3-32 characters.', 'sina-ext' );
			} elseif ( strlen($fname) > 32 ) {
				$err = esc_html__( 'First name too long! Must be contain 3-32 characters.', 'sina-ext' );
			} elseif ( preg_match("/^[a-zA-Z][ a-zA-Z0-9]{2,31}$/", $fname) ) {
				$fname = $fname;
			} else {
				$err = esc_html__( 'Special character(s) not allowed in your first name!', 'sina-ext' );
			}

			if ( '' == $err ) {
				if ( '' == $lname) {
					$lname = $lname;
				} elseif ( strlen($lname) < 3 ) {
					$err = esc_html__( 'Last name too short! Must be contain 3-32 characters.', 'sina-ext' );
				} elseif ( strlen($lname) > 32 ) {
					$err = esc_html__( 'Last name too long! Must be contain 3-32 characters.', 'sina-ext' );
				} elseif ( preg_match("/^[a-zA-Z][ a-zA-Z0-9]{2,31}$/", $lname) ) {
					$lname = $lname;
				} else {
					$err = esc_html__( 'Special character(s) not allowed in your last name!', 'sina-ext' );
				}
			}

			if ( '' == $err ) {
				if ( '' == $email) {
					$err = esc_html__( 'Invalid email!', 'sina-ext' );
				}
			}

			if ( '' == $err ) {
				if ( '' == $phone ) {
					$phone = $phone;
				} elseif ( preg_match("/^[0-9\(\+][ 0-9-\(\)]{2,19}$/", $phone) ) {
					$phone = $phone;
				} else {
					$err = esc_html__( 'Invalid phone number!', 'sina-ext' );
				}
			}

			if ( '' == $err ) {
				$mail_chimp = get_option( 'sina_mailchimp' );
				$api_parts = explode( '-', $mail_chimp['apikey'] );
				$list_id = $mail_chimp['list_id'];
				$url = 'https://'.$api_parts[1].'.api.mailchimp.com/3.0/lists/'.$list_id.'/members';

				$args = [
					'method' => 'POST',
					'headers' => [
						'Authorization'	=> 'Basic ' . base64_encode( 'user:'. implode('-', $api_parts) ),
						'Content-Type'	=> 'application/json; charset=utf-8',
					],
					'body' => json_encode( [
						'email_address' => $email,
						'merge_fields'	=> [
							'FNAME' 		=> $fname,
							'LNAME' 		=> $lname,
							'PHONE' 		=> $phone,
						],
						'status'        => $status
					] )
				];

				$response = wp_remote_post( $url, $args );

				if ( is_wp_error( $response ) ) {
					$err = esc_html__("Internal Error!", 'sina-ext');
				} else {
					$body = json_decode( $response['body'] );
					if ( $response['response']['code'] == 200 && $body->status == $status ) {
						$err = 'success';
					} else {
						$err = $body->title.'!';
					}
				}
			}

			die( $err );
		}
		die();
	}

	public static function ajax_contact() {
		if ( check_ajax_referer( 'sina_contact', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_contact' ) ) {

			$email = sanitize_email( $_POST['email'] );
			$name = sanitize_text_field( $_POST['name'] );
			$subject = sanitize_text_field( $_POST['subject'] );
			$message = sanitize_textarea_field( $_POST['message'] );
			$inbox = sanitize_text_field( $_POST['inbox'] );
			$is_captcha	= sanitize_text_field( $_POST['is_captcha'] );
			$captcha = sanitize_text_field( $_POST['captcha'] );
			$err = '';

			if ( '' == $name) {
				$err = esc_html__( 'Name can\'t be empty!', 'sina-ext' );
			} elseif ( strlen($name) < 3 ) {
				$err = esc_html__( 'Name too short! Must be contain 3-32 characters.', 'sina-ext' );
			} elseif ( strlen($name) > 32 ) {
				$err = esc_html__( 'Name too long! Must be contain 3-32 characters.', 'sina-ext' );
			} elseif ( preg_match("/^[a-zA-Z][ a-zA-Z0-9]{2,31}$/", $name) ) {
				$name = $name;
			} else {
				$err = esc_html__( 'Special character(s) not allowed in your name!', 'sina-ext' );
			}

			if ( '' == $err ) {
				if ( '' == $email) {
					$err = esc_html__( 'Invalid email!', 'sina-ext' );
				}
			}

			if ( '' == $err ) {
				if ( '' == $subject) {
					$err = esc_html__( 'Subject can\'t be empty!', 'sina-ext' );
				} elseif ( strlen($subject) < 3 ) {
					$err = esc_html__( 'Subject too short! Must be contain 3-200 characters.', 'sina-ext' );
				} elseif ( strlen($subject) > 200 ) {
					$err = esc_html__( 'Subject too long! Must be contain 3-200 characters.', 'sina-ext' );
				} elseif ( $subject ) {
					$subject = $subject;
				} else{
					$err = esc_html__( 'Invalid subject!', 'sina-ext' );
				}
			}

			if ( '' == $err ) {
				if ( '' == $message) {
					$err = esc_html__( 'Message can\'t be empty!', 'sina-ext' );
				} elseif ( strlen($message) < 3 ) {
					$err = esc_html__( 'Message too short! Must be contain 3-2000 characters.', 'sina-ext' );
				} elseif ( strlen($message) > 2000 ) {
					$err = esc_html__( 'Message too long! Must be contain 3-2000 characters.', 'sina-ext' );
				} elseif ( $message ) {
					$message = $message;
				} else{
					$err = esc_html__( 'Invalid message!', 'sina-ext' );
				}

				if ( '' == $err && 'true' == $is_captcha ) {
					$secret_key = get_option( 'sina_ext_pro_recaptcha_secret_key' );
					$url 		= 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key .'&response='. $captcha;
					$response 	= wp_remote_get( $url );
					$data 		= json_decode( wp_remote_retrieve_body( $response ), true );

					if ( !$data["success"] ) {
						$err = esc_html__( 'Invalid reCAPTCHA!', 'sina-ext' );
					}
				}

				$from_text = sanitize_text_field( $_POST['from_text'] );
				$site_name = get_bloginfo( 'name' );
				$site_name = $from_text ? $from_text : $site_name;
				$headers = 'From: '. $site_name .' <'. $email .'>';
				$message = esc_html__( 'Email: ', 'sina-ext' ).$email."\n\n".$message;
				$message = esc_html__( 'Name: ', 'sina-ext' ).$name."\n".$message;

				if ( '' == $err  && $inbox ) {
					$custom_email = get_option('sina_contact_email'.$inbox);
					wp_mail( $custom_email, $subject, $message, $headers );
				} elseif ( '' == $err ) {
					$admin_email = get_option('admin_email');
					wp_mail( $admin_email, $subject, $message, $headers );
				}
			}
			die( $err );
		}
		die();
	}

	public static function ajax_login() {
		if ( check_ajax_referer( 'sina_login', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_login' ) ) {

			$username = sanitize_text_field( $_POST['email'] );
			$password = sanitize_text_field( $_POST['password'] );
			$remember = sanitize_text_field( $_POST['remember'] );
			$email = sanitize_email( $username );
			$err = '';

			if ( $username ) {
				if ( '' == $email ) {
					$email = $username;
				}
			} else{
				die( esc_html__( 'Username and Email can\'t be empty!', 'sina-ext' ) );
			}

			if ( '' == $password) {
				die( esc_html__( 'Password can\'t be empty!', 'sina-ext' ) );
			} else {
				$rem = $remember == 'true' ? true : false;
				$user = wp_signon( array(
					'user_login'    => $email,
					'user_password' => $password,
					'remember'      => $rem
				) );

				if ( is_wp_error( $user ) ) {
					die( esc_html__( 'Username or Email and password don\'t match!', 'sina-ext' ) );
				}
			}
			die( 'logged in' );
		}
		die();
	}

	public static function ajax_load_more_posts() {
		if ( check_ajax_referer( 'sina_load_more_posts', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_load_more_posts' ) ) {

			$offset = sanitize_text_field( $_POST['offset'] );
			$data = sanitize_text_field( $_POST['posts_data'] );
			$data = json_decode(stripslashes($data), true);
			$content_length = (int) $data['content_length'];

			$default = [
				'category__in'		=> $data['categories'],
				'tag__in'			=> $data['tags'],
				'posts_per_page'	=> (int) $data['posts_num'],
				'offset'			=> (int) $offset,
				'orderby'			=> [ $data['order_by'] => $data['sort'] ],
				'has_password'		=> false,
				'post_status'		=> 'publish',
				'post__not_in'		=> get_option( 'sticky_posts' ),
			];

			// Post Query
			$post_query = new WP_Query( $default );

			if ( $post_query->have_posts() ) {
				?>
				<div class="sina-ajax-posts">
					<?php if ( 'grid' == $data['layout'] || 'list' == $data['layout']): ?>
						<?php include realpath( SINA_EXT_LAYOUT.'/blogpost/'.$data['layout'].'.php' ); ?>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</div>
				<?php
			}
		}
		die();
	}

	public static function ajax_user_counter() {
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
			die( strval($count) );
		}
		die();
	}

	public static function ajax_visit_counter() {
		if ( check_ajax_referer( 'sina_visit_counter', 'nonce') && wp_verify_nonce( $_POST['nonce'], 'sina_visit_counter' ) ) {

			$page = (int) sanitize_text_field( $_POST['page'] );
			if ( $page > 0 ) {
				$visit_data = get_post_meta( $page, 'sina_visit_counter', true);

				$data = $visit_data['sina_visit_today'] . '|' . $visit_data['sina_visit_yesterday'];
				die( $data );
			}
		}
		die();
	}

	public static function redirect_after_logout(){
		$logout_url = get_option( 'sina_ext_after_logout_url' );
		wp_safe_redirect( $logout_url );
		exit;
	}
}

$sina_ext_logout_url = get_option( 'sina_ext_after_logout_url' );
if ( $sina_ext_logout_url ) {
	add_action( 'wp_logout', ['Sina_Ext_Hooks', 'redirect_after_logout' ]);
}