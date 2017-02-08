@extends('layouts.admin')

@section('content')

<style type="text/css">
    .table > tbody > tr > td {
        word-break: break-all;
    }
</style>

<div id="home_articles" >
	<div class="ibox-content">
		<a href="{{ url('admin/articles/create')}}" type="button" class="btn btn-primary btn-lg">Add new Post</a>
	    <table class="table">
	        <thead>
	        <tr>
	            <!-- <th >Id</th> -->
				<th >Title</th>
				<th >Alias</th>
				<th >Thumbnail</th>
				<!-- <th >Link</th> -->
				<th >Content</th>
				<th >Excerpt</th>
				<th >Category name</th>
				<th >Publish</th>
				<th >Created_at</th>
				<th >Updated_at</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($articles as $post)
				<tr>				
					{{--<td > {{$post->id}} </td> --}}
					<td > {{$post->title}} </td>
					<td > {{$post->alias}} </td>
					<td >
						@if ($post->thumbnail)
							<img src="{{$post->thumbnail}} " alt="" width="100px;">
					 	@endif
					</td>
					{{--<td > {{$post->link}} </td>--}}
					<td >{{str_limit(strip_tags($post->content),100, '...')}}</td>
					<td > {{ str_limit(strip_tags($post->excerpt),50, '...')}} </td>
					<td > 
						@if ($post->categories_id != 0)
							@php $cate = App\Http\Controllers\Admin\ArticlesController::getCat($post->categories_id); @endphp
							{{$cate->name}} 
						@endif
					</td>
					<td > {{$post->published == 1 ? 'Yes' : 'No'}} </td>
					<td > {{$post->created_at}} </td>
					<td > {{$post->updated_at}} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/articles/edit/'. $post->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/articles/delete/' . $post->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$articles->links()}}</div>
	</div>
</div>

@endsection