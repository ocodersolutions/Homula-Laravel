@extends('layouts.admin')

@section('content')

<div id="edit_menu" >
	<div class="ibox-content">
		{!! Form::model($menu,[ 'method' => 'PATCH', 'action' => ['Admin\MenuController@update', $menu->id] ]) !!}

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
 
		{!! Form::submit('Update menu')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection