@extends('layouts.frontend')

@section('content')

	<div class="sub_cat_news">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<ul class="sub_cat_news_nav">
						@foreach($group_cat as $cat)
							@if($cat->id == $categories->id)
							<li><a href="/news/{{$cat->alias}}" class="active">{{$cat->name}}</a></li>
							@else
							<li><a href="/news/{{$cat->alias}}">{{$cat->name}}</a></li>
							@endif
						@endforeach
						<div class="clr"></div>
					</ul>
					<div class="sub_cat_news_content">
						<div class="row">
						@foreach ($news_detail as $article)
							<div class="col-sm-3">
								<div class="scn_item">
									<div class="snc_item_top">
										<div class="snc_it_author_avatar">
											<img src="/images/agentphoto-1.png" alt="">
										</div>
										<div class="snc_it_author_info">
											<h3>realestate</h3>
											<span>February 3, 2017</span>
										</div>
									</div>
									<div class="snc_item_thumbnail">
										<a href="/news-detail/{{$article->alias}}"><img src="{{$article->thumbnail}}" alt=""></a>
									</div>
									<div class="snc_item_main_content">
										<div class="snc_item_name">
											<span>{{$categories->name}}</span>
										</div>
										<div class="snc_item_title">
											<a href="/news-detail/{{$article->alias}}"><h3>{{$article->title}}</h3></a>
										</div>
										<div class="snc_item_excerpt">
											<p>{!!$article->excerpt!!}</p>
										</div>
										<a href="/news-detail/{{$article->alias}}" class="read_more">Read more</a>
										<div class="snc_item_comment">
											<span class="comment_1">Add Comment</span>
											<span class="comment_2">0 Comment</span>
										</div>
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