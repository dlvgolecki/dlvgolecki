jQuery(document).ready(function($) {
  "use strict";
  //toggle link, grid-link script
  if (screen.width >= 1280) {
    $('.clickevent .toggle-link, .clickevent .grid-link').on('click', function(){
      $('body').removeClass('scroll-false');
      $('.elstn-sidebar').toggleClass('open');
      $('.elstn-sidebar').removeClass('static-width');
      $('.elstn-wrap-inner').toggleClass('open');
      $('.elstn-wrap-inner').removeClass('static-width');
      $('.elstn-search-wrap').removeClass('open');
      $('.elstn-search-wrap').addClass('closing');
      $('.elstn-toggle-btn').removeClass('active');
        setTimeout(function() {
          $('.elstn-search-wrap').removeClass('closing');
        }, 350);
    });
  }

  //onclick, and hover script
  if ($('div').hasClass("clickevent")) {
     $('.toggle-link, .grid-link').on('click', function () {
      $('.elstn-sidebar').on(function () {
        $(this).toggleClass('open');
        $('.elstn-wrap-inner').toggleClass('open');
        $('.elstn-detail-wrap').removeClass('fixed');
     });
    });
  } else if($('html').hasClass("no-touchevents")) {
    // $('.elstn-sidebar').on('hover', function () {
    //   $(this).toggleClass('open');
    //   $('.elstn-wrap-inner').toggleClass('open');
    //   $('.elstn-detail-wrap').removeClass('fixed');
    // });

    // New
    $('.elstn-sidebar').on({
      mouseenter: function(){
        $(this).addClass('open');
        $('.elstn-wrap-inner').addClass('open');
        $('.elstn-detail-wrap').removeClass('fixed');
        $('.elstn-toggle-btn').addClass('active');
      },
      mouseleave: function(){
        $(this).removeClass('open');
        $('.elstn-wrap-inner').removeClass('open');
        $('.elstn-detail-wrap').addClass('fixed');
        $('.elstn-toggle-btn').removeClass('active');
      }
    });
    // New

  }

  //div outside click remove script
  $(document).on('click', function(e) {
    if ($(e.target).is('.elstn-sidebar, .elstn-sidebar *, .elstn-toggle-btn, .elstn-toggle-btn *') === false) {
      $('.elstn-sidebar, .elstn-wrap-inner').removeClass('open');
      $('.elstn-toggle-btn').removeClass('active');
    }
  });

  //onclick toggle class script
  $('.search-link').on('click', function() {
     $('body').toggleClass('scroll-false');
     $('.elstn-search-wrap').toggleClass('open');
     $('.elstn-search-wrap').find('.search-input').focus();
     $('.elstn-sidebar').toggleClass('static-width');
     $('.elstn-sidebar').removeClass('open');
     $('.elstn-wrap-inner').toggleClass('static-width');
     $('.elstn-wrap-inner').removeClass('open');
     $('.elstn-toggle-btn').removeClass('active');
  });
  $('.search-link').on('click', function() {
    $('.elstn-search-wrap').addClass('closing');
      setTimeout(function()
        {
          $('.elstn-search-wrap').removeClass('closing');
      }, 350);
  });

  //search closer script
  $('.search-closer').on('click', function() {
     $('body').removeClass('scroll-false');
     $('.elstn-search-wrap').removeClass('open');
     $('.elstn-sidebar').removeClass('open');
     $('.elstn-sidebar').removeClass('static-width');
     $('.elstn-wrap-inner').removeClass('open');
     $('.elstn-wrap-inner').removeClass('static-width');
  });
  $('.search-closer').on('click', function() {
    $('.elstn-search-wrap').addClass('closing');
      setTimeout(function()
        {
          $('.elstn-search-wrap').removeClass('closing');
      }, 350);
  });

  //onclick slidedown and slideup script
  $('.toggle-link').on('click', function() {
     $('#main-nav').slideDown(420);
     $('#portfolio-nav').slideUp(420);
  });
  $('.grid-link').on('click', function() {
     $('#main-nav').slideUp(420);
     $('#portfolio-nav').slideDown(420);
  });

  //toggle button script
  $('.elstn-toggle-btn a').on('click', function() {
      $('body').removeClass('scroll-false');
      $('.elstn-toggle-btn').toggleClass('active');
      $('.elstn-sidebar').toggleClass('open');
      $('.elstn-sidebar').removeClass('static-width');
      $('.elstn-wrap-inner').toggleClass('open');
      $('.elstn-wrap-inner').removeClass('static-width');
      $('.elstn-search-wrap').removeClass('open');
      $('.elstn-search-wrap').toggleClass('closing');
      setTimeout(function()
        {
          $('.elstn-search-wrap').removeClass('closing');
      }, 350);
  });

  //sub menu script
  $('nav ul > li.sub-menu-item').hover(function() {
      $(this).children('.sub-menu:hidden').slideDown();
    }, function() {
      $(this).children('.sub-menu:visible').slideUp();
  });

  //elstn banner spacer height script
  $(window).resize(function() {
    $('.elstn-banner-spacer').height($('.elstn-top-banner').height() );
  });
  $(window).trigger('resize');

  //banner effect script
  function parallax(){
    var scrolled = $(window).scrollTop();
    $('.elstn-parallax-text .banner-caption').css('top', (scrolled * 0.5) + 'px');
    $('.elstn-parallax-text .banner-caption').css('opacity', 1-(scrolled / 950));
    $('.elstn-parallax-section').css('top', -(scrolled * 0.1) + 'px');
  }
  $(window).scroll(function(){
    parallax();
  });

  //bootstrap jquery tab script
  $('#tabs').tab();

  //mate list hover script
  $('.mate-list, .blog-item, .post-item, .item, .gallery-item').hover(
     function(){$(this).addClass('ishover')},
     function(){$(this).removeClass('ishover')}
  );

  var prev_item_height = $('.post-item.prev-post').height();
  var next_item_height = $('.post-item.next-post').height();
  if (prev_item_height > next_item_height) {
    $('.post-item.next-post').removeClass('first-item-height');
    $('.post-item.prev-post').addClass('second-item-height');
  } else if (prev_item_height == next_item_height) {
    $('.post-item.prev-post').removeClass('second-item-height');
    $('.post-item.next-post').removeClass('first-item-height');
    $('.post-item.next-post').addClass('first-item-height');
  } else {
    $('.post-item.prev-post').removeClass('second-item-height');
    $('.post-item.next-post').addClass('first-item-height');
  }

  //default sliders script
  $(window).load(function() {
  $('.elstn-default-slider').each( function() {
    var $carousel = $(this);
    var $items = ($carousel.data("items") !== undefined) ? $carousel.data("items") : 1;
    var $items_tablet = ($carousel.data("items-tablet") !== undefined) ? $carousel.data("items-tablet") : 1;
    var $items_mobile_landscape = ($carousel.data("items-mobile-landscape") !== undefined) ? $carousel.data("items-mobile-landscape") : 1;
    var $items_mobile_portrait = ($carousel.data("items-mobile-portrait") !== undefined) ? $carousel.data("items-mobile-portrait") : 1;
        $carousel.owlCarousel({
        loop : ($carousel.data("loop") !== undefined) ? $carousel.data("loop") : true,
        items : $carousel.data("items"),
        margin : ($carousel.data("margin") !== undefined) ? $carousel.data("margin") : 0,
        dots : ($carousel.data("dots") !== undefined) ? $carousel.data("dots") : true,
        nav : ($carousel.data("nav") !== undefined) ? $carousel.data("nav") : false,
        navText : ["<div class='slider-no-current'><span class='current-no'></span><span class='total-no'></span></div><span class='current-monials'></span>", "<div class='slider-no-next'></div><span class='next-monials'></span>"],
        autoplay : ($carousel.data("autoplay") !== undefined) ? $carousel.data("autoplay") : false,
        autoplayTimeout : ($carousel.data("autoplay-timeout") !== undefined) ? $carousel.data("autoplay-timeout") : 5000,
        animateOut : ($carousel.data("animateout") !== undefined) ? $carousel.data("animateout") : false,
        mouseDrag : ($carousel.data("mouse-drag") !== undefined) ? $carousel.data("mouse-drag") : true,
        autoWidth : ($carousel.data("auto-width") !== undefined) ? $carousel.data("auto-width") : false,
        autoHeight : ($carousel.data("auto-height") !== undefined) ? $carousel.data("auto-height") : false,
        responsiveClass: true,
        responsive : {
          0 : {
            items : $items_mobile_portrait,
          },
          480 : {
            items : $items_mobile_landscape,
          },
          768 : {
            items : $items_tablet,
          },
          960 : {
            items : $items,
          }
        }
      });
     //adding slide nav and slide numbers script
    var totLength = $(".owl-dot", $carousel).length;
      $(".total-no", $carousel).html(totLength);
      $(".current-no", $carousel).html(totLength);
      $carousel.owlCarousel();
      $(".current-no", $carousel).html(1);
     //owl event nav slide current and total numbers script
    $carousel.on('changed.owl.carousel', function(event) {
      var total_items = event.page.count;
      var currentNum = event.page.index + 1;
        $(".total-no", $carousel ).html(total_items);
        $(".current-no", $carousel).html(currentNum);
      });
    });
  });

  //back top script
  jQuery('.elstn-back-top').hide();
  jQuery(function () {
    jQuery(window).scroll(function () {
      if (jQuery(this).scrollTop() > 150) {
        jQuery('.elstn-back-top').fadeIn();
      } else {
        jQuery('.elstn-back-top').fadeOut();
      }
    });
    jQuery('.elstn-back-top a').on('click', function () {
      jQuery('body,html').animate({
        scrollTop: 0
      }, 350);
      return false;
    });
   });

  // Filter script
  $(window).on("load",function(){
    var $grid = $('.elstn-masonry').isotope({
      itemSelector: '.item',
      layoutMode: 'packery'
    });
    var filterFns = {
      ium: function() {
        var name = $(this).find('.name').text();
        return name.match( /ium$/ );
      }
    };
    $('.filter-buttons').on( 'click', 'a', function() {
      var filterValue = $( this ).attr('data-filter');
      filterValue = filterFns[ filterValue ] || filterValue;
      $grid.isotope({ filter: filterValue });
    });
    $('.filter-buttons').each( function( i, buttonGroup ) {
      var $buttonGroup = $( buttonGroup );
      $buttonGroup.on( 'click', 'a', function() {
        $buttonGroup.find('.active').removeClass('active');
        $( this ).addClass('active');
       });
      });
  });

  //blog item hover script
  $('.share-post h6 a').on('click', function() {
    $(this).toggleClass('active');
    $('.share-post ul').slideToggle();
  });

  // Blog author fixed script
  $('.elstn-blog-sticky .col-md-4')
    .theiaStickySidebar({
      additionalMarginTop: 30
  });

  //full page script
  $('#elstn-fullpage').fullpage({
    'verticalCentered': false,
    'css3': false,
    'navigation': true,
    'navigationPosition': 'right',
    responsiveWidth: 900,
    onLeave: function(index, nextIndex, direction){
      if (index == 5 && direction == 'down'){
        $('.section').eq(index -1).removeClass('moveDown').addClass('moveUp');
      }
      else if(index == 5 && direction == 'up'){
        $('.section').eq(index -1).removeClass('moveUp').addClass('moveDown');
      }
      // Fullpage Navigation Change
      var section_id = $('.elstn-fixed-bg.active').attr('id');
      $('body').removeClass(section_id);
    },
    afterLoad: function(anchorLink, index){
      // Fullpage Navigation Change
      var section_id = $('.elstn-fixed-bg.active').attr('id');
      $('body').addClass(section_id);
    }
  });
  // Down Arrow
  $(document).on('click', '#menu a', function(e){
    e.preventDefault();
    $.fn.fullpage.moveSectionDown();
  });

  // magnific popup script
  $('.elstn-portfolio-picture, .elstn-products-wrap, .gallery-item').magnificPopup({
    delegate: 'a',
    type: 'image',
    closeOnContentClick: false,
    closeBtnInside: false,
    mainClass: 'mfp-with-zoom mfp-img-mobile',
    closeMarkup:'<div class="mfp-close" title="%title%"></div>',
    image: {
      verticalFit: true,
      titleSrc: function(item) {
        return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
      }
    },
    gallery: {
      enabled: true,
      arrowMarkup:'<div title="%title%" class="mfp-arrow mfp-arrow-%dir%"></div>',
    },
    zoom: {
      enabled: true,
      duration: 300, // don't foget to change the duration also in CSS
      opener: function(element) {
        return element.find('img');
      }
    }
  });

  //project info script
  $('.see-project a').on('click', function() {
      $('.see-project').addClass('disable');
      $('.elstn-project-wrap').addClass('active');
   });
  $('.action-arrow a').on('click', function() {
      $('.see-project').removeClass('disable');
      $('.elstn-project-wrap').removeClass('active');
   });

  // floting sidebar script
  $(window).scroll(function() {
    var $window = jQuery(window),
    $flotingbar = jQuery('.elstn-floting-wrap'),
    offset = jQuery('.elstn-portfolio-detail .container').offset(),
    $scrolling = jQuery('.elstn-portfolio-detail .vc_col-sm-8').height(),
    $offsetHeight = jQuery('.elstn-portfolio-detail .vc_col-sm-8').offset(),
    $topHeight = 0;
      if (jQuery('.elstn-floting-wrap').length > 0) {
        if ($window.width() > 1023) {
          if (($window.scrollTop() + $topHeight) > offset.top) {
            if ($window.scrollTop() + $topHeight + $flotingbar.height() + 50 < $offsetHeight.top + $scrolling) {
              $flotingbar.stop().animate({
                marginTop: ($window.scrollTop() - offset.top) + $topHeight + 30,
             });
           }
           else {
              $flotingbar.stop().animate({
              marginTop: ($scrolling - $flotingbar.height() - 80) + 30,
              });
          }
      } else {
          $flotingbar.stop().animate({
          marginTop: 0,
          paddingTop: 0
      });
      }
      } else {
      $flotingbar.css('margin-top', 0);
      }
    }
  });

  $(window).scroll(function() {
    var $window = jQuery(window), $flotingbar = jQuery('.stickysidebar'), offset = jQuery('.elstn-portfolio-detail .vc_row, .elstn-blog-detail .wrapper').offset(), $scrolling = jQuery('.elstn-portfolio-detail .vc_col-sm-8, .elstn-blog-detail .col-md-8').height(), $offsetHeight = jQuery('.elstn-portfolio-detail .vc_col-sm-8, .elstn-blog-detail .col-md-8').offset(), $topHeight = 0;
      if (jQuery('.stickysidebar').length > 0) {
        if ($window.width() > 960) {
          if (($window.scrollTop() + $topHeight) > offset.top) {
            if ($window.scrollTop() + $topHeight + $flotingbar.height() + 50 < $offsetHeight.top + $scrolling) {
              $flotingbar.stop().animate({
                marginTop: ($window.scrollTop() - offset.top) + $topHeight + 30,
             },0);
           }
           else {
              $flotingbar.stop().animate({
              marginTop: ($scrolling - $flotingbar.height() - 80) + 30,
              },0);
          }
      } else {
          $flotingbar.stop().animate({
          marginTop: 0,
          paddingTop: 0
      },0);
      }
      } else {
      $flotingbar.css('margin-top', 0);
      }
    }
  });

  //blog author fixed script

  var tr = $(".elstn-target").hasClass("sticky");
  var tr1 = $(".elstn-target").hasClass("floting");

  if (tr) {
    $('.elstn-portfolio-detail .sticky').parents('.wpb_column.vc_column_container').addClass('stickysidebar');
    $('.elstn-portfolio-detail .floting').parents('.wpb_column.vc_column_container').removeClass('stickysidebar');
  }

  if (tr1) {
    $('.elstn-portfolio-detail .floting').parents('.wpb_column.vc_column_container').addClass('elstn-floting-wrap');
    $('.elstn-portfolio-detail .sticky').parents('.wpb_column.vc_column_container').removeClass('elstn-floting-wrap');
  }

  $('.elstn-portfolio-detail .sticky').parents('.wpb_column.vc_column_container').addClass('stickysidebar');
  $('.elstn-portfolio-detail .elstn-floting-wrap').parents('.wpb_column.vc_column_container').removeClass('stickysidebar');
  //$('.elstn-portfolio-detail .stickysidebar')
    //.theiaStickySidebar({
      //additionalMarginTop: 100
  //});

  // Left or Right class in Portfolio Singles
  if ($('.vc_row > div:first-child').hasClass('elstn-floting-wrap')) {
    $('.vc_row', this).addClass("floatside-left-aligned");
  }
  if ($('.vc_row > div:last-child').hasClass('elstn-floting-wrap')) {
    $('.vc_row', this).addClass("floatside-right-aligned");
  }
  if ($('.vc_row > div:first-child').hasClass('stickysidebar')) {
    $('.vc_row', this).addClass("floatside-left-aligned");
  }
  if ($('.vc_row > div:last-child').hasClass('stickysidebar')) {
    $('.vc_row', this).addClass("floatside-right-aligned");
  }

  // About Shortcode Full Height Image
  if ($('div').hasClass('about-wrapper')) {
    $('body > div', this).addClass("about-wrapper-image");
  }

  //nav script
  $('.nav-slyder').slyder({
    wrapper: 'nav-wrapper-inner',
    link: '.s-link'
  });

  //Hover script
  $('.direction-hover > .item').hoverdir({
    hoverElem: '.item-info'
  });

  //Hover script
  $('.direction-hover-inverse > .item').hoverdir({
    hoverElem: '.item-info',
    inverse: true
  });

  //Image Popup script(modern)
  var popupActive = $('div.popup').hasClass('popup-modern');
  if (popupActive) {
    $('body').addClass('gallery-version2');
  }

  //Image Popup script(modern)
  $('.elstn-projects-slider').parents('.elstn-portfolio-detail').find('.elstn-more-project').addClass('spacer2');

  //Custom Code
  $('div.vc_tta-tabs-container').children('ul.vc_tta-tabs-list').removeClass('vc_tta-tabs-list').addClass('nav nav-tabs');
  $('div.wrapper').removeClass('vc_column_container vc_col-sm-12');

  $('table').addClass('table table-bordered');
  $('iframe').wrap('<div class="elstn-video-wrap"></div>');
  $('.elstn-services').addClass('version2');
  $('.elstn-services').find('.vc_row').addClass('container service-item');
  $('.elstn-services').find('.vc_row > .wpb_column').addClass('margin-no padding-no');
  $('.elstn-services-group').addClass('wrapper');

  $('.elstn-btn.submit').on('click', function(){
    function showpanel() {
      var auth_field = $('form.comment-form .elstn-form-inputs label[for="author"]'),
          email_field = $('form.comment-form .elstn-form-inputs label[for="email"]'),
          has_auth_attr = auth_field.attr('style');
          has_email_attr = email_field.attr('style');

          if (has_auth_attr == 'display: none;') {
            $('form.comment-form .elstn-form-inputs input[name="author"]').css('border-color', '#e8e8e8');
          } else {
            auth_field.prev('input').css('border-color', 'red');
          }
          if (has_email_attr == 'display: none;') {
            $('form.comment-form .elstn-form-inputs input[name="email"]').css('border-color', '#e8e8e8');
          } else {
            email_field.prev('input').css('border-color', 'red');
          }
    }
    setTimeout(showpanel, 200);
  });

  $('form.comment-form .elstn-form-inputs input[name="author"]').keyup(function(){
    $(this).css('border-color', '#e8e8e8');
  });

  $('form.comment-form .elstn-form-inputs input[name="email"]').keyup(function(){
    $(this).css('border-color', '#e8e8e8');
  });

});