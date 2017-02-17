@extends('layouts.admin')

@section('content')
@php( $properties = isset($properties) ? $properties : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/properties/save') }}">

    <input  type="hidden" name='id' value="{{ $properties ? $properties->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $properties ? "Edit" : 'Create' }} Properties</h2>
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/properties')}}">Properties</a>
                </li>
                <li class="active">
                    <strong>{{ $properties ? "Edit" : 'Create' }} Properties</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Properties"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/properties')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
                            Address
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='address' value="{{old('address') ? old('address') : ($properties ? $properties->address : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Thumbnail
                        </label>
                        <div class="col-sm-10">
                            @php ($value = (old('thumbnail') ? old('thumbnail') : ($properties ? $properties->thumbnail : '')))
                            {!! App\Library\SelectImageHelper::GenerateIcon($value, 'id_of_the_target_input', URL::asset("/filemanager/index.html"), 'thumbnail') !!}
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Price
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='price' value="{{old('price') ? old('price') : ($properties ? $properties->price : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            City
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='city' value="{{old('city') ? old('city') : ($properties ? $properties->city : '') }}">
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