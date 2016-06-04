jQuery( document ).ready(function($) {
	
	// Initialize FitVids (applied only to videos that appear in posts & pages)
	$( '.entry-content' ).fitVids();

	// Maintain Vertical Rhythm on Images (Uses the 30px baseline setup in CSS.  If you change this baselines in the CSS, change it here, too!)
	var hasPostImage = $('.entry-image .wp-post-image').length;
	if (hasPostImage > 0) {
		$( '.entry-image .wp-post-image' ).baseline(30);
	}

	// Double tap responsive menu (For responsive devices.  Standard rollover in desktop and laptop browsers)
	$( '#nav li:has(ul)' ).doubleTapToGo();

	// prettyPhoto lightbox (It's a lightbox!)
	$("a[data-rel^='prettyPhoto']").prettyPhoto();

	// Slider

	$('.flexslider').imagesLoaded( function() {
	  $('.flexslider').flexslider({
	    animation : 'fade',
	    smoothHeight : true,
	    controlNav : false
	  });
	});  

  // Shrink fixed header on scroll

	function shrinkHeader() {

		if ($(window).width() > 960) {

	  	var headerHeight = $('.site-header-inner').height();  	

	  	$('body').css('margin-top', headerHeight);	 

		  $(window).scroll(function () {
			  if ($(document).scrollTop() >= headerHeight) {
			    $('.site-header-inner').addClass('tiny');
			  } else {
			  	$('.site-header-inner').removeClass('tiny');
			  }
			});
		} else {
			$('body').css('margin-top', 0);	 
		}
	}

	shrinkHeader();

  $(window).bind('resize', shrinkHeader);

	// Search
	$( ".search-btn" ).click(function() {
	  if ( $('.header-search').hasClass('open') == true ) {
	    $('.header-search').removeClass('open');
	  } else {
	    $('.header-search').addClass('open');
	  }
	});

});