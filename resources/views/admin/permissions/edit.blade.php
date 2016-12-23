@extends('layouts.admin')

@section('content')

<div id="edit_permission" >
	<div class="ibox-content">
		@php if (isset($permissions)) { @endphp
		{!! Form::model($permissions,[ 'method' => 'PATCH', 'action' => ['Admin\PermissionController@update', $permissions->id] ]) !!}
		@php } else { @endphp
		{!! Form::open(['url' => 'admin/user/permission/save']) !!}
		@php } @endphp

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('dis_name','Display Name:') !!}
		{!! Form::text('display_name') !!} <br />
 
		{!! Form::label('description','Description:') !!}
		{!! Form::text('description') !!} </br>
 
		{!! Form::submit('Update Permission')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection