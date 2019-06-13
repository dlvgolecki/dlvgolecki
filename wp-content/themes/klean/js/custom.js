/**
 *
 * All the custom Javascript Code used in the theme.
 *
**/

jQuery(document).ready(function() {
	jQuery('#scroll-arrow').on('click', function( e ) {
		
		e.preventDefault();
		
		jQuery('#scroll-arrow').fadeOut();
		
		jQuery('body,html').animate({
			scrollTop: '700',
		}, 500);
	});
});

jQuery(function(){
    jQuery('.nav-menu').slicknav({
    });
});