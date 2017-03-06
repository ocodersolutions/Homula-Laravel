@extends('layouts.frontend')

@section('meta_keywords'){{ $page->keyword }}@stop 

@section('meta_description'){{ $page->description }}@stop 

@section('content')
	<style type="text/css">
		/* style for resale-home page */
		.resale_homes_box_one {
		    background: #fff;
		}
		.resale_homes_box_one h2 {
		    font-size: 32px;
		    font-weight: bold;
		    color: #fff;
		    background: #039be5;
		    padding: 10px 0;
		    text-align: center;
		    margin: 50px 0 20px 0;
		}
		.resale_homes_box_one p, .resale_homes_box_two p, .resale_homes_box_three p, .resale_homes_box_four p {
		    color: #232323;
		    font-size: 15px;
		    line-height: 24px;
		    text-align: justify;
		}
		.traditional_sale, .short_sale, .foceclosure_or_bank {
		    margin: 20px 0;
		    font-size: 16px;
		    color: #039be5;
		    font-weight: bold;
		}
		.traditional_sale .img-responsive, .short_sale .img-responsive, .foceclosure_or_bank .img-responsive {
		    display: inline-block;
		    margin-right: 20px;
		}
		.resale_homes_box_two, .resale_homes_box_three, .resale_homes_box_four {
		    padding: 30px 0;
		}
		.resale_homes_img_left {
		    float: left;
		    margin-right: 2%;
		    width: 33.33%;
		}
		.resale_homes_h3_left {
		    font-weight: bold;
		    color: #fff;
		    background: #333366;
		    margin-left: 35.33%;
		    padding: 10px 20px;
		    font-size: 18px;
		    margin-bottom: 15px;
		}
		.resale_homes_box_three {
		    background: #fff;
		}
		.resale_homes_img_right {
		    float: right;
		    margin-left: 2%;
		    width: 33.33%;
		}
		.resale_homes_h3_right {
		    font-weight: bold;
		    color: #fff;
		    background: #333366;
		    margin-right: 35.33%;
		    padding: 10px 20px;
		}
		/* style for exclusive-homes page */
		.page_frontend .page_frontend_header {
		    background: #039be5;
		    color: #fff;
		    padding: 10px 20px 10px 20px;
		    font-size: 32px;
		    margin-bottom: 50px;
		    margin-top: 50px;
		    width: 100%;
		    text-align: center;
		    text-transform: uppercase;
		    font-weight: bold;
		}
		.exclusive_homes_form .input-group {
		    margin-bottom: 15px;
		}
		.page_frontend p {
		    font-size: 16px;
		}
		.exclusive_homes_form > .input-group p:first-child strong:first-child {
		    color: #000;
		    font-size: 16px;
		}
		.exclusive_homes_form > .input-group p:first-child strong:last-child {
		    color: #223c6e;
		    font-size: 16px;
		}
		.exclusive_homes_form > .input-group p:nth-child(2) strong {
		    color: #223c6e;
		    font-size: 16px;
		}
		.exclusive_homes_box {
		    border: 1px solid #b7b7b7;
		    background: #fff;
		    margin-bottom: 20px;
		    min-height: 263px;
		}
		.exclusive_homes_box h4 {
		    background: #223c6e;
		    margin: 0 0 20px 0;
		    color: #fff;
		    font-size: 18px;
		    font-weight: bold;
		    padding: 15px;
		}
		.exclusive_homes_box p {
		    padding: 0 15px;
		    margin: 0;
		}
		.exclusive_homes_box ul {
		    padding: 0 15px;
		    margin-bottom: 15px;
		}
		.exclusive_homes_box ul li {
		    position: relative;
		    padding-left: 25px;
		    margin-bottom: 10px;
		}
		.exclusive_homes_box ul li:before {
		    position: absolute;
		    font-family: FontAwesome;
		    content: "\f054";
		    display: inline-block;
		    left: 0;
		    font-size: 12px;
		    top: 4px;
		    background: #232323;
		    width: 18px;
		    line-height: 18px;
		    color: #fff;
		    text-align: center;
		    border-radius: 50%;
		}
		/* style for open-house page */
		.page-open-house .stbg_1 {
		    padding: 0px 0 40px 0;
	        /*background-color: #f1f1f1;*/
		}
		.page_frontend .shadow_bottom {
		    position: relative;
		    z-index: 1;
		}
		.page_frontend .shadow_bottom:after, .page_frontend .shadow_bottom:before {
		    content: "";
		    position: absolute;
		    z-index: -1;
		    -webkit-box-shadow: 0 0 20px rgba(0,0,0,0.8);
		    -moz-box-shadow: 0 0 20px rgba(0,0,0,0.8);
		    box-shadow: 0 0 20px rgba(0,0,0,0.8);
		    top: 50%;
		    bottom: 0;
		    left: 10px;
		    right: 10px;
		    -moz-border-radius: 100px / 10px;
		    border-radius: 350px / 60px;
		}
		.page-open-house .header_form {
		    background-color: #f8f8f8;
		    text-align: center;
		    padding: 30px;
		    border: 1px solid #cacaca;
		    font-size: 16px;
		}
		.page-open-house form div.input-group {
		    text-align: center;
		    margin-bottom: 15px;
		}
		.page-open-house form div.input-group .btn-simple {
		    border-radius: 10px;
		    box-shadow: 0 5px 0 #027eba;
		    background-color: #039be6;
		    color: #fff;
		    font-size: 13px;
		    font-weight: 500;
		    padding: 6px 12px;
		    overflow: hidden;
		    text-transform: uppercase;
		    height: 48px;
		    text-align: center;
		}
		.page-open-house form div.input-group .btn-simple i {
		    margin-right: 10px;
		    opacity: 0.7;
		}
		.page-open-house .stbg_2 {
		    background-color: #fff;
		    padding: 50px 0;
		}
		.page-open-house .stbg_2 h3 {
		    font-size: 18px;
		    margin-bottom: 15px;
		}
		.page-open-house .tittle_style {
		    background: #039be6;
		    padding: 20px 30px;
		    margin: 0;
		    color: #fff;
		    font-weight: 700;
		    font-size: 18px;
		    margin-bottom: 15px;
		    text-transform: uppercase;
		}
		.page-open-house ul.nav.nav-tabs li a {
		    background: #6782b9;
		    color: #FFF;
		    text-transform: uppercase;
	        border: 0;
		    border-radius: 0;
		    font-weight: 500;
		    margin: 0 5px 0 0;
		    overflow: hidden;
		    padding: 20px;
		    position: relative;
		    text-align: center;
	        line-height: 1.42857;
		}
		.page-open-house ul.nav.nav-tabs li.active a {
		    background: #223c6d;
		    box-shadow: none;
		}
		.page-open-house .tab-content {
		    box-sizing: border-box;
		    padding: 20px;
		    border: 1px solid #cacaca;
		}
		.page-open-house .nav-tabs {
			border: 0;
		}
		.page-open-house #advertising ul {
		    margin-bottom: 30px;
		    padding: 0;
		}
		.page-open-house #advertising ul li {
			margin-bottom: 10px;
		}
		.page-open-house #advertising ul li i {
			margin-right: 10px;
		}
		.page-open-house #advertising p {
			font-size: 16px;
		}
		/* style ask-a-question page */
		.page-ask-a-question .askform {
			margin-bottom: 40px;
		}
		.page-ask-a-question .askform form {
			border: 1px solid #aaaaaa;
		    background: #f8f8f8;
		    padding: 30px 0;
		    overflow: hidden;
		}
		.page-ask-a-question .askform .cformfield {
		    width: auto;
		    margin: 0;
		    color: #000;
		}
		.page-ask-a-question .askform .cformfield label {
		    display: inline-block;
		    width: 190px;
		    font-size: 15px;
		    font-weight: normal;
		    color: #000;
		    cursor: pointer;
		    text-transform: uppercase;
		    margin-bottom: 5px;
		}
		.wpcf7-form-control-wrap {
		    position: relative;
		}
		.page-ask-a-question .askform .cformfield input {
			background: #fcfcfc;
		    border: 1px solid #6984b6;
		    border-radius: 10px;
		    height: 50px;
		    margin-bottom: 50px;
		    color: #000;
		    padding: 5px;
		    line-height: 60px;
		    font-size: 19px;
		    box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
		    position: relative;
		    transition: box-shadow .12s linear;
		}
		.page-ask-a-question .askform .cformfield input:focus {
			box-shadow: 0 2px 0 0 #039be5;
		    outline: 0;
		}
		.page-ask-a-question .askform .cformfield select {
			padding: 10px;
		    border: 1px solid #6984b6;
		    border-radius: 10px;
		    text-transform: uppercase;
		    margin-bottom: 50px;
		}
		.page-ask-a-question .askform .col-sm-4 .cformfield {
			border: 1px solid #6984b6;
		    border-radius: 10px;
		    padding: 10px;
		    text-transform: uppercase;
		    background: #fcfcfc;
		}
		.page-ask-a-question .askform .cformfield textarea {
		    background: none;
		    box-shadow: none;
		    padding: 0px 20px;
		    color: #000;
		    border: 0;
		    resize: none;
		}
		.page-ask-a-question .askform .cformfield textarea:focus {
			outline: 0;
		}
		.page-ask-a-question .askform .col-sm-4 input[type=submit] {
			background: #039be5;
		    padding: 10px 50px;
		    border-radius: 10px;
		    font-weight: bold;
		    font-size: 16px;
		    box-shadow: 0 3px 0px #027fbb;
		    margin: 30px 0 0 100%;
		    transform: translateX(-100%);
		    color: #fff;
		    border: 0;
		    overflow: hidden;
		    position: relative;
		    text-transform: uppercase;
		}
		.page-ask-a-question .askform .col-sm-4 div.wpcf7 img.ajax-loader {
		    border: 0;
		    vertical-align: middle;
		    margin-left: 4px;
		}
		.ask_a_question_box {
		    border: 1px solid #b7b7b7;
		    background: #fff;
		    padding: 15px;
		}
		.ask_a_question_box p {
			color: #232323;
			font-size: 15px;
		    line-height: 24px;
		}
		.ask_a_question_box p a {
		    color: #337ab7;
		}
		.page-ask-a-question h3 {
		    font-size: 18px;
		    font-weight: bold;
		    background: #333366;
		    color: #fff;
		    padding: 20px;
		    margin: 0;
		    text-align: center;
		    text-transform: uppercase;
		}
		/* style for list-my-house page */
		.page-list-my-house div.wpcf7 {
		    border: 1px solid #aaaaaa;
		    background: #f8f8f8;
		    margin-bottom: 30px;
		}
		div.wpcf7 .screen-reader-response {
		    position: absolute;
		    overflow: hidden;
		    clip: rect(1px,1px,1px,1px);
		    height: 1px;
		    width: 1px;
		    margin: 0;
		    padding: 0;
		    border: 0;
		}
		.page-list-my-house form {
		    padding: 30px 0px 0 0px;
		    margin: 0;
		    background: #f8f8f8;
		}
		.page-list-my-house .cformfield {
		    margin: 0;
		    color: #000;
		    font-size: 15px;
		    line-height: 24px;
		}
		.page-list-my-house .cformfield label {
		    display: inline-block;
		    width: 190px;
		    font-size: 15px;
		    font-weight: normal;
		    color: #000;
	        cursor: pointer;
	        text-transform: uppercase;
		}
		.page-list-my-house .cformfield input {
		    padding: 5px;
		    line-height: 60px;
		    text-align: left;
		    font-size: 19px;
	        box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
	        position: relative;
		    transition: box-shadow .12s linear;
	        background: #fcfcfc;
		    border: 1px solid #6984b6;
		    border-radius: 10px;
		    height: 50px;
		    margin-bottom: 50px;
		    color: #000;
		}
		.page-list-my-house .cformfieldtext {
			color: #000;
		    margin: 0 auto;
		    padding: 10px;
		    display: block;
		    width: 100%;
		    background: #fcfcfc;
		    text-transform: uppercase;
		    border: 1px solid #6984b6;
		    border-radius: 10px;
		}
		.page-list-my-house .cformfieldtext textarea {
			box-shadow: none;
			border: 0;
			background: none;
			outline: 0;
			resize: none;
		}
		.page-list-my-house .cformfield input:focus {
			box-shadow: 0 2px 0 0 #039be5;
		    outline: 0;
		}		
		.page-list-my-house .wpcf7 form p input[type=submit] {
		    background: #039be5;
		    padding: 10px 50px;
		    border-radius: 10px;
		    font-weight: bold;
		    font-size: 16px;
		    box-shadow: 0 3px 0px #027fbb;
		    border: 0;
		    color: #fff;
	        margin-top: 20px;
		    margin-left: 100%;
		    transform: translateX(-100%);
		}
		.page-list-my-house .wpcf7 form {
			overflow: hidden;
		}
		.page-list-my-house p {
			color: #232323;
			font-size: 15px;
		    line-height: 24px;
		}
		.page-list-my-house h3 {
		    font-size: 18px;
		    font-weight: bold;
		    background: #333366;
		    color: #fff;
		    padding: 20px;
		    width: 643px;
		    margin-bottom: 15px;
	        margin-top: 20px;
	        text-transform: uppercase;
		}
		.page_frontend.page-list-my-house .page_frontend_header {
		    margin-top: 150px;
		    margin-bottom: 0;
		    padding: 15px 0;
		}
		.list_my_house_box_1 {
		    margin: 30px 0;
		}
		.list_my_house_box_1 div strong, .list_my_house_box_2 div strong {
		    background: #6682b8;
		    padding: 10px;
		    margin-right: 3px;
		    display: inline-block;
		    color: #fff;
		    font-size: 18px;
		    font-weight: bold;
		    text-transform: uppercase;
		    cursor: pointer;
		}
		.list_my_house_box_1 div strong.active_strong, .list_my_house_box_2 div strong.active_strong {
		    background: #223c6e;
		}
		.list_my_house_box_1 p, .list_my_house_box_2 p {
		    border: 1px solid #b7b7b7;
		    background: #fff;
		    padding: 20px;
		    display: none;
		}
		.list_my_house_box_1 p.box_1_p_1, .list_my_house_box_2 p.box_2_p_1 {
		    display: block;
		}
		/* style for utility-companies page */
		.page-utility-companies {
			background: #f1f1f1;
		    padding: 0;
		}
		.page-utility-companies p {
			text-align: left;
		    margin-bottom: 20px;
		    font-size: 15px;
		}
		.page-utility-companies #form-utility {
		    width: 60%;
		    float: left;
		}
		.page-utility-companies .wpcf7 form {
		    margin: 0;
		    padding: 0;
		    background: #f1f1f1;
		}
		.page-utility-companies .wpcf7 .cformfield {
		    margin-bottom: 25px;
		    position: relative;
		    background: #fff;
		    z-index: 0;
		    border: 1px solid #dcdcdc;
		    color: #000;
		}
		.page-utility-companies .wpcf7 .cformfield:before, .page-utility-companies .wpcf7 .cformfield:after {
			position: absolute;
		    content: "";
		    height: 50%;
		    bottom: 18px;
		    left: 15px;
		    right: 15px;
		    z-index: -1;
		    box-shadow: 0 15px 15px #777;
		    border-radius: 100px/20px;
		    margin: 0 auto;
		    width: 50%;
		}
		.page-utility-companies .wpcf7 .cformfield .wrap-shadow {
		    padding: 7px 15px;
		    background: #fff;
		}
		.page-utility-companies #form-utility .wpcf7-form-control-wrap {
		    margin-left: 72px;
		}
		.page-utility-companies #form-utility .wpcf7 .cformfield input {
			padding: 5px;
		    border-radius: 5px;
		    line-height: 60px;
		    text-align: left;
		    height: 45px;
		    background: #fff;
		    border: 1px solid #0496df;
		    width: 60%;
		    margin: 0;
		    color: rgba(0, 0, 0, 0.7);
		    font-size: 16px;
		}
		.page-utility-companies #form-utility .wpcf7 .cformfield input:focus,
		.page-utility-companies #form-utility .wpcf7-form-control-wrap.your-request textarea:focus {
			box-shadow: 0 2px 0 0 #039be5;
		    outline: 0;
		}
		.page-utility-companies #form-utility .wpcf7-form-control-wrap.your-request textarea {
			box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
		    color: rgba(0,0,0,0.7);
		    font-size: 16px;
		    line-height: 48px;
		    padding: 0 5px;
		    position: relative;
		    transition: box-shadow .12s linear;
		    margin-left: 16px;
		    border: 1px solid #0496df;
		    border-radius: 5px;
		    width: 60%;
		    vertical-align: top;
		    background: #fff;
		    resize: none;
		}
		.page-utility-companies #form-utility .wpcf7 .cformbtn {
		    margin: 60px 0 0 0;
		}
		.page-utility-companies #form-utility .wpcf7 .cformbtn input {
			border: 0;
			color: #fff;
			font-weight: 500;
		    overflow: hidden;
		    position: relative;
		    text-transform: uppercase;
			border-radius: 5px;
			box-shadow: 2px 2px 1px #000;
			font-size: 20px;
		    background: #0496df;
		    padding: 10px 50px;
		}
		.page-utility-companies div.wpcf7 img.ajax-loader {
		    border: 0;
		    vertical-align: middle;
		    margin-left: 4px;
		}
		.page-utility-companies .effect-1 {
		    width: 35%;
		    float: right;
		    background: #fff;
		    position: relative;
		    z-index: 0;
		}
		.page-utility-companies .effect-1:before, .page-utility-companies .effect-1:after {
		    z-index: -1;
		    position: absolute;
		    content: "";
		    bottom: 15px;
		    left: 26px;
		    width: 50%;
		    top: 80%;
		    max-width: 300px;
		    background: #777;
		    box-shadow: 0 15px 10px #777;
		    transform: rotate(-3deg);
		}
		.page-utility-companies .effect-1:after {
			transform: rotate(3deg);
		    right: 26px;
		    left: auto;
		}
		.page-utility-companies .content-1 {
		    clear: both;
		    background: #fff;
		    margin-top: 30px;
		    text-transform: none;
		}
		.page-utility-companies ul.nav.nav-tabs {
			border: 0;
		    display: block;
		    margin: 0;
		    padding: 0;
		    box-shadow: none;
		    line-height: 10px;
		}
		.page-utility-companies ul.nav.nav-tabs li a {
			border: 0;
			margin: 0 5px 0 0;
		    overflow: hidden;
		    position: relative;
		    text-align: center;
		    line-height: 1.42857;
		    border-radius: 0;
		    padding: 10px;
		    font-weight: bold;
		    background: #6782b9;
		    color: #FFF;
		    text-transform: uppercase;
		}
		.page-utility-companies ul.nav.nav-tabs li.active a {
		    background: #223c6d;
		    box-shadow: none;
		}
		.page-utility-companies .tab-content {
		    box-sizing: border-box;
		    padding: 20px;
		    border: 1px solid #cacaca;
		    background: #fff;
		    margin-bottom: 50px;
		}
		.page-utility-companies .content-2 {
		    clear: both;
		    margin-top: 65px;
		    text-transform: none;
		}
		.page-utility-companies strong.choosing {
		    background: #0496df;
		    padding: 10px;
		    text-transform: uppercase;
		    color: #fff;
		}
		/* style for property-management page */
		.page-property-management {
			background: #f2f2f2;
		}
		.page_frontend.page-property-management .page_frontend_header {
			margin: 0;
		    color: #039be5;
		    font-size: 23px;
		    padding-top: 50px;
		    background: #fff;
		}
		.property-management-body {
			background: #fff;
		    overflow: hidden;
		    padding: 15px;
		}
		.property-management-body .custommenul_item {
		    float: left;
		    padding: 15px;
		    margin: 0 4px;
		    box-shadow: 0 0 10px;
		    width: 362px;
		    min-height: 458px;
		}
		.property-management-body .custommenul_item h2 {
		    color: #0a368a;
		    font-weight: bold;
		    padding-bottom: 10px;
		    border-bottom: 1px solid;
		    margin: 0 0 10px 0;
		    font-size: 20px;
		    text-transform: uppercase;
		    line-height: 1.1;
		}
		.property-management-body .custommenul_item ul {
			padding: 0;
			margin: 0 0 10px 0;
		}
		.property-management-body .custommenul_item ul li {
			margin-bottom: 10px;
		}
		.property-management-body .custommenul_item a {
		    color: #68b7ec;
		    transition: color .15s linear;
		}
		.property-management-body .custommenul_item a:hover {
			text-decoration: none;
		}
		.property-management-body ul {
			padding: 0;
			margin: 0 0 10px 0;
		}
		.property-management-body ul li {
			margin-bottom: 10px;
			font-size: 16px;
		}
		.property-management-body p {
			font-size: 16px;
		}
		.property-management-body strong {
			font-size: 16px;
		}
		.property-management-body a {
			font-size: 16px;
		}
		.property-management-body a:hover {
			text-decoration: none;
		}
		.property-management-body h3 {
			font-size: 18px;
		    margin-bottom: 15px;
		    font-weight: normal;
		    text-transform: uppercase;
		}
		.page-home-stagers,.page-sign-suppliers,.page-appraiser,.page-insurance-brokers,.page-moving-company{
		    padding: 0;
    		background: #f2f2f2;
		}
		.page-home-stagers .container,.page-sign-suppliers .container,.page-appraiser .container,.page-insurance-brokers .container,.page-moving-company .container{
			padding: 10px 20px;
		    width: 1200px;
		    margin: 0 auto;
		    background: #fff;
		    text-align: justify;
		}
		.page-home-stagers ul, .type-profess ul{
			list-style-type: none;
		    margin-top: 0;
		    padding: 0;
		}
		.page-home-stagers ul li, .type-profess ul li{
		    margin-bottom: 10px;
		}
		.page-home-stagers p *,.page-home-stagers ul li *, .type-profess ul li *{
			font-size: 16px;
		}
		.agent-row-content {
		    box-shadow: 0 0 10px;
		    float: left;
		    margin: 0 15px 40px 15px;
		    width: 356px;
		    min-height: 260px;
		}
		.agent-row-content .agent-row-info {
		    padding: 0;
		}
		.agent-row-content {
		    padding: 20px;
		}
		.page-home-stagers h2.page_frontend_header,.page-sign-suppliers h2.page_frontend_header,.page-appraiser h2.page_frontend_header,.page-insurance-brokers h2.page_frontend_header,.page-moving-company .page_frontend_header{
			background: #fff;
		    text-align: center;
		    color: #039be5;
		    border-bottom: none;
		    font-size: 23px;
		    font-weight: bold;
		    margin-bottom: 25px;
		    margin-top: 10px;
		}
		.page-home-stagers h2 {
		    margin: 0;
		}
		.agent-row-content h2{
			margin: 0;
		}
		.agent-row-content h2 strong{
			font-size: 17px;
		}
		.agent-row-content h2 {
		    color: #0a368a;
		    padding: 0 !important;
		    margin-bottom: 10px;
		    font-size: 17px;
		    text-align: left;
		    text-transform: uppercase;
		}
		.agent-row-content hr{
		    display: none;
		}
		.agent-row-info ul {
		    color: #424242;
		    list-style: none;
		    margin: 0;
		    padding: 0;
		}
		.agent-row-info ul li{
			font-size: 16px;
			 margin-bottom: 10px;
		}
		.agent-row-info,.agent-row-info ul li a{
			font-size: 15px;
		}
		.agent-row-info ul .fa {
		    color: #039be4;
		    margin-right: 10px;
		    font-size: 30px;
		    vertical-align: middle;
	        margin: 0 5px 0 0;
		}
		.page-home-stagers .container a,.page-sign-suppliers .container a,.agent-row-content a {
			text-decoration: none;
		    color: #337ab7!important;
		}
		.page-receive-free-home-report{
		    margin: 0;
		    padding: 50px 0 0 0;
		    background: #f1f1f1;
		}
		.after_title{
			margin: 40px auto 30px auto;
		    text-align: center;
		    font-size: 18px;
		}
		.current_box_wr{
			background: #fcfcfc;
		}
		.current_box_wr_content {
			margin: 0px auto 0px auto;
			padding: 50px 0 20px 0;
		}
		.current_box_wr_content p{
			color: #000;
		}
		.current_box_wr_content p:first-child {
		    margin-bottom: 30px;
		}
		.current_box {
		    border: 1px solid #c0c0c0;
		    min-height: 360px;
		    margin-bottom: 30px;
		}
		.current_box p {
			padding: 20px;
			margin: 0;
			font-size: 15px;
		}
		.current_box p *{
			font-size: 15px;
		}
		.current_box h3 {
			text-transform: uppercase;
			margin: 0;
			padding: 20px;
			background: #223c6e;
			color: #fff;
			font-weight: bold;
			font-size: 18px;
		}
		/* form contact*/
		.page-receive-free-home-report form {
			margin: 0;
			padding-bottom: 50px;
			background: none;
		    padding-left:20px;
		    padding-top: 0;
		    padding-right: 50px;
		}
		.page-receive-free-home-report form p.cformfield {
		    border: 1px solid #d9d9d9;
		    margin-bottom: 40px !important;
		    background: #f8f8f8;
		    padding: 10px 20px;
		    font-size: 16px;
		    text-transform: uppercase;
		    width: 100%;
		    color: #000;
    		line-height: 24px;
		}
		.wpcf7-form-control-wrap {
		    position: relative;
		}
		.page-receive-free-home-report .cformfield input {
		    color: #000;
		    margin: 0 0 0 8%;
		    padding: 10px;
		    border: 1px solid #6984b6;
		    border-radius: 10px;
		    background: #fcfcfc;
		    width: 65%;
		    height: 50px;
		}
		.page-receive-free-home-report .cformfield input[type=text]:focus,.page-receive-free-home-report .cformfield input[type=email]:focus{
			box-shadow: 0 2px 0 0 #039be5;
    		outline: 0;
		}
		.cformfield input {
	    	padding: 5px;
		    background: #0496df;
		    border-radius: 5px;
		    height: 60px;
		    line-height: 60px;
		    margin-bottom: 15px;
		    text-align: left;
		    font-size: 19px;
		    color: white;
		}
		span.wpcf7-not-valid-tip {
		    color: #f00;
		    font-size: 1em;
		    display: block;
		}
		.cformbtn {
		    margin: 0;
		    width: 100%;
		    text-align: right;
		    display: table;
    		float: none;
		}
		.cformbtn input[type=submit] {
		    background: #039be5;
		    font-size: 21px;
		    font-weight: bold;
		    box-shadow: 0 4px 1px #027fbb;
		    border-radius: 10px;
	        padding: 15px 50px;
            color: #fff;
            border: 0;
            overflow: hidden;
			position: relative;
			text-transform: uppercase;
		}
		.page_frontend.page-receive-free-home-report .page_frontend_header{
			margin: 0;
		}
		.page-mortgage-broker .mortgage-broker,.page_frontend .type-profess{
			width: 1200px;
		    margin: 0 auto;
		    padding: 0 20px 10px;
		    background: #fff;
		    text-align: justify;
		}
		.mortgage-broker p{
			clear: both;
		}
		.page_frontend.page-mortgage-broker .container,.page-appraiser .container{
			background-color: #fff;
			width: 1200px;
		}
		.page_frontend.page-mortgage-broker{
			background: #f2f2f2;
		}
		.page_frontend.page-mortgage-broker .page_frontend_header {
			background: #fff;
			text-align: center;
			color: #039be5;
			border-bottom: none;
			font-size: 23px;
			font-weight: bold;
			margin-bottom: 25px;
			margin-top: 10px;
		}
		.mortgage-broker h3{
			text-transform: uppercase;
			font-size: 18px;
		}
		.mortgage-broker p *,.type-profess p *{
			font-size: 16px;
		}
		.type-profess h2{
			font-size: 20px;
			margin: 0;
			text-transform: uppercase;
		}
	</style>

	<div class="page_frontend page-{{$page->alias}}">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="page_frontend_header">{!!$page->title!!}</h2>
				</div>
			</div>
		</div>
		{!!$page->content!!}
	</div>
	<div class="top_agents">
		<h2 class="title_hasline">TOP AGENTS</h2>
		<div class="main_top_agents">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="owl-demo-agent" class="owl-carousel owl-theme">	
							@foreach ($agents as $agent)
								<div class="item">
						    		<div class="top_agents_content">
						    			<div class="avartar_agents">
						    				<a href="/agents/{{$agent->alias}}" target="_blank"><img width="225" height="300" src="{{$agent->thumbnail}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="{{$agent->name}} real estate professional on Homula"></a>
					    				</div>
					    				<div class="detail_agents">
					    					<p><a href="/agents/{{$agent->alias}}" target="_blank">
					    					<b>{{$agent->name}}</b></a></p>
					    					<p>{{$agent->spoken_language}}</p>
					    					<p>{!!$agent->email!!}</p><p></p>
				    					</div>
				    					<div class="foot-agent-content" style="">
				    						<a href="/agents/{{$agent->alias}}" target="_blank" class="btn btn-primary">Contact now</a>
			    						</div>
		    						</div>
	    						</div>
	    					@endforeach
    					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="hot_properties">
		<h2 class="title_hasline">HOT PROPERTIES</h2>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="hot_properties_overflow">
						<div class="content_one_ads">
							<div id="owl-demo-home" class="owl-carousel owl-theme">
								@foreach ($properties as $post)
									<div class="item">
									    <div class="hot_properties_item">
									        <a href="/properties/{{$post->alias}}" target="_blank">
									            <div class="hot_properties_item_top">
									                <div class="item_img"><img width="480" height="320" src="{{URL::asset($post->thumbnail)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-9.jpg">										                </div>
									                <div class="visite_libre">
									                    <p>VISIT NOW</p>
									                </div>
									                <p class="tag_p">+</p>
									            </div>
									        </a>
									        <div class="hot_properties_item_bot">
									        	<b>{{$post->price}}</b>
									            <p class="main_p">{{$post->content}}</p>
									            <p><a href="/properties/{{$post->alias}}" target="_blank">{{$post->address}}</a>
									            </p>
									            <p class="min_p">{!!$post->location!!}</p>
									        </div>
									    </div>
									</div>	
								@endforeach	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
<?php 


 ?>