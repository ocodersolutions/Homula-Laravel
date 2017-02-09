@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_agents" >
	<div class="ibox-content">
		<a href="{{ url('admin/agents/create')}}" type="button" class="btn btn-primary btn-lg">Add new Agent</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Name</th>
				<th >Email</th>
				<th >Alias</th>
				<th >Thumbnail</th>
				<th >Area work</th>
				<th >Spoken language</th>
				<th >Experience</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($agents as $agent)
				<tr>
					<td > {{$agent->name}} </td>
					<td > {{$agent->email}} </td>
					<td > {{$agent->alias}} </td>
					<td >
						@if ($agent->thumbnail)
							<img src="{{$agent->thumbnail}} " alt="" width="100px;">
					 	@endif
					</td>
					<td > {!!$agent->area_work!!} </td>
					<td > {!!$agent->spoken_language!!} </td>
					<td > {!!$agent->experience!!} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/agents/edit/'. $agent->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/agents/delete/' . $agent->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$agents->links()}}</div>
	</div>
</div>

@endsection