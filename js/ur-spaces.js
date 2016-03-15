/**
 *
 * Specific functions for the UrbanRights map
 *
 */

( function( $ ) {

// set map height,
// depending on window width
function ur_map_h() {
	map_h = $(window).height() - 152;
	$("#map").css('height',map_h);
};

$(document).ready(function() {

	// window load event
	$(window).load(function() {
		ur_map_h();
	});
	// window resize event
	$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 500);
	});
	$(window).bind("resizeEnd", function() {
		ur_map_h();
	});

});

} )( jQuery );
