@extends('layouts.frontend')

@section('meta_keywords'){{ $meta->keyword }}@stop 

@section('meta_description'){{ $meta->description }}@stop 

@section('banner')
	<style type="text/css">
		.agents-page {
			background: #f2f2f2;
		}
		.header_bot {
			border-bottom: none;
			margin-bottom: 60px;
		}
		.header_bot_video {
			background: url(/images/agents_header_bg.jpg);
			background-size: cover;
		    background-position: center center;
		    background-repeat: no-repeat;
		    position: relative;
		}
		.header_bot_video:after {
			background-color: rgba(129,212,250,0.15);
		    bottom: 0;
		    content: '';
		    display: block;
		    left: 0;
		    position: absolute;
		    right: 0;
		    top: 0;
		    z-index: 10;
		}
		.shadow-box {
		    background-color: rgba(255, 255, 255, 0.7);
		    height: 100%;
		    width: 70%;
		    margin: 0 auto;
		    position: relative;
		    margin-top: 45px;
		    z-index: 11;
		}
		.shadow-box h1 {
		    color: #0a368a;
		    padding-top: 30px;
		    font-size: 30px;
		    font-weight: bold;
		    margin: 20px 0;
		    position: static;
		    text-transform: uppercase;
		}
		.shadow-box p {
		    font-size: 20px;
		    color: #777777;
		    text-align: center;
		    font-weight: 600;
		    line-height: 24px;
		}
		.group_button {
			width: 70%;
			margin: 0 auto;
		}
		.button-row {
			display: inline-block;
		}
		.button-row {
			float: left;
		    width: 50%;
		    padding: 30px 55px;
		    box-sizing: border-box;
		}
		.shadow-box .form-control {
		    border: 1px solid rgba(0,0,0,0.7);
		    width: 100%;
		    float: right;
		    background: white;
		    border-radius: 4px;
		    color: rgba(0,0,0,0.7);
		    font-size: 16px;
		    height: 48px;
		    line-height: 48px;
		    padding: 0 5px;
		    position: relative;
		    transition: box-shadow .12s linear;
		    font-weight: 600;
		}
		.shadow-box button {
		    background-color: #0a368a;
		    margin: 0px;
		    height: 50px;
		    width: 100%;
		    border-radius: 4px;
		    border: 0;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		    color: #fff;
		    font-size: 13px;
		    font-weight: 500;
		    padding: 6px 12px;
		    overflow: hidden;
		    position: relative;
		    text-transform: uppercase;

		}
		.shadow-box button:hover, .shadow-box button:focus {
			color: #fff;
		}
	</style>

	<div class="header_bot">
		<div class="header_bot_video">
			<form action="">
				<div class="survey">
					<div class="shadow-box ask-1">
						<h1>Find the best real estate agent for your needs.</h1>
						<p> Working with the right agent makes all the difference.<br>100% Free. No obligation.</p>
						<div class="group_button">
							<div class="button-row">
								<input type="text" placeholder="Enter City or Postal code" required name="location" class="form-control">
							</div>
							<div class="button-row">
								<button type="button" class="btn"><span class="ink animate" style="height: 205px; width: 205px; top: -80.5px; left: 35px;"></span>FIND MY PERFECT AGENT</button>
							</div>
							<div class="clr"></div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('content') 
	<div class="agents-page">
		<div class="search-agents">
			<div class="container"><h3></h3></div>
			<div class="search-agents-main">
				<div class="search-agents-content">
					<form action="">
						<input type="text" placeholder="Search here...">
						<button><i class="fa fa-search" aria-hidden="true"></i> SEARCH</button>
					</form>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="agents-content-title">Agents</h1>
				</div>
				<div class="agents-content col-sm-12">
					@foreach($agents as $agent)
						<div class="col-sm-6">
							<div class="agents-item">
								<div class="agents-item-content">
									<div class="aic-image">
										<div class="aic-image-inner">
											<a href="/agents/{{$agent->alias}}">
												@if ($agent->thumbnail != '')
													<img src="{{$agent->thumbnail}}" alt="">
												@else 
													<img src="/images/agent_no_thum.jpg" alt="">
												@endif
											</a>
										</div>
									</div>
									<div class="aic-information">
										<h2><a href="/agents/{{$agent->alias}}">{{$agent->name}}</a></h2>
										<div class="aic-infor-area-work">
											<h3>AREAS YOU WORK IN</h3>
											<span>{!!$agent->area_work!!}</span>
										</div>
										<div class="aic-infor-spoken-lang">
											<h3>SPOKEN LANGUAGES</h3>
											<span>{!! $agent->spoken_language !!}</span>
										</div>
										<div class="aic-infor-exp">
											<h3>EXPERIENCE</h3>
											<span>{!! $agent->experience !!}</span>
										</div>
										<div class="aic-infor-link">
											<a href="" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
											<a href="" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
											<a href="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
					<form action="" class="agents-content-form">
						<button>Ask a question</button>
					</form>
				</div>
				
			</div>
		</div>
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
									        <a href="/properties/{{$post->id}}" target="_blank">
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
									            <p><a href="{{$post->link}}" target="_blank">{{$post->address}}</a>
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