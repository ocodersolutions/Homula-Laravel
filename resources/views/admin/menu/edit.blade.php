@extends('layouts.admin')

@section('content')

<div id="edit_menu" >
	<div class="ibox-content">
		@php if(isset($menus_item)) { @endphp
			{!! Form::model($menus_item,[ 'method' => 'PATCH', 'action' => ['Admin\MenuController@update', $menus_item->id] ]) !!}
		@php } else { @endphp 
			{!! Form::open(['url' => 'admin/menu/save']) !!}
		@php }  @endphp 

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />
 
		{!! Form::label('icon','Icon:') !!}
		{!! Form::text('icon') !!} </br>

		{!! Form::label('parent_id','Parent_id:') !!}
		<select name="parent_id">
			<option value="0">none</option>	
			@php if(isset($menus_item)) { @endphp
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
			@php } else { @endphp
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
			@php } @endphp
		</select>
		</br>

		{!! Form::label('link','Link:') !!}
		{!! Form::text('link') !!} </br>

		@php if(isset($menus_item)) { @endphp
			{!! Form::label('target','Target:') !!}
			{!! Form::select('target', [
				'' => 'none', 
				'_blank' => '_blank',
				'_self' => '_self',
				'_parent' => '_parent',
				'_top' => '_top',
				'framename' => 'framename'
			], $menus_item->target) !!} </br>
		@php } else { @endphp
			{!! Form::label('target','Target:') !!}
			{!! Form::select('target', [
				'' => 'none', 
				'_blank' => '_blank',
				'_self' => '_self',
				'_parent' => '_parent',
				'_top' => '_top',
				'framename' => 'framename'
			]) !!} </br>
		@php } @endphp

		{!! Form::label('published','Published:') !!}
		{!! Form::select('published', ['0', '1']) !!} </br>


 
		{!! Form::submit('Update menu')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection