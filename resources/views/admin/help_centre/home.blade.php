@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_admin_page" >
	<div class="ibox-content">
		<a href="{{ url('admin/helpcentre/create')}}" type="button" class="btn btn-primary btn-lg">Add new Help centre</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Question</th>
				<th >Answer</th>
				<th >Categories name</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($help_centre as $post)
				<tr>
					<td > {{$post->question}} </td>
					<td >{!!str_limit(strip_tags($post->answer),150, '...')!!}</td>
					<td > 
						@if ($post->categories_id != 0)
							@php $cate = App\Http\Controllers\Admin\HelpCentreController::getCat($post->categories_id); @endphp
							{{$cate->name}} 
						@endif
					</td>
					<td style="width: 162px;">
						<a href="{{ url('admin/helpcentre/edit/'. $post->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/helpcentre/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$help_centre->links()}}</div>
	</div>
</div>

@endsection