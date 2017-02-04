$(document).ready(function(){
    /**
     * delay 10s will show video
     */
    setTimeout(function() {
          $("#wrap-cover-video").html('<video id="cover-video" preload="metadata" autoplay="" muted="" loop=""><source src="http://preview.byaviators.com/theme/realsite/wp-content/uploads/2015/03/Houses_1-5_720p_h264_30rf_wo.mp4" type="video/mp4"></video>');

    }, 4000);
    /**
     * scroll top
     */
    $('.move_page_top i').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    });

    $(document).scroll(function(){
        if($(this).scrollTop() > 100) {
            $('.move_page_top i').show('slow');
        }
        else {
            $('.move_page_top i').hide('slow');
        }
    });
    
    $('.customizer-header img').click(function(){
        if($('.customizer-content').hasClass('closed')) {
            $('.customizer-content').removeClass('closed');
        }
        else {
            $('.customizer-content').addClass('closed')
        }
    });

    $('#show_search_oftion').click(function(){
        $('#select-search-options').toggle(500);
    });

	$("#type_title").typed({
        strings: ["HOMULA IS THE REAL-ESTATE FORMULA"],
        typeSpeed: 70,
        backDelay: 500,
        loop: false,
        showCursor: false,
        contentType: 'html', // or text
        // defaults to false for infinite loop
        loopCount: false
        // resetCallback: function() { newTyped(); }
    });

	var owlhome = $("#owl-demo-home");
 
   	owlhome.owlCarousel({
       
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            400:{
                items:2,
            },
            600:{
                items:3,
            },
            700:{
                items:3,
            },
            1000:{
                items:4,
                slideBy: 1,
            },
            1200:{
                items:6,
                slideBy: 1,
            },
            1400:{
                items:6,
                slideBy: 1,
            },
            1600:{
                items:6,
                slideBy: 1,
            }
        },
        mergeFit:true,
        nav : false,
        loop:true,
        transitionStyle : "fade",
        rewindSpeed: 100,
        dots: true,
        margin:25,
		autoplay:true,
	    autoplayTimeout:2000,
	    autoplayHoverPause:true
    });

    $('#owl-demo-home .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');

    var owlagent = $("#owl-demo-agent");
    owlagent.owlCarousel({
       
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            400:{
                items:1,
            },
            600:{
                items:2,
            },
            700:{
                items:2,
            },
            1000:{
                items:3,
                slideBy: 1,
            },
            1200:{
                items:4,
                slideBy: 1,
            },
            1600:{
                items:5,
                slideBy: 1,
            }
        },
        navigation : false,
        loop:true,
        items: 1,
        rewindSpeed: 100,
        dots:true,
        margin:15,
		autoplay:true,
	    autoplayTimeout:2000,
	    autoplayHoverPause:true
    });

    $('#owl-demo-agent .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');

    /*carousel news */
    var owlnews = $("#owl-demo-news");
    owlnews.owlCarousel({
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            400:{
                items:2,
            },
            600:{
                items:2,
            },
            700:{
                items:3,
            },
            1000:{
                items:4,
                slideBy: 1,
            },
            1600:{
                items:5,
                slideBy: 1,
            }
        },
        navigation : false,
        loop:true,
        rewindSpeed: 100,
        dots: true,
        margin:15,
		autoplay:true,
	    autoplayTimeout:2000,
	    autoplayHoverPause:true
    });
    $('#owl-demo-news .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');

    $(document).on("click","#owl-demo-home .see-more", function(){
         //   owlhome.trigger('next.owl.carousel');
		 var $dots = $('#owl-demo-home .owl-dot');
		 var $next = $dots.filter('.active').next();
			if (!$next.length)
				$next = $dots.first();
			$next.trigger('click');
    });
    $(document).on("click","#owl-demo-agent .see-more", function(){
		// owlagent.trigger('next.owl.carousel');
		var $dots = $('#owl-demo-agent .owl-dot');
		var $next = $dots.filter('.active').next();
		if (!$next.length)
			$next = $dots.first();
		$next.trigger('click');
	});
	$(document).on("click","#owl-demo-news .see-more", function(){
        //owlnews.trigger('next.owl.carousel');
		 var $dots = $('#owl-demo-news .owl-dot');
	 var $next = $dots.filter('.active').next();
		if (!$next.length)
			$next = $dots.first();
		$next.trigger('click');
    });

    $('.hp_show_link').click(function(){
        if($(this).hasClass('show_link')) {
            $(this).parent().find('ul').css("display","none");
            $(this).removeClass('show_link');
            $(this).html('More...').css({'color':'#fff', 'font-wieght':'normal'});
        }
        else {
            $(this).parent().find('ul').css("display","block");
            $(this).addClass('show_link');
            $(this).html('Less...').css({'color':'rgb(3, 155, 229)', 'font-wieght':'bold'});
        }
    });
});