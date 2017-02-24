@extends('layouts.admin')

@section('content')
@php( $meta = isset($meta) ? $meta : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/meta/save') }}">

    <input  type="hidden" name='id' value="{{ $meta ? $meta->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $meta ? "Edit" : 'Create' }} Meta</h2>


            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/meta')}}">Meta list</a>
                </li>
                <li class="active">
                    <strong>{{ $meta ? "Edit" : 'Create' }} Meta</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Meta"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/meta')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
            </div>
        </div>
    </div>


    {{ csrf_field() }}
    <!--input type="hidden" name="id" value="{{empty($user) ? old('id') : $user->id}}" /-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">                
                <div class="ibox-content">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Name
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='name' value="{{old('name') ? old('name') : ($meta? $meta->name : '')}}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Alias
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='alias' value="{{old('alias') ? old('alias') : ($meta? $meta->alias : '')}}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Keyword
                        </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name='keyword' >{!! old('keyword') ? old('keyword') : ($meta ? $meta->keyword : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Description
                        </label>
                        <div class="col-sm-10">
                            <textarea class="form-control" type="text" name='description' >{!! old('description') ? old('description') : ($meta ? $meta->description : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div> 
                </div>
            </div>
        </div>
    </div>
</form>

@endsection
@section("content_js")

<script>

    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {color: '#1AB394'});
</script>
@endsection