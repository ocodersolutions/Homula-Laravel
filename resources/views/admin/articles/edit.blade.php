@extends('layouts.admin')

@section('content')

<div id="edit_post" >
	<div class="ibox-content">
		{!! Form::model($articles,[ 'method' => 'PATCH', 'action' => ['Admin\ArticlesController@update', $articles->id] ]) !!}

		{!! Form::label('title','Title:') !!}
		{!! Form::text('title') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />

		{!! Form::label('thumbnail','Thumbnail:') !!}
		{!! Form::text('thumbnail') !!} <br />

		{!! Form::label('content','Content:') !!}
		{!! Form::textarea('content') !!} <br />

		{!! Form::label('excerpt','Excerpt:') !!}
		{!! Form::textarea('excerpt') !!} <br />

		{!! Form::label('categories_id','Categories_id:') !!}
		<select name="categories_id">
			@foreach($categories as $category)	
				@if ($category->id == $articles->categories_id)
					<option value="{{$category->id}}" selected="selected">{{$category->id}}</option>
				@else
					<option value="{{$category->id}}">{{$category->id}}</option>	
				@endif					
			@endforeach
		</select>
		</br>
		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::select('publisher', ['0', '1']) !!} </br>
 
		{!! Form::submit('Update post')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection