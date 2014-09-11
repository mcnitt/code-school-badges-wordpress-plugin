jQuery(document).ready(function($){

	/*
	* Update profile via AJAX
	*
	*/

	$.post(ajaxurl, {

		action: 'wpcodeschool_badges_refresh_profile'

	}
	//debug: ensure profile was refreshed
	// , function( response ) {
	// 	console.log( 'Code School Badge plugin: AJAX complete' );
	// }
	);

});