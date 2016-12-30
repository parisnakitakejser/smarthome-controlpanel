(function ( $ ) {
	var setSettings = function(options,attrId) {
		var settings = $.extend({
			dataType: 'json',
			alertToolbar: true,
			alertId : attrId,
			alertClass : 'dialogToolbar',
			callback_error : null,
			callback_success : null
		}, options );

		return settings;
	}

	var getToolbar = function(header, content, mode) {
		if ( mode == 'error' ) {
			$( document.createElement('div') )
			.addClass('alertTopNav alertTopNav-error')
			.append(
				$( document.createElement('div') )
				.append(
					$( document.createElement('strong') )
					.html( header )
				)
				.append(
					$( document.createElement('br') )
				)
				.append( content )
			)
			.appendTo('#'+ toolbarId )
			.slideDown()
			.delay(3000)
			.slideUp(800, function()
			{
				$(this).remove();
			});
		} else if ( mode == 'success' ) {
			$( document.createElement('div') )
			.addClass('alertTopNav alertTopNav-success')
			.append(
				$( document.createElement('div') )
				.append(
					$( document.createElement('strong') )
					.html( header )
				)
				.append(
					$( document.createElement('br') )
				)
				.append( content )
			)
			.appendTo('#'+ toolbarId )
			.slideDown()
			.delay(3000)
			.slideUp(800, function() {
				$(this).remove();
			});
		}
	}
	var toolbarId = '';

	$.fn.ajax_callback = function(call_url, call_data_array,call_settings) {
		var settings = setSettings(call_settings,$(this).attr('id'));
		toolbarId = settings.alertId;

		if (!$(this).hasClass("dialogToolbar")) {
			$(this).addClass('dialogToolbar');
		}

		$.ajax({
			type: 'POST',
			url: call_url,
			crossDomain: true,
			xhrFields: {withCredentials: true},
			data: call_data_array,
			dataType: settings.dataType,
			beforeSend: function(data) {
				// do somthing before sending
				$('#'+ toolbarId ).html('');
			},
			success: function(data) {
				if(data.status==200) {
					if(typeof data.success === "undefined" || typeof data.success.header === "undefined") {
						settings.alertToolbar = false;
					}

					if (settings.alertToolbar == true) {
						getToolbar(data.success.header,data.success.msg,'success');
					}

					if ( settings.callback_success != null ) {
						settings.callback_success(data);
					}
				} else {
					if(typeof data.error === "undefined" || typeof data.error.header === "undefined") {
						settings.alertToolbar = false;
					}

					if (settings.alertToolbar == true) {
						getToolbar(data.error.header,data.error.msg,'error');
					}

					if(settings.callback_error != null) {
						settings.callback_error(data);
					}
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				// do somthing on error
			}
		});
	}

}( jQuery ));
