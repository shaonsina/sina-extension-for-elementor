/* Sina Extension for Elementor v3.7.0 */
;(function ($) {
	"use strict";
	
	var SinaExtThemeBuilder = {
		instance: [],
		templateId: 0,
		init: function init() {
			this.renderPopup();
			$('#sina-ext-hf-s-display-type').select2({
				ajax: {
					url: ajaxurl,
					dataType: 'json',
					method: 'post',
					delay: 200,
					data: function data(params) {
						return {
							q: params.term,
							page: params.page,
							action: 'sina_ext_get_posts_by_query',
							'nonce': Sina_Ext_Theme_Builder.nonce
						};
					},
					processResults: function processResults(data) {
						return {
							results: data
						};
					},
					cache: true
				},
				minimumInputLength: 2
			});

			//open popup onclick
			$('body.post-type-sina-ext-template #wpcontent').on('click', '.page-title-action, .row-title, .row-actions .edit > a', this.openPopup);
			$(document).on('click', '.sina-ext-body-overlay,.sina-ext-template-edit-cross', this.closePopup).on('click', ".sina-ext-tmp-save", this.savePost).on('click', '.sina-ext-tmp-elementor', this.redirectEditPage).on('sina_ext_template_edit_popup_open', this.displayLocation).on('change', '#sina-ext-template-type, #sina-ext-hf-display-type', this.displayLocation);
		},
		// Render Popup HTML
		renderPopup: function renderPopup(event) {
			var popupTmp = wp.template('sina-ext-cpt-popup'),
			content = null;
			content = popupTmp({
				templatetype: Sina_Ext_Theme_Builder.templatetype,
				hflocation: Sina_Ext_Theme_Builder.hflocation,
				archivelocation: Sina_Ext_Theme_Builder.archivelocation,
				singlelocation: Sina_Ext_Theme_Builder.singlelocation,
				otherslocation: Sina_Ext_Theme_Builder.otherslocation,
				editor: Sina_Ext_Theme_Builder.editor,
				heading: Sina_Ext_Theme_Builder.labels
			});
			$('body').append(content);
		},
		// Edit PopUp
		openPopup: function openPopup(event) {
			event.preventDefault();
			var rowId = $(this).closest('tr').attr('id'),
			tmpId = null,
			elementorEditlink = null;
			if (rowId) {
				tmpId = rowId.replace('post-', '');
				elementorEditlink = 'post.php?post=' + tmpId + '&action=elementor';
			}
			$('.sina-ext-tmp-save').attr('data-tmpid', tmpId);
			$('.sina-ext-tmp-elementor').attr({
				'data-link': elementorEditlink,
				'data-tmpid': tmpId
			});
			if (tmpId) {
				//fetch existing template data
				$.ajax({
					url: Sina_Ext_Theme_Builder.ajaxurl,
					data: {
						'action': 'sina_ext_get_template',
						'nonce': Sina_Ext_Theme_Builder.nonce,
						'tmpId': tmpId
					},
					type: 'POST',
					beforeSend: function beforeSend() {},
					success: function success(response) {
						document.querySelector("#sina-ext-template-type option[value='" + response.data.tmpType + "']").selected = "true";
						$('#sina-ext-template-title').attr('value', response.data.tmpTitle);
						$('.sina-ext-tmp-elementor').removeClass('disabled').removeAttr('disabled', 'disabled');
					},
					complete: function complete(response) {
						$(document).trigger('sina_ext_template_edit_popup_open');

						var temDisplay = $('.hf-location:visible select, .archive-location:visible select, .single-location:visible select, .others-location:visible select');
						temDisplay.find("option[value='" + response.responseJSON.data.tmpLocation + "']")[0].selected = "true";

						//display specific locations
						if (response.responseJSON.data.tmpSpLocation) {
							$.each(response.responseJSON.data.tmpSpLocation, function (i, item) {
								// Create a DOM Option and pre-select by default
								var data = {
									id: i,
									text: item
								};
								var newOption = new Option(data.text, data.id, true, true);
								$('#sina-ext-hf-s-display-type').append(newOption).trigger('change');
							});
						}
						$('.sina-ext-template-edit-popup-area').addClass('open-popup');
					},
					error: function error(errorThrown) {
						console.log(errorThrown);
					}
				});
			} else {
				// Fire custom event.
				$(document).trigger('sina_ext_template_edit_popup_open');
				$('.sina-ext-tmp-elementor').addClass('button disabled').attr('disabled', 'disabled');
				$('.sina-ext-template-edit-popup-area').addClass('open-popup');
			}
		},
		// Close Popup
		closePopup: function closePopup(event) {
			$('.sina-ext-template-edit-popup-area').removeClass('open-popup');
		},
		// Save Post
		savePost: function savePost(event) {
			var _JSON$stringify;
			var $this = $(this),
			tmpId = event.target.dataset.tmpid ? event.target.dataset.tmpid : '',
			title = $('#sina-ext-template-title').val(),
			tmpType = $('#sina-ext-template-type').val(),
			temDisplay = $('.hf-location:visible select, .archive-location:visible select, .single-location:visible select, .others-location:visible select').val(),
			specificsDisplay = $('.hf-s-location:visible select').val();

			$.ajax({
				url: Sina_Ext_Theme_Builder.ajaxurl,
				data: {
					'action': 'sina_ext_save_template',
					'nonce': Sina_Ext_Theme_Builder.nonce,
					'tmpId': tmpId,
					'title': title,
					'tmpType': tmpType,
					'tmpDisplay': temDisplay,
					'specificsDisplay': (_JSON$stringify = JSON.stringify(specificsDisplay)) !== null && _JSON$stringify !== void 0 ? _JSON$stringify : null
				},
				type: 'POST',
				beforeSend: function beforeSend() {
					$this.text(Sina_Ext_Theme_Builder.labels.buttons.save.saving);
					$this.addClass('updating-message');
				},
				success: function success(data) {
					if (tmpId == '') {
						if (data.data.id) {
							var elementorEditlink = 'post.php?post=' + data.data.id + '&action=elementor';
						}
						$('.sina-ext-tmp-save').attr('data-tmpid', data.data.id);
						$('.sina-ext-tmp-elementor').attr({
							'data-link': elementorEditlink,
							'data-tmpid': data.data.id
						});
						$('.sina-ext-tmp-elementor').removeClass('disabled').removeAttr('disabled', 'disabled');
					} else {}
				},
				complete: function complete(data) {
					$this.removeClass('updating-message');
					$this.text(Sina_Ext_Theme_Builder.labels.buttons.save.saved);
				},
				error: function error(errorThrown) {
					console.log(errorThrown);
				}
			});
		},
		// Redirect Edit Page
		redirectEditPage: function redirectEditPage(event) {
			event.preventDefault();
			var $this = $(this),
			link = $this.data('link') ? $this.data('link') : '';
			window.location.replace(Sina_Ext_Theme_Builder.adminURL + link);
		},
		displayLocation: function displayLocation(event) {
			var type = $('#sina-ext-template-type').val();
			$('.hf-s-location').addClass('hidden');
			if ('single' === type) {
				$('.single-location').removeClass('hidden');
				$('.hf-location, .archive-location, .others-location').addClass('hidden');
			} else if ('archive' === type) {
				$('.archive-location').removeClass('hidden');
				$('.hf-location, .single-location, .others-location').addClass('hidden');
			} else if ('others' === type) {
				$('.others-location').removeClass('hidden');
				$('.hf-location, .archive-location, .single-location').addClass('hidden');
			} else {
				$('.hf-location').removeClass('hidden');
				$('.archive-location, .single-location, .others-location').addClass('hidden');
				setTimeout(function () {
					//specifics location for page post taxonomy etc
					if ('specifics' === $('#sina-ext-hf-display-type').val()) {
						$('.hf-s-location').removeClass('hidden');
					}
				}, 100);
			}
		}
	};
	SinaExtThemeBuilder.init();
})(jQuery);