jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;

	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);

	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;

	// Class to find out and embed data.
	var class_name = pbd_alp.class_name;

	// More text.
	var more_text = pbd_alp.more_text;

	// Loading text.
	var loading_text = pbd_alp.loading_text;

	// End of post text.
	var end_text = pbd_alp.end_text;

	var search_query = pbd_alp.is_search;
	var home_url = pbd_alp.home_url;

	/**
	 * Load new posts when the link is clicked.
	 */
	if(pageNum <= max) {
		$('#elston-load-posts a').click(function() {
			// Show after click read more button.
			$(this).text(loading_text);

			if(search_query){
				var searchurl = home_url + 'page/' + pageNum + '/?s=' + search_query;
			} else {
				var searchurl = location.href + 'page/' + pageNum + '/';
			}

			$.ajax({
				type: 'POST',
				url: searchurl,
				success: function(data) {
					var result = $(data).find('div.content_ajax .'+class_name+'');
					if( class_name == 'item'){
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
					} else {
						$('div.content_ajax').append( result );
					}

					$('.blog-item, .post-item, .item, .gallery-item').hover(
					   function(){$(this).addClass('ishover')},
					   function(){$(this).removeClass('ishover')}
					);

					pageNum++;
					// Update the button message.
					if(pageNum <= max) {
						$('#elston-load-posts a').text(more_text);
					} else {
						$('#elston-load-posts a').css({'pointer-events': 'none','cursor': 'default'}).text(end_text);
					}
				}
			});

			return false;
		});

	} else {
		$('#elston-load-posts a').hide();
	}
});