(function($) {
  "use strict";

  	/* ========================================== 
	Sticky Header 1
	========================================== */
	$(window).on("scroll", function(){
		if ( $( '#site-header' ).hasClass( "sticky-header" ) ) {
			var site_header = $('#site-header').outerHeight() + 30;	
			
		    if ($(window).scrollTop() >= site_header) {	    	
		        $('.sticky-header .octf-main-header, .mobile-header-sticky .header_mobile').addClass('is-stuck');	        
		    }else {
		        $('.sticky-header .octf-main-header, .mobile-header-sticky .header_mobile').removeClass('is-stuck');		              
		    }
		}
	});

	/* ========================================== 
	Sticky Header 2
	========================================== */
	if ($('.cd-header').length) {
		//if you change this breakpoint in the style.css file, don't forget to update this value as well
		var MQL = 1170;

		//primary navigation slide-in effect
		if($(window).width() > MQL) {
			var headerHeight = $('.cd-header').height();
			$(window).on('scroll',
			{
		        previousTop: 0
		    }, 
		    function () {
			    var currentTop = $(window).scrollTop();
			    //check if user is scrolling up
			    if (currentTop < this.previousTop ) {
			    	//if scrolling up...
			    	if (currentTop > 0 && $('.cd-header').hasClass('is-fixed')) {
			    		$('.cd-header').addClass('is-visible');
			    	} else {
			    		$('.cd-header').removeClass('is-visible is-fixed');
			    	}
			    } else {
			    	//if scrolling down...
			    	$('.cd-header').removeClass('is-visible');
			    	if( currentTop > headerHeight && !$('.cd-header').hasClass('is-fixed')) $('.cd-header').addClass('is-fixed');
			    }
			    this.previousTop = currentTop;
			});
		};
	}

	/* ========================================== 
	Search on Header
	========================================== */
	$('.toggle_search').on("click", function(){
		$(this).toggleClass( "active" );
        $('.h-search-form-field').toggleClass('show');
        if ($(this).find('i').hasClass( "flaticon-search" )) {
       		$('.toggle_search > i').removeClass( "flaticon-search" ).addClass("flaticon-delete");
        }else{
       		$('.toggle_search > i').removeClass( "flaticon-delete" ).addClass("flaticon-search");
        }
        $('.h-search-form-inner > form > input.search-field').focus();
    });

    /* ========================================== 
	Header Mobile
	========================================== */
	/* mobile_mainmenu create span */
	$('.mobile_mainmenu li:has(ul)').prepend('<span class="arrow"><i class="flaticon-arrow-point-to-right"></i></span>');

	$( "#mmenu_toggle" ).on('click', function() {
		$(this).toggleClass( "active" );
		if ($(this).hasClass( "active" )) {
			$('.mobile_nav').stop(true, true).slideDown();
		}else{
			$('.mobile_nav').stop(true, true).slideUp();
		}		
	});

	$(".mobile_mainmenu > li span.arrow").click(function() {
        $(this).parent().find("> ul").stop(true, true).slideToggle()
        $(this).toggleClass( "active" ); 
    });

	/* ========================================== 
	Back To Top
	========================================== */
    if ($('#back-to-top').length) {
	    var scrollTrigger = 500, // px
	        backToTop = function () {
	            var scrollTop = $(window).scrollTop();
	            if (scrollTop > scrollTrigger) {
	                $('#back-to-top').addClass('show');
	            } else {
	                $('#back-to-top').removeClass('show');
	            }
	        };
	    backToTop();
	    $(window).on('scroll', function () {
	        backToTop();
	    });
	    $('#back-to-top').on('click', function (e) {
	        e.preventDefault();
	        $('html,body').animate({
	            scrollTop: 0
	        }, 700);
	    });	
    };

})(jQuery);