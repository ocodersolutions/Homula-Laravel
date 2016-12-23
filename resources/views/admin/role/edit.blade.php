@extends('layouts.admin')

@section('content')

<div id="edit_roles" >
	<div class="ibox-content">
		@php if(isset($roles)) { @endphp
			{!! Form::model($roles,[ 'method' => 'PATCH', 'action' => ['Admin\RoleController@update', $roles->id] ]) !!}
		@php } else { @endphp
			{!! Form::open(['url' => 'admin/user/role/save']) !!}
		@php } @endphp

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('dis_name','Display Name:') !!}
		{!! Form::text('display_name') !!} <br />
 
		{!! Form::label('description','Description:') !!}
		{!! Form::text('description') !!} </br>
 
		{!! Form::submit('Update roles')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection