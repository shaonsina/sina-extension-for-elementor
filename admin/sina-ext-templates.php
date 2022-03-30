<?php namespace Sina_Extension;use Elementor\Plugin;use Elementor\TemplateLibrary\Source_Base;use Elementor\TemplateLibrary\Source_Local;use Elementor\Core\Common\Modules\Ajax\Module as Ajax;use Elementor\User;class Sina_Ext_Templates_Library{public static function init(){if(!empty(get_option('sina_templates_option'))){add_action('elementor/init',[__CLASS__,'register_source']);add_action('elementor/editor/after_enqueue_scripts',[__CLASS__,'enqueue_editor_scripts']);add_action('elementor/ajax/register_actions',[__CLASS__,'register_ajax_actions']);add_action('elementor/editor/footer',[__CLASS__,'render_template']);}}public static function logo(){return defined('SINA_EXT_PRO_URL')?SINA_EXT_PRO_URL.'assets/img/logo.png':SINA_EXT_URL.'admin/assets/img/logo.png';}public static function register_source(){Plugin::$instance->templates_manager->register_source(__NAMESPACE__.'\Sina_Ext_Templates_Source');}public static function enqueue_editor_scripts(){wp_enqueue_script('sina-templates-lib',SINA_EXT_URL.'admin/assets/js/sina-templates-lib.min.js',['jquery','backbone-marionette','backbone-radio','elementor-common-modules','elementor-dialog',],SINA_EXT_VERSION,true);wp_localize_script('sina-templates-lib','sina_ext_templates_lib',array('logoUrl'=>self::logo(),));}public static function register_ajax_actions(Ajax $ajax){$library_ajax_requests=['sina_get_library_data',];foreach($library_ajax_requests as $ajax_request){$ajax->register_ajax_action($ajax_request,function($data)use($ajax_request){return self::handle_ajax_request($ajax_request,$data);});}}private static function handle_ajax_request($ajax_request,array $data){if(!User::is_current_user_can_edit_post_type(Source_Local::CPT)){throw new \Exception('Access Denied');}if(!empty($data['editor_post_id'])){$editor_post_id=absint($data['editor_post_id']);if(!get_post($editor_post_id)){throw new \Exception(__('Post not found.','sina-ext'));}Plugin::$instance->db->switch_to_post($editor_post_id);}$result=call_user_func([__CLASS__,$ajax_request],$data);if(is_wp_error($result)){throw new \Exception($result->get_error_message());}return $result;}public static function sina_get_library_data(array $args){$library_data=self::get_library_data(!empty($args['sync']));Plugin::$instance->documents->get_document_types();return['templates'=>self::get_templates(),'config'=>$library_data['types_data'],];}public static function get_library_data($force_update=false){return self::get_templates_data($force_update);}private static function get_templates_data($force_update=false){$type=get_option('sina_ext_type');$key=('pro'==$type)?get_option('sina_ext_pro_license_key'):get_option('sina_ext_license_key');$url=self::$api_info_url.'&type='.$type.'&dom='.get_option('siteurl').'&key='.$key.'&version='.SINA_EXT_VERSION;$response=wp_remote_get($url,['timeout'=>60]);$info_data=json_decode(wp_remote_retrieve_body($response),true);$templates=[];if(isset($info_data['library']['templates'])&&!empty($info_data['library']['templates'])){$templates=$info_data['library'];}return $templates;}public static function get_templates(){$source=Plugin::$instance->templates_manager->get_source('sina_ext');return $source->get_items();}public static function ajax_reset_api_data(){check_ajax_referer('elementor_reset_library','_nonce');self::get_templates_data(true);wp_send_json_success();}public static function get_template_content($template_id){$type=get_option('sina_ext_type');$key=('pro'==$type)?get_option('sina_ext_pro_license_key'):get_option('sina_ext_license_key');$url=sprintf(self::$api_get_template_content_url.'&type='.$type.'&dom='.get_option('siteurl').'&key='.$key,$template_id);$response=wp_remote_get($url,['timeout'=>60]);$data=json_decode(wp_remote_retrieve_body($response),true);$response_code=(int) wp_remote_retrieve_response_code($response);if(!$response_code){return new \WP_Error(500,'No Response');}if(false===$data){return new \WP_Error(422,'Wrong Server Response');}return $data;}public static function render_template(){ ?>
		<script type="text/template" id="tmpl-elementor-template-library-header-actions-sina-ext">
			<div id="elementor-template-library-header-sync" class="elementor-templates-modal__header__item">
				<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e('Sync Templates','sina-ext'); ?>"></i>
				<span class="elementor-screen-only"><?php echo esc_html__('Sync Templates','sina-ext'); ?></span>
			</div>
		</script>
		<script type="text/template" id="tmpl-elementor-templates-modal__header__logo-sina-ext">
			<span class="elementor-templates-modal__header__logo__icon-wrapper">
				<img src="<?php echo esc_url(self::logo()); ?>" style="height: 30px;" />
			</span>
			<span class="elementor-templates-modal__header__logo__title">{{{ title }}}</span>
		</script>
		<script type="text/template" id="tmpl-elementor-template-library-header-preview-sina-ext">
			<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
				{{{ sina_ext_templates_lib.templates.layout.getTemplateActionButton( obj ) }}}
			</div>
		</script>
		<script type="text/template" id="tmpl-elementor-template-library-templates-sina-ext">
			<#
				var activeSource = sina_ext_templates_lib.templates.getFilter('source');
			#>
			<div id="elementor-template-library-toolbar">
				<# if ( 'sina_ext' === activeSource ) {
					var activeType = sina_ext_templates_lib.templates.getFilter('type');
					#>
					<div id="elementor-template-library-filter-toolbar-remote" class="elementor-template-library-filter-toolbar">
						<# if ( 'new_page' === activeType ) { #>
							<div id="elementor-template-library-order">
								<input type="radio" id="elementor-template-library-order-new" class="elementor-template-library-order-input" name="elementor-template-library-order" value="date">
								<label for="elementor-template-library-order-new" class="elementor-template-library-order-label"><?php echo esc_html__('New','sina-ext'); ?></label>
								<input type="radio" id="elementor-template-library-order-trend" class="elementor-template-library-order-input" name="elementor-template-library-order" value="trendIndex">
								<label for="elementor-template-library-order-trend" class="elementor-template-library-order-label"><?php echo esc_html__('Trend','sina-ext'); ?></label>
								<input type="radio" id="elementor-template-library-order-popular" class="elementor-template-library-order-input" name="elementor-template-library-order" value="popularityIndex">
								<label for="elementor-template-library-order-popular" class="elementor-template-library-order-label"><?php echo esc_html__('Popular','sina-ext'); ?></label>
							</div>
						<# } else {
							var config = sina_ext_templates_lib.templates.getConfig( activeType );
							if ( config.categories ) { #>
								<div id="elementor-template-library-filter">
									<select id="elementor-template-library-filter-subtype" class="elementor-template-library-filter-select" data-elementor-filter="subtype">
										<option></option>
										<# config.categories.forEach( function( category ) {
											var selected = category === sina_ext_templates_lib.templates.getFilter( 'subtype' ) ? ' selected' : '';
											#>
											<option value="{{ category }}"{{{ selected }}}>{{{ category }}}</option>
										<# } ); #>
									</select>
								</div>
							<# }
						} #>
						<div id="elementor-template-library-my-favorites">
							<# var checked = sina_ext_templates_lib.templates.getFilter( 'favorite' ) ? ' checked' : ''; #>
							<input id="elementor-template-library-filter-my-favorites" type="checkbox"{{{ checked }}}>
							<label id="elementor-template-library-filter-my-favorites-label" for="elementor-template-library-filter-my-favorites">
								<i class="eicon" aria-hidden="true"></i>
								<?php echo esc_html__('My Favorites','sina-ext'); ?>
							</label>
						</div>
					</div>
				<# } #>
				<div id="elementor-template-library-filter-text-wrapper">
					<label for="elementor-template-library-filter-text" class="elementor-screen-only"><?php echo esc_html__('Search Templates:','sina-ext'); ?></label>
					<input id="elementor-template-library-filter-text" placeholder="<?php echo esc_attr__('Search','sina-ext'); ?>">
					<i class="eicon-search"></i>
				</div>
			</div>
			<div id="elementor-template-library-templates-container"></div>
			<# if ( 'sina_ext' === activeSource ) { #>
				<div id="elementor-template-library-footer-banner">
					<img class="elementor-nerd-box-icon" src="<?php echo esc_url(ELEMENTOR_ASSETS_URL.'images/information.svg'); ?>" />
					<div class="elementor-excerpt"><?php echo esc_html__('Stay tuned! More awesome templates coming real soon.','sina-ext'); ?></div>
				</div>
			<# } #>
		</script>
		<script type="text/template" id="tmpl-elementor-template-library-template-sina-ext">
			<div class="elementor-template-library-template-body">
				<# if ( 'page' === type ) { #>
					<div class="elementor-template-library-template-screenshot" style="background-image: url({{ thumbnail }});"></div>
				<# } else { #>
					<img src="{{ thumbnail }}">
				<# } #>
				<div class="elementor-template-library-template-preview">
					<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
				</div>
			</div>
			<div class="elementor-template-library-template-footer">
				{{{ sina_ext_templates_lib.templates.layout.getTemplateActionButton( obj ) }}}
				<div class="elementor-template-library-template-name">{{{ title }}} - {{{ type }}}</div>
				<div class="elementor-template-library-favorite">
					<input id="elementor-template-library-template-{{ template_id }}-favorite-input" class="elementor-template-library-template-favorite-input" type="checkbox"{{ favorite ? " checked" : "" }}>
					<label for="elementor-template-library-template-{{ template_id }}-favorite-input" class="elementor-template-library-template-favorite-label">
						<i class="eicon-heart-o" aria-hidden="true"></i>
						<span class="elementor-screen-only"><?php echo esc_html__('Favorite','sina-ext'); ?></span>
					</label>
				</div>
			</div>
		</script>
		<script type="text/template" id="tmpl-elementor-template-library-get-pro-button-sina-ext">
			<a class="elementor-template-library-template-action elementor-button elementor-go-pro" href="https://sina-extension.sinaextra.com/?utm_source=panel-library&utm_campaign=gopro&utm_medium=wp-dash" target="_blank">
				<i class="eicon-external-link-square" aria-hidden="true"></i>
				<span class="elementor-button-title"><?php echo __('Go Pro','sina-ext'); ?></span>
			</a>
		</script>
		<script type="text/template" id="tmpl-elementor-pro-template-library-activate-license-button-sina-ext">
			<a class="elementor-template-library-template-action elementor-button elementor-go-pro" href="<?php echo admin_url('/admin.php?page=sina_ext_settings'); ?>" target="_blank">
				<i class="eicon-external-link-square"></i>
				<span class="elementor-button-title"><?php _e('Enter License Key','sina-ext'); ?></span>
			</a>
		</script>
		<?php }public static $api_info_url='https://sinaextra.com/api/v1/sina-ext/get/?data=lib';private static $api_get_template_content_url='https://sinaextra.com/api/v1/sina-ext/get/?data=%d';}Sina_Ext_Templates_Library::init();class Sina_Ext_Templates_Source extends Source_Base{public function get_id(){return 'sina_ext';}public function get_title(){return esc_html__('Sina Templates','sina-ext');}public function register_data(){}public function get_items($args=[]){$library_data=Sina_Ext_Templates_Library::get_library_data();$templates=[];$pro_status='inactive';$options=get_option('sina_ext_pro_validity');$is_pro=defined('SINA_EXT_PRO_VERSION');if($is_pro&&isset($options['is_license'])&&'active'==$options['is_license']){$pro_status=$options['is_license'];}elseif($is_pro){$pro_status='license_inactive';}if(!empty($library_data['templates'])){foreach($library_data['templates']as $template_data){$data=$this->prepare_template($template_data);$data['proStatus']=$pro_status;$templates[]=$data;}}return $templates;}public function get_item($template_id){$templates=$this->get_items();return $templates[$template_id];}public function save_item($template_data){return new \WP_Error('invalid_request','Cannot save template to a remote source');}public function update_item($new_data){return new \WP_Error('invalid_request','Cannot update template to a remote source');}public function delete_template($template_id){return new \WP_Error('invalid_request','Cannot delete template from a remote source');}public function export_template($template_id){return new \WP_Error('invalid_request','Cannot export template from a remote source');}public function get_data(array $args,$context='display'){$data=Sina_Ext_Templates_Library::get_template_content($args['template_id']);$data=(array) $data;$data['content']=$this->replace_elements_ids($data['content']);$data['content']=$this->process_export_import_content($data['content'],'on_import');$post_id=$args['editor_post_id'];$document=Plugin::$instance->documents->get($post_id);if($document){$data['content']=$document->get_elements_raw_data($data['content'],true);}return $data;}private function prepare_template(array $template_data){$favorite_templates=$this->get_user_meta('favorites');return['template_id'=>$template_data['id'],'source'=>$this->get_id(),'type'=>$template_data['type'],'subtype'=>$template_data['subtype'],'title'=>$template_data['title'],'thumbnail'=>$template_data['thumbnail'],'date'=>$template_data['tmpl_created'],'author'=>$template_data['author'],'tags'=>json_decode($template_data['tags']),'isPro'=>$template_data['is_pro'],'url'=>$template_data['url'],'favorite'=>!empty($favorite_templates[$template_data['id']]),];}}