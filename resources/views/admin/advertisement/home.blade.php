@extends('layouts.admin')

@section('content')
	<div class="ads-template">
		<div class="ads-template-header">
		 	<div class="ads-th-left">
		 		<i class="fa fa-arrow-left" aria-hidden="true"></i>
		 		<h1>Templates</h1>
		 	</div>
		 	<div class="ads-th-right">
		 		<a class="custom_code"><i class="fa fa-code" aria-hidden="true"></i> Custom code</a>
		 		<a class="import_pdf"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Import PDF to email</a>
		 	</div>
		 	<div class="clr"></div>
		</div>
		<div class="ads-template-search">
			<form action="">
				<input type="text" placeholder="Start typing keywords here to search">
				<i class="fa fa-search" aria-hidden="true"></i>
			</form>
		</div>
		<div class="ads-template-content">
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-1.png" alt=""></a>
				<p>Basic Newsletter</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-2.png" alt=""></a>
				<p>Blank</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-3.png" alt=""></a>
				<p>Basic Letter</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-4.png" alt=""></a>
				<p>Basic Card/Flyer</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-5.png" alt=""></a>
				<p>Valentine's Day Card</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-6.png" alt=""></a>
				<p>Valentine's Day Sale</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-7.png" alt=""></a>
				<p>Valentine's Day Specials</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-8.png" alt=""></a>
				<p>Product Sale</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-9.png" alt=""></a>
				<p>St. Patrick's Day</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="ads-tc-item">
				<a href="/advertisement/create"><img src="/images/ads/template-10.png" alt=""></a>
				<p>St. Patrick's Day Promo</p>
				<div class="select_pre">
					<span>Select</span>
					<span>Preview</span>
				</div>
			</div>
			<div class="clr"></div>
		</div>
	</div>
@endsection