@extends('layouts.admin')

@section('content')

<div id="home_categories" >
	<div class="ibox-content">
		<a href="{{ url('admin/categories/create')}}" type="button" class="btn btn-primary btn-lg">Add new Categories</a>
	    <table class="table">
	        <thead>
	        <tr>
	            <th >Id</th>
				<th >Name</th>
				<th >Alias</th>
				<!-- <th >Description</th> -->
				<th >Parent category name</th>
				<th >Yes/No</th>
				<th >&nbsp;</th>
	        </tr>
	        </thead>
	        <tbody>
	        @foreach ($categories as $category)
				<tr>				
					<td > {{$category->id}} </td>
					<td > {{$category->name}} </td>
					<td > {{$category->alias}} </td>
					{{--<td > {{$category->description}} </td> --}}
					<td > 
						@if ($category->parent_id != 0)
							@php $cate = App\Http\Controllers\Admin\CategoriesController::getCat($category->parent_id); @endphp
							{{$cate->name}} 
						@endif
					</td>
					<td > {{$category->published == 1 ? 'Yes' : 'No'}} </td>
					<td style="width: 162px;">
						<a href="{{ url('admin/categories/edit/'. $category->id) }}" class="btn btn-info">Update</a>
						<a href="{{ url('admin/categories/delete/' . $category->id) }}" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			@endforeach
	        </tbody>
	    </table>
		<div class="menu_pagination">{{$categories->links()}}</div>
	</div>
</div>

@endsection