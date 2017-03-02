@extends('layouts.frontend');

@section('content')
	<style type="text/css">
		.help-centre-page {
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
		    float: left;
		    width: 48%;
		    margin: 0 1% 3% 1%;
		    background: #fff;
		    border: 1px solid #cacaca;
		}
		.help_centre_content h4 {
		    font-size: 21px;
		    font-weight: bold;
		    text-transform: capitalize;
		    color: #232323;
		    margin: 10px 0 15px 15px;
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
		.help_centre_content ul {
		    padding: 0 15px;
		    font-size: 16px;
		    margin: 10px 0 20px 0;
		}
		.help_centre_content ul li {
		    position: relative;
		    padding-left: 25px;
		    margin-bottom: 10px;
		}
		.help_centre_content ul li:before {
		    position: absolute;
		    font-family: FontAwesome;
		    content: "\f054";
		    display: inline-block;
		    left: 0;
		    font-size: 12px;
		    top: 4px;
		    background: #6d6d6d;
		    width: 18px;
		    line-height: 18px;
		    color: #fff;
		    text-align: center;
		    border-radius: 50%;
		}
		.help_centre_content ul li a {
		    color: #7b7b7b;
		    transition: color .15s linear;
		    font-size: 16px;
		}
		.help_centre_content a:hover {
			text-decoration: none;
		}

	</style>
	<div class="help-centre-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<form action="" id="form_help_centre" class="ng-pristine ng-valid">
			            <input type="text" name="help_centre_search" placeholder="Search here..." id="help_centre_search" class="ui-autocomplete-input" autocomplete="off">
			            <input type="submit" value="Search">
			        </form>
			        <div class="page_realestate">
					    <div class="sub_posts_about_us">
				            <h2>BROWSE BY TOPIC</h2>
				            @foreach ($categories as $cat)
				            <div class="help_centre_content">
				                <h4>{{$cat->name}}</h4>
				                <div class="help_centre_article">
				                	@php $count = App\Http\Controllers\FrontendController::count_art($cat->id); @endphp
				                    <span><i class="fa fa-database" aria-hidden="true"></i>{{$count}} Articles</span>
				                    <span><a href="/help-centre/{{$cat->alias}}">View All</a></span>
				                </div>
				                <ul>
				                	@php $articles = App\Http\Controllers\FrontendController::get_art_help_centre($cat->id); @endphp
				                	@foreach ($articles as $art)
										<li><a href="/{{$art->alias}}">{{$art->question}}</a></li>
				                	@endforeach
				                </ul>
				            </div>
				            <div class="clr"></div>
				            @endforeach
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection