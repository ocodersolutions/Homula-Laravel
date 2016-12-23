@extends('layouts.admin')

@section('content')

<div id="create_post" >
	<div class="ibox-content">
		{!! Form::open(['url' => 'admin/articles/save']) !!}

		{!! Form::label('title','Title:') !!}
		{!! Form::text('title') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />

		{!! Form::label('thumbnail','Thumbnail:') !!}
		{!! Form::text('thumbnail') !!} <br />

		{!! Form::label('content','Content:') !!}
		{!! Form::textarea('content', '', ['id' => 'editor1']) !!} <br />

		{!! Form::label('excerpt','Excerpt:') !!}
		{!! Form::textarea('excerpt', '', ['id' => 'editor2']) !!} <br />

		{!! Form::label('categories_id','Categories_id:') !!}
		<select name="categories_id">
			@foreach($categories as $category)			
				<option value="{{$category->id}}">{{$category->id}}</option>				
			@endforeach
		</select>
		</br>
		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::select('publisher', ['0', '1']) !!} </br>
 		
		{!! Form::submit('Add new Post')!!}

		{!! Form::close() !!}
	</div>
</div>

<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
</script>

@endsection