jQuery(document).ready(function($){
    // $('.wpColorPicker').wpColorPicker({
    //     mode: 'alpha',
    //     border: false,
    // });
    $('.color-input').on('input', function(){
        $(this).siblings().html($(this).val());
        // console.log($(this).val());
    });
    
    $('#open-switching-dropdown').on('click', function(e){
        e.preventDefault();
        $('#wp-admin-bar-ultimate-view-as-customer-for-woocommerce-switch-as-customer').toggleClass('hover');
    });
    $('.user_switched_clear_cookie').on('click', function (e){
        e.preventDefault();
        $(this).closest('.ultimate-view-as-customer-for-woocommerce-switch-notice').remove();
        setCookie('user_switched',0,0);
    });
});
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}