@extends('layouts.admin')

@section('content')
@php( $page = isset($page) ? $page : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/page/save') }}">

    <input  type="hidden" name='id' value="{{ $page ? $page->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $page ? "Edit" : 'Create' }} Page</h2>


            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/page')}}">Page</a>
                </li>
                <li class="active">
                    <strong>{{ $page ? "Edit" : 'Create' }} Page</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Page"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/page')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
                            Title
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='title' value="{{old('title') ? old('title') : ($page? $page->title : '')}}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Alias
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='alias' value="{{old('alias') ? old('alias') : ($page? $page->alias : '')}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Thumbnail
                        </label>
                        <div class="col-sm-10">
                            @php ($value = (old('thumbnail') ? old('thumbnail') : ($page ? $page->thumbnail : '')))
                            {!! App\Library\SelectImageHelper::GenerateIcon($value, 'id_of_the_target_input', URL::asset("/filemanager/index.html"), 'thumbnail') !!}
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>  

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Content
                        </label>
                        <div class="col-sm-10">
                            <textarea id="page_editor1" class="form-control" type="text" name='content' >{!! old('content') ? old('content') : ($page ? $page->content : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Page parent
                        </label>
                        <div class="col-sm-10">
                            <select name="page_parent" data-placeholder="Choose a page parent..." class="chosen-select" style="width:350px;" tabindex="2">
                                @if($page)
                                    <option value="0">no parent</option>
                                @else
                                    <option value="0" selected="selected">no parent</option>
                                @endif
                                @foreach ($page_parent as $value)
                                    @if ($page && $value->id == $page->page_parent)
                                        <option value="{{$value->id}}" selected="selected">{{$value->title}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>     

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Template
                        </label>
                        <div class="col-sm-10">
                            <select name="template" data-placeholder="Choose a page template..." class="chosen-select" style="width:350px;" tabindex="2">
                                <option value="0" selected="selected">Template 1</option>
                                <option value="0">Template 2</option>
                                <option value="0">Template 3</option>
                                <option value="0">Template 4</option>
                            </select>
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
    CKEDITOR.replace('page_editor1', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });

    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {color: '#1AB394'});
    //choosen select
     var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
        }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }
</script>
@endsection