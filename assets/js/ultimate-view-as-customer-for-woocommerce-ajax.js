jQuery(document).ready(function($) {
    $('#settings-reset').on('click', function(e){
        e.preventDefault();
        let text = "Are You Sure?\nAre you sure you want to proceed with the changes.";
        if (confirm(text) == true) {
            let tab = $(this).data('tab');
            let redirect = $(this).data('redirect');
            var dataJSON = {
                'action': 'ultimate_view_as_customer_for_woocommerce_reset_settings_ajax',
                'tab': tab,
                'ultimate_view_as_customer_for_woocommerce_security': ultimate_view_as_customer_for_woocommerce_ajax_obj.ultimate_view_as_customer_for_woocommerce_security,
            };

            $.ajax({
                url: ultimate_view_as_customer_for_woocommerce_ajax_obj.ajax_url, // or example_ultimate_view_as_customer_for_woocommerce_ajax_obj.ajaxurl if using on frontend
                type:"POST",
                dataType:"json",
                data: dataJSON,
                success: function(result){
                    console.log(result);
                    window.location.replace(redirect);
                },
                error: function(errorThrown){
                    console.log(errorThrown);
                }
            });

        } 
        // else {
        //     console.log("You canceled!");
        // }
        
    });


	$('.ultimate_view_as_customer_for_woocommerce_api_settings_input').on('change', function(){
		// var form_data = $(this).closest('form').serialize();
        // var settings_enable =  $("#ultimate_view_as_customer_for_woocommerce_api_settings_settings_enable").is( ":checked" )?1:0;
        // var fontend_enable =  $("#ultimate_view_as_customer_for_woocommerce_api_settings_fontend_enable").is( ":checked" )?1:0;
		// console.log(form_data);
        // console.log($(this).val());
        // console.log($(this).data('name'));
        // console.log($(this).attr('type'));
        var value = '';
        if ($(this).attr('type') == 'checkbox' || $(this).attr('type') == 'radio') {
            value = ($(this).is(":checked"))?1:0;
        } else {
            value = $(this).val();
        }
        var name = $(this).data('name');
          
        var dataJSON = {
            'action': 'ultimate_view_as_customer_for_woocommerce_save_settings_ajax',
            'name': name,
            'value': value,
            // 'form_data': form_data,
            // 'settings_enable': settings_enable,
            // 'fontend_enable': fontend_enable,
            'ultimate_view_as_customer_for_woocommerce_security': ultimate_view_as_customer_for_woocommerce_ajax_obj.ultimate_view_as_customer_for_woocommerce_security,
        };
        // console.log(dataJSON);
        /*$.ajax({
            url: ultimate_view_as_customer_for_woocommerce_ajax_obj.ajax_url, // or example_ultimate_view_as_customer_for_woocommerce_ajax_obj.ajaxurl if using on frontend
            type:"POST",
            dataType:"json",
            data: dataJSON,
            success: function(result){
                console.log(result);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });*/
	});

    $("input.search-user-input").keyup(function() {
        let $ths = $(this);
        let userQuery = $(this).val();
        let length = userQuery.length;
        if (userQuery.length > 1) {
            var dataJSON = {
                'action': 'ultimate_view_as_customer_for_woocommerce_show_customer_on_demand',
                'userQuery': userQuery,
                'ultimate_view_as_customer_for_woocommerce_security': ultimate_view_as_customer_for_woocommerce_ajax_obj.ultimate_view_as_customer_for_woocommerce_security,
            };
            $.ajax({
                cache: false,
                type: "POST",
                url: ultimate_view_as_customer_for_woocommerce_ajax_obj.ajax_url,
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
    $("input.search-user-input-from-frontend").keyup(function() {
        let $ths = $(this);
        let userQuery = $(this).val();
        let old_user_id = $(this).closest('form').find('#old_user_id').val();
        let length = userQuery.length;
        if (userQuery.length > 1) {
            var dataJSON = {
                'action': 'ultimate_view_as_customer_for_woocommerce_show_customer_on_demand',
                'userQuery': userQuery,
                'requestFrom': 'frontend',
                'old_user_id': old_user_id,
                'ultimate_view_as_customer_for_woocommerce_security': ultimate_view_as_customer_for_woocommerce_ajax_obj.ultimate_view_as_customer_for_woocommerce_security,
            };
            $.ajax({
                cache: false,
                type: "POST",
                url: ultimate_view_as_customer_for_woocommerce_ajax_obj.ajax_url,
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

    // console.log(ultimate_view_as_customer_for_woocommerce_ajax_obj);
    $(document).on('click', '#ultimate_view_as_customer_for_woocommerce_wooinstall', function(e) {
        // console.log('clicked');
        e.preventDefault();
        var current = $(this);
        var plugin_slug = current.attr("data-plugin-slug");
        current.addClass('updating-message').text('Installing...');
        var data = {
            action: 'ultimate_view_as_customer_for_woocommerce_ajax_install_plugin',
            _ajax_nonce: ultimate_view_as_customer_for_woocommerce_ajax_obj.ultimate_view_as_customer_for_woocommerce_install_plugin_wpnonce,
            slug: plugin_slug,
        };

        $.post(ultimate_view_as_customer_for_woocommerce_ajax_obj.ajax_url, data, function(response) {
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