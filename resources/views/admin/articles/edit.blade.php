@extends('layouts.admin')

@section('content')

<style type="text/css">
    .article_thumbnail {
        position: relative;
    }
    .article_thumbnail button {
        position: absolute;
        top: 0;
        right: 70px;
        border-radius: 0;
        background: #f2f2f2;
        border: 1px solid #cccccc;
        color: black;
    }
    .article_thumbnail i {
        position: absolute;
        top: 0;
        font-size: 20px;
        line-height: 32px;
        padding: 0 10px;
        background: #eeeeee;
        border: 1px solid #cccccc;
        cursor: pointer;
    }
    .article_thumbnail span {
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
    .article_thumbnail input[type=text] {
        padding: 0 122px 0 45px;
    }
    .article_thumbnail img {
        max-width: 100%;
        max-height: 100%;
    }

</style>

@php if (!isset($articles)) { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/articles/save') }}">
@php } else { @endphp
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/articles/update/'.$articles->id) }}">
@php } @endphp

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
        	@php if (!isset($articles)) { @endphp
            	<h2>Create Articles</h2>
            @php } else { @endphp
            	<h2>Edit Articles</h2>
            @php } @endphp
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/articles')}}">Articles</a>
                </li>
                <li class="active">
                	@php if (!isset($articles)) { @endphp
                    	<strong>Create Articles</strong>
                    @php } else { @endphp
                    	<strong>Edit Articles</strong>
                    @php } @endphp
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Articles"><i class="fa fa-plus"></i> Save</button>
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
                    @php if (!isset($articles)) { @endphp
                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Title
                            </label>
                            <div class="col-sm-10">
		                    	<input class="form-control" type="text" name='title' value="{{old('title') ? old('title') : '' }}">
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
                                Thumbnail
                            </label>
                            <div class="col-sm-10 article_thumbnail">
		                    	<input class="form-control" type="text" name='thumbnail' value="{{old('title') ? old('title') : '' }}" id="id_of_the_target_input">
                                @php
                                    $url = URL::asset("/filemanager/index.html");
                                    echo App\Library\SelectImageHelper::GenerateIcon('id_of_the_target_input', $url);
                                @endphp
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>     

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Content
                            </label>
                            <div class="col-sm-10">
		                    	<textarea id="editor1" class="form-control" type="text" name='content'>{{old('title') ? old('title') : '' }}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>   

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Excerpt
                            </label>
                            <div class="col-sm-10">
		                    	<textarea id="editor2" class="form-control" type="text" name='excerpt' >{{old('title') ? old('title') : '' }}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>   

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Categories_id
                            </label>
                            <div class="col-sm-10">
                                <select name="categories_id">
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
                                Title
                            </label>
                            <div class="col-sm-10">
		                    	<input class="form-control" type="text" name='title' value="{{$articles->title}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                Alias
                            </label>
                            <div class="col-sm-10">
		                    	<input class="form-control" type="text" name='alias' value="{{$articles->alias}}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Thumbnail
                            </label>
                            <div class="col-sm-10 article_thumbnail">
		                    	<input class="form-control" type="text" name='thumbnail' value="{{$articles->thumbnail}}" id="id_of_the_target_input">
                                @php
                                    $url = URL::asset("/filemanager/index.html");
                                    echo App\Library\SelectImageHelper::GenerateIcon('id_of_the_target_input', $url);
                                @endphp
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>     

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Content
                            </label>
                            <div class="col-sm-10">
		                    	<textarea id="editor1" class="form-control" type="text" name='content' >{{$articles->content}}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>   

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Excerpt
                            </label>
                            <div class="col-sm-10">
		                    	<textarea id="editor2" class="form-control" type="text" name='excerpt'>{{$articles->excerpt}}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>   

                        <div class="form-group">
                            <label class="col-sm-2 control-label">   
                                Categories_id
                            </label>
                            <div class="col-sm-10">
                                <select name="categories_id">
									<option value="0">none</option>	
									@foreach ($categories_level as $categories_level_1)	
										@if ($categories_level_1->id == $articles->categories_id)		
											<option value="{{$categories_level_1->id}}" selected="selected">{{$categories_level_1->name}}</option>
										@else		
											<option value="{{$categories_level_1->id}}">{{$categories_level_1->name}}</option>
										@endif
										@foreach ($categories as $categories_level_2)
											@if ($categories_level_2->parent_id == $categories_level_1->id)
												@if ($categories_level_2->id == $articles->categories_id)	
													<option value="{{$categories_level_2->id}}" selected="selected">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
												@else		
													<option value="{{$categories_level_2->id}}">&nbsp;&nbsp;&nbsp;{{$categories_level_2->name}}</option>
												@endif
												@foreach ($categories as $categories_level_3)
													@if ($categories_level_3->parent_id == $categories_level_2->id)
														@if ($categories_level_3->id == $articles->categories_id)		
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
<script>
    CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });
    CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });
    // CKEDITOR.replace( 'editor1' );
    // CKEDITOR.replace( 'editor2' );
</script>
@endsection