@extends('layouts.frontend')

@section('meta_keywords'){{ $page->keyword }}@stop 

@section('meta_description'){{ $page->description }}@stop 

@section('content')
	<style type="text/css">
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

		.page-open-house .stbg_1 {
		    padding: 0px 0 40px 0;
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