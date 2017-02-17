@extends('layouts.frontend')

@section('content')
	<div class="agents-detail-page">
		<h1 class="adp-title">Alaadin Zahran</h1>
		<div class="adp-module">
			<div class="adp-module-content container">
				<div class="agents-card">
					<div class="row">
						<div class="col-md-3 agents-card-img">
							<div class="agents-card-img-content">
								<img src="{{$agents_detail->thumbnail}}" alt="">
								<div class="agent-card-link">
									<i class="fa fa-facebook-square"></i>
									<i class="fa fa-twitter-square"></i>
									<i class="fa fa-google-plus-square"></i>
								</div>
							</div>
						</div>
						<div class="col-md-5 agents-card-info">
							<div class="agents-card-info-content">
								<div><strong>Areas you work in:</strong><br>{!!$agents_detail->area_work!!}</div>
								<div><strong>Spoken Languages:</strong><br>{!!$agents_detail->spoken_language!!}</div>
								<div><strong>Email</strong><br>{{$agents_detail->email}}</div>
							</div>
						</div>
						<div class="col-md-3 agents-detail-contact-form">
							<h2><i class="fa fa-envelope" aria-hidden="true"></i> Contact Form</h2>
							<div class="agents-card-form">
								<form action="">
									<input type="text" placeholder="Subject">
									<input type="email" placeholder="E-mail">
									<textarea name="" id="" placeholder="Message"></textarea>
									<button>Send Message</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="agents-detail-nav">
						<ul>
							<li class="about-ag active">
								<span>ABOUT</span>
								<div class="agents-detail-nav-content"></div>
							</li>
							<li class="agents-properties-ag">
								<span>AGENTS PROPERTIES</span>
								<div class="agents-detail-nav-content"></div>
							</li>
							<li class="rate-ag">
								<span>RATE</span>
								<div class="agents-detail-nav-content"></div>
							</li>
							<div class="clr"></div>
						</ul>
						<div class="agents-detail-nav-content">
							<p class="adnc-about">For over 65 years, Enbridge has been effectively delivering energy in North America. Their dedication, hard work and proven techniques has enabled them to be recognized as one of the Global 100 Most Sustainable Corporation in the world. Safety is the number one priority of this excellent energy company. Enbridge has had a 99.9994% safe delivery record through their crude oil pipelines for the past 10 years!</p>
							<p class="adnc-agents-properties">A subsidiary of PowerStream Holdings Inc., PowerStream Energy Services was established in 2013. This electricity distribution company, owned by the city of Markham, Vaughan and Barrie, provides Sub-Metering services to both commercial properties and condos throughout Canada! PowerStream Energy Services works closely with our experts at Homula in order to exceed your needs. From commissioning to installation, you can count on the experienced technicians at PowerStream Energy Services.</p>
							<p class="adnc-rate">Incorporated in 1929, Reliance Infrastructure companies distribute over 36 billion units of energy to over 30 million consumers. Reliance is one of the most trusted utility companies in the world today. With their vow to continuously offer 24/7 phone support, they have truly become one of the leaders in the industry.</p>
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
									            <p class="min_p">{!!$post->city!!}</p>
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