jQuery(document).ready(function($) {
	$('.view_as_customer_api_settings_checkbox').on('change', function(){
		// var form_data = $(this).closest('form').serialize();
        var settings_enable =  $("#view_as_customer_api_settings_settings_enable").is( ":checked" )?1:0;
        var fontend_enable =  $("#view_as_customer_api_settings_fontend_enable").is( ":checked" )?1:0;
		// console.log(form_data);
          
        var dataJSON = {
            'action': 'view_as_customer_save_settings_ajax',
            // 'form_data': form_data,
            'settings_enable': settings_enable,
            'fontend_enable': fontend_enable,
            'view_as_customer_security': view_as_customer_ajax_obj.view_as_customer_security,
        };
        $.ajax({
            url: view_as_customer_ajax_obj.ajax_url, // or example_view_as_customer_ajax_obj.ajaxurl if using on frontend
            type:"POST",
            dataType:"json",
            data: dataJSON,
            success: function(result){
                console.log(result);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
	});

    $("input.search-user-input").keyup(function() {
        let $ths = $(this);
        let userQuery = $(this).val();
        let length = userQuery.length;
        if (userQuery.length > 1) {
            var dataJSON = {
                'action': 'view_as_customer_show_customer_on_demand',
                'userQuery': userQuery,
                'view_as_customer_security': view_as_customer_ajax_obj.view_as_customer_security,
            };
            $.ajax({
                cache: false,
                type: "POST",
                url: view_as_customer_ajax_obj.ajax_url,
                data: dataJSON,
                // beforeSend: function() {
                //     $('.some-class').addClass('loading');
                // },
                success: function(response) {
                    console.log(response);
                    $ths.next('.search-result').html(response);
                    // on success
                    // code...
                },
                error: function(xhr, status, error) {
                    console.log('Status: ' + xhr.status);
                    console.log('Error: ' + xhr.responseText);
                },
                complete: function() {}
            });
        } else {
            $ths.next('.search-result').html('');
        }
    });

    console.log(view_as_customer_ajax_obj);
    $(document).on('click', '#view_as_customer_wooinstall', function(e) {
        // console.log('clicked');
        e.preventDefault();
        var current = $(this);
        var plugin_slug = current.attr("data-plugin-slug");
        current.addClass('updating-message').text('Installing...');
        var data = {
            action: 'view_as_customer_ajax_install_plugin',
            _ajax_nonce: view_as_customer_ajax_obj.view_as_customer_install_plugin_wpnonce,
            slug: plugin_slug,
        };

        $.post(view_as_customer_ajax_obj.ajax_url, data, function(response) {
            current.removeClass('updating-message');
            current.addClass('updated-message').text('Installing...');
            current.attr("href", response.data.activateUrl);
        })
        .fail(function() {
            current.removeClass('updating-message').text('Install Failed');
        })
        .always(function() {
            current.removeClass('install-now updated-message').addClass('activate-now button-primary').text('Activating...');
            current.unbind(e);
            current[0].click();
        });
    }); 

});