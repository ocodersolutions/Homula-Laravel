$(document).ready(function(){
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

});