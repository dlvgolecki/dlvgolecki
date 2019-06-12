jQuery(document).ready(function($){
	/* Teaser grid: isotope
	---------------------------------------------------------- */
	// cache jQuery window
	var $window = jQuery(window);
	  
	// cache container
	jQuery('.wpb_grid-alternative').each(function(){
		var $gridContainer = jQuery(this);
		var $container = $gridContainer.find('.teaser_grid_container:not(.wpb_carousel), .wpb_filtered_grid .teaser_grid_container:not(.wpb_carousel)');
		var $isotopeItems = jQuery(this).find('.isotope-item');
		$isotopeItems.css({ opacity: 0 });
		
		var $thumbs = $container.find('.wpb_thumbnails-alternative');
		
		if ( $container.hasClass("lazyload-enabled") ) {
			
			vc_teaserGrid_alternative();
			$window.smartresize( vc_teaserGrid_alternative );
			setTimeout(function(){
				vc_teaserGrid_alternative();
			}, 200 );
	
			$('.mt-loader').stop(true,true).fadeOut(200);
			if ( $container.hasClass("mt-animate_when_almost_visible-disabled") ) {
				$thumbs.css({ opacity: 1 });
				$isotopeItems.each(function(i){
					jQuery(this).delay(i*125).transition({
						opacity: 1,
						duration: 700,
						easing: 'ease',
					});
				});
			}
			
			$thumbs.one( 'layoutComplete',
			  function( event, laidOutItems ) {
				
				// Animate the blog when it enters into the browsers viewport.
				if ( $container.hasClass("mt-animate_when_almost_visible-enabled") ) {
					//if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
						$isotopeItems.css({ transform: 'translate(0px, 40px), scale(1)' });
						if (typeof jQuery.fn.waypoint !== 'undefined') {
							$container.waypoint(function( direction ) {
								$thumbs.css({ opacity: 1 });
								$isotopeItems.each(function(i){
									jQuery(this).delay(i*125).transition({
										opacity: 1, y: '0px', scale: 1,
										duration: 700,
										easing: 'ease',
									});
								});
							}, { offset: '85%', triggerOnce: true });
						}
					//} else {
						//$thumbs.css({ opacity: 1 });
						//$isotopeItems.each(function(i){
							//jQuery(this).delay(i*125).transition({
								//opacity: 1,
								//duration: 700,
								//easing: 'ease',
							//});
						//});
					//}
				}
				
			  }
			);
		}
				
		// start up isotope with default settings
		$container.imagesLoaded( function(){
			
			var $thumbs = $container.find('.wpb_thumbnails-alternative');
			
			if ( !$container.hasClass("lazyload-enabled") ) {
			
				// Animate the blog when it enters into the browsers viewport.
				if ( $container.hasClass("mt-animate_when_almost_visible-enabled") ) {
					//if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
						$isotopeItems.css({ transform: 'translate(0px, 40px), scale(1)' });
						if (typeof jQuery.fn.waypoint !== 'undefined') {
							$container.waypoint(function( direction ) {
								$thumbs.css({ opacity: 1 });
								$isotopeItems.each(function(i){
									jQuery(this).delay(i*125).transition({
										opacity: 1, y: '0px', scale: 1,
										duration: 700,
										easing: 'ease',
									});
								});
							}, { offset: '85%', triggerOnce: true });
						}
					//} else {
						//$thumbs.css({ opacity: 1 });
						//$isotopeItems.each(function(i){
							//jQuery(this).delay(i*125).transition({
								//opacity: 1,
								//duration: 700,
								//easing: 'ease',
							//});
						//});
					//}
				}
				
				vc_teaserGrid_alternative();
				$window.smartresize( vc_teaserGrid_alternative );
				
				$('.mt-loader').stop(true,true).fadeOut(200);
				if ( $container.hasClass("mt-animate_when_almost_visible-disabled") ) {
					$thumbs.css({ opacity: 1 });
					$isotopeItems.each(function(i){
						jQuery(this).delay(i*125).transition({
							opacity: 1,
							duration: 700,
							easing: 'ease',
						});
					});
				}
			
			}
			
			// Infinite scroll with load more button
			if ( $container.hasClass("infinite-scroll-enabled-with-button") ) {
				if ( $gridContainer.is('[id|="block-posts-alternative"]') ) {
					var $itemSelector = '#'+ $gridContainer.attr('id') + ' .isotope-item';
				} else {
					var $itemSelector = '.infinite-scroll-enabled-with-button .wpb_thumbnails-alternative .isotope-item';
				}
				
				$thumbs.infinitescroll({
					navSelector  : $gridContainer.find('.nav-pagination'),    // selector for the paged navigation 
					nextSelector : $gridContainer.find('.nav-pagination a.next'),  // selector for the NEXT link (to page 2)
					itemSelector : $itemSelector,     // selector for all items you'll retrieve
					pathParse: function(path,nextPage){
						path = ['page',''];
						return path;
					},
					path: function generatePageUrl(currentPageNumber) {
						var $body = jQuery('body');
						if ( $body.is('.search') ) {
							if ( $container.hasClass("permalinks-enabled") ) {
								var n = megaBlog.current_url.lastIndexOf("?");
								return (megaBlog.current_url.substring(0,n) + "page/" + currentPageNumber + "/" + megaBlog.current_url.substring(n));
							} else {
								return (megaBlog.current_url + "&paged=" + currentPageNumber );
							}
						} else {
							if ( $container.hasClass("permalinks-enabled") ) {
								return (megaBlog.current_url + "/page/" + currentPageNumber + "/");
							} else {
								if ( $body.is('.blog') ) {
									return (megaBlog.current_url + "?paged=" + currentPageNumber );
								} else {
									return (megaBlog.current_url + "&paged=" + currentPageNumber );
								}
							}
						}
					},
					loading: {
						selector: $gridContainer.find('.load-more'),
						finishedMsg: megaBlog.finishedMsg,
						img: megaBlog.loader,
					},
					errorCallback: function(selector, msg) {
							$gridContainer.find('.load-more #infscr-loading div').remove();
							$gridContainer.find('.load-more #infscr-loading').parent().after('<div class="is-finishedMsg">' + megaBlog.finishedMsg + '</div>');
							$gridContainer.find('.load-more #infscr-loading').transition({
								opacity: 0, scale: .85,
								duration: 'fast',
								easing: 'ease',
							});
							$gridContainer.find('.load-more').removeClass('is-animating');
							$gridContainer.find('.load-more').addClass('is-finished');
							$gridContainer.find('.load-more-wrapper .is-finishedMsg').delay(1200).transition({
								opacity: 0, scale: .85, visibility: 'hidden',
								duration: 'fast',
								easing: 'ease',
							});
							$gridContainer.find('.load-more-wrapper').delay(1400).transition({
								opacity: 0, height: 0, margin: 0,
								duration: 'fast',
								easing: 'ease',
								complete: function() {
									// update skrollr
									var $parallaxInner = jQuery('.vc_parallax-inner');
									if ($parallaxInner.length) {
										setTimeout(function(){
											vcParallaxSkroll.refresh();
										}, 1500 );
									}
									
									// update waypoints
									if (typeof jQuery.fn.waypoint !== 'undefined') {
										setTimeout(function(){
											jQuery.waypoints('refresh');
										}, 1500 );
									}
								}
							});
						},
				},
				// call Isotope as a callback
				function ( newElements ) {
					var $newElems = jQuery( newElements ).hide(); // hide to begin with
					// ensure that images load before adding to masonry layout
					$newElems.imagesLoaded(function() {
						$newElems.find('img').removeAttr( "title" );
						$thumbs.isotope({
							hiddenStyle: {
								opacity: 0,
								transform: 'translate(0px, 40px) scale(1)'
							},
							visibleStyle: {
								opacity: 1,
								transform: 'translate(0px, 0px) scale(1)'
							},
							stagger: 125,
							transitionDuration: 700
						}).isotope( 'appended', $newElems );
						
						// lazy-load-xt
						if ( $container.hasClass("lazyload-enabled") ) {
							$window.lazyLoadXT();
						}
						
						// update skrollr
						var $parallaxInner = jQuery('.vc_parallax-inner');
						if ($parallaxInner.length) {
							setTimeout(function(){
								vcParallaxSkroll.refresh();
							}, 1000 );
						}
						
						// update waypoints
						if (typeof jQuery.fn.waypoint !== 'undefined') {
							setTimeout(function(){
								jQuery.waypoints('refresh');
							}, 1000 );
						}
					});
				}
				);
								
				$(window).unbind('.infscr');
							
				$gridContainer.find('.load-more').click(function() {
					$thumbs.infinitescroll('retrieve');
					return false;
				});
			}
			
		});
		
	});

	function vc_teaserGrid_alternative() {
		jQuery('.wpb_grid-alternative .teaser_grid_container:not(.wpb_carousel), .wpb_filtered_grid .teaser_grid_container:not(.wpb_carousel)').each(function(){
			var $container = jQuery(this);
			var $thumbs = $container.find('.wpb_thumbnails-alternative');
			var teaser_grid = $thumbs.closest('.wpb_teaser_grid');
					$thumbs.isotope({
						// options
						itemSelector : '.isotope-item',
						masonry: {
							columnWidth: '.grid-sizer',
							gutter: '.gutter-sizer',
							percentPosition: true
						}
					}).isotope( 'layout' );
					
					// lazy-load-xt
					if ( $container.hasClass("lazyload-enabled") ) {
						$thumbs.isotope('on', 'layoutComplete', function() {
							$thumbs.lazyLoadXT({show: true});
						});
					}
		});
		
		// update skrollr
		var $parallaxInner = jQuery('.vc_parallax-inner');
		if ($parallaxInner.length) {
			setTimeout(function(){
				vcParallaxSkroll.refresh();
			}, 1000 );
		}
		
		// update waypoints
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			setTimeout(function(){
				jQuery.waypoints('refresh');
			}, 1000 );
		}
	}
	
});
