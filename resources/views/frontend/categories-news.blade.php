@extends('layouts.nobanner')

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
					@foreach ($articles as $article)
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
									<a href="/articles/{{$article->alias}}"><img src="{{$article->thumbnail}}" alt=""></a>
								</div>
								<div class="snc_item_main_content">
									<div class="snc_item_name">
										<span>{{$categories->name}}</span>
									</div>
									<div class="snc_item_title">
										<a href="/articles/{{$article->alias}}"><h3>{{$article->title}}</h3></a>
									</div>
									<div class="snc_item_excerpt">
										<p>{!!$article->excerpt!!}</p>
									</div>
									<a href="/articles/{{$article->alias}}" class="read_more">Read more</a>
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

@endsection