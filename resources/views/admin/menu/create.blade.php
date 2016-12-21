@extends('layouts.admin')

@section('content')

<div id="create_menu" >
	<div class="ibox-content">
		{!! Form::open(['url' => 'admin/menu/save']) !!}

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />
 
		{!! Form::label('icon','Icon:') !!}
		{!! Form::text('icon') !!} </br>

		{!! Form::label('parent_id','Parent_id:') !!}
		{!! Form::text('parent_id') !!} </br>

		{!! Form::label('link','Link:') !!}
		{!! Form::text('link') !!} </br>

		{!! Form::label('target','Target:') !!}
		{!! Form::text('target') !!} </br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::text('publisher') !!} </br>
 
		{!! Form::submit('Add new menu')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection