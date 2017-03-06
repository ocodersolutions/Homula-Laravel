$(document).ready(function() {
    /**
     * delay 10s will show video
     */
    setTimeout(function() {
        $("#wrap-cover-video").html('<video id="cover-video" preload="metadata" autoplay="" muted="" loop=""><source src="http://preview.byaviators.com/theme/realsite/wp-content/uploads/2015/03/Houses_1-5_720p_h264_30rf_wo.mp4" type="video/mp4"></video>');

    }, 4000);
    /**
     * scroll top
     */
    $('.move_page_top i').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 800);
        return false;
    });

    $(document).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('.move_page_top i').show('slow');
        } else {
            $('.move_page_top i').hide('slow');
        }
    });

    $('.customizer-header img').click(function() {
        if ($('.customizer-content').hasClass('closed')) {
            $('.customizer-content').removeClass('closed');
        } else {
            $('.customizer-content').addClass('closed')
        }
    });

    $('#show_search_oftion').click(function() {
        $('#select-search-options').toggle(500);
    });

    /*
     * nav agents detail
     */
    $(".agents-detail-nav ul li").click(function() {
        $(this).parent().find('li').removeClass('active');
        $(this).addClass('active');
        if ($(this).hasClass('about-ag')) {
            $('.agents-detail-nav-content p').css('display', 'none');
            $('.adnc-about').fadeIn(1000);
        } else if ($(this).hasClass('agents-properties-ag')) {
            $('.agents-detail-nav-content p').css('display', 'none');
            $('.adnc-agents-properties').fadeIn(1000);
        } else {
            $('.agents-detail-nav-content p').css('display', 'none');
            $('.adnc-rate').fadeIn(1000);
        }
    });

    /*
     * position fixed with sidebar of page article-detail
     */
    $(document).scroll(function() {
        if ($(window).width() >= 750) {
            var h_doc = $(this).height();
            var h_window = $(window).height();
            var h_footer = $("#footer").height();
            var max_scroll = h_doc - h_window - h_footer;
            var min_scroll = $(".header_menu_content").height() + 220;
            if ($(this).scrollTop() > min_scroll && $(this).scrollTop() < max_scroll) {
                $(".ad_sidebar_wrap").css({ 'position': 'fixed', 'top': '0' });
            } else if ($(this).scrollTop() >= max_scroll) {
                $(".article_detail .sidebar").height($(".article_detail .content").height());
                $(".ad_sidebar_wrap").css({ 'position': 'absolute', 'top': 'auto', 'bottom': '50px' });
            } else {
                $(".ad_sidebar_wrap").css({ 'position': 'static', 'top': 'inherit' });
            }
        }
    });

    if ($(window).width() >= 350 && $(window).width() < 991) {
        $(".hmc_show_menu i").click(function() {
            $(".header_main_menu").toggle('slow');
            if ($(this).hasClass('show_menu')) {
                $(this).removeClass('show_menu fa-times-circle').addClass('fa-bars');
            } else {
                $(this).addClass('show_menu fa-times-circle').removeClass('fa-bars');
            }
        });
        $(".header_main_menu > li > a").click(function(e) {
            e.preventDefault();
            if ($(this).parent().hasClass('no_after')) {
                window.location.replace($(this).attr('href'));
            }
        });
        $(".header_main_menu > li").click(function() {
            $(this).find('.header_sub_menu').toggle('slow');
        });
        $(".header_top_favorites i").click(function() {
            // alert("123");
            // console.log($(this).parent().find('a').attr('href'));
            window.location.replace($(this).parent().find('a').attr('href'));
        });
    }


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

        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            400: {
                items: 2,
            },
            600: {
                items: 3,
            },
            700: {
                items: 3,
            },
            1000: {
                items: 4,
                slideBy: 1,
            },
            1200: {
                items: 6,
                slideBy: 1,
            },
            1400: {
                items: 6,
                slideBy: 1,
            },
            1600: {
                items: 6,
                slideBy: 1,
            }
        },
        mergeFit: true,
        nav: false,
        loop: true,
        transitionStyle: "fade",
        rewindSpeed: 100,
        dots: true,
        margin: 25,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
    });

    $('#owl-demo-home .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');

    var owlagent = $("#owl-demo-agent");
    owlagent.owlCarousel({

        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            400: {
                items: 1,
            },
            600: {
                items: 2,
            },
            700: {
                items: 2,
            },
            1000: {
                items: 3,
                slideBy: 1,
            },
            1200: {
                items: 4,
                slideBy: 1,
            },
            1600: {
                items: 5,
                slideBy: 1,
            }
        },
        navigation: false,
        loop: true,
        items: 1,
        rewindSpeed: 100,
        dots: true,
        margin: 15,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
    });

    $('#owl-demo-agent .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');

    /*carousel news */
    var owlnews = $("#owl-demo-news");
    owlnews.owlCarousel({
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            400: {
                items: 2,
            },
            600: {
                items: 2,
            },
            700: {
                items: 3,
            },
            1000: {
                items: 4,
                slideBy: 1,
            },
            1600: {
                items: 5,
                slideBy: 1,
            }
        },
        navigation: false,
        loop: true,
        rewindSpeed: 100,
        dots: true,
        margin: 15,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
    });
    $('#owl-demo-news .owl-stage-outer').append('<div class="see-more"><p>SEE MORE<i class="fa fa-long-arrow-right" aria-hidden="true"></i></p></div>');

    $(document).on("click", "#owl-demo-home .see-more", function() {
        //   owlhome.trigger('next.owl.carousel');
        var $dots = $('#owl-demo-home .owl-dot');
        var $next = $dots.filter('.active').next();
        if (!$next.length)
            $next = $dots.first();
        $next.trigger('click');
    });
    $(document).on("click", "#owl-demo-agent .see-more", function() {
        // owlagent.trigger('next.owl.carousel');
        var $dots = $('#owl-demo-agent .owl-dot');
        var $next = $dots.filter('.active').next();
        if (!$next.length)
            $next = $dots.first();
        $next.trigger('click');
    });
    $(document).on("click", "#owl-demo-news .see-more", function() {
        //owlnews.trigger('next.owl.carousel');
        var $dots = $('#owl-demo-news .owl-dot');
        var $next = $dots.filter('.active').next();
        if (!$next.length)
            $next = $dots.first();
        $next.trigger('click');
    });

    $('.hp_show_link').click(function() {
        if ($(this).hasClass('show_link')) {
            $(this).parent().find('ul').css("display", "none");
            $(this).removeClass('show_link');
            $(this).html('More...').css({ 'color': '#fff', 'font-wieght': 'normal' });
        } else {
            $(this).parent().find('ul').css("display", "block");
            $(this).addClass('show_link');
            $(this).html('Less...').css({ 'color': 'rgb(3, 155, 229)', 'font-wieght': 'bold' });
        }
    });
    // hide properties content
    $(".properties_page_menu ul li").click(function() {
        $(".properties_page_menu ul li").removeClass("active");
        var class_name = $(this).attr("class");
        $(this).addClass("active");
        var properties_show = "#" + class_name;
        $(".properties_select_hide").hide();
        $(properties_show).fadeIn(1000);
    });


    WinH = $(window).width();
    if (WinH > 992) {
        $(".header_main_menu > li").mouseenter(function() {
            clearTimeout(this.timeout);
            $(this).find(".header_sub_menu").stop(true, true).css('visibility', 'visible').fadeIn(1000);
        }).mouseleave(function() {
            $(this).find(".header_sub_menu").stop(true, true).fadeOut(500);

        });
    }

    /**
     * Button animation
     */


    $("button.btn.get, .customizer-header, .header_sub_menu li a, .header_top_account i, .header_top_favorites i, .shadow-box button, .agents-content-form button").click(function(e) {
        var ink, d, x, y;
        if ($(this).find(".ink").length === 0) {
            $(this).prepend("<span class='ink'></span>");
        }

        ink = $(this).find(".ink");
        ink.removeClass("animate");

        if (!ink.height() && !ink.width()) {
            d = Math.max($(this).outerWidth(), $(this).outerHeight());
            ink.css({ height: d, width: d });
        }

        x = e.pageX - $(this).offset().left - ink.width() / 2;
        y = e.pageY - $(this).offset().top - ink.height() / 2;

        ink.css({ top: y + 'px', left: x + 'px' }).addClass("animate");
    });

    $(".list_my_house_box_1 div strong:nth-child(1), .list_my_house_box_1 div strong:nth-child(2), .list_my_house_box_1 div strong:nth-child(3), .list_my_house_box_1 div strong:nth-child(4)").click(function() {
        if ($(".list_my_house_box_1 div strong").hasClass("active_strong")) {
            $(".list_my_house_box_1 div strong").removeClass("active_strong");
            $(this).addClass("active_strong");

        }
    });
    $(".list_my_house_box_2 div strong:nth-child(1), .list_my_house_box_2 div strong:nth-child(2), .list_my_house_box_2 div strong:nth-child(3), .list_my_house_box_2 div strong:nth-child(4), .list_my_house_box_2 div strong:nth-child(5)").click(function() {
        if ($(".list_my_house_box_2 div strong").hasClass("active_strong")) {
            $(".list_my_house_box_2 div strong").removeClass("active_strong");
            $(this).addClass("active_strong");

        }
    });
    $(".list_my_house_box_1 div strong:nth-child(1)").click(function() {
        $(".list_my_house_box_1 p").css("display", "none");
        $(".list_my_house_box_1 .box_1_p_1").css("display", "block");
    });
    $(".list_my_house_box_1 div strong:nth-child(2)").click(function() {
        $(".list_my_house_box_1 p").css("display", "none");
        $(".list_my_house_box_1 .box_1_p_2").css("display", "block");
    });
    $(".list_my_house_box_1 div strong:nth-child(3)").click(function() {
        $(".list_my_house_box_1 p").css("display", "none");
        $(".list_my_house_box_1 .box_1_p_3").css("display", "block");
    });
    $(".list_my_house_box_1 div strong:nth-child(4)").click(function() {
        $(".list_my_house_box_1 p").css("display", "none");
        $(".list_my_house_box_1 .box_1_p_4").css("display", "block");
    });
    $(".list_my_house_box_2 div strong:nth-child(1)").click(function() {
        $(".list_my_house_box_2 p").css("display", "none");
        $(".list_my_house_box_2 .box_2_p_1").css("display", "block");
    });
    $(".list_my_house_box_2 div strong:nth-child(2)").click(function() {
        $(".list_my_house_box_2 p").css("display", "none");
        $(".list_my_house_box_2 .box_2_p_2").css("display", "block");
    });
    $(".list_my_house_box_2 div strong:nth-child(3)").click(function() {
        $(".list_my_house_box_2 p").css("display", "none");
        $(".list_my_house_box_2 .box_2_p_3").css("display", "block");
    });
    $(".list_my_house_box_2 div strong:nth-child(4)").click(function() {
        $(".list_my_house_box_2 p").css("display", "none");
        $(".list_my_house_box_2 .box_2_p_4").css("display", "block");
    });
    $(".list_my_house_box_2 div strong:nth-child(5)").click(function() {
        $(".list_my_house_box_2 p").css("display", "none");
        $(".list_my_house_box_2 .box_2_p_5").css("display", "block");
    });

//// Q-start
    jQuery('.shadow-box .back-button').click(function(){
         ask_number = jQuery(this).closest('.shadow-box').data('ask');
         jQuery(this).closest('.shadow-box').fadeOut(function(){
            jQuery('.ask-'+(ask_number-1)).find('input:checked').removeAttr('checked');
            jQuery('.ask-'+(ask_number-1)).fadeIn(2000);
         });
    });

    jQuery('.shadow-box button').click(function(){
        ask_number = jQuery(this).closest('.shadow-box').data('ask');
        
        switch(ask_number) {
            case 1:
                    area = jQuery(this).closest('.shadow-box').find('input[name="location"]').val();
                    if (area != '') {
                        jQuery(this).closest('.ask-1').fadeOut(function(){
                            jQuery('.ask-2').fadeIn(2000);    
                        });
                    }else{
                        jQuery('input[name="location"]').css({"border": "1px solid red"});
                    }
                break;
            case 2:
                jQuery(this).closest('.button').find('input[name="buyorsell"]').attr('checked','');
                jQuery(this).closest('.ask-2').fadeOut(function(){
                    jQuery('.ask-3').fadeIn(2000);
                });
                
                break;
            case 3:
                jQuery(this).closest('.button-row').find('input[name="price"]').attr('checked','');
                jQuery(this).closest('.ask-3').fadeOut(function(){
                    jQuery('.ask-4').fadeIn(2000);    
                });
                
                break;
            case 4:
                jQuery(this).closest('.button-row').find('input[name="type"]').attr('checked','');
                jQuery(this).closest('.ask-4').fadeOut(function(){
                    jQuery('.ask-5').fadeIn(2000);    
                });
            
                break;
            case 5:
                jQuery(this).closest('.button').find('input[name="important"]').attr('checked','');
                jQuery(this).closest('.ask-5').fadeOut(function(){
                    jQuery('.ask-6').fadeIn(2000);    
                });
            
                break;
            default:
                submit = jQuery(this).attr('type');
                name = jQuery('input[name="fullname"]').val();
                phone = jQuery('input[name="phone"]').val();
                email = jQuery('input[name="email"]').val();
                time = jQuery('input[name="time"]').val();
                if(name != "" && phone != "" && email != "" ){
                    if(submit == 'submit'){
                        jQuery ("form#survey" ).submit();
                    }
                }


                
        }

       
    });
//// Q-end

});
