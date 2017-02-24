@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_admin_meta" >
	<div class="ibox-content">
		<a href="{{ url('admin/meta/create')}}" type="button" class="btn btn-primary btn-lg">Add new Meta</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Name</th>
				<th >Alias</th>
				<th >Keyword</th>
				<th >Description</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($meta_list as $meta)
				<tr>
					<td > {{$meta->name}} </td>
					<td > {{$meta->alias}} </td>
					<td > {{$meta->keyword}} </td>
					<td > {{$meta->description}} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/meta/edit/'. $meta->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/meta/delete/' . $meta->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$meta_list->links()}}</div>
	</div>
</div>

@endsection