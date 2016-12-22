@extends('layouts.admin')

@section('content')

<div id="edit_categories" >
	<div class="ibox-content">
		{!! Form::model($categories,[ 'method' => 'PATCH', 'action' => ['Admin\CategoriesController@update', $categories->id] ]) !!}

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />

		{!! Form::label('description','Description:') !!}
		{!! Form::text('description') !!} <br />

		{!! Form::label('parent_id','Parent_id:') !!}
		<select name="parent_id">
			@foreach($all_categories as $category)	
				@if ($category->id == $categories->parent_id)
					<option value="{{$category->id}}" selected="selected">{{$category->id}}</option>
				@else
					<option value="{{$category->id}}">{{$category->id}}</option>	
				@endif					
			@endforeach
		</select>
		</br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::select('publisher', ['0', '1']) !!} </br>
 
		{!! Form::submit('Update categories')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection