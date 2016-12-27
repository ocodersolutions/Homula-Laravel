@extends('layouts.admin')

@section('content')

<script type="text/javascript">
    // File Picker modification for FCK Editor v2.0 - www.fckeditor.net
    // by: Pete Forde <pete@unspace.ca> @ Unspace Interactive
    var urlobj;

    function BrowseServer(obj)
    {
      urlobj = obj;
      OpenServerBrowser(
      '{{URL::asset("/plugin/Filemanager-master/index.html")}}',
      screen.width * 0.7,
      screen.height * 0.7 ) ;
    }

    function OpenServerBrowser( url, width, height )
    {
      var iLeft = (screen.width - width) / 2 ;
      var iTop = (screen.height - height) / 2 ;
      var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
      sOptions += ",width=" + width ;
      sOptions += ",height=" + height ;
      sOptions += ",left=" + iLeft ;
      sOptions += ",top=" + iTop ;
      var oWindow = window.open( url, "BrowseWindow", sOptions ) ;
    }

    function SetUrl( url, width, height, alt )
    {
      document.getElementById(urlobj).value = url ;
      oWindow = null;
    }
</script>

<style type="text/css">
    .menu_icon 
    .menu_icon {
        position: relative;
    }
    .menu_icon button {
        position: absolute;
        top: 0;
        right: 70px;
        border-radius: 0;
        background: #f2f2f2;
        border: 1px solid #cccccc;
        color: black;
    }
    .menu_icon i {
        position: absolute;
        top: 0;
        font-size: 20px;
        line-height: 32px;
        padding: 0 10px;
        background: #eeeeee;
        border: 1px solid #cccccc;
        cursor: pointer;
    }
    .menu_icon span {
        display: inline-block;
        position: absolute;
        top: 0;
        right: 15px;
        line-height: 32px;
        font-size: 25px;
        font-weight: bold;
        padding: 0px 20px;
        cursor: pointer;
        background: #f2f2f2;
        border: 1px solid #cccccc;
        color: #000;
    }
    .menu_icon input[type=text] {
        padding: 0 122px 0 45px;
    }
    .menu_icon img {
        max-width: 100% !important;
        max-height: 100% !important;
    }
</style>

@php if (!isset($menus_item)) { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/menu/save') }}">
@php } else { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/menu/update/'.$menus_item->id) }}">
@php } @endphp

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
        	@php if (!isset($menus_item)) { @endphp
            	<h2>Create Menu</h2>
            @php } else { @endphp
            	<h2>Edit Menu</h2>
            @php } @endphp
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/menu')}}">Menus</a>
                </li>
                <li class="active">
                	@php if (!isset($menus_item)) { @endphp
                    	<strong>Create Menu</strong>
                    @php } else { @endphp
                    	<strong>Edit Menu</strong>
                    @php } @endphp
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Menu"><i class="fa fa-plus"></i> Save</button>
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
                    @php if (!isset($menus_item)) { @endphp
                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Name
                            </label>
                            <div class="col-sm-10">
		                    	<input class="form-control" type="text" name='name' value="{{old('title') ? old('title') : '' }}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Alias
                            </label>
                            <div class="col-sm-10">
		                    	<input class="form-control" type="text" name='alias' value="{{old('title') ? old('title') : '' }}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Icon
                            </label>
                            <div class="col-sm-10 menu_icon">
		                    	<input class="form-control" type="text" name='icon' value="{{old('title') ? old('title') : '' }}"  id="id_of_the_target_input">
                                <i class="fa fa-eye" aria-hidden="true" title=""></i>
                                <button type="button" class="btn btn-primary" onclick="BrowseServer('id_of_the_target_input');">Select</button>
                                <span>x</span>
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
                                        <option value="{{$menus_level_1->id}}">{{$menus_level_1->name}}</option>
                                        @foreach ($menus as $menus_level_2)
                                            @if ($menus_level_2->parent_id == $menus_level_1->id)
                                                <option value="{{$menus_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
                                                @foreach ($menus as $menus_level_3)
                                                    @if ($menus_level_3->parent_id == $menus_level_2->id)
                                                        <option value="{{$menus_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>

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
                                <input class="form-control" type="text" name='link' value="{{old('title') ? old('title') : '' }}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>     

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Target
                            </label>
                            <div class="col-sm-10">
                                <select name="target" class="form-control">
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
                                <select name="published" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>    

                    @php } else { @endphp  

                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Name
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name='name' value="{{$menus_item->name}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Alias
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name='alias' value="{{$menus_item->alias}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Icon
                            </label>
                            <div class="col-sm-10 menu_icon">
                                <input class="form-control" type="text" name='icon' value="{{$menus_item->icon}}" id="id_of_the_target_input">
                                <i class="fa fa-eye" aria-hidden="true" title=""></i>
                                <button type="button" class="btn btn-primary" onclick="BrowseServer('id_of_the_target_input');">Select</button>
                                <span>x</span>
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
                                        @if ($menus_level_1->id == $menus_item->parent_id)      
                                            <option value="{{$menus_level_1->id}}" selected="selected">{{$menus_level_1->name}}</option>
                                        @else       
                                            <option value="{{$menus_level_1->id}}">{{$menus_level_1->name}}</option>
                                        @endif
                                        @foreach ($menus as $menus_level_2)
                                            @if ($menus_level_2->parent_id == $menus_level_1->id)
                                                @if ($menus_level_2->id == $menus_item->parent_id)  
                                                    <option value="{{$menus_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
                                                @else       
                                                    <option value="{{$menus_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$menus_level_2->name}}</option>
                                                @endif
                                                @foreach ($menus as $menus_level_3)
                                                    @if ($menus_level_3->parent_id == $menus_level_2->id)
                                                        @if ($menus_level_3->id == $menus_item->parent_id)      
                                                            <option value="{{$menus_level_3->id}}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
                                                        @else       
                                                            <option value="{{$menus_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menus_level_3->name}}</option>
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
                                <input class="form-control" type="text" name='link' value="{{$menus_item->link}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>     

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Target
                            </label>
                            <div class="col-sm-10">
                                <select name="target" class="form-control">
                                    <option value="{{$menus_item->target}}" selected="selected" disabled="">
                                        @if ($menus_item->target == "") 
                                            None
                                        @else
                                            {{$menus_item->target}}
                                        @endif
                                    </option>
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
                                <select name="published" class="form-control">
                                    <option value="{{$menus_item->published}}" selected="selected" disabled="">
                                        {{$menus_item->published}}
                                    </option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>    
                    @php } @endphp  
                </div>
            </div>
        </div>
    </div>
</form>

@endsection