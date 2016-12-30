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
				</div>
				<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				    	<div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Homula - MLS listing - Toronto real estate - Canada real estate 2016</h4>
				        </div>
				        <div class="modal-body">
				         <iframe width="100%" height="472" src="https://www.youtube.com/embed/VGP0hMjEGc8" frameborder="0" allowfullscreen></iframe>
				        </div>
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
							@foreach ($articles_agent as $agent)
								<div class="item">
						    		<div class="top_agents_content">
						    			<div class="avartar_agents">
						    				<a href="{{$agent->link}}" target="_blank"><img width="225" height="300" src="{{URL::asset($agent->thumbnail)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="{{$agent->title}} real estate professional on Homula"></a>
					    				</div>
					    				<div class="detail_agents">
					    					<p><a href="{{$agent->link}}" target="_blank">
					    					<b>{{$agent->title}}</b></a></p>
					    					<p>{{$agent->alias}}</p>
					    					<p>{!!$agent->content!!}</p><p></p>
				    					</div>
				    					<div class="foot-agent-content" style="">
				    						<a href="{{$agent->link}}" target="_blank" class="btn btn-primary">Contact now</a>
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
							<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/11/homula-2016-graph_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="homula-2016-graph_thum">							    				<a href="http://realestate.homula.com/10-effective-tips-finding-right-realtor-toronto/" target="_blank"><p>10 Effective Tips for Finding the Right Realtor in Toronto</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>10 Effective Tips for Finding the Right Realtor in Toronto</p>-->
					    				<a href="http://realestate.homula.com/10-effective-tips-finding-right-realtor-toronto/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
	    					<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/Graph2_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="graph2_thum">							    				<a href="http://realestate.homula.com/toronto-real-estate-utilities/" target="_blank"><p>TORONTO REAL ESTATE UTILITIES</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>TORONTO REAL ESTATE UTILITIES</p>-->
					    				<a href="http://realestate.homula.com/toronto-real-estate-utilities/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/graph-2_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="graph-2_thum">							    				<a href="http://realestate.homula.com/toronto-real-estate-studies/" target="_blank"><p>TORONTO REAL ESTATE STUDIES</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>TORONTO REAL ESTATE STUDIES</p>-->
					    				<a href="http://realestate.homula.com/toronto-real-estate-studies/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/Homula-Grapha-3_thum-1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="homula-grapha-3_thum">							    				<a href="http://realestate.homula.com/toronto-real-estate-social/" target="_blank"><p>TORONTO REAL ESTATE SOCIAL</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>TORONTO REAL ESTATE SOCIAL</p>-->
					    				<a href="http://realestate.homula.com/toronto-real-estate-social/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img src="http:\/\/realestate.homula.com\/wp-content\/uploads\/2016\/10\/image-C3615220-1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-1.jpg" \="">							    				<a href="http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/" target="_blank"><p>Five things to expect from Canadian real estate in 2017</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>Five things to expect from Canadian real estate in 2017</p>-->
					    				<a href="http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img src="http:\/\/realestate.homula.com\/wp-content\/uploads\/2016\/10\/image-C3615220-1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-1.jpg" \="">							    				<a href="http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/" target="_blank"><p>4 Illegal Tactics You Need to Beware of in Toronto Real Estate</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>4 Illegal Tactics You Need to Beware of in Toronto Real Estate</p>-->
					    				<a href="http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="620" height="500" src="http://realestate.homula.com/wp-content/uploads/2016/12/homula-chart-12-8-2016.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Real Estate Market">							    				<a href="http://realestate.homula.com/5-biggest-risks-will-face-toronto-real-estate-market-2016/" target="_blank"><p>The 5 Biggest Risks You Will Face in the Toronto Real Estate Market in 2016</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>The 5 Biggest Risks You Will Face in the Toronto Real Estate Market in 2016</p>-->
					    				<a href="http://realestate.homula.com/5-biggest-risks-will-face-toronto-real-estate-market-2016/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="940" height="529" src="http://realestate.homula.com/wp-content/uploads/2016/11/real-estate-gg.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Find A Realtor Toronto">							    				<a href="http://realestate.homula.com/find-realtor-toronto-theyre-terrible/" target="_blank"><p>What if You Find a Realtor in Toronto and They’re Terrible?</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>What if You Find a Realtor in Toronto and They’re Terrible?</p>-->
					    				<a href="http://realestate.homula.com/find-realtor-toronto-theyre-terrible/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/Graph2_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="graph2_thum">							    				<a href="http://realestate.homula.com/top-10-key-factors-must-know-toronto-real-estate-market/" target="_blank"><p>Top 10 key factors you must know about the Toronto real estate market</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>Top 10 key factors you must know about the Toronto real estate market</p>-->
					    				<a href="http://realestate.homula.com/top-10-key-factors-must-know-toronto-real-estate-market/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/11/Toronto-ontario-graph_thum.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="toronto-ontario-graph_thum">							    				<a href="http://realestate.homula.com/latest-trends-sweeping-real-estate-market-toronto/" target="_blank"><p>Latest trends sweeping the real estate market in Toronto</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>Latest trends sweeping the real estate market in Toronto</p>-->
					    				<a href="http://realestate.homula.com/latest-trends-sweeping-real-estate-market-toronto/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/11/homula-2016-graph_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="homula-2016-graph_thum">							    				<a href="http://realestate.homula.com/10-effective-tips-finding-right-realtor-toronto/" target="_blank"><p>10 Effective Tips for Finding the Right Realtor in Toronto</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>10 Effective Tips for Finding the Right Realtor in Toronto</p>-->
					    				<a href="http://realestate.homula.com/10-effective-tips-finding-right-realtor-toronto/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/Graph2_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="graph2_thum">							    				<a href="http://realestate.homula.com/toronto-real-estate-utilities/" target="_blank"><p>TORONTO REAL ESTATE UTILITIES</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>TORONTO REAL ESTATE UTILITIES</p>-->
					    				<a href="http://realestate.homula.com/toronto-real-estate-utilities/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/graph-2_thum.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="graph-2_thum">							    				<a href="http://realestate.homula.com/toronto-real-estate-studies/" target="_blank"><p>TORONTO REAL ESTATE STUDIES</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>TORONTO REAL ESTATE STUDIES</p>-->
					    				<a href="http://realestate.homula.com/toronto-real-estate-studies/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="300" height="230" src="http://realestate.homula.com/wp-content/uploads/2016/10/Homula-Grapha-3_thum-1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="homula-grapha-3_thum">							    				<a href="http://realestate.homula.com/toronto-real-estate-social/" target="_blank"><p>TORONTO REAL ESTATE SOCIAL</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>TORONTO REAL ESTATE SOCIAL</p>-->
					    				<a href="http://realestate.homula.com/toronto-real-estate-social/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img src="http:\/\/realestate.homula.com\/wp-content\/uploads\/2016\/10\/image-C3615220-1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-1.jpg" \="">							    				<a href="http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/" target="_blank"><p>Five things to expect from Canadian real estate in 2017</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>Five things to expect from Canadian real estate in 2017</p>-->
					    				<a href="http://realestate.homula.com/five-things-expect-canadian-real-estate-2017/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img src="http:\/\/realestate.homula.com\/wp-content\/uploads\/2016\/10\/image-C3615220-1.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="image-C3615220-1.jpg" \="">							    				<a href="http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/" target="_blank"><p>4 Illegal Tactics You Need to Beware of in Toronto Real Estate</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>4 Illegal Tactics You Need to Beware of in Toronto Real Estate</p>-->
					    				<a href="http://realestate.homula.com/4-illegal-tactics-need-beware-toronto-real-estate/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="620" height="500" src="http://realestate.homula.com/wp-content/uploads/2016/12/homula-chart-12-8-2016.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Real Estate Market">							    				<a href="http://realestate.homula.com/5-biggest-risks-will-face-toronto-real-estate-market-2016/" target="_blank"><p>The 5 Biggest Risks You Will Face in the Toronto Real Estate Market in 2016</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>The 5 Biggest Risks You Will Face in the Toronto Real Estate Market in 2016</p>-->
					    				<a href="http://realestate.homula.com/5-biggest-risks-will-face-toronto-real-estate-market-2016/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
			    			<div class="real_estate_custom item">
					    		<div class="real_estate_post">
					    			<div class="real_estate_post_img">
					    				<img width="940" height="529" src="http://realestate.homula.com/wp-content/uploads/2016/11/real-estate-gg.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Find A Realtor Toronto">							    				<a href="http://realestate.homula.com/find-realtor-toronto-theyre-terrible/" target="_blank"><p>What if You Find a Realtor in Toronto and They’re Terrible?</p></a>
					    			</div>
					    			<div class="real_estate_post_detail">
					    				<!--<p>What if You Find a Realtor in Toronto and They’re Terrible?</p>-->
					    				<a href="http://realestate.homula.com/find-realtor-toronto-theyre-terrible/" target="_blank">Read more</a>
					    			</div>
				    			</div>
			    			</div>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection