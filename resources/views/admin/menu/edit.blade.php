@extends('layouts.admin')

@section('content')

<div id="edit_menu" >
	<div class="ibox-content">
		{!! Form::model($menus_item,[ 'method' => 'PATCH', 'action' => ['Admin\MenuController@update', $menus_item->id] ]) !!}

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
				@if ($menus_level_1->id == $menus_item->parent_id)		
					<option value="{{$menus_level_1->id}}" selected="selected">{{$menus_level_1->name}}</option>
				@else		
					<option value="{{$menus_level_1->id}}">{{$menus_level_1->name}}</option>
				@endif
				@foreach ($menus as $menus_level_2)
					@if ($menus_level_2->parent_id == $menus_level_1->id)
						@if ($menus_level_2->id == $menus_item->parent_id)	
							<option value="{{$menus_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
						@else		
							<option value="{{$menus_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
						@endif
						@foreach ($menus as $menus_level_3)
							@if ($menus_level_3->parent_id == $menus_level_2->id)
								@if ($menus_level_3->id == $menus_item->parent_id)		
									<option value="{{$menus_level_3->id}}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
								@else		
									<option value="{{$menus_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
								@endif
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
		], $menus_item->target) !!} </br>

		{!! Form::label('publisher','Publisher:') !!}
		{!! Form::select('publisher', ['0', '1']) !!} </br>
 
		{!! Form::submit('Update menu')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection