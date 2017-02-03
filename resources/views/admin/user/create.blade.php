@extends('layouts.admin')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/user/save') }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Create User</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/users')}}">User</a>
                </li>
                <li class="active">
                    <strong>Create User</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button   class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new User"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
            </div>
        </div>
    </div>

    {{ csrf_field() }}
    <!-- <input type="hidden" name="id" value="{{empty($user) ? old('id') : $user->id}}" /> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">                
                <div class="ibox-content">

                    <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">     
                            Username
                        </label>
                        <div class="col-sm-10">
                            <input id="username" class="form-control" type="text" name='username' value="{{old('title') ? old('title') : '' }}" required autofocus>
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">     
                            Email
                        </label>
                        <div class="col-sm-10">
                            <input id="email" class="form-control" type="text" name='email' value="{{old('title') ? old('title') : '' }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">   
                            Password
                        </label>
                        <div class="col-sm-10">
                            <input id="password" class="form-control" type="password" name='password' value="" required>
                             @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Confirm password
                        </label>
                        <div class="col-sm-10">
                            <input id="password-confirm" class="form-control" type="password" name='password_confirmation' value="" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                </div>
            </div>
        </div>
    </div>
</form>

@endsection