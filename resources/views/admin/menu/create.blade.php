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
			<option value="0">none</option>	
			@foreach ($menus_level as $menus_level_1)			
				<option value="{{$menus_level_1->id}}">{{$menus_level_1->name}}</option>
				@foreach ($menus as $menus_level_2)
					@if ($menus_level_2->parent_id == $menus_level_1->id)
						<option value="{{$menus_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
						@foreach ($menus as $menus_level_3)
							@if ($menus_level_3->parent_id == $menus_level_2->id)
								<option value="{{$menus_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>

							@endif
						@endforeach
					@endif
				@endforeach			
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