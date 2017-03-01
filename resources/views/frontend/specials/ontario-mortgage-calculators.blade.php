@extends('layouts.frontend')

@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/style-cal.css">
	<link rel="stylesheet" type="text/css" href="/css/popup-cal.css">
@endsection

@section('content')
	<script type="text/javascript">
	    var n = 9999999;
	    n.toLocaleString('en-US', {
	        minimumFractionDigits: 2
	    }); // 10,000.00
    </script>
    <style>
	    .mg-calculator-header {
	        border-bottom: none;
	        padding: 6% 0px;
	        color: #0a368a;
	        font-size: 48px;
	        text-shadow: 2px 1px 6px #000;
	        text-align: center;
	    }
	    
	    .ontario-mortgage-calculators-page {
	        background-image: url(/images/ontario-mortgage-calculator-bg.jpg);
	        background-size: cover;
	        background-position: center top;
	    }
	    
	    .col-md-11 {
	        width: 95.9%;
	    }
	    
	    div#tab1:hover {
	        background-color: #0a368a;
	    }
	    
	    p.round:hover {
	        -moz-box-shadow: inset 0 0 10px #000000;
	        -webkit-box-shadow: inset 0 0 10px #000000;
	        box-shadow: inset 0 0 10px #000000;
	    }
	    
	    #interestrate {
	        border: none;
	        padding-top: 0px;
	    }
	    
	    #mortamount {
	        padding-top: 0px;
	    }
	    
	    #amort {
	        padding-top: 0px;
	    }
	    
	    #payment {
	        padding-top: 0px;
	    }
	    
	    .canvasjs-chart-credit {
	        display: none;
	    }
	    
	    #chart1 {
	        display: block;
	        position: relative;
	        bottom: 14px;
	    }
	    
	    #graph1 {
	        border: solid 1px #6d727b;
	        margin-bottom: 10px;
	        width: 103%;
	        position: relative;
	        bottom: 14px;
	        right: 14px;
	    }
	    
	    #box1 {
	        overflow: visible!important;
	        position: relative;
	        padding: 12px 3px 1px 3px;
	        margin: 10px auto;
	        height: 130px;
	        width: 445px;
	        border: none!important;
	        background: #223c6e;
	    }
	    
	    #box2 {
	        overflow: visible!important;
	        position: relative;
	        padding: 12px 3px 1px 3px;
	        margin: 10px auto;
	        height: 130px;
	        width: 445px;
	        border: none!important;
	        background: url(/images/results_box.png) no-repeat center;
	    }
	    
	    #box3 {
	        overflow: visible!important;
	        position: relative;
	        padding: 12px 3px 1px 3px;
	        margin: 10px auto;
	        height: 130px;
	        width: 445px;
	        border: none!important;
	        background: url(/images/results_box.png) no-repeat center;
	    }
	    
	    #myTable {
	        font-size: 12px;
	    }
	    
	    .tab p {
	        margin: 0 0 0px!important;
	        color: #fff;
	        font-size: 21px;
	        text-transform: uppercase;
	        font-weight: bold;
	        font-family: 'Open sans', sans-serif;
	        display: inline;
	    }
	    
	    p {
	        margin: 0 0 0px!important;
	    }
	    
	    input::-webkit-outer-spin-button,
	    input::-webkit-inner-spin-button {
	        /* display: none; <- Crashes Chrome on hover */
	        -webkit-appearance: none;
	        margin: 0;
	        /* <-- Apparently some margin are still there even though it's hidden */
	    }
	    
	    .graph {
	        border: none!important;
	        color: #FFF;
	        padding: 5px 17px;
	        float: right;
	        margin-top: -11;
	        cursor: pointer;
	        -webkit-border-radius: 10px 0px 0px 10px;
	        -moz-border-radius: 10px 0px 0px 10px;
	        border-radius: 0px;
	        background-color: #039be5;
	    }
	    
	    .chart {
	        color: #FFF;
	        border: none!important;
	        background-color: #039be5;
	        padding: 5px 17px;
	        float: right;
	        margin-top: -11;
	        cursor: pointer;
	        -webkit-border-radius: 0px;
	        -moz-border-radius: 0px;
	        border-radius: 0px;
	    }
	    
	    .round {
	        -webkit-border-radius: 10px 10px 10px 10px;
	        -moz-border-radius: 10px 10px 10px 10px;
	        border-radius: 10px 10px 10px 10px;
	        border: 1px solid #DEDEDE;
	        width: 65%;
	    }
	    
	    table {
	        font-family: arial, sans-serif;
	        border-collapse: collapse;
	        width: 100%;
	    }
	    
	    td,
	    th {
	        border: 1px solid #dddddd!important;
	        text-align: left!important;
	        padding: 8px!important;
	    }
	    
	    tr:nth-child(even) {
	        background-color: #dddddd;
	    }
	    </style>
	    <style>
	    input[type=range] {
	        /*removes default webkit styles*/
	        -webkit-appearance: none;
	        /*fix for FF unable to apply focus style bug */
	        border: 7px solid white;
	        /*required for proper track sizing in FF*/
	        width: 100px;
	    }
	    
	    input[type=range]::-webkit-slider-runnable-track {
	        width: 100px;
	        height: 5px;
	        background: #ddd;
	        border: none;
	        border-radius: 3px;
	    }
	    
	    input[type=range]::-webkit-slider-thumb {
	        -webkit-appearance: none;
	        border: none;
	        height: 16px;
	        width: 16px;
	        border-radius: 50%;
	        background: #0a368a !important;
	        margin-top: -4px;
	    }
	    
	    input[type=range]:focus {
	        outline: none;
	        border: 0px !omportant;
	    }
	    
	    input[type=range]:focus::-webkit-slider-runnable-track {
	        background: #ccc;
	    }
	    
	    input[type=range]::-moz-range-track {
	        width: 100px;
	        height: 5px;
	        background: #ddd;
	        border: none;
	        border-radius: 3px;
	    }
	    
	    input[type=range]::-moz-range-thumb {
	        border: none;
	        height: 16px;
	        width: 16px;
	        border-radius: 50%;
	        background: #0a368a;
	    }
	    /*hide the outline behind the border*/
	    
	    input[type=range]:-moz-focusring {
	        outline: 7px solid white;
	        outline-offset: -1px;
	    }
	    
	    input[type=range]::-ms-track {
	        width: 100px;
	        height: 5px;
	        /*remove bg colour from the track, we'll use ms-fill-lower and ms-fill-upper instead */
	        background: transparent;
	        /*leave room for the larger thumb to overflow with a transparent border */
	        border-color: transparent;
	        border-width: 6px 0;
	        /*remove default tick marks*/
	        color: transparent;
	    }
	    
	    input[type=range]::-ms-fill-lower {
	        background: #777;
	        border-radius: 10px;
	    }
	    
	    input[type=range]::-ms-fill-upper {
	        background: #ddd;
	        border-radius: 10px;
	    }
	    
	    input[type=range]::-ms-thumb {
	        border: none;
	        height: 16px;
	        width: 16px;
	        border-radius: 50%;
	        background: goldenrod;
	    }
	    
	    input[type=range]:focus::-ms-fill-lower {
	        background: #888;
	    }
	    
	    input[type=range]:focus::-ms-fill-upper {
	        background: #ccc;
	    }
	    </style>
	    <style type="text/css">
	    .border {
	        border: 1px solid #bac90b;
	    }
	    
	    .tab {
	        padding: 19px 5px 15px 5px;
	        ;
	        border: none;
	        background-color: #039be5;
	        color: #FFF;
	        display: inline-block;
	    }
	    
	    #pay SPAN,
	    #mort SPAN,
	    #year SPAN {
	        color: #0a368a;
	    }
	    
	    #pay,
	    #mort,
	    #year {
	        cursor: pointer;
	    }
	    
	    .tabbg {
	        color: #ffffff;
	        background: #0a368a !important;
	    }
	    
	    select {
	        background: url(/images/dropdownArrow.png) no-repeat right;
	        -webkit-appearance: none;
	        -moz-appearance: none;
	        appearance: none;
	        border: 1px solid #0a368a;
	        border-radius: 5px;
	        width: 130px;
	        height: 30px;
	        padding: 0px 0px 0px 13px;
	    }
	    
	    i.dxc_social {
	        visibility: hidden;
	        display: inline-block;
	    }
	    
	    i.dxc_social svg {
	        width: 100%;
	        height: 100%;
	        overflow: visible;
	    }
    </style>
    <style>
	    .td {
	        color: #ffffff !important;
	        background: #0a368a !important;
	    }
	    
	    .tg {
	        background-color: #fff !important;
	        color: #039be5 !important;
	    }
	    
	    .randomProperty #map_canvas,
	    .randomProperty .property_thumb {
	        height: 200px;
	        margin-bottom: 5px;
	    }
	    
	    .randomProperty .property_thumb {
	        height: 200px;
	    }
	    
	    .randomProperty p {
	        height: 14px;
	        line-height: 18px !important;
	        margin: 30px 0 !important;
	    }
	    
	    #bodyContent img {
	        float: left;
	        height: 50px;
	        margin-right: 5px;
	        margin-top: 5px;
	        width: 50px;
	    }
	    
	    .firstHeading {
	        float: left;
	        margin: 0;
	        padding: 0;
	    }
	    
	    #bodyContent p {
	        display: block;
	        float: right;
	        margin-top: 5px !important;
	        padding: 0;
	        width: 100%;
	    }
	    
	    #popupWrapper {
	        height: 100px;
	        width: 100%;
	        overflow: hidden;
	    }
	    </style>
	    <style>
	    .header-icons-set {
	        display: flex;
	    }
	    
	    .header-icons-set li {
	        width: 64px;
	        height: 64px;
	        margin: 5px;
	        list-style-type: none;
	    }
    </style>
    <style>
	    .btn {
	        font-size: 3vmin;
	        padding: 0.75em 1.5em;
	        background-color: #fff;
	        border: 1px solid #bbb;
	        color: #333;
	        text-decoration: none;
	        display: inline;
	        border-radius: 4px;
	        -webkit-transition: background-color 1s ease;
	        -moz-transition: background-color 1s ease;
	        transition: background-color 1s ease;
	    }
	    
	    .btn:hover {
	        background-color: #ddd;
	        -webkit-transition: background-color 1s ease;
	        -moz-transition: background-color 1s ease;
	        transition: background-color 1s ease;
	    }
	    
	    .btn-small {
	        padding: .75em 1em;
	        font-size: 0.8em;
	    }
	    
	    .modal-box {
	        display: none;
	        position: absolute;
	        z-index: 1000;
	        width: 98%;
	        background: white;
	        border-bottom: 1px solid #aaa;
	        border-radius: 4px;
	        box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
	        border: 1px solid rgba(0, 0, 0, 0.1);
	        background-clip: padding-box;
	    }
	    
	    @media (min-width: 32em) {
	        .modal-box {
	            width: 70%;
	        }
	    }
	    
	    .modal-box header,
	    .modal-box .modal-header {
	        padding: 1.25em 1.5em;
	        border-bottom: 1px solid #ddd;
	    }
	    
	    .modal-box header h3,
	    .modal-box header h4,
	    .modal-box .modal-header h3,
	    .modal-box .modal-header h4 {
	        margin: 0;
	    }
	    
	    .modal-box .modal-body {
	        padding: 2em 1.5em;
	    }
	    
	    .modal-box footer,
	    .modal-box .modal-footer {
	        padding: 1em;
	        border-top: 1px solid #ddd;
	        background: rgba(0, 0, 0, 0.02);
	        text-align: right;
	    }
	    
	    .modal-overlay {
	        opacity: 0;
	        filter: alpha(opacity=0);
	        position: absolute;
	        top: 0;
	        left: 0;
	        z-index: 900;
	        width: 100%;
	        height: 100%;
	        background: rgba(0, 0, 0, 0.3) !important;
	    }
	    
	    a.close {
	        line-height: 1;
	        font-size: 1.5em;
	        position: absolute;
	        top: 5%;
	        right: 2%;
	        text-decoration: none;
	        color: #bbb;
	    }
	    
	    a.close:hover {
	        color: #222;
	        -webkit-transition: color 1s ease;
	        -moz-transition: color 1s ease;
	        transition: color 1s ease;
	    }
    </style>
    <style>
	    .login_and_resg {
	        right: 572px;
	        position: absolute;
	        bottom: 66px;
	    }
	    
	    .icon_setting_main {
	        right: 500px;
	    }
	    
	    .fav_cls_main {
	        right: 95px;
	        position: absolute;
	        bottom: 66px;
	    }
	    
	    .IDX-contactFormRight {
	        display: none;
	    }
	    
	    @media all and (min-width: 320px) and (max-width: 750px) {
	        .icon_setting_main {
	            right: 0px;
	            bottom: 57px;
	        }
	        .login_and_resg {
	            right: 61px;
	            position: absolute;
	            bottom: 66px;
	        }
	        .fav_cls_main {
	            right: 61px;
	            position: absolute;
	            bottom: 11px;
	        }
	        .fav_action {
	            bottom: 0px;
	            right: 0px;
	        }
	        .icon_setting_main {
	            right: 0px;
	        }
	        .cover-title h1 {
	            font-weight: 600;
	            font-size: 35px;
	        }
	        .cover-title {
	            top: 20px;
	        }
	        .cover-title h2 {
	            font-size: 40px!important;
	        }
	    }
    </style>
    <style>
	    input[type="range"] {
	        border: none;
	    }
	    
	    #mortamount {
	        background: #dddddd none repeat scroll 0 0;
	        border-radius: 16px;
	        height: 6px;
	        padding-top: 1px;
	        margin: 8px 0 0;
	        width: 100%;
	    }
	    
	    #amort {
	        background: #dddddd none repeat scroll 0 0;
	        border-radius: 16px;
	        height: 6px;
	        padding-top: 1px;
	        margin: 8px 0 0;
	        width: 100%;
	    }
	    
	    #interestrate {
	        background: #dddddd none repeat scroll 0 0;
	        border-radius: 16px;
	        height: 6px;
	        padding-top: 1px;
	        margin: 8px 0 0;
	        width: 100%;
	    }
	    
	    #payment {
	        background: #dddddd none repeat scroll 0 0;
	        border-radius: 16px;
	        height: 6px;
	        padding-top: 1px;
	        margin: 8px 0 0;
	        width: 100%;
	    }
	    
	    #mortamounttxt {
	        border: 1px solid #6a84b7;
	        border-radius: 6px;
	        float: right;
	        font-size: 13px;
	        height: 33px;
	        line-height: 32px;
	        width: 73px;
	    }
	    
	    #amorttxt {
	        border: 1px solid #6a84b7;
	        border-radius: 6px;
	        float: right;
	        font-size: 13px;
	        height: 33px;
	        line-height: 32px;
	        width: 73px;
	    }
	    
	    #interestratetxt {
	        border: 1px solid #6a84b7;
	        border-radius: 6px;
	        float: right;
	        font-size: 13px;
	        height: 33px;
	        line-height: 32px;
	        width: 73px;
	    }

	    p input[type=text] {
			padding: 0 5px;
	    }
	    
	    .addel input[type="text"] {
	        border: 1px solid #0a368a;
	        border-radius: 6px;
	        float: right;
	        font-size: 13px;
	        height: 30px;
	        line-height: 32px;
	        margin: 0 0 0 5px;
	        width: 76px;
	    }
	    
	    .addel input[type="text"].adc {
	        border: 1px solid #0a368a;
	        border-radius: 6px;
	        float: left;
	        font-size: 13px;
	        height: 30px;
	        line-height: 32px;
	        margin: 0 5px 0 5px;
	        width: 76px;
	    }
	    
	    .addel .btn {
	        width: 35px;
	        background: #0a368a !important;
	    }
	    
	    .ontario-mortgage-calculators-page .img-responsive {
	        display: none;
	    }
	    
	    .mg-calculator-header {
	        font-size: 32px;
	        text-shadow: none;
	        padding: 70px 0;
	        text-transform: uppercase;
	        color: #fff;
	        font-weight: bold;
	    }
	    
	    .hutlrb {
	        border: none;
	        background: none;
	    }
	    
	    .row_head_calculator {
	        background-color: #039ae4;
	    }
	    
	    .widget_cover_widget {
	        display: none;
	    }
	    
	    .hutlrb div div h4 {
	        font-size: 21px;
	        color: #fff;
	        font-weight: bold;
	        background: #0a368a;
	        width: 60%;
	        text-align: center;
	        padding: 10px 0;
	        text-transform: uppercase;
	    }
	    
	    .public_p_one {
	        padding: 10px 10px 20px 10px !important;
	        border: 1px solid #dadadd;
	        margin-bottom: 20px !important;
	    }
	    
	    .public_p_one span a i {
	        width: 30px;
	        line-height: 30px;
	        background: #0a368a;
	        text-align: center;
	        border-radius: 50%;
	        color: #fff;
	        font-size: 20px;
	        margin-right: 5px;
	    }
	    
	    .public_p_one span:first-child {
	        font-size: 21px;
	        float: left;
	        padding-right: 30px;
	        color: #000;
	        min-width: 240px;
	    }
	    
	    .public_p_two {
	        padding: 10px 10px 40px 10px !important;
	        border: 1px solid #dadadd;
	        margin-bottom: 20px !important;
	    }
	    
	    .public_p_two select {
	        font-size: 17px;
	        width: 170px;
	    }
	    
	    .span_margin {
	        margin-top: 6px;
	    }
	    
	    .b_style {
	        font-size: 15px;
	        display: inline-block;
	        width: 24px;
	        line-height: 24px;
	        text-align: center;
	        border-radius: 50%;
	        background: #0397e0;
	        color: #fff;
	        margin-top: 4px;
	    }
	    
	    .cal-btn {
	        text-align: center;
	        color: #fff !important;
	        background-color: #039be5;
	        padding: 10px;
	        font-size: 21px;
	        font-weight: bold;
	    }
	    
	    @media (min-width: 992px) and (max-width: 1199px) {
	        .tab p {
	            font-size: 16px;
	        }
	        .public_p_one span:first-child {
	            font-size: 17px;
	            padding-right: 5px;
	            min-width: 190px;
	        }
	        #mortamount {
	            width: 100px;
	        }
	        #amort {
	            width: 100px;
	        }
	        #interestrate {
	            width: 100px;
	        }
	    }
	    
	    @media (min-width: 380px) and (max-width: 589px) {
	        .mg-calculator-header {
	            line-height: 40px;
	            padding-top: 0;
	        }
	        .tab {
	            width: 100%;
	            text-align: center;
	        }
	        .row_head_calculator h2 {
	            text-align: center;
	        }
	        .hutlrb div div h4 {
	            width: 100%;
	        }
	        .span_margin {
	            float: none !important;
	            width: 130px;
	            display: inline-block;
	        }
	        .public_p_two {
	            padding: 10px 10px 80px 10px !important;
	        }
	        .public_p_two select {
	            margin-top: 10px;
	            margin-left: 0 !important;
	        }
	        #box1 {
	            width: auto;
	        }
	        .public_p_one span:first-child {
	            width: 100%;
	        }
	        .cal-btn {
	            width: 100%;
	        }
	    }
	    
	    @media (min-width: 590px) and (max-width: 767px) {
	        .mg-calculator-header {
	            line-height: 40px;
	            padding-top: 0;
	        }
	        .tab p {
	            font-size: 19px;
	        }
	    }
    </style>
    <div class="ontario-mortgage-calculators-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="padding:0;">
                    <div class="clearfix"></div>
                </div>
            </div>
            <!--row End Hut-->
            <div class="row">
                <div class="col-md-12" style="float:none; margin:0 auto;">
                    <div class="hutlrb" style="float:none; margin:100px auto;">
                        <!--          <article id="page-590" class="">-->
                        <!--h2 class="page-header test-homula1" style="border:none;">Ontario Mortgage Payment Calculator</h2-->
                        <div class="mg-calculator-header">Ontario Mortgage Payment Calculator</div>
                        <div class="col-md-12 row_head_calculator">
                            <div class="col-md-6" style="padding:0px;">
                                <div class="popup" data-popup="popup-1">
                                    <div class="popup-inner">
                                        <h2> 
											<img src="/images/pop.png" >Calculation type
										</h2>
                                        <p>
                                            <strong>Payment:</strong> Complete the mortgage amount, amortization, payment frequency, and interest rate to find out your payment amount.
                                        </p>
                                        <p>
                                            <strong> Mortgage Amount:</strong> Complete the amortization, payment amount, payment frequency, and interest rate to find out the amount you can borrow.
                                        </p>
                                        <p>
                                            <strong> Amortization:</strong>Complete the mortgage amount, payment amount, payment frequency, and interest rate to find out how long it will take to pay off your mortgage.
                                        </p>
                                        <a class="popup-close" data-popup-close="popup-1" href="#"><img src="/images/close.png" ></a>
                                    </div>
                                </div>
                                <h2 class="subtitle font-medium" style="font-weight:bold; margin:0px;color: #fff; font-size:24px ; padding:17px 0; text-transform: uppercase;">What would you like to calculate?</h2>
                            </div>
                            <!--Three Col Menu Start-->
                            <div class="col-md-6">
                                <div class="tab" id="tab1">
                                    <p id="pay"> Payment </p>
                                </div>
                                <div class="tab" id="tab2">
                                    <p id="mort"> Mortgage Amount </p>
                                </div>
                                <div class="tab" id="tab3">
                                    <p style="text-align:center;" id="year"> Amortization </p>
                                </div>
                            </div>
                        </div>
                        <div class="clr"></div>
                        <div class="col-md-12" style=" margin:0 auto; float:none; padding:0px; border: solid 1px #0c9ce2;margin-bottom: 15px; background: #fff; opacity: 0.9;">
                            <div class="popup" data-popup="popup-4">
                                <div class="popup-inner">
                                    <h2> <img src="/images/pop.png" >Mortgage Amount</h2>
                                    <p>The amount of money you will be borrowing to purchase your home.</p>
                                    <a class="popup-close" data-popup-close="popup-4" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-2">
                                <div class="popup-inner">
                                    <h2> <img src="/images/pop.png" >Amortization</h2>
                                    <p>The actual number of years it will take to repay your mortgage in full. This may go beyond the term of the mortgage. For example, mortgages often have 5 year terms but 25 year amortization periods.</p>
                                    <a class="popup-close" data-popup-close="popup-2" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-3">
                                <div class="popup-inner">
                                    <h2> <img style="position: relative;bottom: 2px;padding-right: 4px;" src="/images/pop.png" >Payment Frequency</h2>
                                    <p>How often you will be making your payments to your mortgage. This can be either monthly, semi-monthly (twice each month), biweekly (every two weeks, accelerated), or weekly (accelerated).</p>
                                    <a class="popup-close" data-popup-close="popup-3" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-5">
                                <div class="popup-inner">
                                    <h2> <img style="position: relative;bottom: 2px;padding-right: 4px;" src="/images/pop.png" >Product</h2>
                                    <p>The desired term for the mortgage.</p>
                                    <a class="popup-close" data-popup-close="popup-5" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-6">
                                <div class="popup-inner">
                                    <h2> <img src="/images/pop.png" >Interest Rate</h2>
                                    <p>The percentage of interest that you will be paying on your mortgage for a specific term.</p>
                                    <a class="popup-close" data-popup-close="popup-6" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-7">
                                <div class="popup-inner">
                                    <h2> <img src="/images/pop.png" >Save More Money</h2>
                                    <p>If you switch to a bi-weekly payment of $727.01, your amortization will be reduced to 21 years, 6 months.</p>
                                    <a class="popup-close" data-popup-close="popup-7" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-8">
                                <div class="popup-inner">
                                    <h2> <img src="/images/pop.png" >Payment Amount</h2>
                                    <p>The actual amount you will be paying on a regular basis to reduce your mortgage.</p>
                                    <a class="popup-close" data-popup-close="popup-8" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class="popup" data-popup="popup-9">
                                <div class="popup-inner">
                                    <div class="addel">
                                        <h2>Lump Pre Payments</h2>
                                        <div>Regularly-Scheduled Prepayments
                                            <div style="float:right;">$
                                                <select>
                                                    <option>once</option>
                                                </select>
                                                <input type="text">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group target" style="display:none;">
                                            <div class="input-group" style="width:100%;">
                                                <p> one time prepayment
                                                    <span style="float: right; margin-left: 36%; margin-top: -5%;">
														<select style="width:90px; float:left;  margin: 0 4px 0 0;">
															<option>year1</option>
														</select>
														<select style="width:90px; float:left;">
															<option>month1</option>
														</select>
													
														<input type="text" class="adc">
	                                           
	                                                	<button type="button" class="btn btn-danger addel-delete" style="width:36px; float:right; background-color: #0a368a;"><i class="fa fa-remove"></i> </button>
													
													</span>
                                                </p>
                                                <hr style="color:#ccc;">
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-success btn-block addel-add"><i class="fa fa-plus"></i></button>
                                        <span>Add Another Payment</span>
                                    </div>
                                    <a class="popup-close" data-popup-close="popup-9" href="#"><img src="/images/close.png" ></a>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <h4>Enter Your Information</h4>
                                <br>
                                <p style="padding-bottom:25px;" id="mortbox" class="public_p_one">
                                    <span>
										<a href="#" data-popup-open="popup-4">
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										</a>Mortgage Amount
									</span>
                                    <span style="float:left; border:0px !important;" class="span_margin">
										<input type="range" id="mortamount" oninput="mortamount(this.value);"  min ="100" max="9999999" step ="1" value ="250000"  />
									</span> &nbsp; &nbsp;
                                    <span><b style="font-size:15px;" class="b_style">$</b></span>
                                    <input type="text" id="mortamounttxt" oninput="mortamounttxt(this.value);" value="" />
                                    <input type="hidden" id="mortage" value="" />
                                    <div class="clr"></div>
                                </p>
                                <p style="padding-bottom:25px;clear:both;" id="yearbox" class="public_p_one">
                                    <span>
										<a href="#" data-popup-open="popup-2">
										<i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>Amortization
									</span>
                                    <span style="float:left; padding-left:0px;" class="span_margin">
										<input type="range" id="amort" oninput="amort(this.value);"  min ="0" max="50" step ="5" value ="25"  />
									</span>
                                    <span style="">&nbsp;&nbsp;&nbsp;<b class="b_style">Y</b></span>
                                    <input type="text" id="amorttxt" oninput="amorttxt(this.value);" value="0" />
                                    <input type="hidden" id="amort_val" value="" />
                                    <div class="clr"></div>
                                </p>
                                <p style="padding-bottom:25px; clear:both;" id="paybox" class="public_p_one">
                                    <span>
										<a href="#" data-popup-open="popup-4">
										<i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>Payment
									</span>
                                    <span style="float:left;">
										<input type="range" id="payment" oninput="payment(this.value);"  min ="0" max="9999999" step ="1" value ="250000"  />
									</span>
                                    <span><b style="font-size:15px;">$&nbsp;</b></span>
                                    <input type="text" id="paymenttxt" oninput="paymenttxt(this.value);" value="">
                                    <input type="hidden" id="pay_val" value="" />
                                    <div class="clr"></div>
                                </p>
                                <p style="display:none; clear:both; padding-bottom:25px;" id="hh3" class="public_p_one">
                                    <span>
										<a href="#" data-popup-open="popup-8">
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										</a>Payment
									</span> &nbsp; &nbsp; &nbsp;
                                    <span style="float:left;">
									<input type="range" style="" ></span> &nbsp; &nbsp;
                                    <span style="font-size:14px;">Years &nbsp;</span>
                                    <input type="text" value="14.54">
                                    <div class="clr"></div>
                                </p>
                                <p style="padding-bottom:25px; clear:both;" class="public_p_one public_p_two">
                                    <span>
										<a href="#" data-popup-open="popup-3">
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										</a>Payment Frequency
										<select id="selectPF" onChange="GetPFValue()" style="margin-left:15px;">
											<option value="12">Monthly</option>
											<option value="24">Semi-Monthly</option>
											<option value="26">Weekly</option>
											<option value="52">bi-Weekly</option>
										</select>&nbsp; &nbsp;
									</span>
                                    <input type="hidden" value="" id="spPF">
                                    <div class="clr"></div>
                                </p>
                                <p style="padding-bottom:25px; clear:both;" class="public_p_one public_p_two">
                                    <span> 
										<a href="#" data-popup-open="popup-5">
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										</a>Product &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
										<select id="selectcustomrate" onChange="GetCustomRateValue()"  style="margin-left: 35px;">
											<option class="clcustom" value="">Custom rate</option>
											<option value="4.55">6 mth close</option>
											<option value="6.45">6 mth open</option>
											<option value="6.5">1 yr open</option>
											<option value="3.29">1 yr closed</option>
											<option value="3.09">2 yr closed</option>
											<option value="3.39">3 yr closed</option>
											<option value="3.89">4 yr closed</option>
											<option value="4.49">5 yr closed</option>
											<option value="5.29">7 yr closed</option>
											<option value="5.79">10 yr closed</option>
											<option value="3">3 yr VRM</option>
											<option value="2.90">5 yr VRM</option>
										</select>&nbsp; &nbsp;
									</span>
                                    <input type="hidden" value="" id="spcustom" />
                                    <div class="clr"></div>
                                </p>
                                <p style="padding-bottom:30px; clear:both;" class="public_p_one">
                                    <span> 
										<a href="#" data-popup-open="popup-6">
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										</a>Interest rate
									</span>
                                    <span style="float:left; padding-left:5px;" class="span_margin">
										<input type="range" id="interestrate" oninput="interestrate(this.value);"  min ="0" max="20" step ="0.5" value ="0.5" />									
									</span>
                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;<b style="font-size:17px;" class="b_style">%</b></span>
                                    <input type="text" id="interestratetxt" oninput="interestratetxt(this.value);" value="">
                                    <div class="clr"></div>
                                </p>
                                <p class="round cal-btn">
                                    <a href="#" style="color:#fff !important; text-decoration:none; font-size:21px; font-weight: bold" data-popup-open="popup-9">Add Additional Prepayments</a>
                                    <div class="clr"></div>
                                </p>
                                <br>
                                <br>
                                <br>
                                <br>
                            </div>
                            <div class=" col-md-6">
                                <!-- Rigth Area of Hut Calculator -->
                                <div id="box1" style="border:2px solid #ccc;">
                                    <p style="text-align:center; font-size:15px; margin:0px!important; color: #fff">For a
                                        <span class="mortage_amt"> </span> mortgage at
                                        <span class="amorization_amt"></span>%,
                                        <span class="intrst_rate"> </span> years amortization, your
                                        <span class="months">monthly</span> payment will be
                                    </p>
                                    <p style="text-align:center; font-size:25px; color: #fff !important;">$
                                        <span id="spmonthly_payment" style="color: #fff; font-size: 18px; font-weight: bold;"></span>
                                    </p>
                                    <br>
                                    <p style="text-align:center; font-size:15px; margin-top: 12px !important;">
                                        <a href="" class="tabbg round" style="border:none; color:#FFFFFF!important; padding:6px 17px!important; float:none; margin-top:-11;     border-radius: 8px; position:relative; top:-4px; margin-right:21px;font-size: 18px; font-weight: bold; background: #039be5 !important;" data-popup-open="popup-7">Send more</a>
                                    </p>
                                </div>
                                <div id="box2" style="border:2px solid #ccc; display:none;">
                                    <p style="text-align:center; font-size:15px; margin-top:0px!important;">With a
                                        <span class="payment_secondtab"> </span>
                                        <span class="months">monthly</span> payment at 5.00%,
                                        <span class="intrst_rate"> </span> years amortization, your mortgage amount will be
                                        <span class="mrtage_amount"> 
									</p>
									<p style="text-align:center; font-size:25px; color: #0a368a !important;">
										<span class="payment_val" value=""></span>
                                    </p>
                                    <br>
                                    <p style="text-align:right; font-size:15px;">
                                        <a href="" class="tabbg round" style="none; color:#FFFFFF!important; padding:6px 17px!important; float:none; position:relative;     border-radius: 0px; top:20px; margin-top:-11; margin-right:20px;" data-popup-open="popup-7">Send more!</a>
                                    </p>
                                </div>
                                <div id="box3" style="border:2px solid #ccc; display:none;">
                                    <p style="text-align:center; font-size:15px; margin-top:0px!important;">For a
                                        <span class="mortage_amt"></span> mortgage with a
                                        <span id="spmonthly_payments">84.4</span>
                                        <span class="months">monthly</span> payment at 5.00%, your amortization will be
                                    </p>
                                    <p style="text-align:center; font-size:25px; color: #0a368a !important;">
                                        <span class="intrst_rate">5</span> Years
                                    </p>
                                    <br>
                                    <p style="text-align:right; font-size:15px;">
                                        <a href="#" class="tabbg round" style="border:none; padding:6px 17px!important; color:#FFFFFF!important; float:none; margin-top:-11;     border-radius: 0px; margin-right:21px; position:relative; top:-4px;" data-popup-open="popup-7">Send more!</a>
                                    </p>
                                </div>
                                <br>
                                <script type="text/javascript">
                                $(document).ready(function() {
                                    $("#paybox").hide("fade"); // Hide At starting
                                    tab1.classList.add("tabbg"); // Load Class on Page Load
                                    $("#pay").click(function() {
                                        $("#paybox").hide();
                                        $("#mortbox").show();
                                        $("#yearbox").show();
                                        //long div box code
                                        $("#box1").show();
                                        $("#box2").hide();
                                        $("#box3").hide();
                                        //Add Remove Class
                                        tab1.classList.add("tabbg");
                                        tab2.classList.remove("tabbg");
                                        tab3.classList.remove("tabbg");


                                    });
                                    $("#mort").click(function() {
                                        $("#mortbox").hide();
                                        $("#yearbox").show();
                                        $("#paybox").show();
                                        //long div box code
                                        $("#box1").hide();
                                        $("#box2").show();
                                        $("#box3").hide();
                                        //Add Remove Class
                                        tab1.classList.remove("tabbg");
                                        tab2.classList.add("tabbg");
                                        tab3.classList.remove("tabbg");

                                    });
                                    $("#year").click(function() {
                                        $("#yearbox").hide();
                                        $("#paybox").show();
                                        $("#mortbox").show();
                                        //long div box code
                                        $("#box1").hide();
                                        $("#box2").hide();
                                        $("#box3").show();
                                        //Add Remove Class
                                        tab1.classList.remove("tabbg");
                                        tab2.classList.remove("tabbg");
                                        tab3.classList.add("tabbg");
                                    });



                                }); // Ready function close

                                ////////////////////////////////////////////////////////////////
                                //////////////////                     /////////////////////////
                                ////////////////// Range Slider Jquery//////////////////////////
                                /////////////////                     //////////////////////////
                                //////////////////////////////////////////////////////////////// 

                                $(document).ready(function() {

                                    document.getElementById('mortamounttxt').value = 25000;
                                    $("#mortage").val($("#mortamounttxt").val());

                                    document.getElementById('amorttxt').value = 5;
                                    $("#amort_val").val($("#amorttxt").val());


                                    document.getElementById('interestratetxt').value = 0.5;

                                    $("#spcustom").val($("#interestratetxt").val());

                                    $('#paymenttxt').val($('#spmonthly_payment').html());

                                    $("#spPF").val($("#selectPF option:selected").val());



                                    if ($("#selectcustomrate option:selected").text() == "Custom rate") {
                                        $("#selectcustomrate option:selected").val(document.getElementById('interestrate').value);
                                        $("#spcustom").val($("#selectcustomrate option:selected").val());
                                    }
                                    GetValue();
                                });
                                GetValue = function() {
                                    var currency = $('#mortage').val();
                                    var number = Number(currency.replace(/[^0-9\.]+/g, ""));
                                    var MA = (parseInt(number));
                                    var Am = (parseInt($('#amort_val').val()));
                                    var Pf = (parseInt($('#spPF').val()));

                                    var Pr = (parseFloat($('#spcustom').val()));

                                    var custom_rate = Pr / 100;

                                    $(".mortage_amt").html('$' + addCommas(MA));
                                    $(".amorization_amt").html(Pr);
                                    $(".intrst_rate").html(Am);


                                    var p_frq_value = $("#selectPF").val();

                                    var result;
                                    if (p_frq_value == 12) {

                                        result = "monthly";
                                    } else if (p_frq_value == 24) {

                                        result = "Semi-Monthly";
                                    } else if (p_frq_value == 26) {

                                        result = "Weekly";
                                    } else {

                                        result = "bi-Weekly";
                                    }
                                    //alert(result);
                                    $('.months').html(result);


                                    var inner_intersest_paid = [];
                                    var inner_intersest_ipmt = [];
                                    var inner_intersest_ppmt = [];
                                    var inner_intersest_Balance_Amount = [];
                                    $("#myTable").empty();
                                    $('#myTable').append('<tr><th>Period</th><th>Total Paid</th><th>Interest</th><th>Principal</th><th>Balance</th></tr>')

                                    var balance_amt = 0;
                                    var ppmtMainPP = 0;

                                    for (j = 1; j <= parseInt(Am); j++) {
                                        var YearStartValue = 0;
                                        var YearEndValue = 0;
                                        var ppmtMain = 0;
                                        var ipmtMain = 0;
                                        var Totalpaid = 0;

                                        if (j == 1) {
                                            YearStartValue = parseInt(j - 1) * 12;
                                            YearEndValue = parseInt(j) * 12;
                                        } else {
                                            YearStartValue = (parseInt(j - 1) * 12);
                                            YearEndValue = parseInt(j) * 12;
                                        }

                                        var intersest_paid = 0;

                                        var pmt = Math.abs((((custom_rate / Pf) * MA * Math.pow((1 + (custom_rate / Pf)), (Am * Pf)) / (1 - Math.pow((1 + (custom_rate / Pf)), (Am * Pf))))).toFixed(2));




                                        for (i = parseInt(YearStartValue); i < parseInt(YearEndValue); i++) {
                                            //alert(YearStartValue);	
                                            //alert(YearEndValue);
                                            //alert(i);
                                            var tmp = Math.pow(1 + (custom_rate / Pf), i);

                                            var ipmt = 0 - (MA * tmp * (custom_rate / Pf) + pmt * (tmp - 1));
                                            //alert(ipmt+" : "+tmp+" : "+MA+" : "+custom_rate+" : "+Pf+" : "+pmt);
                                            //alert(i);
                                            //alert(ipmt);
                                            var intersest_paid = parseInt(intersest_paid + ipmt);
                                            var ppmt = ((pmt - ipmt));


                                            var Total_Paid = pmt * 12;
                                            var Principal_paid = Total_Paid - intersest_paid;

                                            var Totalpaids = Math.abs(parseInt(pmt * Pf * Am));

                                            ipmtMain += parseFloat(ipmt);
                                            ppmtMain += ppmt;
                                            ppmtMainPP += ppmt;
                                            Totalpaid += Totalpaids;
                                            //alert(Totalpaid);
                                            // alert(ipmtMain);
                                            inner_intersest_paid.push(ipmt);
                                            inner_intersest_ppmt.push(ppmt);
                                            inner_intersest_ipmt.push(intersest_paid);
                                            inner_intersest_Balance_Amount.push(Balance_Amount);

                                        }
                                        var Balance_Amount = (MA + ppmtMainPP).toFixed(2);
                                        if (j == 1) {
                                            $('#myTable').append('<tr><td>Year 0</td><td>$0.00</td><td>$0.00</td><td>$0.00</td><td>' + MA + '</td></tr>')
                                        }
                                        $('#myTable').append('<tr><td>Year ' + (parseInt(j)) + ' </td><td>$' + (Totalpaid).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</td><td>$' + Math.abs((ipmtMain).toFixed(2)).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</td><td>$' + Math.abs((ppmtMain).toFixed(2)).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</td><td>$' + Balance_Amount.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + '</td></tr>')
                                    }


                                    var payment = pmt;
                                    var interest = inner_intersest_paid;
                                    var principal = inner_intersest_ppmt;
                                    if (pmt == null) {
                                        $("#spmonthly_payment").html('0');
                                    } else {
                                        $("#spmonthly_payment").html(addCommas(pmt));
                                    }
                                    $('#paymenttxt').val(pmt);
                                    $('#spmonthly_payments').html('$' + addCommas(pmt)).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");;
                                    var amount = $('#mortage').val();

                                    ($('.mrtage_amount').html('$' + amount)).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");

                                    var nper = Am * Pf;

                                    var fv = 0;

                                    if (custom_rate == 0) { // Interest rate is 0
                                        pv_value = -(fv + ((-pmt) * nper));
                                    } else {

                                        x = Math.pow(1 + custom_rate, -nper);
                                        y = Math.pow(1 + custom_rate, nper);
                                        pv_value = ((-(x * (fv * custom_rate - (-pmt) + y * (-pmt))) / custom_rate).toFixed(2));

                                    }

                                    $('.payment_secondtab').html('$' + addCommas(pv_value)).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                                    var third_tab_nper = Math.log((-0 * custom_rate + (-pmt)) / ((-pmt) + custom_rate * pv_value)) / Math.log(1 + custom_rate);

                                    customchart(inner_intersest_Balance_Amount);

                                }

                                $("#interestrate").on("change", function() {
                                    if ($("#selectcustomrate option:selected").text() == "Custom rate") {
                                        $("#selectcustomrate option:selected").val(document.getElementById('interestrate').value);
                                        $("#spcustom").val(document.getElementById('interestrate').value);
                                    }

                                });
                                GetCustomRateValue = function() {
                                    var strval = $("#selectcustomrate option:selected").val();
                                    $("#spcustom").val(strval);
                                    GetValue();
                                };

                                GetPFValue = function() {
                                    var strval = $("#selectPF option:selected").val();
                                    $("#spPF").val(strval);
                                    GetValue();
                                };

                                function mortamount(val) {
                                    document.getElementById('mortamounttxt').value = addCommas(val);
                                    $("#mortage").val($("#mortamounttxt").val());
                                    var j = 9;
                                    var k = parseFloat($("#mortamounttxt").val()) + parseFloat(j);
                                    $("#spmonthly_payment").html(k);
                                    GetValue();

                                }

                                function addCommas(nStr) {
                                    nStr += '';
                                    x = nStr.split('.');
                                    x1 = x[0];
                                    x2 = x.length > 1 ? '.' + x[1] : '';
                                    var rgx = /(\d+)(\d{3})/;
                                    while (rgx.test(x1)) {
                                        x1 = x1.replace(rgx, '$1' + ',' + '$2');
                                    }
                                    return x1 + x2;
                                }

                                function mortamounttxt(txtval) {

                                    document.getElementById('mortamount').value = txtval;
                                    if (txtval > 9999999) {


                                        alert("Value is more than range");
                                        $("#mortamounttxt").val("");

                                    } else {


                                        $("#mortage").val(txtval);
                                        GetValue();
                                    }
                                }
                                ////////////////////////////////////////////////////////////////

                                function amort(val) {
                                    var test = document.getElementById('amorttxt').value = val;
                                    $("#amort_val").val($("#amorttxt").val());
                                    GetValue();
                                }

                                function amorttxt(txtval) {
                                    document.getElementById('amort').value = txtval;
                                    if (txtval > 50) {
                                        alert("Value is more than range");
                                        $("#amorttxt").val("");
                                    } else {


                                        $("#amort_val").val(txtval);
                                        GetValue();

                                    }

                                }
                                ////////////////////////////////////////////////////////////////

                                function payment(payval) {
                                    document.getElementById('paymenttxt').value = payval;
                                    $("#pay_val").val($("#paymenttxt").val());
                                    GetValue();
                                }

                                function paymenttxt(paytxt) {
                                    document.getElementById('payment').value = paytxt;
                                    if (paytxt > 9999999) {
                                        alert("Value is more than range");
                                        $("#paymenttxt").val("");
                                    } else {



                                        $("#pay_val").val(paytxt);
                                        GetValue();
                                    }
                                }
                                ////////////////////////////////////////////////////////////////

                                function interestrate(intratval) {
                                    document.getElementById('interestratetxt').value = intratval;
                                    $('#spcustom').val(intratval);
                                    GetValue();

                                }

                                function interestratetxt(intrattxt) {
                                    document.getElementById('interestrate').value = intrattxt;
                                    if (intrattxt > 20) {


                                        alert("Value is more than range");
                                        $("#interestratetxt").val("");

                                    } else {

                                        $('#spcustom').val(intrattxt);
                                        GetValue();
                                    }
                                }
                                //    ONLY NUMERIC VALUE ACCEPT

                                /* $("#mortamounttxt, #amorttxt, #paymenttxt, #interestratetxt").keydown(function (e) {
                                      // Allow: backspace, delete, tab, escape, enter and .
                                      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                           // Allow: Ctrl+A, Command+A
                                          (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                                           // Allow: home, end, left, right, down, up
                                          (e.keyCode >= 35 && e.keyCode <= 40)) {
                                               // let it happen, don't do anything
                                               return;
                                      }
                                      // Ensure that it is a number and stop the keypress
                                      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                          e.preventDefault();
                                      }
                                  });*/
                                </script>
                                <div style="margin-top:10%;">
                                    <p><span style="padding: 5px 20px!important;" class="chart" id="chart">Chart</span>
                                        <span style="padding: 5px 20px!important; margin-right:3px;" class="graph" id="graph">Graph</span>
                                    </p>
                                </div>
                                <br>
                                <br>
                                <div id="graph1">
                                    <p style="text-align:center;">
                                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                    </p>
                                </div>
                                <div id="chart1" style="display:none;">
                                    <table id="myTable">
                                        <tr>
                                            <th>Company</th>
                                            <th>Contact</th>
                                            <th>Country</th>
                                        </tr>
                                        <tr>
                                            <td>Alfreds Futterkiste</td>
                                            <td>Maria Anders</td>
                                            <td>Germany</td>
                                        </tr>
                                        <tr>
                                            <td>Centro comercial Moctezuma</td>
                                            <td>Francisco Chang</td>
                                            <td>Mexico</td>
                                        </tr>
                                        <tr>
                                            <td>Ernst Handel</td>
                                            <td>Roland Mendel</td>
                                            <td>Austria</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!--          </article>-->
                        <div class="clearfix"></div>
                    </div>
                    <!--Col 11 End Hut-->
                </div>
                <!--Col 12 End Hut-->
            </div>
            <!--row End Hut-->
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        //----- OPEN
        $('[data-popup-open]').on('click', function(e) {
            var targeted_popup_class = $(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

            e.preventDefault();
        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function(e) {
            var targeted_popup_class = $(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            e.preventDefault();
        });
    });

    ;
    (function($) {

        'use strict';

        var pluginName = 'addel';

        var formElements = 'input, select, textarea';

        function Plugin(element, options) {

            // vars
            var container = $(element);

            var settings = $.extend(true, {}, $.fn[pluginName].defaults, options);

            var targetClass = '.' + settings.classes.target;
            var addClass = '.' + settings.classes.add;
            var deleteClass = '.' + settings.classes.delete;

            var animation = {
                duration: settings.animation.duration,
                easing: settings.animation.easing
            };

            // hide feature
            if (settings.hide) {
                container.find(targetClass).hide().find(formElements).prop('disabled', true);
            }

            // add
            container.on('click', addClass, function() {

                var target = container.find(targetClass).last();

                // addel:add event
                var addEvent = $.Event('addel:add', {
                    target: target
                });
                container.trigger(addEvent);
                if (addEvent.isDefaultPrevented()) {
                    return
                }

                // no visible targets
                if (target.filter(':visible').length === 0) {
                    target.fadeIn(animation).find(formElements).prop('disabled', false);

                    // visible target/s
                } else {
                    target.clone().insertAfter(target).hide().fadeIn(animation).find(formElements).val(null);
                }

                var added = container.find(targetClass).last();
                added.find(':input:enabled:visible:first').focus();

                // addel:added event
                container.trigger($.Event('addel:added', {
                    target: target,
                    added: added
                }));

            });

            // del
            container.on('click', deleteClass, function() {

                var target = $(this).closest(targetClass);
                var prevTarget = target.prev(targetClass);
                var nextTarget = target.next(targetClass);

                // addel:delete event
                var deleteEvent = $.Event('addel:delete', {
                    target: target
                });
                container.trigger(deleteEvent);
                if (deleteEvent.isDefaultPrevented()) {
                    return false;
                }

                // 1 target exists
                if (container.find(targetClass).length === 1) {

                    target.fadeOut(animation).find(formElements).prop('disabled', true);
                    container.find(addClass).focus();

                    // >1 targets exist
                } else {

                    target.fadeOut(animation.duration, animation.easing, function() {
                        $(this).remove();
                    });

                    if (prevTarget.length === 1) {
                        prevTarget.find(deleteClass).focus();
                    } else {
                        nextTarget.find(deleteClass).focus();
                    }

                }

                // addel:deleted event
                container.trigger($.Event('addel:deleted', {
                    target: target
                }));

            });


        }

        // plugin wrapper
        // instantiates the plugin as many times as needed
        // and makes sure no duplication occurs
        $.fn[pluginName] = function(options) {
            return this.each(function() {
                if (!$.data(this, "plugin_" + pluginName)) {
                    $.data(this, "plugin_" + pluginName,
                        new Plugin(this, options));
                }
            });
        };

        // defaults
        $.fn[pluginName].defaults = {
            hide: false,
            classes: {
                target: 'addel-target',
                add: 'addel-add',
                delete: 'addel-delete'
            },
            animation: {
                duration: 0,
                easing: 'swing'
            }
        };

    })($);

    (function($) {
        $(document).ready(function() {
            graph.classList.add("tabbg"); // Load Class on Page Load    
            $("#graph").click(function() {
                $("#chart1").hide();
                $("#graph1").show();

                //Add Remove Class
                graph.classList.add("tabbg");
                chart.classList.remove("tabbg");

            });
            $("#chart").click(function() {
                $("#graph1").hide();
                $("#chart1").show();

                //Add Remove Class
                graph.classList.remove("tabbg");
                chart.classList.add("tabbg");

            });




        }); // Ready function close
    }($));
    </script>
    <script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $('.addel').addel({
                classes: {
                    target: 'target'
                },
                animation: {
                    duration: 100
                }
            }).on('addel:delete', function(event) {
                if (!window.confirm('Are you absolutely positive you would like to delete: ' + '"' + event.target.find(':input').val() + '"?')) {
                    console.log('preventDefault()!');
                    event.preventDefault();
                }
            });
        });
    }($));
    </script>
@endsection

@section('script')
	<script type="text/javascript" src="/js/chart.js"></script>
	<script type="text/javascript" src="/js/jquery.canvasjs.min.js"></script>
@endsection