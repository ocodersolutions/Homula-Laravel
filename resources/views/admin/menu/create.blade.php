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
		<select name="parent_id">
			@foreach($menus as $menu)			
				<option value="{{$menu->id}}">{{$menu->id}}</option>				
			@endforeach
		</select>
		</br>

		{!! Form::label('link','Link:') !!}
		{!! Form::text('link') !!} </br>

		{!! Form::label('target','Target:') !!}
		{!! Form::select('target', [
			'' => 'none', 
			'_blank' => '_blank',
			'_self' => '_self',
			'_parent' => '_parent',
			'_top' => '_top',
			'framename' => 'framename'
		]) !!} </br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::select('publisher', ['0', '1']) !!} </br>
 
		{!! Form::submit('Add new menu')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection