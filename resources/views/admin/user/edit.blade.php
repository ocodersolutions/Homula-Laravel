@extends('layouts.admin')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/user/update') }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Edit User</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/users')}}">User</a>
                </li>
                <li class="active">
                    <strong>Edit User</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button   class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new User"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/users')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
            </div>
        </div>
    </div>

    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{empty($user) ? old('id') : $user->id}}" />
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">                
                <div class="ibox-content">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Username
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='username' value="{{old('title') ? old('title') : $user->username }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Email
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='email' value="{{old('title') ? old('title') : $user->email }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            New password
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='new_password' value="">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Image
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='image' value="{{old('image') ? old('image') : $user->image }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Phone number
                        </label>
                        <div class="col-sm-10">
                            <input id="phone_number" class="form-control" type="text" name='phone_number' value="{{old('phone_number') ? old('phone_number') : $user->phone_number }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Address
                        </label>
                        <div class="col-sm-10">
                            <input id="address" class="form-control" type="text" name='address' value="{{old('address') ? old('address') : $user->address }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            City
                        </label>
                        <div class="col-sm-10">
                            <input id="city" class="form-control" type="text" name='city' value="{{old('city') ? old('city') : $user->city }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Province
                        </label>
                        <div class="col-sm-10">
                            <input id="province" class="form-control" type="text" name='province' value="{{old('province') ? old('province') : $user->province }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Postal
                        </label>
                        <div class="col-sm-10">
                            <input id="postal" class="form-control" type="text" name='postal' value="{{old('postal') ? old('postal') : $user->postal }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Roles
                        </label>
                        <div class="col-sm-10">
                            @foreach($roles as $role)
                            
                            <label><input type="checkbox" name="roles[]"  {{$user->hasRole($role->name) ?  'checked' : '' }} value="{{$role->id}}">{{$role->display_name}}</label><br>
                             @endforeach

                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                </div>
            </div>
        </div>
    </div>
</form>

@endsection