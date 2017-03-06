@extends("layouts.frontend")

@section("content")
	<style type="text/css">
		.photographers-properties-page {
			background: #f2f2f2;
		}
		.photographers-properties-content {
			padding: 10px 20px;
		    background: #fff;
		    text-align: justify;
		}
		h2.page-header {
		    background: #fff;
		    text-align: center;
		    color: #039be5;
		    border-bottom: none;
		    font-size: 23px;
		    font-weight: bold;
		    margin: 0 0 25px 0;
		    padding: 0;
	        line-height: 48px;
	        text-transform: uppercase;
		}
		.agent-row-content {
		    box-shadow: 0 0 10px;
		    float: left;
		    margin: 0 15px 40px 15px;
		    width: 336px;
		    min-height: 260px;
		    padding: 20px;
		    background-color: #fff;
		}
		.agent-row-content h2 {
		    color: #0a368a;
		    padding: 0 ;
		    margin-bottom: 10px;
		    font-size: 17px;
		    text-align: left;
		    text-transform: uppercase;
		    margin-top: 0;
		}
		.agent-row-content h2 strong {
			font-size: 17px;
		}
		.agent-row-content .agent-row-info {
		    padding: 0;
		    font-size: 15px;
		}
		.agent-row-info ul {
		    color: #424242;
		    list-style: none;
		    margin: 0;
		    padding: 0;
		}
		.agent-row-info ul li {
		    margin-bottom: 10px;
		    font-size: 15px;
		}
		.agent-row-info ul .fa {
		    color: #039be4;
		    margin-right: 10px;
		    font-size: 30px;
		    vertical-align: middle;
		}
		.agent-row-content hr {
		    display: none;
		}

	</style>

	<div class="photographers-properties-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="photographers-properties-content">
						<h2 class="page-header test-homula1">Photographers (Properties)</h2>
						@foreach ($photographers as $photo)
							<div class="agent-row-content ">
							    <h2 class="agent-row-title"><strong>{{$photo->name}}</strong></h2>
							    <hr>
							    <div class="agent-row-info">
							        {{$photo->company}}
							        <ul>
							            <li><i class="fa fa-phone"></i>{{$photo->phone}}</li>
							            <li><i class="fa fa-at"></i>
							                <a>{{$photo->email}}</a>
							            </li>
							            <li><i class="fa fa-globe"></i>
							                <a>{{$photo->web}}</a>
							            </li>
							            <li>{{$photo->city}}</li>
							        </ul>
							    </div>
							</div>
						@endforeach
						<div class="clr"></div>
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