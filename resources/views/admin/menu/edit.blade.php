@extends('layouts.admin')

@section('content')

<div id="edit_menu" >
	<div class="ibox-content">
		{!! Form::model($menus,[ 'method' => 'PATCH', 'action' => ['Admin\MenuController@update', $menus->id] ]) !!}

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />
 
		{!! Form::label('icon','Icon:') !!}
		{!! Form::text('icon') !!} </br>

		{!! Form::label('parent_id','Parent_id:') !!}
		<select name="parent_id">
			@foreach($all_menus as $menu)	
				@if ($menu->id == $menus->parent_id)
					<option value="{{$menu->id}}" selected="selected">{{$menu->id}}</option>
				@else
					<option value="{{$menu->id}}">{{$menu->id}}</option>	
				@endif					
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
		], $menus->target) !!} </br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::select('publisher', ['0', '1']) !!} </br>
 
		{!! Form::submit('Update menu')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection