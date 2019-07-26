<?php
namespace Elementor\TemplateLibrary;

use \Elementor\Plugin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sina_Ext_Library Class for remote library.
 *
 * @since 2.4.0
 */
class Sina_Ext_Library extends Source_Base {

	/**
	 * New library option key.
	 */
	const SINA_LIBRARY_OPTION_KEY = 'sina_remote_info_library';

	/**
	 * Prepend library option key.
	 */
	const SINA_LIBRARY_PREPEND_OPTION_KEY = 'sina_prepend_remote_info_library';

	/**
	 * Timestamp cache key to trigger library sync.
	 */
	const SINA_TIMESTAMP_CACHE_KEY = 'sina_remote_update_timestamp';

	/**
	 * Get remote template ID.
	 *
	 * @since 2.4.0
	 */
	public function get_id() {
		return 'remote';
	}

	/**
	 * Get remote template title.
	 *
	 * @asince 2.4.0
	 */
	public function get_title() {
		return __( 'Remote', 'sina-ext' );
	}

	/**
	 * Register remote template data.
	 *
	 * @since 2.4.0
	 */
	public function register_data() {}

	/**
	 * Save remote template.
	 *
	 * @since 2.4.0
	 */
	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to a remote source' );
	}

	/**
	 * Update remote template.
	 *
	 * @since 2.4.0
	 */
	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to a remote source' );
	}

	/**
	 * Delete remote template.
	 *
	 * @since 2.4.0
	 */
	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from a remote source' );
	}

	/**
	 * Export remote template.
	 *
	 * @since 2.4.0
	 */
	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from a remote source' );
	}

	/**
	 * Get remote template data.
	 *
	 * @since 2.4.0
	 */
	public function get_data( Array $args, $context = 'display' ) {
		$data = self::get_template_content( $args['template_id'] );

		if ( is_wp_error( $data ) ) {
			return $data;
		}

		$data['content'] = $this->replace_elements_ids( $data['content'] );
		$data['content'] = $this->process_export_import_content( $data['content'], 'on_import' );

		$post_id = $args['editor_post_id'];
		$document = Plugin::$instance->documents->get( $post_id );
		if ( $document ) {
			$data['content'] = $document->get_elements_raw_data( $data['content'], true );
		}

		return $data;
	}

	/**
	 * Get template content.
	 *
	 * @since 2.4.0
	 */
	public static function get_template_content( $template_id ) {
		if ( $template_id > 10000000) {
			$url = sprintf( self::$api_get_template_content_url.'&dom='.get_option( 'siteurl' ).'&key='.get_option( 'sina_ext_license_key' ), $template_id );
		} else{
			$url = sprintf( 'https://my.elementor.com/api/v1/templates/%d', $template_id );
		}

		$body_args = [
			// Which API version is used.
			'api_version' => ELEMENTOR_VERSION,
			// Which language to return.
			'site_lang' => get_bloginfo( 'language' ),
		];

		/**
		 * API: Template body args.
		 *
		 * @since 2.4.0
		 */
		$body_args = apply_filters( 'elementor/api/get_templates/body_args', $body_args );

		$response = wp_remote_get( $url, [
			'timeout' => 40,
			'body' => $body_args,
		] );

		if ( is_wp_error( $response ) ) {
			return $response;
		}

		$response_code = (int) wp_remote_retrieve_response_code( $response );

		if ( 200 !== $response_code ) {
			return new \WP_Error( 'response_code_error', sprintf( 'The request returned with a status code of %s.', $response_code ) );
		}

		$template_content = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( isset( $template_content['error'] ) ) {
			return new \WP_Error( 'response_error', $template_content['error'] );
		}

		if ( empty( $template_content['data'] ) && empty( $template_content['content'] ) ) {
			return new \WP_Error( 'template_data_error', 'An invalid data was returned.' );
		}

		return $template_content;
	}

	/**
	 * Get remote template.
	 *
	 * @since 2.4.0
	 */
	public function get_item( $template_id ) {
		$templates = $this->get_items();

		return $templates[ $template_id ];
	}

	/**
	 * Get remote templates.
	 *
	 * @since 2.4.0
	 */
	public function get_items( $args = [] ) {
		$library_data = self::get_library_data();
		$templates = [];

		if ( ! empty( $library_data['templates'] ) ) {
			foreach ( $library_data['templates'] as $template_data ) {
				$templates[] = $this->prepare_template( $template_data );
			}
		}
		return $templates;
	}

	/**
	 * Get templates data.
	 *
	 * @since 2.4.0
	 */
	public static function get_library_data( $force_update = false ) {
		self::get_info_data( $force_update );
		$temps = get_option( 'sina_templates_option' );
		if ( isset($temps['sina_templates_merge']) ) {
			$library_data = get_option( self::SINA_LIBRARY_PREPEND_OPTION_KEY );
		} else {
			$library_data = get_option( self::SINA_LIBRARY_OPTION_KEY );
		}

		if ( empty( $library_data ) ) {
			return [];
		}
		return $library_data;
	}

	/**
	 * Get info data.
	 *
	 * @since 2.4.0
	 */
	private static function get_info_data( $force_update = false ) {
		$update_timestamp = get_transient( self::SINA_TIMESTAMP_CACHE_KEY );

		if ( ! $update_timestamp ) {
			$timeout = ( $force_update ) ? 25 : 8;

			$response = wp_remote_get( self::$api_info_url.'&dom='.get_option( 'siteurl' ).'&key='.get_option( 'sina_ext_license_key' ), [
				'timeout' => $timeout,
				'body' => [
					// Which API version is used.
					'api_version' => ELEMENTOR_VERSION,
					// Which language to return.
					'site_lang' => get_bloginfo( 'language' ),
				],
			] );

			if ( is_wp_error( $response ) ) {
				return false;
			}

			$info_data = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( isset( $info_data['library']['templates'] ) ) {
				$default_tems = get_option( 'elementor_remote_info_library' );
				$merge_tems = array_merge($info_data['library']['templates'], $default_tems['templates']);
				$default_tems['templates'] = $merge_tems;
				update_option( self::SINA_LIBRARY_OPTION_KEY, $info_data['library'], 'no' );
				update_option( self::SINA_LIBRARY_PREPEND_OPTION_KEY, $default_tems, 'no' );
			}

			set_transient( self::SINA_TIMESTAMP_CACHE_KEY, time(), HOUR_IN_SECONDS );
			return $info_data;
		}
	}

	/**
	 * @since 2.4.0
	 */
	private function prepare_template( Array $template_data ) {
		$favorite_templates = $this->get_user_meta( 'favorites' );

		return [
			'template_id' => $template_data['id'],
			'source' => $this->get_id(),
			'type' => $template_data['type'],
			'subtype' => $template_data['subtype'],
			'title' => $template_data['title'],
			'thumbnail' => $template_data['thumbnail'],
			'date' => $template_data['tmpl_created'],
			'author' => $template_data['author'],
			'tags' => json_decode( $template_data['tags'] ),
			'isPro' => ( '1' === $template_data['is_pro'] ),
			'popularityIndex' => (int) $template_data['popularity_index'],
			'trendIndex' => (int) $template_data['trend_index'],
			'hasPageSettings' => ( '1' === $template_data['has_page_settings'] ),
			'url' => $template_data['url'],
			'favorite' => ! empty( $favorite_templates[ $template_data['id'] ] ),
		];
	}

	/**
	 * API info URL.
	 *
	 * @since 2.4.0
	 */
	public static $api_info_url = 'https://plugins.shaonsina.com/api/v1/sina-ext/get/?type=free&data=lib';

	/**
	 * API get template content URL.
	 *
	 * @since 2.4.0
	 */
	private static $api_get_template_content_url = 'https://plugins.shaonsina.com/api/v1/sina-ext/get/?type=free&data=%d';
}