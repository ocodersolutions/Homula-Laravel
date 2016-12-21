@extends('layouts.admin')

@section('content')

<div id="edit_categories" >
	<div class="ibox-content">
		{!! Form::model($categories,[ 'method' => 'PATCH', 'action' => ['Admin\CategoriesController@update', $categories->id] ]) !!}

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('description','Description:') !!}
		{!! Form::text('description') !!} <br />

		{!! Form::label('parent_id','Parent_id:') !!}
		{!! Form::text('parent_id') !!} </br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::text('publisher') !!} </br>
 
		{!! Form::submit('Update categories')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection