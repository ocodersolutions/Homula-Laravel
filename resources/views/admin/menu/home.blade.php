@extends('layouts.admin')

@section('content')

<div id="home_roles" >
	<div class="ibox-content">
		<a href="{{ url('admin/menu/create')}}" type="button" class="btn btn-primary btn-lg">Add new Menu</a>
	    <table class="table">
	        <thead>
	        <tr>
	            <th >Id</th>
				<th >Name</th>
				<th >Alias</th>
				<th >Icon</th>
				<th >Parent_id</th>
				<th >Link</th>
				<th >Target</th>
				<th >Publisher</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($menus as $menu)
				<tr>				
					<td > {{$menu->id}} </td>
					<td > {{$menu->name}} </td>
					<td > {{$menu->alias}} </td>
 					<td > {{$menu->icon}} </td>
					<td > {{$menu->parent_id}} </td>
					<td > {{$menu->link}} </td>
					<td > {{$menu->target}} </td>
					<td > {{$menu->publisher}} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/menu/edit/'. $menu->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/menu/delete/' . $menu->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$menus->links()}}</div>
	</div>
</div>

@endsection