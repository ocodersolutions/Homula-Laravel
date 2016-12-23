@extends('layouts.admin')

@section('content')

<div id="edit_categories" >
	<div class="ibox-content">
		@php if (isset($categories_item)) { @endphp
			{!! Form::model($categories_item,[ 'method' => 'PATCH', 'action' => ['Admin\CategoriesController@update', $categories_item->id] ]) !!}
		@php } else { @endphp
			{!! Form::open(['url' => 'admin/categories/save']) !!}
		@php } @endphp

		{!! Form::label('name','Name:') !!}
		{!! Form::text('name') !!} <br />

		{!! Form::label('alias','Alias:') !!}
		{!! Form::text('alias') !!} <br />

		{!! Form::label('description','Description:') !!}
		{!! Form::text('description') !!} <br />
		
		{!! Form::label('parent_id','Parent_id:') !!}
		@php if (isset($categories_item)) { @endphp
			<select name="parent_id">
				<option value="0">none</option>	
				@foreach ($categories_level as $categories_level_1)	
					@if ($categories_level_1->id == $categories_item->parent_id)		
						<option value="{{$categories_level_1->id}}" selected="selected">{{$categories_level_1->name}}</option>
					@else		
						<option value="{{$categories_level_1->id}}">{{$categories_level_1->name}}</option>
					@endif
					@foreach ($categories as $categories_level_2)
						@if ($categories_level_2->parent_id == $categories_level_1->id)
							@if ($categories_level_2->id == $categories_item->parent_id)	
								<option value="{{$categories_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
							@else		
								<option value="{{$categories_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
							@endif
							@foreach ($categories as $categories_level_3)
								@if ($categories_level_3->parent_id == $categories_level_2->id)
									@if ($categories_level_3->id == $categories_item->parent_id)		
										<option value="{{$categories_level_3->id}}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>
									@else		
										<option value="{{$categories_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>
									@endif
								@endif
							@endforeach
						@endif
					@endforeach			
				@endforeach
			</select>
		@php } else { @endphp
			<select name="parent_id">
				<option value="0">none</option>	
				@foreach ($categories_level as $categories_level_1)			
					<option value="{{$categories_level_1->id}}">{{$categories_level_1->name}}</option>
					@foreach ($categories as $categories_level_2)
						@if ($categories_level_2->parent_id == $categories_level_1->id)
							<option value="{{$categories_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
							@foreach ($categories as $categories_level_3)
								@if ($categories_level_3->parent_id == $categories_level_2->id)
									<option value="{{$categories_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>

								@endif
							@endforeach
						@endif
					@endforeach			
				@endforeach
			</select>
		@php } @endphp
		</br>

		{!! Form::label('published','Published:') !!}
		{!! Form::select('published', ['0', '1']) !!} </br>
 
		{!! Form::submit('Update categories')!!}

		{!! Form::close() !!}
	</div>
</div>

@endsection