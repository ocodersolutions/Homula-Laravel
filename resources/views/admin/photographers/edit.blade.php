@extends('layouts.admin')

@section('content')
@php( $photographers = isset($photographers) ? $photographers : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/photographers/save') }}">

    <input  type="hidden" name='id' value="{{ $photographers ? $photographers->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $photographers ? "Edit" : 'Create' }} Photographers</h2>
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/photographers')}}">Photographers</a>
                </li>
                <li class="active">
                    <strong>{{ $photographers ? "Edit" : 'Create' }} Photographers</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Photographers"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/photographers')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
                            <input class="form-control" type="text" name='name' value="{{old('name') ? old('name') : ($photographers ? $photographers->name : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Alias
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='alias' value="{{old('alias') ? old('alias') : ($photographers ? $photographers->alias : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Company
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='company' value="{{old('company') ? old('company') : ($photographers ? $photographers->company : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Phone
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='phone' value="{{old('phone') ? old('phone') : ($photographers ? $photographers->phone : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Email
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name='email' value="{{old('email') ? old('email') : ($photographers ? $photographers->email : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Web
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='web' value="{{old('web') ? old('web') : ($photographers ? $photographers->web : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            City
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='city' value="{{old('city') ? old('city') : ($photographers ? $photographers->city : '') }}">
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