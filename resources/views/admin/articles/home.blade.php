@extends('layouts.admin')

@section('content')

<div id="home_articles" >
	<div class="ibox-content">
		<a href="{{ url('admin/articles/create')}}" type="button" class="btn btn-primary btn-lg">Add new Post</a>
	    <table class="table">
	        <thead>
	        <tr>
	            <th >Id</th>
				<th >Title</th>
				<th >Alias</th>
				<th >Thumbnail</th>
				<th >Content</th>
				<th >Excerpt</th>
				<th >Categories_id</th>
				<th >published</th>
				<th >Created_at</th>
				<th >Updated_at</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($articles as $post)
				<tr>				
					<td > {{$post->id}} </td>
					<td > {{$post->title}} </td>
					<td > {{$post->alias}} </td>
					<td > {{$post->thumbnail}} </td>
					<td >@php  echo str_limit($post->content,100, '...'); @endphp </td>
					<td > @php  echo str_limit($post->excerpt,50, '...'); @endphp </td>
					<td > {{$post->categories_id}} </td>
					<td > {{$post->published}} </td>
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