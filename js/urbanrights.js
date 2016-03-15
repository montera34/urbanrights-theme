/**
 *
 * Specific functions for the UrbanRights theme.
 *
 */

( function( $ ) {

$(document).ready(function() {
	var container_w = $('#content').width() - 30;
	var video = $(".declaration-featured iframe");
	var video_w = video.attr("width");
	console.log(video_w);
	var video_h = video.attr("height");
	var video_h_new = container_w * video_h / video_w;
	video.css('height',video_h_new);
});
} )( jQuery );
