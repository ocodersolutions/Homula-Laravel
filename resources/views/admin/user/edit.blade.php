@extends('layouts.admin')

@section('content')
@php( $user = isset($user) ? $user : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/users/save') }}">

    <input type="hidden" name="id" value="{{ $user ? $user->id : '' }}" />

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $user ? "Edit" : 'Create' }} User</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/users')}}">User</a>
                </li>
                <li class="active">
                    <strong>{{ $user ? "Edit" : 'Create' }} User</strong>
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
    <!--input type="hidden" name="id" value="{{empty($user) ? old('id') : $user->id}}" /-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">                
                <div class="ibox-content">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Username
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='username' value="{{old('username') ? old('username') : ($user ? $user->username : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Email
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name='email' value="{{old('email') ? old('email') : ($user ? $user->email : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            {{ $user ? 'New' : '' }} password
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="password" name='password' value="" {{ $user ? "" : 'required' }}>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Confirm password
                        </label>
                        <div class="col-sm-10">
                            <input id="password-confirm" class="form-control" type="password" name='password_confirmation' {{ $user ? "" : 'required' }}>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Image
                        </label>
                        <div class="col-sm-10">
                            @php ($value = (old('image') ? old('image') : ($user ? $user->image : '')))
                            {!! App\Library\SelectImageHelper::GenerateIcon($value, 'id_of_the_target_input', URL::asset("/filemanager/index.html"), 'image') !!}
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Phone number
                        </label>
                        <div class="col-sm-10">
                            <input id="phone_number" class="form-control" type="text" name='phone_number' value="{{old('phone_number') ? old('phone_number') : ($user ? $user->phone_number : '' ) }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Address
                        </label>
                        <div class="col-sm-10">
                            <input id="address" class="form-control" type="text" name='address' value="{{old('address') ? old('address') : ($user ? $user->address : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            City
                        </label>
                        <div class="col-sm-10">
                            <input id="city" class="form-control" type="text" name='city' value="{{old('city') ? old('city') : ($user ? $user->city : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Province
                        </label>
                        <div class="col-sm-10">
                            <input id="province" class="form-control" type="text" name='province' value="{{old('province') ? old('province') : ($user ? $user->province : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Postal
                        </label>
                        <div class="col-sm-10">
                            <input id="postal" class="form-control" type="text" name='postal' value="{{old('postal') ? old('postal') : ($user ? $user->postal : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Roles
                        </label>
                        <div class="col-sm-10">
                            @foreach($roles as $role)
                            
                            <label><input type="checkbox" name="roles[{{$role->id}}]"  {{$user ? ($user->hasRole($role->name) ?  'checked' : '') : '' }} value="{{$role->id}}" @if(array_key_exists($role->id, old('roles', []))) checked @endif  >{{$role->display_name}}</label><br>
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