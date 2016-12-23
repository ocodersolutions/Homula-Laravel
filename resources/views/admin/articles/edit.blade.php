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
		{!! Form::textarea('content', $articles->content, ['id' => 'editor1']) !!} <br />

		{!! Form::label('excerpt','Excerpt:') !!}
		{!! Form::textarea('excerpt', $articles->excerpt, ['id' => 'editor2']) !!} <br />

		{!! Form::label('categories_id','Categories_id:') !!}
		<select name="categories_id">
			<option value="0">none</option>	
			@foreach ($categories_level as $categories_level_1)	
				@if ($categories_level_1->id == $articles->categories_id)		
					<option value="{{$categories_level_1->id}}" selected="selected">{{$categories_level_1->name}}</option>
				@else		
					<option value="{{$categories_level_1->id}}">{{$categories_level_1->name}}</option>
				@endif
				@foreach ($categories as $categories_level_2)
					@if ($categories_level_2->parent_id == $categories_level_1->id)
						@if ($categories_level_2->id == $articles->categories_id)	
							<option value="{{$categories_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
						@else		
							<option value="{{$categories_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
						@endif
						@foreach ($categories as $categories_level_3)
							@if ($categories_level_3->parent_id == $categories_level_2->id)
								@if ($categories_level_3->id == $articles->categories_id)		
									<option value="{{$categories_level_3->id}}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>
								@else		
									<option value="{{$categories_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>
								@endif
							@endif
						@endforeach
					@endif
				@endforeach			
			@endforeach
		</select>
		</br>
		{!! Form::label('published','Published:') !!}
		{!! Form::select('published', ['0', '1']) !!} </br>
 
		{!! Form::submit('Update post')!!}

		{!! Form::close() !!}
	</div>
</div>

<script>
    CKEDITOR.replace( 'editor1' );
    CKEDITOR.replace( 'editor2' );
</script>

@endsection