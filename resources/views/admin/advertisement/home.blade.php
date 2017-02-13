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
			
			@foreach($ads as $temp)
				<div class="ads-tc-item">
					<a href="/advertisement/create/{{$temp->id}}"><img src="{{$temp->thumbnail}}" alt=""></a>
					<p>{{$temp->name}}</p>
					<div class="select_pre">
						<span>Select</span>
						<span>Preview</span>
					</div>
				</div>
			@endforeach
			<div class="clr"></div>
		</div>
	</div>
@endsection