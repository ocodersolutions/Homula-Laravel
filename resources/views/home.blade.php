@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
	<div class="hot_properties">
		<h2 class="title_hasline">HOT PROPERTIES</h2>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="hot_properties_overflow">
						<div class="content_one_ads">
							<div id="owl-demo-home" class="owl-carousel owl-theme">
								@foreach ($articles as $post)
									<div class="item">
									    <div class="hot_properties_item">
									        <a href="{{$post->link}}" target="_blank">
									            <div class="hot_properties_item_top">
									                <div class="item_img"><img width="480" height="320" src="{{URL::asset($post->thumbnail)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-9.jpg">										                </div>
									                <div class="visite_libre">
									                    <p>VISIT NOW</p>
									                </div>
									                <p class="tag_p">+</p>
									            </div>
									        </a>
									        <div class="hot_properties_item_bot">
									        	<b>{{$post->alias}}</b>
									            <p class="main_p">{{$post->content}}</p>
									            <p><a href="{{$post->link}}" target="_blank">{{$post->title}}</a>
									            </p>
									            <p class="min_p">{!!$post->excerpt!!}</p>
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
	<div class="get_started">
		<h2>GET STARTED TODAY WITH A FREE HOME EVALUATION</h2>
		<p>Receive a professional, detailed consultation from our real estate team with up-to-date market reports.</p>
		<a href="/free-home-evaluation/"><button id="btn-search-options">Get Started</button></a>
	</div>
	<div class="content_video">
		<div class="container">
			<div class="row">
				<h2 class="title_hasline">WHAT IS HOMULA?</h2>
				<div class="col-sm-4 col-md-4">						
					<div class="box_item_what">
						<div class="box_item_what_hover">
							<a href="/radius-search">
								<img src="{{URL::asset('images/homula-search.jpg')}}" alt="homula search" class="img-responsive">
								<div class="overplay_title">
									<a href="#"><p class="box_items_title">Ask Questions</p></a>
								</div>
							</a>
						</div>	
					</div>						
				</div>					
				<div class="col-sm-4 col-md-4">						
					<div class="box_item_what">
						<div class="box_item_what_hover">
							<iframe width="100%" height="234" src="https://www.youtube.com/embed/VGP0hMjEGc8" frameborder="0" allowfullscreen></iframe>
							<div class="overplay_title">
								<a href="/about-us"><p class="box_items_title">Read more</p></a>
							</div>
						</div>	
					</div>
				</div>					
				<div class="col-sm-4 col-md-4">						
					<div class="box_item_what">
						<div class="box_item_what_hover">
							<a href="/realestate-search">
								<img src="{{URL::asset('images/homula-map.jpg')}}" alt="homula search" class="img-responsive">
								<div class="overplay_title">
									<p class="box_items_title">Search</p>
								</div>
							</a>
						</div>	
					</div>
				</div>
				<div class="clr"></div>
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
	<div class="real_estate_news">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="title_hasline">REAL ESTATE NEWS</h2>
					<div class="real_estate_all_post">
						<div id="owl-demo-news" class="owl-carousel owl-theme">
						@foreach ($articles_news as $news)
							<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="{{URL::asset($news->thumbnail)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="homula-2016-graph_thum">							    				<a href="{{$news->link}}" target="_blank"><p>{{$news->title}}</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>10 Effective Tips for Finding the Right Realtor in Toronto</p>-->
					    				<a href="{{$news->link}}" target="_blank">Read more</a>
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
@endsection