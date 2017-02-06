@extends('layouts.admin')

@section('content')

<div id="home_roles" >
	<div class="ibox-content">
		<a href="{{ url('admin/users/create')}}" type="button" class="btn btn-primary btn-lg">Add new User</a>
	    <table class="table">
	        <thead>
	        <tr>
	            <th >Id</th>
				<th >Username</th>
				<th >Email</th>
				<th >Image</th>
				<th >Phone Number</th>
				<th >Address</th>
				<th >City</th>
				<th >Province</th>
				<th >Postal</th>
				<th ></th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($users as $user)
				<tr>				
					<td > {{$user->id}} </td>
					<td > {{$user->username}} </td>
					<td > {{$user->email}} </td>
 					<td >  						 
 						@if($user->image)
 							<img src="{{$user->image}}" alt="" style="width: 60px">
 						@endif
 					</td>
					<td > {{$user->phone_number}} </td>
					<td > {{$user->address}} </td>
					<td > {{$user->city}} </td>
					<td > {{$user->province}} </td>
					<td > {{$user->postal}} </td>
					<td>
						<a href="{{ url('admin/users/edit/'. $user->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/users/delete/' . $user->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>

	</div>
</div>

@endsection