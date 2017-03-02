@extends('layouts.frontend')

@section('content')
	<style type="text/css">
		.help-centre-cat-page {
			margin-top: 50px;
	        margin-bottom: 60px;
		}
		#form_help_centre {
		    position: relative;
		    margin-bottom: 50px;
		}
		#form_help_centre input[type=text] {
		    width: 100%;
		    border: 1px solid;
		    padding: 5px 15px;
		    background: #fff;
		    box-shadow: 0 1px 0 0 rgba(0,0,0,0.12);
		    font-size: 16px;
		    height: 48px;
		    line-height: 48px;
		    transition: box-shadow .12s linear;
		}
		#form_help_centre input[type=text]:focus {
			box-shadow: 0 2px 0 0 #039be5;
		    outline: 0;
		}
		#form_help_centre input[type=submit] {
		    position: absolute;
		    top: 0;
		    right: 0;
		    height: 48px;
		    font-size: 18px;
		    font-weight: bold;
		    background-color: #e91e63;
		    border: 0;
		    border-radius: 0;
		    box-shadow: 0 2px 5px 0 rgba(0,0,0,0.26);
		    color: #fff;
		    padding: 6px 12px;
		    text-transform: uppercase;
		}
		.sub_posts_about_us {
			border: 1px solid #4b6088;
		    background: #fcfcfc;
		    padding: 20px;
		}
		.sub_posts_about_us h2 {
			text-align: center;
		    color: #013888;
		    font-size: 28px;
		    font-weight: bold;
		    position: relative;
		    margin-bottom: 60px;
		    text-transform: uppercase;
		}
		.sub_posts_about_us h2:before {
		    position: absolute;
		    font-family: FontAwesome;
		    content: "";
		    display: inline-block;
		    left: 50%;
		    transform: translate(-50%);
		    font-size: 12px;
		    top: 40px;
		    background: url(/images/help-centre-line-bg.png);
		    width: 100%;
		    height: 19px;
		    background-position: center;
		    background-repeat: no-repeat;
		}
		.help_centre_content {
		    width: 98%;
		    margin: 0 1% 3% 1%;
		    background: #fff;
		    border: 1px solid #cacaca;
		}
		.help_centre_article {
		    background: #6d6d6d;
		    color: #fff;
		    padding: 0 15px 0 10px;
		}
		.help_centre_article span:first-child {
			font-size: 18px;
			display: inline-block;
			padding: 5px 0;
			font-weight: bold;
		}
		.help_centre_article span i {
		    font-size: 18px;
		    width: 36px;
		    line-height: 36px;
		    text-align: center;
		    border-radius: 50%;
		    background: #fff;
		    color: #6d6d6d;
		    margin-right: 10px;
		}
		.help_centre_article span:last-child {
		    display: inline-block;
		    float: right;
		    background: #013888;
		    font-size: 14px;
		    margin-top: 10px;
		    border-radius: 5px;
		}
		.help_centre_article span:last-child a {
		    display: inline-block;
		    padding: 0 10px;
		    color: #fff;
		    transition: color .15s linear;
		}
		.help_centre_post {
		    padding: 10px 40px;
		    background: #fff;
		}
		.help_centre_post h4 {
		    padding-bottom: 5px;
		    border-bottom: 1px solid #cccccc;
		    position: relative;
		}
		.help_centre_post h4:before {
		    position: absolute;
		    font-family: FontAwesome;
		    content: "\f054";
		    display: inline-block;
		    left: -25px;
		    font-size: 12px;
		    top: 4px;
		    background: #6d6d6d;
		    width: 18px;
		    line-height: 18px;
		    color: #fff;
		    text-align: center;
		    border-radius: 50%;
		}
		.help_centre_post h4 a {
		    color: #3a64b0;
		    font-weight: bold;
		    font-size: 21px;
		    text-transform: uppercase;
		}
		.help_centre_post p {
			color: #777777;
		    font-size: 15px;
		    line-height: 24px;
		}
		.help_centre_post p:last-child {
		    color: #000;
		    font-weight: bold;
		    font-size: 17px;
		}
	
	</style>
	<div class="help-centre-cat-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<form action="" id="form_help_centre" class="ng-pristine ng-valid">
			            <input type="text" name="help_centre_search" placeholder="Search here..." id="help_centre_search" class="ui-autocomplete-input" autocomplete="off">
			            <input type="submit" value="Search">
			        </form>
			        <div class="page_realestate">
					    <div class="sub_posts_about_us">
				            <h2>{{$cat_hc->name}}</h2>
				            <div class="help_centre_content">
				                <div class="help_centre_article">
				                	@php $count = App\Http\Controllers\FrontendController::count_art($cat_hc->id); @endphp
				                    <span><i class="fa fa-database" aria-hidden="true"></i>{{$count}} Articles</span>
				                    <span><a href="/help-centre">Help centre</a></span>
				                </div>
				                @php $articles = App\Http\Controllers\FrontendController::full_art_help_centre($cat_hc->id); @endphp
				                @foreach ($articles as $art)
				                <div class="help_centre_post">
				                    <h4><a href="/{{$art->alias}}">{{$art->question}}</a></h4>
				                    <p>{!!str_limit(strip_tags($art->answer),150, '...')!!}</p>
				                    <p>{{ date_format(date_create_from_format('Y-m-d h:i:s', $art->created_at), 'M d, Y h:iA') }}</p>
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