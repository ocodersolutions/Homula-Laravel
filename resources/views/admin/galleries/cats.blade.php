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
                    <th >Id</th>
                    <th >Title</th>

                    <th >Created_at</th>
                    <th >Updated_at</th>
                    <th >&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cats as $post)
                <tr>				
                    <td > {{$post->id}} </td>
                    <td > {{$post->title}} </td>

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
        <div class="menu_pagination">{{$cats->links()}}</div>
    </div>
</div>

@endsection