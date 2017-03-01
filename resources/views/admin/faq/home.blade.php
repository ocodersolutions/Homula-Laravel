@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_admin_page" >
	<div class="ibox-content">
		<a href="{{ url('admin/faq/create')}}" type="button" class="btn btn-primary btn-lg">Add new Faq</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Question</th>
				<th >Answer</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($faq as $post)
				<tr>
					<td > {{$post->question}} </td>
					<td >{{str_limit(strip_tags($post->answer),150, '...')}}</td>
					<td style="width: 162px;">
						<a href="{{ url('admin/faq/edit/'. $post->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/faq/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$faq->links()}}</div>
	</div>
</div>

@endsection