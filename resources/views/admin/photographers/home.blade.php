@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_photographers">
	<div class="ibox-content">
		<a href="{{ url('admin/photographers/create')}}" type="button" class="btn btn-primary btn-lg">Add new Photographers</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Name</th>
				<th >Alias</th>
				<th >Company</th>
				<th >Phone</th>
				<th >Email</th>
				<th >Web</th>
				<th >City</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($photographers as $com)
				<tr>
					<td > {{$com->name}} </td>
					<td > {{$com->alias}} </td>
					<td > {{$com->company}} </td>
					<td > {{$com->phone}} </td>
					<td > {!!$com->email!!} </td>
					<td > {!!$com->web!!} </td>
					<td > {!!$com->city!!} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/photographers/edit/'. $com->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/photographers/delete/' . $com->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$photographers->links()}}</div>
	</div>
</div>

@endsection