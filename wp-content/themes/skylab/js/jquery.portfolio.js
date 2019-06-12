jQuery(document).ready(function($){
	
		// cache jQuery window
		var $window = jQuery(window);
  
		// cache container
		jQuery('.block-portfolio').each(function(){
			var $container = jQuery(this);
			
			if ( $container.hasClass("layout-justified") ) {
				Isotope.Item.prototype._create = function() {
				  // assign id, used for original-order sorting
				  this.id = this.layout.itemGUID++;
				  // transition objects
				  this._transn = {
					ingProperties: {},
					clean: {},
					onEnd: {}
				  };
				  this.sortData = {};
				};

				Isotope.Item.prototype.layoutPosition = function() {
				  this.emitEvent( 'layout', [ this ] );
				};

				Isotope.prototype.arrange = function( opts ) {
				  // set any options pass
				  this.option( opts );
				  this._getIsInstant();
				  // flag for initalized
				  this._isLayoutInited = true;
				};

				// layout mode that does not position items
				Isotope.LayoutMode.create('none');
			}
		
			// start up isotope with default settings
			var $isotopeItems = $container.find('.isotope-item');
			$isotopeItems.css({ opacity: 0 });
			
			var $thumbs = $container.find('.portfolio-gallery');
			
			if ( $container.hasClass("lazyload-enabled") ) {
				
				reLayoutPortfolio();
				$window.smartresize( reLayoutPortfolio );
				setTimeout(function(){
					reLayoutPortfolio();
				}, 100 );
				
				$('.mt-loader').stop(true,true).fadeOut(200);
				if ( $thumbs.hasClass("mt-animate_when_almost_visible-disabled") ) {
					$thumbs.css({ 'opacity': '1', 'visibility': 'visible' });
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
					
					// Animate the portfolio when it enters into the browsers viewport.
					if ( $thumbs.hasClass("mt-animate_when_almost_visible-enabled") ) {
							
						if ($container.is('.animation-for-every-item-in-viewport')) {
							$isotopeItems.css({ transform: 'translate(0px, 40px), scale(1)' });
							
							var itemQueue = []
							var delay = 125
							var queueTimer
							
							function processItemQueue () {
								if (queueTimer) return // We're already processing the queue
								queueTimer = window.setInterval(function () {
								  if (itemQueue.length) {
									$(itemQueue.shift()).transition({
										opacity: 1, y: '0px', scale: 1,
										duration: 700,
										easing: 'ease',
									});
									processItemQueue()
								  } else {
									window.clearInterval(queueTimer)
									queueTimer = null
								  }
								}, delay)
							}
									 
							if (typeof jQuery.fn.waypoint !== 'undefined') {
								$isotopeItems.waypoint(function( direction ) {
									$thumbs.css({ 'opacity': '1', 'visibility': 'visible' });
									itemQueue.push(jQuery(this))
									processItemQueue()
								}, { offset: '95%', triggerOnce: true });
							}	
							
						} else {
								
							if (typeof jQuery.fn.waypoint !== 'undefined') {
								$thumbs.waypoint(function( direction ) {
									$thumbs.css({ 'opacity': '1', 'visibility': 'visible' });
									$isotopeItems.css({ transform: 'translate(0px, 40px), scale(1)' });
									$isotopeItems.each(function(i){
										jQuery(this).delay(i*125).transition({
											opacity: 1, y: '0px', scale: 1,
											duration: 700,
											easing: 'ease',
										});
									});
								}, { offset: '85%', triggerOnce: true });
							}
							
						}
					}
					
				  }
				);
				
			}
			
			$thumbs.imagesLoaded( function(){
			
				var $thumbs = $container.find('.portfolio-gallery');
				
				if ( !$container.hasClass("lazyload-enabled") ) {
			
					// Animate the portfolio when it enters into the browsers viewport.
					if ( $thumbs.hasClass("mt-animate_when_almost_visible-enabled") ) {
							
						if ($container.is('.animation-for-every-item-in-viewport')) {
							$isotopeItems.css({ transform: 'translate(0px, 40px), scale(1)' });
							
							var itemQueue = []
							var delay = 125
							var queueTimer
							
							function processItemQueue () {
								if (queueTimer) return // We're already processing the queue
								queueTimer = window.setInterval(function () {
								  if (itemQueue.length) {
									$(itemQueue.shift()).transition({
										opacity: 1, y: '0px', scale: 1,
										duration: 700,
										easing: 'ease',
									});
									processItemQueue()
								  } else {
									window.clearInterval(queueTimer)
									queueTimer = null
								  }
								}, delay)
							}
									 
							if (typeof jQuery.fn.waypoint !== 'undefined') {
								$isotopeItems.waypoint(function( direction ) {
									$thumbs.css({ 'opacity': '1', 'visibility': 'visible' });
									itemQueue.push(jQuery(this))
									processItemQueue()
								}, { offset: '95%', triggerOnce: true });
							}
									
							
						} else {
								
							if (typeof jQuery.fn.waypoint !== 'undefined') {
								$thumbs.waypoint(function( direction ) {
									$thumbs.css({ 'opacity': '1', 'visibility': 'visible' });
									$isotopeItems.css({ transform: 'translate(0px, 40px), scale(1)' });
									$isotopeItems.each(function(i){
										jQuery(this).delay(i*125).transition({
											opacity: 1, y: '0px', scale: 1,
											duration: 700,
											easing: 'ease',
										});
									});
								}, { offset: '85%', triggerOnce: true });
							}
							
						}
					}
				
				}
			
				reLayoutPortfolio();
				$window.smartresize( reLayoutPortfolio );
				
				$('.mt-loader').stop(true,true).fadeOut(200);
				if ( $thumbs.hasClass("mt-animate_when_almost_visible-disabled") ) {
					$thumbs.css({ 'opacity': '1', 'visibility': 'visible' });
					$isotopeItems.each(function(i){
						jQuery(this).delay(i*125).transition({
							opacity: 1,
							duration: 700,
							easing: 'ease',
						});
					});
				}
				
				// Infinite scroll
				if ( $thumbs.hasClass("infinite-scroll-enabled") ) {
					if ( $container.is('[id|="block-portfolio"]') ) {
						var $itemSelector = '#'+ $container.attr('id') + ' .isotope-item';
					} else {
						var $itemSelector = '.infinite-scroll-enabled-with-button .isotope-item';
					}
					
					$thumbs.infinitescroll({
						navSelector  : $container.find('.nav-pagination'),    // selector for the paged navigation 
						nextSelector : $container.find('.nav-pagination a.next'),  // selector for the NEXT link (to page 2)
						itemSelector : $itemSelector,     // selector for all items you'll retrieve
						pathParse: function(path,nextPage){
							path = ['page',''];
							return path;
						},
						path: function generatePageUrl(currentPageNumber) {
							if ( $thumbs.hasClass("permalinks-enabled") ) {
								return (megaPortfolio.current_url + "/page/" + currentPageNumber + "/");
							} else {
								return (megaPortfolio.current_url + "&paged=" + currentPageNumber );
							}
						},
						loading: {
							finishedMsg: megaPortfolio.finishedMsg,
							img: megaPortfolio.loader
						}
					},
					// call Isotope as a callback
					function ( newElements ) {
					 var $newElems = jQuery( newElements ).hide(); // hide to begin with
					  // ensure that images load before adding to masonry layout
					  $newElems.imagesLoaded(function() {
						$newElems.fadeIn(); // fade in when ready
						$thumbs.isotope( 'appended', $newElems );
					  });
					}
					);
				}
				
				// Infinite scroll with load more button
				if ( $thumbs.hasClass("infinite-scroll-enabled-with-button") ) {
					if ( $container.is('[id|="block-portfolio"]') ) {
						var $itemSelector = '#'+ $container.attr('id') + ' .isotope-item';
					} else {
						var $itemSelector = '.infinite-scroll-enabled-with-button .isotope-item';
					}
					
					$thumbs.infinitescroll({
						navSelector  : $container.find('.nav-pagination'),    // selector for the paged navigation 
						nextSelector : $container.find('.nav-pagination a.next'),  // selector for the NEXT link (to page 2)
						itemSelector : $itemSelector,     // selector for all items you'll retrieve
						pathParse: function(path,nextPage){
							path = ['page',''];
							return path;
						},
						path: function generatePageUrl(currentPageNumber) {
							if ( $thumbs.hasClass("permalinks-enabled") ) {
								return (megaPortfolio.current_url + "/page/" + currentPageNumber + "/");
							} else {
								return (megaPortfolio.current_url + "&paged=" + currentPageNumber );
							}
						},
						loading: {
							selector: $container.find('.load-more'),
							finishedMsg: megaPortfolio.finishedMsg,
							img: megaPortfolio.loader,
						},
						errorCallback: function(selector, msg) {
							$container.find('.load-more #infscr-loading div').remove();
							$container.find('.load-more #infscr-loading').parent().after('<div class="is-finishedMsg">' + megaPortfolio.finishedMsg + '</div>');
							$container.find('.load-more #infscr-loading').transition({
								opacity: 0, scale: .85,
								duration: 'fast',
								easing: 'ease',
							});
							$container.find('.load-more').removeClass('is-animating');
							$container.find('.load-more').addClass('is-finished');
							$container.find('.load-more-wrapper .is-finishedMsg').delay(1200).transition({
								opacity: 0, scale: .85, visibility: 'hidden',
								duration: 'fast',
								easing: 'ease',
							});
							$container.find('.load-more-wrapper').delay(1400).transition({
								opacity: 0, height: 0, margin: 0,
								duration: 'fast',
								easing: 'ease',
								complete: function() {
									// update waypoints
									if (typeof jQuery.fn.waypoint !== 'undefined') {
										setTimeout(function(){
											jQuery.waypoints('refresh');
										}, 1000 );
									}
								}
							});
						},
					},
					// call Isotope as a callback
					function ( newElements ) {
						var $newElems = jQuery( newElements ).hide(); // hide to begin with
						$newElems.find('img').removeAttr( "title" );; // remove titles
						// ensure that images load before adding to masonry layout
						$newElems.imagesLoaded(function() {
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
									vcParallaxSkroll.refresh(document.body);
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
				
					$container.find('.load-more').click(function() {
						$thumbs.infinitescroll('retrieve');
						return false;
					});
				}
				
			});
		
		});
		
		function reLayoutPortfolio() {
			jQuery('.block-portfolio').each(function(){
				var $container = jQuery(this);
				var $thumbs = $container.find('.portfolio-gallery');

				var gutter = '';
				if ( !$thumbs.hasClass("margin-disabled") ) {
					gutter = '.gutter-sizer';
				} else {
					gutter = 0;
				}
				
				var layoutMode = '';
				if ( $container.hasClass("layout-justified") ) {
					layoutMode = 'none';
				} else {
					layoutMode = 'masonry';
				}
				
				$thumbs.isotope({
				  itemSelector : '.isotope-item',
				  layoutMode: layoutMode,
				  masonry: {
					columnWidth: '.grid-sizer',
					gutter: gutter
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

		// filter items when filter link is clicked
		jQuery('.block-portfolio').each(function(){
			var $container = jQuery(this);
			var $filterButtons = $container.find('.filters a');
			var $thumbs = $container.find('.portfolio-gallery');
			$filterButtons.on('click', function() {
				$thumbs.removeClass( 'mt-animate_when_almost_visible-enabled' );
				
				var selector = jQuery(this).attr('data-filter');
				$thumbs.isotope({ filter: selector });
				
				setTimeout(function(){
					reLayoutPortfolio();
				}, 1000 );
				
				return false;
			});
			
			// set selected menu items
			var $optionSets = $container.find('.option-set'),
				$optionLinks = $optionSets.find('a');
	 
				$optionLinks.on('click', function() {
					var $this = jQuery(this);
					// don't proceed if already selected
					if ( $this.hasClass('selected') ) {
						return false;
					}
					var $optionSet = $this.parents('.option-set');
					$optionSet.find('.selected').removeClass('selected');
					$this.addClass('selected'); 
				});
		});
});
