jQuery(document).ready(function($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$('.switch-to-another').find('.header-text').on('click', function(){
		$(this).next().slideToggle(10);
	});
	$(document).on("click", function (event) {
		// If the target is not the container or a child of the container, then process
		// the click event for outside of the container.
		if ($(event.target).closest(".switch-to-another").length === 0) {
		  $('.switch-to-another').find('.hover-content').hide();
		}
	  });
	$("#cuctomer-to-customer-redirect").trigger( "click" );
	if (document.getElementById("cuctomer-to-customer-redirect") != null) {
		$('#cuctomer-to-customer-redirect')[0].click();
	}

});
