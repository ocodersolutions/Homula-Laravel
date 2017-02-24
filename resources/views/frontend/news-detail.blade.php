@extends('layouts.frontend')

@section('meta_keywords'){{ $news_detail->meta_keywords }}@stop 

@section('meta_description'){{ $news_detail->meta_description }}@stop 

@section('content')
<div class="article_detail">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 article_details_title">
				<p class="article_details_first_line"></p>
		        <h1>{{$news_detail->title}}</h1>
		    </div>
			<div class="col-sm-9 content">
				<div class="adc_wrap">
					<div class="article_detail_content">
						<p>{!!$news_detail->content!!}</p>
					</div>
					<div class="article_detail_comment">
						<h2 class="ad_comments_title">One thought on “{{$news_detail->title}}”</h2>
						<ol class="ad_comment_list">
							<div class="ad_comment_author">
								<img src="http://1.gravatar.com/avatar/a9f1749c94744124d5f4e90e1e8936e4?s=50&d=mm&r=g" alt="">
							</div>
							<div class="ad_comment_content">
								<div class="ad_comment_meta">
									<strong>pvhhoang</strong>
									<a href="">Reply</a>
									<span>December 27, 2016</span>
								</div>
								<div class="ad_comment_body">
									<p>helfully for someone who finding house</p>
								</div>
							</div>
						</ol>
						<h3>Leave a Reply </h3>
						<ul class="article_detail_provider">
							<li><a href="" class="adp_facebook"></a></li>
							<li><a href="" class="adp_google"></a></li>
							<li><a href="" class="adp_instagram"></a></li>
							<li><a href="" class="adp_linkedin"></a></li>
							<li><a href="" class="adp_pinterest"></a></li>
							<li><a href="" class="adp_twitter"></a></li>
							<div  class="clr"></div>
						</ul>
						<form action="" class="comment-form">
							<p class="adc_notes">
								<span id="adc_email_notes">Your email address will not be published.</span>
								 Required fields are marked 
								<span class="adc_required">*</span>
							</p>
							<p class="adc_comment">
								<textarea name="" id="" cols="45" rows="8" placeholder="Your comment"></textarea>
							</p>
							<p class="adc_name">
								<label for="">Name *</label>
								<input type="text">
							</p>
							<p class="adc_email">
								<label for="">Email *</label>
								<input type="text">
							</p>
							<p class="adc_website">
								<label for="">Website</label>
								<input type="text">
							</p>
							<p class="adc_submit">
								<input type="submit" value="POST COMMENT">
							</p>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-3 sidebar">
				<div class="ad_sidebar_wrap">
					<div class="ad_sidebar_content">
						<h3 class="most_read_head">Recent Posts</h3>
						<div class="type-small">
							<div class="property-small">
								<div class="number_left"><p>1</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/1.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>2</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/2.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>3</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/3.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>4</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/4.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>5</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/5.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>6</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/1.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>7</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/3.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
							<div class="property-small">
								<div class="number_left"><p>8</p></div>
								<div class="property-small-image">
									<a href="">
										<img src="http://realestate.homula.com/wp-content/themes/realsite/assets/newhompage/images/4.jpg" alt="">
									</a>
								</div>
								<div class="property-small-content">
									<h3 class="property-small-title">
										<a href="">What does Toronto real estate have in store for the year 2017</a>
									</h3>
								</div>
								<div class="clr"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection