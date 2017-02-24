@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_properties" >
	<div class="ibox-content">
		<a href="{{ url('admin/properties/create')}}" type="button" class="btn btn-primary btn-lg">Add new Properties</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Address</th>
				<th >Alias</th>
				<th >Thumbnail</th>
				<th >Price</th>
				<th >Location</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($properties as $property)
				<tr>
					<td > {{$property->address}} </td>
					<td > {{$property->alias}} </td>
					<td >
						@if ($property->thumbnail)
							<img src="{{$property->thumbnail}} " alt="" width="100px;">
					 	@endif
					</td>
					<td > {!!$property->price!!} </td>
					<td > {!!$property->location!!} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/properties/edit/'. $property->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/properties/delete/' . $property->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$properties->links()}}</div>
	</div>
</div>

@endsection