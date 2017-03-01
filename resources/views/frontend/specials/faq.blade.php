@extends('layouts.frontend')

@section('content')
	<style type="text/css">
		.faq-page {
			background: #fff;
			padding-top: 70px;
		}
		.page-header {
			font-size: 32px;
		    font-weight: bold;
		    color: #fff;
		    background: #039be5;
		    padding: 0px 30px;
		    visibility: inherit;
		    border: 0;
		    margin-bottom: 30px;
		    line-height: 60px;
	        margin-top: 0;
		}
		.faq-item {
			width: 100%;
		    margin-bottom: 10px;
		    background-color: #fff;
		}
		.faq-item-question {
		    margin: 0;
		    cursor: pointer;
		}
		.faq-item-question h2 {
		    font-size: 18px;
		    background: #039be5;
		    color: #fff;
		    font-weight: bold;
		    padding: 10px;
		    position: relative;
		    margin: 0;
		}
		.faq_item_active .faq-item-question h2 {
		    background: #223c6e;
		}
		.faq-item-question h2:after {
		    content: "\f078";
		    font-family: FontAwesome;
		    position: absolute;
		    right: 20px;
		}
		.faq_item_active .faq-item-question h2:after {
		    content: "\f077";
		    font-family: FontAwesome;
		    position: absolute;
		    right: 20px;
		}
		.faq-item-answer {
		    border: 1px solid #c2c2c2;
		    padding: 10px;
		    display: none;
		    color: #616161;
		}
		.faq_item_first .faq-item-answer {
		    display: block;
		}
		.faq-item-answer p {
			color: #777777;
		    font-size: 15px;
		    line-height: 24px;
		}
		.menu_pagination .pagination li span, .menu_pagination .pagination li a {
		    border: 1px solid #4caf50!important;
		    margin-right: 5px;
		    border-radius: 0;
		    color: #000;
		    background: none;
		    padding: 10px 18px;
		}
		.menu_pagination .pagination li span:hover, .menu_pagination .pagination li a:hover {
			background-color: #eee;
			color: #000;
		}
		.menu_pagination .pagination li.active span {
			font-weight: bold;
		}

	</style>
	<div class="faq-page">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="faq-content">
						<h1 class="page-header">FREQUENTLY ASKED QUESTIONS</h1>
						<div class="faq">
						@php $i = 0; @endphp
						@foreach ($faq as $item)
							@if($i == 0)
								<div class="faq-item faq_item_first faq_item_active">
							@else
								<div class="faq-item">
							@endif
							        <div class="faq-item-question">
							            <h2>{{$item->question}}</h2>
							        </div>
							        <div class="faq-item-answer">
							            {!!$item->answer!!}
							        </div>
							    </div>
							@php $i++; @endphp
						@endforeach
						</div>
					</div>
					<div class="menu_pagination">{{$faq->links()}}</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function() {
		$(".faq-item-question").click(function(){
	        if($(this).parent().hasClass("faq_item_active")) {
	            $(this).parent().removeClass("faq_item_active");
	            $(this).parent().find(".faq-item-answer").slideUp();
	        }
	        else {
	            $(this).parents(".faq").find(".faq_item_active .faq-item-answer").slideUp();
	            $(this).parents(".faq").find(".faq_item_active").removeClass("faq_item_active");
	            $(this).parent().addClass("faq_item_active");
	            $(this).parent().find(".faq-item-answer").slideDown();
	        }
	    });
	});
</script>
@endsection