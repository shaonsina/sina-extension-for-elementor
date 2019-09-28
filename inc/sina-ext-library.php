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
 * @since 3.0.0
 */
class Sina_Ext_Library extends Source_Base {

	/**
	 * Get remote template ID.
	 *
	 * @since 3.0.0
	 */
	public function get_id() {
		return 'sina_ext_templates';
	}

	/**
	 * Get remote template title.
	 *
	 * @asince 3.0.0
	 */
	public function get_title() {
		return __( 'Sina Templates', 'sina-ext' );
	}

	/**
	 * Register remote template data.
	 *
	 * @since 3.0.0
	 */
	public function register_data() {}

	/**
	 * Save remote template.
	 *
	 * @since 3.0.0
	 */
	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to a remote source' );
	}

	/**
	 * Update remote template.
	 *
	 * @since 3.0.0
	 */
	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to a remote source' );
	}

	/**
	 * Delete remote template.
	 *
	 * @since 3.0.0
	 */
	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from a remote source' );
	}

	/**
	 * Export remote template.
	 *
	 * @since 3.0.0
	 */
	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from a remote source' );
	}

	/**
	 * Get remote template data.
	 *
	 * @since 3.0.0
	 */
	public function get_data( Array $args, $context = 'display' ) {
		$type 		= get_option( 'sina_ext_type' );
		$key 		= ('pro' ==  $type) ? get_option( 'sina_ext_pro_license_key' ) : get_option( 'sina_ext_license_key' );
		$temp_id 	= str_replace( 'sina_ext_', '', $args['template_id'] );
		$url 		= sprintf( self::$api_get_template_content_url.'&type='.$type.'&dom='.get_option( 'siteurl' ).'&key='.$key, $temp_id );
		$response 	= wp_remote_get( $url, ['timeout' => 60] );
		$data 		= json_decode( wp_remote_retrieve_body( $response ), true );
		$template 	= [];

		$template['content'] = $this->replace_elements_ids( $data['content'] );
		$template['content'] = $this->process_export_import_content( $template['content'], 'on_import' );
		$template['page_settings'] = [];

		return $template;
	}

	/**
	 * Get remote template.
	 *
	 * @since 3.0.0
	 */
	public function get_item( $template_data ) {
		$favorite_templates = $this->get_user_meta( 'favorites' );

		return [
			'template_id' => 'sina_ext_'. $template_data['id'],
			'source' => 'remote',
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
			'favorite' => ! empty( $favorite_templates[ 'sina_ext_'.$template_data['id'] ] ),
		];
	}

	/**
	 * Get remote templates.
	 *
	 * @since 3.0.0
	 */

	public function get_items( $args = [] ) {
		$type 		= get_option( 'sina_ext_type' );
		$key 		= ('pro' == $type) ? get_option( 'sina_ext_pro_license_key' ) : get_option( 'sina_ext_license_key' );
		$url 		= self::$api_info_url.'&type='.$type.'&dom='.get_option( 'siteurl' ).'&key='.$key;
		$response 	= wp_remote_get( $url, ['timeout' => 60] );
		$info_data 	= json_decode( wp_remote_retrieve_body( $response ), true );
		$templates 	= [];

		if ( isset( $info_data['library']['templates'] ) && !empty( $info_data['library']['templates'] ) ) {
			$templates_data = $info_data['library']['templates'];
			// update_option( 'elementor_remote_info_library', $info_data['library'], 'no' );
		} else{
			$templates_data = [];
		}

		if ( ! empty( $templates_data ) ) {
			foreach ( $templates_data as $template_data ) {
				$templates[] = $this->get_item( $template_data );
			}
		}

		return $templates;
	}


	/**
	 * API info URL.
	 *
	 * @since 3.0.0
	 */
	public static $api_info_url = 'https://plugins.shaonsina.com/api/v1/sina-ext/get/?data=lib';

	/**
	 * API get template content URL.
	 *
	 * @since 3.0.0
	 */
	private static $api_get_template_content_url = 'https://plugins.shaonsina.com/api/v1/sina-ext/get/?data=%d';
}