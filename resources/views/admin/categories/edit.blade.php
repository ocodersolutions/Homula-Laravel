@extends('layouts.admin')

@section('content')
@php if (!isset($categories_item)) { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/categories/save') }}">
@php } else { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/categories/update/'.$categories_item->id) }}">
@php } @endphp

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
        	@php if (!isset($categories_item)) { @endphp
            	<h2>Create Categories</h2>
            @php } else { @endphp
            	<h2>Edit Categories</h2>
            @php } @endphp
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/categories')}}">Categories</a>
                </li>
                <li class="active">
                	@php if (!isset($categories_item)) { @endphp
                    	<strong>Create Categories</strong>
                    @php } else { @endphp
                    	<strong>Edit Categories</strong>
                    @php } @endphp
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Categories"><i class="fa fa-plus"></i> Save</button>
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
                    @php if (!isset($categories_item)) { @endphp
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
                                Description
                            </label>
                            <div class="col-sm-10">
		                    	<input class="form-control" type="text" name='description' value="{{old('title') ? old('title') : '' }}">
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
                                    @foreach ($categories_level as $categories_level_1)			
										<option value="{{$categories_level_1->id}}">{{$categories_level_1->name}}</option>
										@foreach ($categories as $categories_level_2)
											@if ($categories_level_2->parent_id == $categories_level_1->id)
												<option value="{{$categories_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
												@foreach ($categories as $categories_level_3)
													@if ($categories_level_3->parent_id == $categories_level_2->id)
														<option value="{{$categories_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>

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
                                <input class="form-control" type="text" name='name' value="{{$categories_item->name}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Alias
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name='alias' value="{{$categories_item->alias}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Description
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name='description' value="{{$categories_item->description}}">
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
                                    @foreach ($categories_level as $categories_level_1)	
										@if ($categories_level_1->id == $categories_item->parent_id)		
											<option value="{{$categories_level_1->id}}" selected="selected">{{$categories_level_1->name}}</option>
										@else		
											<option value="{{$categories_level_1->id}}">{{$categories_level_1->name}}</option>
										@endif
										@foreach ($categories as $categories_level_2)
											@if ($categories_level_2->parent_id == $categories_level_1->id)
												@if ($categories_level_2->id == $categories_item->parent_id)	
													<option value="{{$categories_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
												@else		
													<option value="{{$categories_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
												@endif
												@foreach ($categories as $categories_level_3)
													@if ($categories_level_3->parent_id == $categories_level_2->id)
														@if ($categories_level_3->id == $categories_item->parent_id)		
															<option value="{{$categories_level_3->id}}" selected="selected">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>
														@else		
															<option value="{{$categories_level_3->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$categories_level_3->name}}</option>
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
                                Published
                            </label>
                            <div class="col-sm-10">
                                <select name="published" class="form-control">
                                    <option value="{{$articles->published}}" selected="selected" disabled="">
                                        {{$articles->published}}
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