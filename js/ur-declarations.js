/**
 *
 * Specific functions for the UrbanRights theme.
 *
 */

( function( $ ) {

// set featured video height,
// depending on window width
function ur_featured_video_h() {
	var container_w = $('#content').width() - 30;
	var video = $(".declaration-featured iframe");
	var video_w = video.attr("width");
	var video_h = video.attr("height");
	var video_h_new = container_w * video_h / video_w;
	video.css('height',video_h_new);
};

$(document).ready(function() {

	// window load event
	$(window).load(function() {
		ur_featured_video_h();
	});
	// window resize event
	$(window).resize(function() {
		if(this.resizeTO) clearTimeout(this.resizeTO);
		this.resizeTO = setTimeout(function() {
			$(this).trigger('resizeEnd');
		}, 500);
	});
	$(window).bind("resizeEnd", function() {
		ur_featured_video_h();
	});
});

} )( jQuery );
