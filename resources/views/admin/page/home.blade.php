@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_admin_page" >
	<div class="ibox-content">
		<a href="{{ url('admin/page/create')}}" type="button" class="btn btn-primary btn-lg">Add new Page</a>
	    <table class="table">
	        <thead>
	        <tr>
				<th >Title</th>
				<th >Alias</th>
				<th >Thumbnail</th>
				<th >Content</th>
				<th >Page Parent</th>
				<th >Template</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($page as $post)
				<tr>
					<td > {{$post->title}} </td>
					<td > {{$post->alias}} </td>
					<td >
						@if ($post->thumbnail)
							<img src="{{$post->thumbnail}} " alt="" width="100px;">
					 	@endif
					</td>
					<td >{!!str_limit(strip_tags($post->content),100, '...')!!}</td>
					<td >
						@php
							$title_parent = App\Http\Controllers\Admin\PageController::getPage($post->page_parent);
							echo $title_parent->title;
						@endphp
					</td>
					<td > @if($post->template == 0) no template @endif </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/page/edit/'. $post->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/page/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$page->links()}}</div>
	</div>
</div>

@endsection