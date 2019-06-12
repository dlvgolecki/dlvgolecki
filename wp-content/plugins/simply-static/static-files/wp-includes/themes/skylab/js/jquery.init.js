/* lazy-load-xt init */
jQuery.extend(jQuery.lazyLoadXT, { autoInit: true, visibleOnly: false, edgeX: 10000, edgeY: 150, lazycomplete: BackgroundCheck.refresh() });
 
/* Waypoints magic
---------------------------------------------------------- */
if ( typeof window['vc_waypoints'] !== 'function' ) {
  function vc_waypoints() {
	if (typeof jQuery.fn.waypoint !== 'undefined') {
	    jQuery('.wpb_animate_when_almost_visible').waypoint(function() {
			jQuery(this).addClass('wpb_start_animation');
		}, { offset: '85%' });
	}
  }
}

jQuery(document).ready(function($) {

	// Superfish
	var $megaMenu = $('#megaMenu');
	var $pageMenu = $('.page-menu');
	
	if ($pageMenu.length && !$megaMenu.length) {
		$pageMenu.children('ul').addClass('sf-menu');
	}
	
	if (!$megaMenu.length) {
		$('.header-position-top #access .sf-menu, .header-position-bottom #access .sf-menu').superfish({
			animation: {},
			animationOut: {},
			speed: 0,
			speedOut: 0,
		});
		
	}
	
	// page init
	$("#page").removeClass('hidden').css({ 'opacity': '1', 'visibility': 'visible', 'pointer-events': 'auto' });
	$(".top-bar-disabled.center-logo-and-menu-disabled #header").transition({
		opacity: 1, y: 0,
		duration: 350,
		easing: 'cubic-bezier(0,0.9,0.3,1)',
		complete: function() {
			$(".center-logo-and-menu-disabled #header").css({ 'transform': '' });
			$(".center-logo-and-menu-disabled #header").removeClass('header-init');
		}
	});
	
	if (document.addEventListener) {
		window.addEventListener('pageshow', function (event) {
			if (event.persisted || window.performance && 
				window.performance.navigation.type == 2) 
			{
				$(".top-bar-disabled.center-logo-and-menu-disabled #header").css({ 'opacity': '1', 'transform': '' });
				$("#page").css({ 'opacity': '1', 'visibility': 'visible', 'pointer-events': 'auto' });
			}
		},
	   false);
	}
	
	// cache jQuery window
	var $window = $(window);
	
	// Left/Right Header Submenu Accordion
	$window.load(function() {
		var $mainSubmenu = jQuery( '#page.header-position-left #access .sub-menu, #page.header-position-right #access .sub-menu' );
		if ($mainSubmenu.length) {
			$mainSubmenu.wrapInner("<div class='clearfix'></div>");
			
			var $mainMenuItem = $("#page.header-position-left #access .nav-menu > .menu-item, #page.header-position-right #access .nav-menu > .menu-item");
			$mainMenuItem.each(function(){
				if ( $(this).is('.current-menu-ancestor') ) {
					$(this).addClass('active');
				}
			});
		}
		
		var $mainMenuItemHasSubmenuDrop = $( '#page.header-position-left #access .menu-item-has-children, #page.header-position-right #access .menu-item-has-children' );
		if ($mainMenuItemHasSubmenuDrop.length) {
			$mainMenuItemHasSubmenuDrop.children('.menu-item-has-children > a').after( "<span class='drop-icon'><span class='drop-icon-helper'></span></span>" );
			$mainMenuItemHasSubmenuDrop.children('.menu-item-has-children > a, .menu-item-has-children .drop-icon').on('click', function(){
				$(this).closest(".menu-item-has-children").toggleClass("active");
				if ( $(this).closest(".menu-item").hasClass('active') ) {
					$(this).closest(".menu-item").find(".menu-item").each(function(i){
						$(this).delay(i*25).transition({
							opacity: 1, y: '0px',
							duration: 300,
							easing: 'cubic-bezier(0,0.9,0.3,1)',
						});
					});
				} else {
					$(this).closest(".menu-item").find(".menu-item").each(function(i){
						$(this).delay(i*1).transition({
							opacity: 0, y: '50px',
							duration: 300,
							easing: 'cubic-bezier(0,0.9,0.3,1)',
						});
					});
				}
			});
		}
		
	});
	
	// Mobile Menu
	if ( $('.mobile-menu-dropdown-wrapper').hasClass('align-right') ) {
		var $translateX = '100%';
		var $translateXcontent = '-100px';
	} else {
		var $translateX = '-100%';
		var $translateXcontent = '100px';
	}
	
	function toggleMobileMenu() {
        if ( $('.mobile-menu-dropdown').hasClass('open') ) {
			
			// Close
			$('.mobile-menu-wrapper').transition({
				x: $translateX,
				duration: 200,
				easing: 'ease',
			});
			
			// Content Animate
			$('#main-wrapper, #colophon, .entry-header-bg').transition({
				x: '0',
				duration: 300,
				easing:  'ease',
				complete: function() {
					$('#main-wrapper, #colophon, .entry-header-bg').css({'transform': 'none'});
				}
			});
		  
			// Menu Content
			var $mobileMenuContent = $('.access-mobile-menu-wrapper');
			$mobileMenuContent.transition({
				opacity: 0, x: '-50px',
				duration: 50,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
			});
		  
			$('.overlay-for-mobile-menu').removeClass('visible');
			
            $('.mobile-menu-dropdown').removeClass('open');
        } else {
            
			// Open
			$('.mobile-menu-wrapper').transition({
				x: '0px',
				duration: 300,
				easing: 'ease',
			});
			
			// Content Animate
			$('#main-wrapper, #colophon, .entry-header-bg').transition({
				x: $translateXcontent,
				duration: 300,
				easing:  'ease',
			});
			
			// Menu Content
			var $mobileMenuContent = $('.access-mobile-menu-wrapper');
			$mobileMenuContent.transition({
				opacity: 1, x: '0px',
				duration: 500,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
				delay: 150,
			});
			
			$('.overlay-for-mobile-menu').addClass('visible');
			
            $('.mobile-menu-dropdown').addClass('open');
        }
    }
	
	function resizeMobileMenu() {
		if ( $('.mobile-menu-dropdown').hasClass('open') ) {
			var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			if (navigator.userAgent.match('MSIE 8') == null) {
				mediaQueryId = mediaQueryId.replace( /"/g, '' );
			}
			if (mediaQueryId !== 'medium') {
				// Close
				$('.mobile-menu-wrapper').transition({
					x: $translateX,
					duration: 0,
					easing: 'ease',
				});
				
				// Content Animate
				$('#main-wrapper, #colophon, .entry-header-bg').transition({
					x: '0',
					duration: 0,
					easing:  'ease',
					complete: function() {
						$('#main-wrapper, #colophon, .entry-header-bg').css({'transform': 'none'});
					}
				});
				
				// Menu Content
				var $mobileMenuContent = $('.access-mobile-menu-wrapper');
				$mobileMenuContent.transition({
					opacity: 0, x: '-50px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
				
				if ( $('.mobile-menu-dropdown').hasClass('open') ) {
					$('.mobile-menu-dropdown').removeClass('open');
				}
				if ( $('.overlay-for-mobile-menu').hasClass('visible') ) {
					$('.overlay-for-mobile-menu').removeClass('visible');
				}
			}
		}
	}
	
	$window.smartresize( resizeMobileMenu );
	
	// Mobile Menu Button
	$('.mobile-menu-wrapper .close-button, .mobile-menu-dropdown, .overlay-for-mobile-menu').on( 'click', function() {
		toggleMobileMenu();
	});
	
	// Mobile Menu Accordion
	$window.load(function() {
		var $mobileSubmenu = jQuery( 'access-mobile-menu-wrapper .sub-menu' );
		if ($mobileSubmenu.length) {
			$mobileSubmenu.wrapInner("<div class='clearfix'></div>");
			
			var $mobileMenuItem = $(".mobile-menu-wrapper .nav-menu > .menu-item");
			$mobileMenuItem.each(function(){
				if ( $(this).is('.current-menu-ancestor') ) {
					$(this).addClass('active');
				}
			});
		}
		
		var $mobileMenuItemHasSubmenuDrop = $( '.access-mobile-menu-wrapper .menu-item-has-children' );
		if ($mobileMenuItemHasSubmenuDrop.length) {
			$mobileMenuItemHasSubmenuDrop.children('.menu-item-has-children > a').after( "<span class='drop-icon'><span class='drop-icon-helper'></span></span>" );
			$mobileMenuItemHasSubmenuDrop.children('.menu-item-has-children > a, .menu-item-has-children .drop-icon').on('click', function(){
				$(this).closest(".menu-item-has-children").toggleClass("active");
				if ( $(this).closest(".menu-item").hasClass('active') ) {
					$(this).closest(".menu-item").find(".menu-item").each(function(i){
						$(this).delay(i*25).transition({
							opacity: 1, y: '0px',
							duration: 300,
							easing: 'cubic-bezier(0,0.9,0.3,1)',
						});
					});
				} else {
					$(this).closest(".menu-item").find(".menu-item").each(function(i){
						$(this).delay(i*1).transition({
							opacity: 0, y: '50px',
							duration: 300,
							easing: 'cubic-bezier(0,0.9,0.3,1)',
						});
					});
				}
			});
		}
		
	});
	
	// Secondary Menu
	if ( $('#secondary-menu-wrapper').hasClass('align-right') ) {
		var $translateXsecondaryMenu = '100%';
		var $translateXcontentSecondaryMenu = '-100px';
	} else {
		var $translateXsecondaryMenu = '-100%';
		var $translateXcontentSecondaryMenu = '100px';
	}
	
	function toggleSecondaryMenu() {
        if ( $('#secondary-menu-dropdown').hasClass('open') ) {
			
			// Close
			$('#secondary-menu-wrapper.center-and-full-width-disabled').transition({
				x: $translateXsecondaryMenu,
				duration: 200,
				easing: 'ease',
			});
		  
			// Center and Full Width Enabled
			$('#secondary-menu-wrapper.center-and-full-width-enabled').transition({
				height: '0%', opacity: 0, visibility: 'hidden',
				duration: 200,
				easing:  'ease',
			});
			
			// Content Animate
			$('#main-wrapper, #colophon, .entry-header-bg').transition({
				x: '0',
				duration: 300,
				easing:  'ease',
			});
		  
			// Menu Content
			// Left
			var $secondaryMenuContent = $('#access-secondary-menu-wrapper');
			$secondaryMenuContent.transition({
				opacity: 0, x: '-50px',
				duration: 50,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
			});
		  
			// Right
			var $secondaryMenuContent = $('#access-secondary-menu-wrapper');
			$secondaryMenuContent.transition({
				opacity: 0, x: '50px',
				duration: 50,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
			});
		  
			// Center and Full Width Enabled
			var $menuItems = $('#secondary-menu-wrapper.align-left.center-and-full-width-enabled .secondary-menu li, #secondary-menu-wrapper.align-right.center-and-full-width-enabled .secondary-menu li');
			$menuItems.each(function(i){
				$(this).delay(i*1).transition({
					opacity: 0, y: '100px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
					delay: 50,
				});
			});
		  
			$('.overlay-for-secondary-menu').removeClass('visible');
			
            $('#secondary-menu-dropdown').removeClass('open');
			
        } else {
            
			// Open
			$('#secondary-menu-wrapper.center-and-full-width-disabled').transition({
				x: '0px',
				duration: 400,
				easing: 'ease',
			});
			
			// Center and Full Width Enabled
			$('#secondary-menu-wrapper.align-left.center-and-full-width-enabled, #secondary-menu-wrapper.align-right.center-and-full-width-enabled').transition({
				height: '100%', opacity: 1, visibility: 'visible',
				duration: 300,
				easing:  'ease',
			});
			
			// Content Animate
			$('#main-wrapper, #colophon, .entry-header-bg').transition({
				x: $translateXcontentSecondaryMenu,
				duration: 300,
				easing:  'ease',
			});
			
			// Menu Content
			var $secondaryMenuContent = $('#access-secondary-menu-wrapper');
			$secondaryMenuContent.transition({
				opacity: 1, x: '0px',
				duration: 500,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
				delay: 150,
			});
			  
			var $menuItems = $('#secondary-menu-wrapper.align-left.center-and-full-width-enabled .secondary-menu li, #secondary-menu-wrapper.align-right.center-and-full-width-enabled .secondary-menu li');
			$menuItems.each(function(i){
				$(this).delay(i*55).transition({
					opacity: 1, y: '0px',
					duration: 500,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
					delay: 200,
				});
			});
			
			$('.overlay-for-secondary-menu').addClass('visible');
			
            $('#secondary-menu-dropdown').addClass('open');
        }
    }
	
	function resizeSecondaryMenu() {
		if ( $('#secondary-menu-dropdown').hasClass('open') ) {
			var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			if (navigator.userAgent.match('MSIE 8') == null) {
				mediaQueryId = mediaQueryId.replace( /"/g, '' );
			}
			if (mediaQueryId == 'medium') {
				// Close
				$('#secondary-menu-wrapper.center-and-full-width-disabled').transition({
					x: $translateXsecondaryMenu,
					duration: 0,
					easing: 'ease',
				});
				
				// Content Animate
				$('#main-wrapper, #colophon, .entry-header-bg').transition({
					x: '0',
					duration: 0,
					easing:  'ease',
					complete: function() {
						$('#main-wrapper, #colophon, .entry-header-bg').css({'transform': 'none'});
					}
				});
				
				// Menu Content
				// Left
				var $secondaryMenuContent = $('#access-secondary-menu-wrapper');
				$secondaryMenuContent.transition({
					opacity: 0, x: '-50px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
			  
				// Right
				var $secondaryMenuContent = $('#access-secondary-menu-wrapper');
				$secondaryMenuContent.transition({
					opacity: 0, x: '50px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
				
				if ( $('#secondary-menu-dropdown').hasClass('open') ) {
					$('#secondary-menu-dropdown').removeClass('open');
				}
				if ( $('.overlay-for-secondary-menu').hasClass('visible') ) {
					$('.overlay-for-secondary-menu').removeClass('visible');
				}
			}
		}
	}
	
	$window.smartresize( resizeSecondaryMenu );
	
	// Secondary Menu Button
	$('#branding #secondary-menu-dropdown, .overlay-for-secondary-menu, #secondary-menu-wrapper .close-button').on( 'click', function() {
		toggleSecondaryMenu();
	});
	
	// Secondary Menu Accordion
	jQuery(window).load(function() {
		var $mobileSubmenu = jQuery( '#access-secondary-menu-wrapper .sub-menu' );
		if ($mobileSubmenu.length) {
			$mobileSubmenu.wrapInner("<div class='clearfix'></div>");
			
			var $mobileMenuItem = $("#access-secondary-menu-wrapper .nav-menu > .menu-item");
			$mobileMenuItem.each(function(){
				if ( $(this).is('.current-menu-ancestor') ) {
					$(this).addClass('active');
				}
			});
		}
		
		var $mobileMenuItemHasSubmenuDrop = $( '#access-secondary-menu-wrapper .menu-item-has-children' );
		if ($mobileMenuItemHasSubmenuDrop.length) {
			$mobileMenuItemHasSubmenuDrop.children('.menu-item-has-children > a').after( "<span class='drop-icon'><span class='drop-icon-helper'></span></span>" );
			$mobileMenuItemHasSubmenuDrop.children('.menu-item-has-children > a, .menu-item-has-children .drop-icon').on('click', function(){
				$(this).closest(".menu-item-has-children").toggleClass("active");
				if ( $(this).closest(".menu-item").hasClass('active') ) {
					$(this).closest(".menu-item").find(".menu-item").each(function(i){
						$(this).delay(i*25).transition({
							opacity: 1, y: '0px',
							duration: 300,
							easing: 'cubic-bezier(0,0.9,0.3,1)',
						});
					});
				} else {
					$(this).closest(".menu-item").find(".menu-item").each(function(i){
						$(this).delay(i*1).transition({
							opacity: 0, y: '50px',
							duration: 300,
							easing: 'cubic-bezier(0,0.9,0.3,1)',
						});
					});
				}
			});
		}
		
	});
	
	// Post Info Button
	$('.post-info-button, .post-info .close-button, .overlay-for-post-info').on( 'click', function() {
		togglePostInfo();
	});
	
	function togglePostInfo() {
        if ( $('.post-info-wrapper').hasClass('open') ) {
			
			// Close
			$('.post-info-wrapper').transition({
				x: '100%',
				duration: 200,
				easing: 'ease',
			});
			
			// Content Animate
			$('#main-wrapper').transition({
				x: '0',
				duration: 300,
				easing:  'ease',
			});
			
			// Post Info Content
			$('.post-info').transition({
				opacity: 0, x: '50px',
				duration: 50,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
			});
		  
			$('.overlay-for-post-info').removeClass('visible');
			
            $('.post-info-wrapper').removeClass('open');
        } else {
            
			// Open
			$('.post-info-wrapper').transition({
				x: '0px',
				duration: 300,
				easing: 'ease',
			});
			
			// Content Animate
			$('#main-wrapper').transition({
				x: '-100px',
				duration: 300,
				easing:  'ease',
			});
			
			// Post Info Content
			$('.post-info').transition({
				opacity: 1, x: '0px',
				duration: 500,
				easing: 'cubic-bezier(0,0.9,0.3,1)',
				delay: 150,
			});
			
			$('.overlay-for-post-info').addClass('visible');
			
            $('.post-info-wrapper').addClass('open');
        }
    }
	
	// Typed.js
	var typed = $('.typed');
	if (typed.length) {
		typed.each(function( i, el ) {
			var $el = $( el ),
				target = $el.data( 'target' ),
				stringsElementId = target.substr(6);
			var randomNumber;
			var typed = new Typed('#' + target, {
			  stringsElement: '#typed-strings-' + stringsElementId,
			  typeSpeed: 90,
			  backSpeed: 30,
			  loop: true,
			  startDelay: 600,
			  backDelay: 9000,
			  shuffle: true,
			  smartBackspace: false,
			  preStringTyped: function() {
			      randomNumber = Math.floor(Math.random() * typed.sequence.length) + 1;
				  $el.removeClass (function (index, className) {
					return (className.match (/\btyped-\S+/g) || []).join(' ');
				  }).addClass( 'typed-' + parseInt(randomNumber) );
			  },
			});
		});
	}
	
	// countUp.js
	var $countWrapper = $('.count-wrapper');
	if ($countWrapper.length) {
		$( '.count-wrapper' ).each(function( i, el ) {
			var $el = $( el ),
				target = $el.data( 'count' ),
				startVal = 0,
				endVal = $el.data( 'end' ),
				decimals = 0;
				
			var theAnimation = new CountUp( target, startVal, endVal, decimals, 2.5, {
				useEasing : true,
				useGrouping : false, 
				separator : '', 
				decimal : '.',
			});

			var $countWrapper = $(this);
			if ( $countWrapper.is('.mt-animate_when_almost_visible-enabled') ) {
				if (typeof jQuery.fn.waypoint !== 'undefined') {
					$( '#' + target ).waypoint(function( direction ) {
						theAnimation.start();
						var $animationDelay = (i*125);
						setTimeout(function() {
							$countWrapper.addClass('mt_start_animation');
						}, $animationDelay);
					}, { offset: '85%', triggerOnce: true });
				}
			} else {
				if (typeof jQuery.fn.waypoint !== 'undefined') {
					$( '#' + target ).waypoint(function( direction ) {
						theAnimation.start();
					}, { offset: '85%', triggerOnce: true });
				}
			}
		});
	}
	
	// Search form (header)
	$(document).on( 'click', function(event) {
		if (!$(event.target).closest("#search-header-icon, .search-wrapper").length) {
			$('#search-header-icon, #remove-search').removeClass('search-form-active');
			$('.search-wrapper').removeClass("active");
		}
	});

	$('#search-header-icon').on('click', function(event){
		if (!$(this).hasClass("search-form-active")) {
			$(this).addClass("search-form-active");
			$('#remove-search').addClass("search-form-active");
			$('#header-wrapper .search-wrapper, #top-bar-wrapper .search-wrapper').addClass("active");
		} else {
			$(this).removeClass("search-form-active");
			$('#remove-search').removeClass("search-form-active");
			$('#header-wrapper .search-wrapper, #top-bar-wrapper .search-wrapper').removeClass("active");
		}
		if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
			setTimeout(function() {
				$('#header-wrapper .s, #top-bar-wrapper .s').focus();
			}, 200);
		} else {
			$('#header-wrapper .s, #top-bar-wrapper .s').focus();
		}
		event.preventDefault();
	});
	
	$('#remove-search').on('click', function(event){
		if ($('#search-header-icon').hasClass("search-form-active")) {
			$('#search-header-icon').removeClass("search-form-active");
			$('#remove-search').removeClass("search-form-active");
			$('#header-wrapper .search-wrapper, #top-bar-wrapper .search-wrapper').removeClass("active");
		}
		event.preventDefault();
	});
	
	/* Remove image titles */
	var $imgs = $('.type-portfolio img, .gallery-alternative img, .image-carousel-alternative img, .lightbox-video img, .vc_single_image-img');
	$imgs.removeAttr( "title" );
	
	/* To Top */
	var $toTop = $('#to-top');
	if ( $toTop.is(".fixed") ) {
		var $img = $('#content img:not(.style-svg):not(.rev-slidebg):not(.avatar)');
		if ($img.length) {
			BackgroundCheck.init({
				targets: '#to-top.fixed i',
				images: '#content img:not(.style-svg):not(.rev-slidebg):not(.avatar)'
			});
		}
		$(window).scroll(function(){
			if ($(this).scrollTop() > 400) {
				$toTop.addClass("to-top-show");
			} else {
				$toTop.removeClass("to-top-show");
			}
		});
	}
	
	$("#to-top").on('click', function( e ) {
		$('html, body').animate({ scrollTop : 0 }, 900, 'easeInOutExpo' );
		
		e.preventDefault();
	});
	
	/* WPML */
	var $langSelSel = $('#top-bar .lang_sel_sel');
	$langSelSel.on('click', function( e ) {
		e.preventDefault();
	});
	
	// Scroll Down Button
	var $header = $('#header');
	$(".scroll-down-button").on('click', function( e ) {
		if ( $(this).is(".scroll-down-button-header") ) {
		$('html, body').animate({
			scrollTop: $(this).closest('.entry-header-bg').next().offset().top - $header.outerHeight()
		}, 900, 'easeInOutExpo' );
		} else {
			if ( $(this).closest('.wpb_row').next().hasClass('intro') ) {
				$('html, body').animate({
					scrollTop: $(this).closest('.wpb_row').next().next().offset().top - $header.outerHeight()
				}, 900, 'easeInOutExpo' );
			} else {
				$('html, body').animate({
					scrollTop: $(this).closest('.wpb_row').next().offset().top - $header.outerHeight()
				}, 900, 'easeInOutExpo' );
			}
		}
	});
	
	// Scroll Down Button Comments
	$(".entry-header-bg .entry-header-wrapper .comments-link a").on('click', function( e ) {
		e.preventDefault();
		$('html, body').animate({
			scrollTop: $(this).closest('#page').find('.comment:first').offset().top - 40
		}, 900, 'easeInOutExpo' );
	});
	
	// Skrollr
	if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
		var s = skrollr.init({
			forceHeight: false,
			smoothScrolling: false,
			smoothScrollingDuration: 0
		});
		var $header= $('#branding');
		$header.imagesLoaded(function(){
			s.refresh();
		});
	}
	
	function parallaxRow() {
        var vcSkrollrOptions, callSkrollInit = !1;
		var skrollrNumber = 300;
        return window.vcParallaxSkroll && window.vcParallaxSkroll.destroy(), $(".vc_parallax-inner").remove(), $("[data-5p-top-bottom]").removeAttr("data-5p-top-bottom data-30p-top-bottom"), $("[data-vc-parallax]").each(function() {
		   var skrollrSpeed, skrollrSize, skrollrStart, skrollrEnd, $parallaxElement, parallaxImage, youtubeId;
            if ( $(this).hasClass('vc_parallax-lazy') ) {
				callSkrollInit = !0, "on" === $(this).data("vcParallaxOFade") && $(this).children().attr("data-5p-top-bottom", "opacity:0;").attr("data-30p-top-bottom", "opacity:1;"), skrollrSize = 100 * $(this).data("vcParallax"), $parallaxElement = $("<div />").addClass("vc_parallax-inner").appendTo($(this)), $parallaxElement.height(skrollrSize + "%"), parallaxImage = $(this).data("vcParallaxImage"), youtubeId = vcExtractYoutubeId(parallaxImage), youtubeId ? insertYoutubeVideoAsBackground($parallaxElement, youtubeId) : "undefined" != typeof parallaxImage && $parallaxElement.attr("data-bg", parallaxImage), skrollrSpeed = skrollrSize + skrollrNumber, skrollrStart = -skrollrSpeed, skrollrEnd = 100/*0*/, $parallaxElement.attr("data-bottom-top", "transform: translate(0px, " + skrollrStart + "px);").attr("data-top-bottom", "transform: translate(0px, " + skrollrEnd + "px);")
			} else {
				callSkrollInit = !0, "on" === $(this).data("vcParallaxOFade") && $(this).children().attr("data-5p-top-bottom", "opacity:0;").attr("data-30p-top-bottom", "opacity:1;"), skrollrSize = 100 * $(this).data("vcParallax"), $parallaxElement = $("<div />").addClass("vc_parallax-inner").appendTo($(this)), $parallaxElement.height(skrollrSize + "%"), parallaxImage = $(this).data("vcParallaxImage"), youtubeId = vcExtractYoutubeId(parallaxImage), youtubeId ? insertYoutubeVideoAsBackground($parallaxElement, youtubeId) : "undefined" != typeof parallaxImage && $parallaxElement.css("background-image", "url(" + parallaxImage + ")"), skrollrSpeed = skrollrSize + skrollrNumber, skrollrStart = -skrollrSpeed, skrollrEnd = 100/*0*/, $parallaxElement.attr("data-bottom-top", "transform: translate(0px, " + skrollrStart + "px);").attr("data-top-bottom", "transform: translate(0px, " + skrollrEnd + "px);")
			}
	   }), callSkrollInit && window.skrollr ? (vcSkrollrOptions = {
            forceHeight: !1,
            smoothScrolling: !1,
            mobileCheck: function() {
                return !1
            }
        }, window.vcParallaxSkroll = skrollr.init(vcSkrollrOptions), window.vcParallaxSkroll) : !1
    }
	parallaxRow();
	
	var $body= $('body');
	$body.imagesLoaded(function(){
		// update waypoints
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery.waypoints('refresh');
		}
	});
	
	jQuery(window).load(function() {
		// update skrollr
		var $parallaxInner = jQuery('.vc_parallax-inner');
		if ($parallaxInner.length) {
			setTimeout(function(){
				vcParallaxSkroll.refresh();
			}, 1000 );
		}
		
		$window.smartresize(function() {
			if ($parallaxInner.length) {
				setTimeout(function(){
					vcParallaxSkroll.refresh();
				}, 1500 );
			}
		});
		
		// update waypoints
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery.waypoints('refresh');
		}
		
		$window.smartresize(function() {
			setTimeout(function(){
				jQuery.waypoints('refresh');
			}, 1500 );
		});
	});
	
	// fancybox
	var $fancyboxGallery = $('[data-fancybox="gallery"]');
	if ($fancyboxGallery.length) {
		var fancyboxBGcolor = $fancyboxGallery.parents('.block-gallery-alternative').attr('data-fancybox-bg-color');
		var fancyboxBGhelperColor = $fancyboxGallery.parents('.block-gallery-alternative').attr('data-fancybox-helper-color');
		var fancyboxButtonsColor = $fancyboxGallery.parents('.block-gallery-alternative').attr('data-fancybox-buttons-color');
		var infobar = false;
		if ($fancyboxGallery.parents('.slick-slider-wrapper').length) {
			infobar = true;
		}
		$().fancybox({
			selector : '[data-fancybox="gallery"]',
			infobar: infobar,
			buttons: [
				"close"
			],
			hash : false,
			animationEffect: "fade",
			protect: true,
			idleTime: false,
			// Base template for layout
			baseTpl:
				'<div class="fancybox-container" role="dialog" tabindex="-1">' +
				'<div class="fancybox-bg" style="background:' + fancyboxBGcolor + ';"></div>' +
				'<div class="fancybox-inner">' +
				'<div class="fancybox-infobar"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div>' +
				'<div class="fancybox-toolbar">{{buttons}}</div>' +
				'<div class="fancybox-navigation">{{arrows}}</div>' +
				'<div class="fancybox-stage"></div>' +
				'<div class="fancybox-caption"></div>' +
				"</div>" +
				"</div>",
			spinnerTpl: '<div class="loader-lg"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10" style="stroke:' + fancyboxButtonsColor + ';"/></svg></div>',
			btnTpl: {
				close:
				  '<button data-fancybox-close class="fancybox-button fancybox-button--close" style="background:' + fancyboxBGhelperColor + '; color:' + fancyboxButtonsColor + ';">' +
				  '<svg viewBox="0 0 40 40"><path d="M10,10 L30,30 M30,10 L10,30"/></svg>' +
				  "</button>",
				arrowLeft:
					'<a data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" style="background:' + fancyboxBGhelperColor + ';">' +
					'<svg viewBox="0 0 32 32">' +
					'<path d="M22.292 31.158l-15.158-15.158 15.158-15.158 1.533 1.533-13.625 13.625 13.625 13.625z" style="fill:' + fancyboxButtonsColor + ';"/>' +
					"</svg>" +
					"</a>",
				arrowRight:
					'<a data-fancybox-next class="fancybox-button fancybox-button--arrow_right" style="background:' + fancyboxBGhelperColor + ';">' +
					'<svg viewBox="0 0 32 32">' +
					'<path d="M9.708 31.158l-1.533-1.533 13.625-13.625-13.625-13.625 1.533-1.533 15.158 15.158z" style="fill:' + fancyboxButtonsColor + ';"/>' +
					"</svg>" +
					"</a>"
			},
		});
	}
	
	// Owl Carousel
	var $owlCarouselWrapper = $('.owl-carousel-wrapper');
	if ($owlCarouselWrapper.length) {
		$owlCarouselWrapper.each(function(i){
			$(this).find('p:empty').remove();
			var $owlCarousel = $(this).find('.owl-carousel');
			var items = $owlCarousel.attr('data-items');
			if ( $owlCarousel.is("[data-items-on-small-screens]") ) {
				var itemsOnSmallScreens = $owlCarousel.attr('data-items-on-small-screens');
			} else {
				var itemsOnSmallScreens = 1;
			}
			var nav = $owlCarousel.attr('data-nav') === 'true';
			if ( $owlCarousel.is(".slide-by-by_page") ) {
				var slideBy = 'page';
			} else {
				var slideBy = 1;
			}
			var dots = $owlCarousel.attr('data-dots') === 'true';
			var center = $owlCarousel.attr('data-center') === 'true';
			if ( $owlCarousel.is("[data-margin]") ) {
				if ( $owlCarousel.is(".no-margin") ) {
					var margin = 0;
				} else {
					var margin = $owlCarousel.attr('data-margin');
				}
			} else {
				if ( $owlCarousel.is(".center-true") || $owlCarousel.is(".mt-fadeIn") ) {
					var margin = 0;
				} else {
					var margin = 30;
				}
			}
			if ( $owlCarousel.is("[data-autoHeight]") ) {
				var autoHeight = $owlCarousel.attr('data-autoHeight');
			} else {
				var autoHeight = true;
			}
			if ( $owlCarousel.is(".mt-testimonials") || $owlCarousel.is(".fade-true") ) {
				var animateOut = 'mt-fadeOut';
				if ( $owlCarousel.is(".mt-fadeIn") ) {
					var animateIn = 'mt-fadeIn';
				} else {
					var animateIn = 'mt-fadeInLeft';
				}
				if ( $owlCarousel.is(".center-true") || $owlCarousel.is(".mt-fadeIn") ) {
					var stagePadding = 0;
				} else {
					var stagePadding = 20;
				}
			} else {
				var animateOut = false;
				var animateIn = false;
				if ( $owlCarousel.is(".image-carousel-alternative") ) {
					if ( $owlCarousel.is(".image-carousel-alternative-style-2") || $owlCarousel.is(".image-carousel-alternative-style-3") ) {
						var stagePadding = 20;
					} else {
						var stagePadding = 0;
					}
				} else {
					if ( $owlCarousel.is(".nav-true") ) {
						var stagePadding = 20;
					} else {
						if ( $owlCarousel.is(".persons-style-2") ) {
							var stagePadding = 20;
						} else {
							var stagePadding = 0;
						}
					}
				}
			}
			if ( $owlCarousel.is(".loop-false") ) {
				var loop = false;
				var stagePaddingPartiallyVisible = 75;
			} else {
				var loop = true;
				var stagePaddingPartiallyVisible = 150;
			}
			if ( $owlCarousel.is(".linked-true") ) {
				if (i % 2 === 0) {
					var linked = '.linked-carousel-' + (i+2);
				}
				else {
					var linked = $owlCarousel.parent().prev().find('.linked-carousel-1');
				}
			} else {
				var linked = '';
			}
			// lazy-load-xt
			if ( $owlCarousel.hasClass("lazyload-enabled") ) {
				$owlCarousel.on('initialized.owl.carousel', function(event) {
					$owlCarousel.lazyLoadXT({show: true});
					setTimeout(function() {
						$owlCarousel.lazyLoadXT({show: true});
					  }, 300);
				});
				jQuery(window).load(function() {
					 $owlCarousel.on('initialized.owl.carousel', function(event) {
						$owlCarousel.lazyLoadXT({show: true});
						setTimeout(function() {
							$owlCarousel.lazyLoadXT({show: true});
						  }, 300);
					});
				});
			}
			if ( $owlCarousel.is(".partially-visible") ) {
			$owlCarousel.owlCarousel({
				animateOut: animateOut,
				animateIn: animateIn,
				items: parseInt(items),
				margin: parseInt(margin),
				dots: dots,
				nav: nav,
				navText: [],
				loop: loop,
				center: center,
				autoHeight: autoHeight,
				smartSpeed: 350,
				linked: linked,
				callbacks: true,
				responsive : {
					// breakpoint from 0 up
					0 : {
						items: 1,
						nav: nav,
						stagePadding: parseInt(stagePadding)
					},
					// breakpoint from 580 up
					680 : {
						items: parseInt(items),
						nav: nav,
						stagePadding: parseInt(stagePadding)
					},
					// breakpoint from 868 up
					968 : {
						items: parseInt(items),
						nav: nav,
						stagePadding: stagePaddingPartiallyVisible
					}
				},
				onInitialized: animateActiveOwlCarouselItems
			});
			} else {
				$owlCarousel.owlCarousel({
					animateOut: animateOut,
					animateIn: animateIn,
					items: parseInt(items),
					margin: parseInt(margin),
					dots: dots,
					nav: nav,
					slideBy: slideBy,
					navText: [],
					loop: loop,
					center: center,
					autoHeight: autoHeight,
					//smartSpeed: 350,
					linked: linked,
					callbacks: true,
					responsive : {
						// breakpoint from 0 up
						0 : {
							items: 1,
							nav: nav,
							stagePadding: parseInt(stagePadding)
						},
						// breakpoint from 580 up
						680 : {
							items: parseInt(itemsOnSmallScreens),
							nav: nav,
							stagePadding: parseInt(stagePadding)
						},
						// breakpoint from 868 up
						968 : {
							items: parseInt(items),
							nav: nav,
							stagePadding: parseInt(stagePadding)
						}
					},
					onInitialized: animateActiveOwlCarouselItems
				});
			}
		
			function animateActiveOwlCarouselItems(event) {
				if ( $owlCarousel.is(".mt-animate_when_almost_visible-enabled") ) {
					var $activeItems = $owlCarousel.find( '.active' );
					//if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
						$activeItems.addClass("mt-animate_when_almost_visible");
						if (typeof jQuery.fn.waypoint !== 'undefined') {
							$owlCarousel.waypoint(function( direction ) {
								$activeItems.each(function(i){
									jQuery(this).delay(i*125).transition({
										opacity: 1, y: '0px',
										duration: 700,
										easing: 'ease',
										complete: function() {
											jQuery(this).removeClass( 'mt-animate_when_almost_visible' );
											jQuery(this).css({ 'opacity': '', 'transform': '' });
											$owlCarousel.removeClass( 'mt-animate_when_almost_visible-enabled' );
										}
									});
								});
							}, { offset: '85%', triggerOnce: true });
						}
					//}
				}
			}
			
			jQuery(window).load(function() {
				$owlCarousel.trigger('refresh.owl.carousel');
			});
		
		});
		
	}
	
	// Animation for Person
	var $rowAnimationEnabledForPerson = $('.vc_row.mt-animate_when_almost_visible-enabled-for-person');
	$rowAnimationEnabledForPerson.each(function(){
		var $rowAnimationEnabledForPersonWrapper = $(this).find( '.wrapper' );
		var $rowAnimationEnabledForPerson = $(this).find( '.person' );
		$rowAnimationEnabledForPerson.addClass("mt-animate_when_almost_visible");
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			$rowAnimationEnabledForPersonWrapper.waypoint(function( direction ) {
				$rowAnimationEnabledForPerson.each(function(i){
					jQuery(this).delay(i*125).transition({
						opacity: 1, y: '0px', //scale: 1,
						duration: 700,
						easing: 'ease',
						complete: function() {
							jQuery(this).removeClass( 'mt-animate_when_almost_visible' );
							jQuery(this).css({ 'opacity': '', 'transform': '' });
							$rowAnimationEnabledForPerson.removeClass( 'mt-animate_when_almost_visible-enabled-for-person' );
						}
					});
				});
			}, { offset: '85%', triggerOnce: true });
		}
	});
	
	// Content Animation
	var $contentAnimated = $( '.content-animated' );
	if ($contentAnimated.length) {
		$contentAnimated.each(function() {
			var $contentSection = $(this).find( '.marketing-tour-content, .wpb_content_element .wpb_wrapper, .count-caption-wrapper, .counting-style-1, .counting-style-3, .counting-style-4' );
			var $contentCountValue = $(this).find( '.counting-style-2 .count-value' );
			$contentSection.children().not('.special-wrapper').addClass( "animated-item" );
			if ($contentAnimated.length) {
				$contentCountValue.addClass( "animated-item" );
			}
		});
	}
	
	// Vivus
	var $svgIconsAnimated = $( '.svg-icons-animated' );
	if ($svgIconsAnimated.length) {
		jQuery(window).load(function() {
			$svgIconsAnimated.each(function() {
				var $svgAnimation = $(this).find( '.svg-animation-enabled' );
				if ($svgAnimation.length) {
					var $icons = [];
					$svgAnimation.each(function(i) {
						var $marketingTourWrapper = $(this).find('.svg-icon');
						$(this).attr('id', 'marketing-tour-icon-animated-' + i);
						$icons[i] = new Vivus($marketingTourWrapper.attr('id'), {
							type: 'delayed',
							duration: 125,
							pathTimingFunction: Vivus.EASE_OUT,
							animTimingFunction: Vivus.EASE_OUT,
							start: 'manual',
						});
						
						var $marketingTourWrapper = $(this);
						if (typeof jQuery.fn.waypoint !== 'undefined') {
							$marketingTourWrapper.waypoint(function( direction ) {
								$(this).find('.svg-icon').css('opacity', '1');
								var $animationDelay = (i*225);
								setTimeout(function() {
									$icons[i].reset().play();
									if ( $marketingTourWrapper.is('.mt_animate_when_almost_visible') ) {
										$marketingTourWrapper.addClass('mt_start_animation');
									}
								}, $animationDelay);
							}, { offset: '85%', triggerOnce: true });
						}
					});
				}
			});
		});
	}
	
	// Footer Parallax
	var $bodyParallaxEnabled = $('.footer-parallax-enabled');
	if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
		var $footerParallaxEnabled = $('#colophon');
		var $footerParallaxOpacity = $('.footer-parallax-opacity');
			
		$bodyParallaxEnabled.css("padding-bottom", $footerParallaxEnabled.outerHeight());
		jQuery(window).load(function() {
			$bodyParallaxEnabled.css("padding-bottom", $footerParallaxEnabled.outerHeight());
		});
		var $footerParallaxOpacityBeforeBottom = $footerParallaxEnabled.outerHeight() - 130;
		$footerParallaxOpacity.attr('data-'+$footerParallaxOpacityBeforeBottom+'-end','opacity: 0;');
		$footerParallaxOpacity.attr('data-0-end','opacity: 1;');
		$footerParallaxOpacity.attr('data-smooth-scrolling','off');
			
		$window.smartresize(function() {
			$bodyParallaxEnabled.css("padding-bottom", $footerParallaxEnabled.outerHeight());
		});
	} else {
		$bodyParallaxEnabled.css({'position': 'relative', 'z-index': '0'});
	}
	
	$window.smartresize(function() {
		setTimeout(function(){
			s.refresh();
		}, 100);
	});
	
	// Contact Loader
	$( ".ajax-loader" ).append( '<svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="6" stroke-miterlimit="10"/></svg>' );
	
	// Team Slider
	var $teamSliderWrapper = $( '.team-slider-wrapper' );
	if ($teamSliderWrapper.length) {
		$teamSliderWrapper.each(function() {
			var $teamSlider = $(this).find('.team-slider');
			$teamSlider.slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: true,
			  fade: true,
			  variableWidth: false,
			  infinite: true,
			  adaptiveHeight: true
			});
		});
		
	}
	
	// Slick Slider
	var $slickSliderWrapper = $( '.slick-slider-wrapper' );
	if ($slickSliderWrapper.length) {
		$slickSliderWrapper.each(function() {
			var $slickSlider = $(this).find('.mt-carousel');
			var nav = $slickSlider.attr('data-nav') === 'true';
			var dots = $slickSlider.attr('data-dots') === 'true';
			if ( $slickSlider.hasClass('image-carousel-alternative-style-4') || $slickSlider.hasClass('portfolio-carousel-alternative-style-2') ) {
				
				$slickSlider.slick({
				  centerMode: true,
				  centerPadding: '0px',
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  arrows: nav,
				  fade: true,
				  variableWidth: false,
				  infinite: true,
				  adaptiveHeight: false,
				  draggable: false,
				  swipe: false,
				  touchMove: false
				});
				
			} else {
				
				if ($slickSlider.attr('data-slide-number-status') === 'true') {
					var $status = $(this).find('.paging-info');
					$slickSlider.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {
						var i = (currentSlide ? currentSlide : 0) + 1;
						$status.html(i + '<span class="slash">/</span>' + slick.slideCount);
					});
				}
				
				$slickSlider.slick({
				  slidesToShow: 1,
				  slidesToScroll: 1,
				  arrows: nav,
				  dots: dots,
				  fade: true,
				  variableWidth: false,
				  infinite: true,
				  adaptiveHeight: false,
				  autoplay: false,
				  autoplaySpeed: 2800,
				  pauseOnFocus: false,
				  pauseOnHover: false,
				});
				
			}
		
		});
		
	}
	
	// Single Product
	var $singleProduct = $( '.single-product' );
	if ($singleProduct.length) {
		Fresco.setDefaultSkin('custom');
		
		var $sliderProduct = $('.slider').find('.slider-for');
		var $sliderProductImage = $('.slider').find('.slider-for li');
		if($sliderProductImage.length > 1) {
			var $slidesLinks = $('.slider-nav a');
			$slidesLinks.on('click', function( e ) {
				e.preventDefault();
			});
			
			$sliderProduct.on({
			beforeChange: function (event, slick, current_slide_index, next_slide_index) {
				$('.slider-nav .slick-slide').removeClass('slick-main-active');
				$('.slider-nav .slick-slide[data-index=' + next_slide_index + ']').addClass('slick-main-active');
			}
			}).slick({
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  arrows: false,
			  fade: true,
			  variableWidth: false,
			  infinite: false,
			  asNavFor: '.slider-nav'
			});
			
			var $sliderProductNav = $('#carousel').find('.slider-nav');
			$sliderProductNav.slick({
			  slidesToShow: 10,
			  slidesToScroll: 1,
			  asNavFor: $sliderProduct,
			  dots: false,
			  centerMode: false,
			  focusOnSelect: true,
			  arrows: false,
			  infinite: false,
			  variableWidth: false
			});
			
		}
		
		// Owl Carousel Related Products
		var $relatedProducts = $('.owl-carousel-enabled');
		if ($relatedProducts.length) {
				var owlCarousel = $(this).find('.owl-carousel');
				owlCarousel.owlCarousel({
					items: 3,
					margin: 30,
					dots: true,
					nav: false,
					navText: [],
					loop: true,
					center: false,
					slideBy: 3,
					smartSpeed: 150,
					stagePadding: 20,
					responsive : {
						// breakpoint from 0 up
						0 : {
							items: 1,
							margin: 30,
							dots: true,
							nav: false,
							navText: [],
							loop: true,
							center: false,
							slideBy: 3,
							smartSpeed: 150,
						},
						// breakpoint from 480 up
						680 : {
							items: 2,
							margin: 30,
							dots: true,
							nav: false,
							navText: [],
							loop: true,
							center: false,
							slideBy: 3,
							smartSpeed: 150,
						},
						// breakpoint from 768 up
						968 : {
							items: 3,
							margin: 30,
							dots: true,
							nav: false,
							navText: [],
							loop: true,
							center: false,
							slideBy: 3,
							smartSpeed: 150,
						}
					},
				});
				
				// Go to the next item
				$('.related .owl-next').on( 'click', function() {
					owlCarousel.trigger('next.owl.carousel');
				})
				// Go to the previous item
				$('.related .owl-prev').on( 'click', function() {
					owlCarousel.trigger('prev.owl.carousel');
				})
		}
	}
	
	jQuery(window).load(function() {

		// Cart count animation
		if ($( '.cart-contents-count' ).length) {
			$( '.cart-contents-count' ).addClass("cart-contents-count-hidden");
			setTimeout(function() {
				$( '.cart-contents-count' ).addClass("cart-contents-count-animation-document-start");
			}, 450);
		}
		
		// Radio buttons, checkboxes
		$( 'input[type="radio"]' ).addClass("input-radio-custom");
		$( 'input[type="checkbox"]' ).addClass("input-checkbox-custom");
		
		// select2 dropdowns
		if ($( 'select#calc_shipping_country, select#calc_shipping_state' ).length) {
			$('select#calc_shipping_country, select#calc_shipping_state').select2();
		}
		
		// Remove Qty title
		$( '.qty' ).removeAttr( "title" );
		
	});
	
	// Easy Social Share custom style
	var $socialShareCustom = $( '#page .easy-social-share-button-custom' );
	if ($socialShareCustom.length) {
		$socialShareCustom.find('.essb_link_sharebtn a').on( 'click', function() {
			$(this).closest(".essb_link_sharebtn").toggleClass("active").parent().toggleClass("active");
		});
		
		$(document).on("click", function(e) {
			$(".essb_links_list, .essb_link_sharebtn").removeClass("active");
		});
		
		if ($singleProduct.length) {
			$socialShareCustom.find('.essb_links_list').children('li').wrapAll('<div class="essb_links_list-drop" />');
		} else {
			$socialShareCustom.find('.essb_links_list').children('li').not(':last-child').wrapAll('<div class="essb_links_list-drop" />');
		}
	}
	
	// Expandable
	var $expandable = $( '.expandable-wrapper' );
	if ($expandable.length) {
		$expandable.find('.expandable-button i').on( 'click', function() {
			toggleExpandable();
		});
	}
	
	function toggleExpandable() {
		if ( $expandable.hasClass('active') ) {
			$expandable.find( '.expandable-container' ).transition({
				opacity: 0, y: '-15px',
				duration: 400,
				easing: 'ease',
				delay: 0,
			});
			setTimeout(function(){
				$expandable.removeClass('active');
			}, 400);
			setTimeout(function(){
				$expandable.find( '.expandable-button' ).removeClass('active');
			}, 1000);
		} else {
			$expandable.addClass('active');
			$expandable.find( '.expandable-container' ).transition({
				opacity: 1, y: 0,
				duration: 400,
				easing: 'ease',
				delay: 600,
			});
			setTimeout(function(){
				$expandable.find( '.expandable-button' ).addClass('active');
			}, 600);
		}
	}
	
	// YITH Wishlist message
		var $yithWcwlPopupMessage = $( '#yith-wcwl-popup-message' );
		if ($yithWcwlPopupMessage.length) {
			$yithWcwlPopupMessage.appendTo(".yith-wcwl-add-to-wishlist");
		}
		
		// YITH Wishlist loading spinner, icon
		var $addToWishlist = $( '.yith-wcwl-add-to-wishlist' );
		if ($addToWishlist.length) {
			// YITH Wishlist loading spinner, icon
			$addToWishlist.find( '.ajax-loading' ).wrap("<i class='ajax-loading-wrapper'></i>");
			$addToWishlist.find( '.add_to_wishlist' ).prepend( "<i class='add_to_wishlist-icon'></i>" );
			// YITH Wishlist exist
			if ( $( '.yith-wcwl-wishlistexistsbrowse' ).hasClass( "show" ) ) {
				$addToWishlist.addClass('exist');
			}
			
		// YITH Wishlist loading spinner
		$(document).ajaxSend(function(event, jqxhr, settings) {
			if (settings.data.indexOf("action=add_to_wishlist") >= 0) {
				$( '.yith-wcwl-add-to-wishlist' ).addClass('loading');
			}
		});
		
		}
		
		// YITH Wishlist loading icon animation
		$( ".add_to_wishlist" ).on( 'click', function() {
			$(this).find( '.add_to_wishlist-icon' ).clone().css({'position': 'absolute', 'z-index': '1'}).prependTo($(this)).addClass('add_to_wishlist-icon-animated-1');
			$(this).find( '.add_to_wishlist-icon' ).clone().css({'position': 'absolute', 'z-index': '1'}).prependTo($(this)).addClass('add_to_wishlist-icon-animated-2');
			$(this).find( '.add_to_wishlist-icon' ).clone().css({'position': 'absolute', 'z-index': '1'}).prependTo($(this)).addClass('add_to_wishlist-icon-animated-3');
			setTimeout(function() {
				$('.add_to_wishlist-icon-animated-1, .add_to_wishlist-icon-animated-2, .add_to_wishlist-icon-animated-3').remove();
			}, 1200);
		});
		
		// YITH Wishlist table
		var $woocommerceWishlist = $( '.woocommerce-wishlist' );
		if ($woocommerceWishlist.length) {
			var thAttrProductName = $('th.product-name').text();
			var thAttrProductPrice = $('th.product-price').text();
			var thAttrProductStatus = $('th.product-stock-stauts').text();
			$( '.wishlist_table td.product-name' ).attr("data-title",thAttrProductName);
			$( '.wishlist_table td.product-price' ).attr("data-title",thAttrProductPrice);
			$( '.wishlist_table td.product-stock-status' ).attr("data-title",thAttrProductStatus);
		}
	
	// Post Likes
	$( document ).on("click", ".post-likes[data-id]", function(e) {
        e.preventDefault();
		var $this = $('.post-likes[data-id]');
		if ( $this.hasClass('unliked') ) {
			$this.find( '.post-likes-icon' ).clone().css({'position': 'absolute', 'z-index': '1'}).prependTo($this).addClass('post-likes-icon-animated-1');
			$this.find( '.post-likes-icon' ).clone().css({'position': 'absolute', 'z-index': '1'}).prependTo($this).addClass('post-likes-icon-animated-2');
			$this.find( '.post-likes-icon' ).clone().css({'position': 'absolute', 'z-index': '1'}).prependTo($this).addClass('post-likes-icon-animated-3');
			setTimeout(function() {
				$('.post-likes-icon-animated-1, .post-likes-icon-animated-2, .post-likes-icon-animated-3').remove();
			}, 1200);
		}
		var postLikesCount = $('.post-likes-wrapper').find(".post-likes-count");
		$.ajax({
		  url: ajaxurl,
		  data: {
			  action: 'mega_update_post_likes',
			  post_id: $this.data("id")
		  },
		  dataType: 'json',
		  beforeSend: function (xhr) {
			  $this.addClass("loading")
		  },
		  success: function (data) {
			$this.removeClass("loading");
			postLikesCount.addClass("text-is-hidden");
			setTimeout(function() {
				postLikesCount.text(data.count);
				postLikesCount.removeClass('text-is-hidden').addClass("text-is-visible");
			}, 400);
			if (data.liked) {
				$this.addClass("liked").removeClass("unliked");
			} else {
				$this.removeClass("liked").addClass("unliked");
			}
		  }
		});
    });
	
	$( document ).on( 'added_to_wishlist', function( response ) {
		$( '.yith-wcwl-add-to-wishlist' ).removeClass('loading').addClass('added');
		// YITH Wishlist exist
		if ( $( '.yith-wcwl-wishlistaddedbrowse' ).hasClass( "show" ) ) {
			$( '.yith-wcwl-add-to-wishlist' ).addClass('exist');
		}
		window.setTimeout( function() {
			$( '.yith-wcwl-add-to-wishlist' ).removeClass('added');
        }, 2500 );
	} );
	
	$( document ).on( 'updated_wc_div', function() {
		
		// Cart count animation
		setTimeout(function() {
			$( '.cart-contents-count' ).addClass("cart-contents-count-animation");
		}, 1400);
		
		// Remove Qty title
		$( '.qty' ).removeAttr( "title" );
		
		// Update cart button wrapper
		var updateCartButton = $( '.button[name="update_cart"]' );
		updateCartButton.parent().addClass("disabled");
		$('.shop_table .quantity .minus, .shop_table .quantity .plus').on('click', function() {
			updateCartButton.parent().removeClass("disabled");
		});
	} );
	
	$('body').on('added_to_cart',function() {
        
		// Cart count animation
		$( '.cart-contents-count' ).addClass("cart-contents-count-animation");
		
		setTimeout(function() {
			$( '.product-list-cart' ).transition({
				opacity: 1, y: '0px', visibility: 'visible',
				duration: 350,
				easing: 'ease',
				complete: function() {
					setTimeout(function() {
						$( '.product-list-cart' ).transition({
							opacity: 0, y: '15px', visibility: 'hidden',
							duration: 350,
							easing: 'ease',
						});
					}, 2500);
				}
			});
		}, 300);
		
    });
	
	$('body').on('updated_checkout',function() {
		// Radio buttons
		$( 'input[type="radio"]' ).addClass("input-radio-custom");
    });
	
	// Update button wrapper
	var wrapper = $( 'form.register, form.checkout, form.edit-account, form.lost_reset_password' ),
	submit = $( 'input[type="submit"]', wrapper ),
	submitWrapper = $( '.submit-button-wrapper', wrapper );
	$('body').on("keyup",'form.register #reg_password', function(){
	  if ( submit.is(".disabled") ) {
		  submitWrapper.addClass( 'disabled' );
	  } else {
		  submitWrapper.removeClass( 'disabled' );
	  }
	});
	
	// Button wrapper trigger form
	 $(document).on("click", ".submit-button-wrapper", function () {
		var input = $(this).find('input');
		if (!$(this).hasClass("disabled")) {
			input.trigger('click');
		}
	});

	$(document).on("click", ".submit-button-wrapper input", function (e) {
		e.stopPropagation();
	});
	
	var $cart = $( 'body.woocommerce-cart' );
	if ($cart.length) {
		$( document ).ajaxSuccess(function() {
			// select2 dropdowns
			if ($( 'select#calc_shipping_country, select#calc_shipping_state' ).length) {
				$('select#calc_shipping_country, select#calc_shipping_state').select2();
			}
		});
		
		// Update cart button wrapper
		var updateCartButton = $( '.button[name="update_cart"]' );
		if ( updateCartButton.prop( "disabled" ) ) {
			updateCartButton.parent().addClass("disabled");
		}
		$('.shop_table .quantity .minus, .shop_table .quantity .plus').on('click', function() {
			updateCartButton.parent().removeClass("disabled");
		});
	}
	
	// Shorten
	var showChar = 227;
	var ellipsestext = "...";
	var moretext = "More";
	var lesstext = "Less";
	$('.main-product-wrapper .woocommerce-product-details__short-description p').each(function() {
		var content = $(this).html();

		if(content.length > showChar) {

			var c = content.substr(0, showChar);
			var h = content.substr(showChar, content.length - showChar);

			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

			$(this).html(html);
		}

	});

	$(".morelink").on( 'click', function() {
		if($(this).hasClass("less")) {
			$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
	
	// YIKES Easy Forms for MailChimp Button
	var $easyFormsButton = $('.yikes-easy-mc-submit-button');
	if ($easyFormsButton.length) {
		$easyFormsButton.wrapInner("<span class='yikes-easy-mc-submit-button-helper'></span>");
		$easyFormsButton.find('.yikes-easy-mc-submit-button-helper').after('<i></i>');
	}
	
	// Input to button
	var $inputButton = $('.wpcf7-submit, #page #respond input#submit');
	if ($inputButton.length) {
		$inputButton.each(function(){
			var $this = $(this);
			$this[0].outerHTML = $this[0].outerHTML.replace(/^\<input/, '<button') + '<span>' + $this[0].value + '</span>' + '</button>'
		});
	}
	
	// Comment Link
	var $commentLink = $('.comment-author .fn .url, .comment-edit-link, .comment-reply-link, #respond #cancel-comment-reply-link');
	if ($commentLink.length) {
		$commentLink.contents().wrap('<span/>')
	}
	
	// WooCommerce Result Count and Ordering Position
	var $WCresultCountOrdering = $('.woocommerce-result-count, .woocommerce-ordering-wrapper');
	if ($WCresultCountOrdering.length) {
		$WCresultCountOrdering.insertBefore( '#main' ).wrapAll('<div class="result-count-ordering-wrapper"/>').wrapAll('<div class="result-count-ordering clearfix"/>');
	}
	
	// delegate all clicks on "a" tag (links)
	var timeoutFadeOut = 0;
	$(document).on("click", "a", function () {
		if ( $(this).is('.add_to_wishlist, .slick-thumbnail, .slick-slider a, .remove, .ajax_add_to_cart, .gallery-alternative-item a, .fancybox-close, .vc_general') ) {
			return;
		}

		// get the href attribute
		var newUrl = $(this).attr("href");
		var newUrlTarget = $(this).attr("target");

		// veryfy if the new url exists or is a hash
		if ( !newUrl || newUrl === "javascript:void(null);" || newUrl.indexOf('#') > -1 || newUrlTarget === '_blank' || newUrl.indexOf('mailto:') > -1 || newUrl.indexOf('tel:') > -1  ) {
			return;
		}
		
		if ( $('.nav-menu-primary-header > ul > li').hasClass('sfHover') ) {
			timeoutFadeOut = 75;
			$('.nav-menu-primary-header > ul > li').removeClass('sfHover');
		}
		
		if ( $('.mobile-menu-dropdown').hasClass('open') ) {
			timeoutFadeOut = 200;
			
			// Close
			$('.mobile-menu-wrapper').transition({
				x: '-100%',
				duration: 200,
				easing: 'ease',
			});
			
			// Content Animate
			$('#main-wrapper, #colophon, .entry-header-bg').transition({
				x: '0',
				duration: 300,
				easing:  'ease',
			});
		  
			// Menu Items
			var $mobileMenuItems = $('.mobile-menu-wrapper .nav-menu > .menu-item');
			$mobileMenuItems.each(function(i){
				$(this).delay(i*1).transition({
					opacity: 0, x: '-50px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
			});
		  
			$('.overlay-for-mobile-menu').removeClass('visible');
			
            $('.mobile-menu-dropdown').removeClass('open');
        }
		
		if ( $('#secondary-menu-dropdown').hasClass('open') ) {
			timeoutFadeOut = 200;
			
			// Close
			
			// Left
			$('#secondary-menu-wrapper.align-left.center-and-full-width-disabled').transition({
				x: '-100%',
				duration: 200,
				easing: 'ease',
			});
		  
			// Right
			$('#secondary-menu-wrapper.align-right.center-and-full-width-disabled').transition({
				x: '100%',
				duration: 200,
				easing: 'ease',
			});
		  
			// Center and Full Width Enabled
			$('#secondary-menu-wrapper.align-left.center-and-full-width-enabled, #secondary-menu-wrapper.align-right.center-and-full-width-enabled').transition({
				height: '0%', opacity: 0,
				duration: 300,
				easing:  'ease',
			});
		  
			// Menu Items
			// Left
			var $menuItems = $('#secondary-menu-wrapper.align-left.center-and-full-width-disabled .secondary-menu li');
			$menuItems.each(function(i){
				$(this).delay(i*1).transition({
					opacity: 0, x: '-100px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
			});
		  
			// Right
			var $menuItems = $('#secondary-menu-wrapper.align-right.center-and-full-width-disabled .secondary-menu li');
			$menuItems.each(function(i){
				$(this).delay(i*1).transition({
					opacity: 0, x: '100px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
			});
		  
			// Center and Full Width Enabled
			var $menuItems = $('#secondary-menu-wrapper.align-left.center-and-full-width-enabled .secondary-menu li, #secondary-menu-wrapper.align-right.center-and-full-width-enabled .secondary-menu li');
			$menuItems.each(function(i){
				$(this).delay(i*1).transition({
					opacity: 0, y: '100px',
					duration: 50,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
					delay: 50,
				});
			});
			
            $('#branding #secondary-menu-dropdown').removeClass('open');
		}
		
		var $header_position_animation = '';
		if ( $('#page').hasClass('header-position-top') ) {
			$header_position_animation = '-100%';
		} else if ( $('#page').hasClass('header-position-bottom') ) {
			$header_position_animation = '100%';
		} else if ( $('#page').hasClass('header-position-left') ) {
			$header_position_animation = '-100%';
		} else if ( $('#page').hasClass('header-position-right') ) {
			$header_position_animation = '100%';
		}
		
		if ( $('#page').hasClass('header-position-left') || $('#page').hasClass('header-position-right') ) {
			
			var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			if (navigator.userAgent.match('MSIE 8') == null) {
				mediaQueryId = mediaQueryId.replace( /"/g, '' );
			}
			
			if (mediaQueryId !== 'medium') {
				setTimeout(function(){
					$(".center-logo-and-menu-disabled #header").transition({
						opacity: 0, x: $header_position_animation,
						duration: 150,
						easing: 'cubic-bezier(0,0.9,0.3,1)',
					});
				}, timeoutFadeOut * 2);
			} else {
				setTimeout(function(){
					$(".center-logo-and-menu-disabled #header").transition({
						opacity: 0, y: $header_position_animation,
						duration: 150,
						easing: 'cubic-bezier(0,0.9,0.3,1)',
					});
				}, timeoutFadeOut * 2);
			}
		
		} else {
			
			setTimeout(function(){
				$(".center-logo-and-menu-disabled #header").transition({
					opacity: 0, y: $header_position_animation,
					duration: 150,
					easing: 'cubic-bezier(0,0.9,0.3,1)',
				});
			}, timeoutFadeOut * 2);
			
		}
		
		setTimeout(function(){
			$("#page").transition({
				opacity: 0, visibility: 'hidden',
				duration: 300,
				easing: 'ease',
				complete: function() {
					// when the animation is complete, set the new location
					location = newUrl;
				}
			});
		}, timeoutFadeOut * 2 + 100);

		// prevent the default browser behavior.
		return false;
	});
		
	$('.essb_links_list li a, .lightbox-video, .play-button').on('click', function(e) {
		e.stopPropagation();
	});
	
	$('.bg-parallax-inner').imagesLoaded( { background: true }, function() {
		$(".bg-parallax-inner").transition({
			opacity: 1,
			duration: 600,
			easing: 'ease',
		});
	});
	
	// select2
	//$(".widget-area select, .wpb_widgetised_column select").select2({
		//minimumResultsForSearch: -1
	//});
	
	// lazy-load-xt init
	$window.lazyLoadXT();
	
	// Read more empty tags
	$(".wpb_thumbnails-alternative .wpb_content_element").filter( function() {
		$this = $(this);
		return (!$.trim($this.text()).length);
	}).hide()
	
}); // END jQuery(function()