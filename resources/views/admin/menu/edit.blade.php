@extends('layouts.admin')

@section('content')
@php( $menus_item = isset($menus_item) ? $menus_item : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/menu/save') }}">

    <input  type="hidden" name='id' value="{{ $menus_item ? $menus_item->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $menus_item ? "Edit" : 'Create' }} Menu</h2>
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/menu')}}">Menus</a>
                </li>
                <li class="active">
                    <strong>{{ $menus_item ? "Edit" : 'Create' }} Menu</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Menu"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
	                    	<input class="form-control" type="text" name='name' value="{{old('title') ? old('title') : ($menus_item ? $menus_item->name : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Alias
                        </label>
                        <div class="col-sm-10">
	                    	<input class="form-control" type="text" name='alias' value="{{old('title') ? old('title') : ($menus_item ? $menus_item->alias : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Icon
                        </label>
                        <div class="col-sm-10">
	                    	@php  ($value = (old('title') ? old('title') : ($menus_item ? $menus_item->icon : '')))
                            {!! App\Library\SelectImageHelper::GenerateIcon($value, 'id_of_the_target_input', URL::asset("/filemanager/index.html"), 'icon')!!}
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>     

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Parent_id
                        </label>
                        <div class="col-sm-10">
                            <select name="parent_id" class="form-control">
                                <option value="0">none</option>                                     
                                @foreach ($menus_level as $menus_level_1)  
                                    @if(!$menus_item)         
                                        <option value="{{$menus_level_1->id}}">{{$menus_level_1->name}}</option>
                                    @else
                                        @if ($menus_level_1->id == $menus_item->parent_id)      
                                            <option value="{{$menus_level_1->id}}" selected="selected">{{$menus_level_1->name}}</option>
                                        @else       
                                            <option value="{{$menus_level_1->id}}">{{$menus_level_1->name}}</option>
                                        @endif
                                    @endif
                                    @foreach ($menus as $menus_level_2)
                                        @if ($menus_level_2->parent_id == $menus_level_1->id)
                                            @if(!$menus_item)  
                                                <option value="{{$menus_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
                                            @else
                                                @if ($menus_level_2->id == $menus_item->parent_id)  
                                                    <option value="{{$menus_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
                                                @else       
                                                    <option value="{{$menus_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
                                                @endif
                                            @endif
                                            @foreach ($menus as $menus_level_3)
                                                @if ($menus_level_3->parent_id == $menus_level_2->id)
                                                    @if(!$menus_item) 
                                                        <option value="{{$menus_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
                                                    @else
                                                        @if ($menus_level_3->id == $menus_item->parent_id)      
                                                            <option value="{{$menus_level_3->id}}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
                                                        @else       
                                                            <option value="{{$menus_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach         
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>     

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Link
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='link' value="{{old('title') ? old('title') : ($menus_item ? $menus_item->link : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>     

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Target
                        </label>
                        <div class="col-sm-10">
                            <select name="target" class="form-control">
                                @if($menus_item)
                                    <option value="{{$menus_item->target}}" selected="selected" disabled="">
                                        @if ($menus_item->target == "") 
                                            None
                                        @else
                                            {{$menus_item->target}}
                                        @endif
                                    </option>
                                @endif
                                <option value="">None</option>
                                <option value="_blank">_blank</option>
                                <option value="_self">_self</option>
                                <option value="_parent">_parent</option>
                                <option value="_top">_top</option>
                                <option value="framename">framename</option>
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Published
                        </label>
                        <div class="col-sm-10">
                            <input class="js-switch" value="1" style="display: none;" data-switchery="true" type="checkbox" name="published" {{(old('published') || $menus_item == false || ($menus_item && $menus_item->published)) ? 'checked' : '' }} >
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