@extends('layouts.frontend')

@section('content')

	<style type="text/css">
		.main{
			display: block;
    		position: relative;
    		background: #fff;
		}
		.new-title-search{
			height: 500px;
			position: absolute;
    		top: 0;
    		width: 100%;
    		text-align: center;
		}    
		.new-title-search .content{
			background: rgba(255, 255, 255, 0.7);
			max-width: 1170px;
		    float: none;
		    margin: 40px auto;
		}
		h2.hsectit {
			font-weight: bold;
		    color: #0a368a;
		    font-size: 30px;
		    text-transform: uppercase;
		}
		h2.hsectitq {
		    font-family: 'Lato';
		    font-size: 20px;
		    margin: 0 0 10px;
		    color: #777777;
		    text-transform: none;
		    font-weight: bold;
		}
		#housesearch{
			color: rgba(0, 0, 0, 0.7);
		    background: #fff;
		    border: 1px solid;
		    border-radius: 3px;
		    padding: 5px 15px;
		    font-weight: bold;
		    width: 50%;
		    line-height: 36px;
    		float: left;
		}
		.fa.fa-map-marker{
			font-size: 35px;
		    height: 48px;
		    padding: 5px 10px 5px 15px;
		    vertical-align: top;
		    width: 50px;
		    color: #0496df;
		    float: left;
		}

		.btn.get{
			height: 48px;
			padding: 0px 35px;
		    background-color: #0a368a!important;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		    color: #fff;
		    text-transform: uppercase;
		    position: relative;
		    overflow: hidden;
		}
		.btn.get.last-step{
			margin: 0;
		}

		form .section-holder .onbox{
			width: 80%;
    		margin: 30px auto;
		}
		span.dempcon{
		    text-transform: uppercase;
		    font-weight: bold;
		    font-size: 13px;
		    color: black;
		    float: left;
		    margin: 15px 50px 45px 50px;
		}
		.section.ofbox .styled-select{
			width: 33%;
            background-color: #fff;
            background-image: url(/images/selar.png);
            background-position: 163px 22px;
            background-repeat: no-repeat;
            border-radius: 4px;
            display: inline-block;
            height: 55px;
            margin-right: 25px;
            margin-top: 10px;
            overflow: hidden;
            width: 211px;
            border: 1px solid #0a368a;
		}
		.section.ofbox .styled-select select{
            border: medium none;
            color: #001446;
            font-weight: bold;
            margin: 15px 15px 50px 0;
            padding: 3px 7px;
            background: transparent none repeat scroll 0 0;
            font-size: 13px;
            width: 268px;
		}
		input.getadd{
			background: none;
    		border: 0;
    		text-align: center;
		}
        .section-holder .submit{
            float: left;
            margin-top: 25px;
            text-align: center;
            width: 100%;
        }

		.back{
			border-bottom: 1px solid #fff;
		    color: black;
		    cursor: pointer;
		    width: 125px;
		    margin: 10px auto;
		    text-align: center;
		    font-weight: bold;
		}

	</style>


<div class="cleafix"></div>
<div class="main">
    <div id="outer-wrap" class="cover" style="background: url(/images/city-wallpaper-32.jpg) no-repeat; background-size: cover;height: 450px"></div>
    <div class="new-title-search">
        <div class="content col-sm-12" style="">
            <div class="clearfix"></div>
            <div class="categories_realestate">
                <div class="sub_posts_home_eval">
                    <h2 class="hsectit">How Much is My Home Worth</h2>
                    <h2 class="hsectitq">Get an instant estimate of the current value of your home</h2>
                    <span id="getaddress_ajax_nonce" data-nonce="63be780c89"></span>
                    <span id="getprice_ajax_nonce" data-nonce="c242891dd3"></span>
                    <div class="sections">
                        <form action="" method="post" class="ng-pristine ng-valid">
                            <div class="section-holder">
                                <div class="section" section="">
                                    <div class="onbox">
                                        <i class="fa fa-map-marker"></i>
                                        <input type="text" name="housesearch" id="housesearch" class="housesearch ui-autocomplete-input" placeholder="Enter Your Address" required="" autocomplete="off">
                                        <div class="next">
                                            <button type="button" class="btn get">Get Instant Estimate</button>
                                        </div>
                                        <img id="loading" style="display:none" src="/images/ui-anim_basic_16x16.gif">
                                        <input type="hidden" name="housesearch_address" id="housesearch_address" value="">
                                        <br>
                                        <span class="dempcon">Ex: 123-456 100 Street, Toronto, ON</span>
                                    </div>
                                </div>
                                <div class="section ofbox" style="display: none;">
                                    <h2 class="hsectit" style="font-size: 25px;">Last Step: Provide the following to get an accurate home value</h2>
                                    <div class="styled-select" style="text-align: right;">
                                        <select name="type">
                                            <option value="">Type</option>
                                            <option value="type">Detached</option>
                                            <option value="type">Apartment/Condo</option>
                                            <option value="type">Multiplex</option>
                                            <option value="type">Manufactured</option>
                                            <option value="type">Land</option>
                                            <option value="house">House</option>
                                        </select>
                                    </div>
                                    <div class="styled-select">
                                        <select name="beds_any">
                                            <option value="">Beds - Any</option>
                                            <option value="1">1 Bed</option>
                                            <option value="2">2 Bed</option>
                                            <option value="3">3 Bed</option>
                                            <option value="4">4 </option>
                                            <option value="5+">5+ Bed</option>
                                        </select>
                                    </div>
                                    <div class="styled-select" style="text-align: left;">
                                        <select name="sqft_range">
                                            <option value="">Square Ft - Any</option>
                                            <option value="0,499">0-499</option>
                                            <option value="500,749">500-749</option>
                                            <option value="750,999">750-999</option>
                                            <option value="1000,1249">1000-1249</option>
                                            <option value="1250,1499">1250-1499</option>
                                            <option value="1500,1999">1500-1999</option>
                                            <option value="2000,2499">2000-2499</option>
                                            <option value="2500,2999">2500-2999</option>
                                            <option value="3000,3499">3000-3499</option>
                                            <option value="3500,3999">3500-3999</option>
                                            <option value="4000,4499">4000-4499</option>
                                            <option value="4500,4999">4500-4999</option>
                                            <option value="5000,10000000">5000+</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="section-holder">
                                    <div class="submit" style="display: none;">
                                        <img id="loading_oneaddress" style="display:none" src="/images/ui-anim_basic_16x16.gif">
                                        <button onclick="return FetchValue();" type="button" class="btn get last-step">Get Instant Estimate</button>
                                    </div>
                                    <div class="clear"></div>
                                    <input type="text" value="" class="getadd" style="display: none;">
                                    <div class="back" style="display: none;">Edit Your Address</div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <div id="dialog" title="Instant Estimate" style="display:none;">
                            <div id="result_div">
                                <div>
                                    <strong>Address</strong> : <span id="search_address"></span>
                                </div>
                                <div class="clear"></div>
                                <div>
                                    <div><strong>Facility</strong> : <span id="facility"></span>
                                    </div>
                                    <!--<div><strong>Price</strong> : <span id="price"></span></div>-->
                                    <div><strong>Minimum Price</strong> : $<span id="minprice"></span>
                                    </div>
                                    <div><strong>Maximum Price</strong> : $<span id="maxprice"></span>
                                    </div>
                                    <div><strong>Average Price</strong> : $<span id="avgprice"></span>
                                    </div>
                                    <div style="clear:both"></div>

                                    <div style="padding-top:15px; padding-bottom:15px;"><b>For More Updated Information About Your Property Please Provide Us with Your Name and Email Address</b>
                                    </div>
                                    <div role="form" class="wpcf7" id="wpcf7-f11344-p520-o1" lang="en-US" dir="ltr">
                                        <div class="screen-reader-response"></div>
                                        <form action="/free-home-evaluation/#wpcf7-f11344-p520-o1" method="post" class="wpcf7-form ng-pristine ng-valid" novalidate="novalidate">
                                            <div style="display: none;">
                                                <input type="hidden" name="_wpcf7" value="11344">
                                                <input type="hidden" name="_wpcf7_version" value="4.5.1">
                                                <input type="hidden" name="_wpcf7_locale" value="en_US">
                                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f11344-p520-o1">
                                                <input type="hidden" name="_wpnonce" value="3cff4c580d">
                                            </div>
                                            <p>
                                                <label> Your Name (required)
                                                    <br>
                                                    <span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false"></span> </label>
                                            </p>
                                            <p>
                                                <label> Your Email (required)
                                                    <br>
                                                    <span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false"></span> </label>
                                            </p>
                                            <p>
                                                <input type="submit" value="Send" class="wpcf7-form-control wpcf7-submit"><img class="ajax-loader" src="/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
                                            </p>
                                            <div class="wpcf7-response-output wpcf7-display-none"></div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="footerbottom bg-categories-page">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script type="text/javascript" src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/js/custom.js"></script> -->
</div>











@endsection

@section('script')
<script src="/js/jquery-ui.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery('.getadd').hide();
        jQuery('.next button').click(function() {
            var housval = jQuery('.housesearch').val();
            var getadd = jQuery('.housesearch').val();
            jQuery('.getadd').val(getadd);

            if (housval == '') {
                jQuery('.housesearch').addClass('enterhouse');
                jQuery('#housesearch').css('border', '1px solid red');
                return false;
            } else {
                jQuery('.onbox').fadeOut(function() {
                    jQuery('.housesearch').removeClass('enterhouse').fadeIn();
                    jQuery(this).hide();
                    jQuery('.ofbox').fadeIn(2000);
                    jQuery('.back').fadeIn(2000);
                    jQuery('.getadd').fadeIn(2000);
                    jQuery('.submit').fadeIn(2000);
                });
            }
        });

        jQuery('.back').click(function() {
            jQuery('.getadd').hide();
            jQuery('.ofbox').hide();
            jQuery('.submit').hide();
            jQuery(this).hide();
            jQuery('.onbox').show();
            jQuery('.next img').show();
        });



        jQuery(".housesearch").autocomplete({
            source: function(request, response) {
                var data = {
                    action: 'get_address',
                    _ajax_nonce: jQuery('#getaddress_ajax_nonce').data('nonce'),
                    query_address: jQuery('#housesearch').val(),
                };
                jQuery("#loading").show();
                jQuery.ajax({
                    url: "http://realestate.homula.com/wp-admin/admin-ajax.php",
                    type: 'POST',
                    dataType: "json",
                    async: true,
                    cache: false,
                    data: data,
                    success: function(responsedata) {
                        response(responsedata);
                        jQuery("#loading").hide();
                    }
                });
            },
            select: function(event, ui) {
                //console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
                var temp = ui.item.value;
                // var address = temp.split("-");
                jQuery("#housesearch_address").val(jQuery.trim(temp));
            },
            delay: 0
        });
    });
    function FetchValue() {
        jQuery("#loading_oneaddress").show();
        var selval = jQuery("input[name=housesearch_address]").val();
        //alert(selval);
        var data = {
            selval: selval,
            action: 'get_price',
            _ajax_nonce: jQuery('#getprice_ajax_nonce').data('nonce'),
        };
        jQuery.ajax({
            url: "http://realestate.homula.com/wp-admin/admin-ajax.php",
            type: 'POST',
            dataType: 'html',
            data: data,
            success: function(responsedata) {
                jQuery("#loading_oneaddress").hide();
                var tmp_data = responsedata.split("===");
                jQuery("#search_address").html(tmp_data[0]);
                jQuery("#facility").html(tmp_data[1]);
                //jQuery("#price").html(tmp_data[2]);
                jQuery("#minprice").html(Math.round((tmp_data[3] * 90) / 100).formatMoney(2, ',', '.'));
                jQuery("#maxprice").html(Math.round((tmp_data[3] * 110) / 100).formatMoney(2, ',', '.'));
                jQuery("#avgprice").html(Math.round(tmp_data[3]).formatMoney(2, ',', '.'));

                jQuery("#dialog").dialog({
                    height: "auto",
                    width: 800
                });
            }
        });
    }
    Number.prototype.formatMoney = function(decPlaces, thouSeparator, decSeparator) {
        var n = this,
            decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
            decSeparator = decSeparator == undefined ? "." : decSeparator,
            thouSeparator = thouSeparator == undefined ? "," : thouSeparator,
            sign = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(decPlaces)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
        return sign + (j ? i.substr(0, j) + thouSeparator : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thouSeparator) + (decPlaces ? decSeparator + Math.abs(n - i).toFixed(decPlaces).slice(2) : "");
    };
</script>
@endsection