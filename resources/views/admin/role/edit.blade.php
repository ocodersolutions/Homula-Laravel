@extends('layouts.admin')

@section('content')
@php if (!isset($roles)) { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/user/role/save') }}">
@php } else { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/user/role/update/'.$roles->id) }}">
@php } @endphp

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
        	@php if (!isset($roles)) { @endphp
            	<h2>Create Role</h2>
            @php } else { @endphp
            	<h2>Edit Role</h2>
            @php } @endphp
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/user/roles')}}">Roles</a>
                </li>
                <li class="active">
                	@php if (!isset($roles)) { @endphp
                    	<strong>Create Role</strong>
                    @php } else { @endphp
                    	<strong>Edit Role</strong>
                    @php } @endphp
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Role"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i>Discard</a>
            </div>
        </div>
    </div>
    @if (Session::has('success'))
    <br>
    <div class="alert alert-success alert-dismissable animated fadeInDown">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ Session::get('success') }}
    </div>

    @elseif (Session::has('error'))
    <br>
    <div class="alert alert-danger  alert-dismissable animated fadeInDown">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        {{ Session::get('error') }}
    </div>

    @endif

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
                        	@php if (!isset($roles)) { @endphp
		                    	<input class="form-control" type="text" name='name' value="{{old('title') ? old('title') : '' }}">
		                    @php } else { @endphp
                            	<input class="form-control" type="text" name='name' value="{{$roles->name}}">
		                    @php } @endphp
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Display_name
                        </label>
                        <div class="col-sm-10">
                        	@php if (!isset($roles)) { @endphp
		                    	<input class="form-control" type="text" name='display_name' value="{{old('title') ? old('title') : '' }}">
		                    @php } else { @endphp
                            	<input class="form-control" type="text" name='display_name' value="{{$roles->display_name}}">
		                    @php } @endphp
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Description
                        </label>
                        <div class="col-sm-10">
                            @php if (!isset($roles)) { @endphp
		                    	<input class="form-control" type="text" name='description' value="{{old('title') ? old('title') : '' }}">
		                    @php } else { @endphp
                            	<input class="form-control" type="text" name='description' value="{{$roles->description}}">
		                    @php } @endphp
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>           
                </div>
            </div>
        </div>
    </div>
</form>

@endsection