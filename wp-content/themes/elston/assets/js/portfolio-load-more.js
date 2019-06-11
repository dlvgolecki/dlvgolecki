jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp_portfolio.startPage) + 1;

	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp_portfolio.maxPages);

	// The link of the next page of posts.
	var nextLink = pbd_alp_portfolio.nextLink;

	// More text.
	var more_text = pbd_alp_portfolio.more_text;

	// Loading text.
	var loading_text = pbd_alp_portfolio.loading_text;

	// End of post text.
	var end_text = pbd_alp_portfolio.end_text;

	/**
	 * Load new posts when the link is clicked.
	 */
	if(pageNum <= max) {
		$('#elston-load-portfolio-posts a').on( "click", function() {

			// Show that we're working.
			$(this).text(loading_text);

			$.ajax({
				type: 'POST',
				url: location.href + 'page/' + pageNum + '/',
				success: function(data) {
					var result = $(data).find('div.content_ajax div.item');

					var $container = $('.elstn-masonry');
					$container.isotope({
						itemSelector: '.item',
						layoutMode: 'packery',
					});

					var $items = $(result);
					$container.append( $items );
					$container.isotope( 'appended', $items );
					$container.imagesLoaded().progress(function(){
						$container.isotope( 'layout' );
					});

					//mate list hover script
					$('.blog-item, .post-item, .item, .gallery-item').hover(
						function(){$(this).addClass('ishover')},
						function(){$(this).removeClass('ishover')}
					);
					  //Hover script
					  $('.direction-hover > .item').hoverdir({
						hoverElem: '.item-info'
					  });

					  //Hover script
					  $('.direction-hover-inverse > .item').hoverdir({
						hoverElem: '.item-info',
						inverse: true
					  });

					pageNum++;
					// Update the button message.
					if(pageNum <= max) {
						$('#elston-load-portfolio-posts a').text(more_text);
					} else {
						$('#elston-load-portfolio-posts a').css({'pointer-events': 'none','cursor': 'default'}).text(end_text);
					}
				}
			});

			return false;
		});

	} else {
		$('#elston-load-portfolio-posts a').hide();
	}
});