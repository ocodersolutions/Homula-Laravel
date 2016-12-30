@extends('layouts.admin')

@section('content')
@php( $permissions = isset($permissions) ? $permissions : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/user/permission/save') }}">

    <input  type="hidden" name='id' value="{{ $permissions ? $permissions->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ $permissions ? "Edit" : 'Create' }} Permission</h2>
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/user/permissions')}}">Permission</a>
                </li>
                <li class="active">
                    <strong>{{ $permissions ? "Edit" : 'Create' }} Permission</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Permission"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i>Discard</a>
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
	                    	<input class="form-control" type="text" name='name' value="{{old('name') ? old('name') : ($permissions ? $permissions->name : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Display_name
                        </label>
                        <div class="col-sm-10">
	                    	<input class="form-control" type="text" name='display_name' value="{{old('display_name') ? old('display_name') : ($permissions ? $permissions->display_name : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Description
                        </label>
                        <div class="col-sm-10">
	                    	<input class="form-control" type="text" name='description' value="{{old('description') ? old('description') : ($permissions ? $permissions->description : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>           
                </div>
            </div>
        </div>
    </div>
</form>

@endsection