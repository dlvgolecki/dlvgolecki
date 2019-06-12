jQuery(document).ready(function($){

		// cache jQuery window
		var $window = jQuery(window);
  
		// cache container
		jQuery('.block-gallery-alternative').each(function(){
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
			var $isotopeItems = $container.find('.gallery-alternative-item');
			$isotopeItems.css({ opacity: 0 });
			
			var $thumbs = $container.find('.gallery-alternative');
			
			if ( $container.hasClass("lazyload-enabled") ) {
				
				reLayoutGallery();
				$window.smartresize( reLayoutGallery );
				setTimeout(function(){
					reLayoutGallery();
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
					
					// Animate the gallery when it enters into the browsers viewport.
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
				
				var $thumbs = $container.find('.gallery-alternative');
				
				if ( !$container.hasClass("lazyload-enabled") ) {
				
					// Animate the gallery when it enters into the browsers viewport.
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
				
				reLayoutGallery();
				$window.smartresize( reLayoutGallery );
				
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
				
			});
			
		});
		
		function reLayoutGallery() {
			jQuery('.block-gallery-alternative').each(function(){
				var $container = jQuery(this);
				var $thumbs = $container.find('.gallery-alternative');
				
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
				  itemSelector : '.gallery-alternative-item',
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
});
