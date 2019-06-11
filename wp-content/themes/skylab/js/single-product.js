/*global wc_single_product_params */
jQuery( function( $ ) {

	// wc_single_product_params is required to continue, ensure the object exists
	if ( typeof wc_single_product_params === 'undefined' ) {
		return false;
	}

	// Tabs
	$( 'body' )
		.on( 'init', '.wc-accordion-wrapper, .woocommerce-accordion', function() {

			var hash  = window.location.hash;
			var url   = window.location.href;
			var $tabs = $( this ).find( '.wc-accordion, ul.accordion' ).first();
			
			if ( hash.toLowerCase().indexOf( 'comment-' ) >= 0 || hash === '#reviews' || hash === '#tab-reviews' ) {
				$tabs.find( 'li.reviews_tab' ).addClass( 'active' );
			} else if ( url.indexOf( 'comment-page-' ) > 0 || url.indexOf( 'cpage=' ) > 0 ) {
				$tabs.find( 'li.reviews_tab' ).addClass( 'active' );
			} else {
				$tabs.find( 'li:first' ).addClass( 'active' );
			}
		})
		.on( 'click', '.wc-accordion li > a >, ul.accordion > li > a', function( e ) {
			e.preventDefault();
			var $tab          = $( this );
			var $tabs_wrapper = $tab.closest( '.wc-accordion-wrapper, .woocommerce-accordion' );
			var $tabs         = $tabs_wrapper.find( '.wc-accordion, ul.accordion' );

			$tab.closest( 'li' ).toggleClass( 'active' );
		})
		// Review link
		.on( 'click', 'a.woocommerce-review-link', function(e) {
			e.preventDefault();
			var $header = $('#header');
			$('html, body').animate({
				scrollTop: $("#tab-reviews").offset().top - $header.outerHeight()
			}, 900, 'easeInOutExpo' );
			$( '.reviews_tab' ).addClass( 'active' );
		})
		// Star ratings for comments
		$('#rating').barrating({
			theme: 'custom-stars'
		})
		.on( 'click', '#respond #submit', function() {
			var $rating = $( this ).closest( '#respond' ).find( '#rating' ),
				rating  = $rating.val();

			if ( $rating.length > 0 && ! rating && wc_single_product_params.review_rating_required === 'yes' ) {
				window.alert( wc_single_product_params.i18n_required_rating_text );

				return false;
			}
		});
	
	//Init Tabs and Star Ratings	
	$( '.wc-accordion-wrapper, .woocommerce-accordion, #rating' ).trigger( 'init' );
});
