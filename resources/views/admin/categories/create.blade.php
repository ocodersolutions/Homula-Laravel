@extends('layouts.admin')

@section('content')

<div id="create_categories" >
	<div class="ibox-content">
		{!! Form::open(['url' => 'admin/categories/save']) !!}

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />

		{!! Form::label('description','Description:') !!}
		{!! Form::text('description') !!} <br />

		{!! Form::label('parent_id','Parent_id:') !!}
		{!! Form::text('parent_id') !!} </br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::text('publisher') !!} </br>
 
		{!! Form::submit('Add new categories')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection