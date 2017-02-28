@extends('layouts.admin')

@section('content')
@php( $help_centre = isset($help_centre) ? $help_centre : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/helpcentre/save') }}">

    <input  type="hidden" name='id' value="{{ $help_centre ? $help_centre->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $help_centre ? "Edit" : 'Create' }} Help centre</h2>


            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/helpcentre')}}">Help centre</a>
                </li>
                <li class="active">
                    <strong>{{ $help_centre ? "Edit" : 'Create' }} Help centre</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Help centre"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/helpcentre')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
                            Question
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='question' value="{{old('question') ? old('question') : ($help_centre ? $help_centre->question : '')}}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Alias
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='alias' value="{{old('alias') ? old('alias') : ($help_centre ? $help_centre->alias : '')}}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Answer
                        </label>
                        <div class="col-sm-10">
                            <textarea id="helpcentre_editor" class="form-control" type="text" name='answer' >{!! old('answer') ? old('answer') : ($help_centre ? $help_centre->answer : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Categories
                        </label>
                        <div class="col-sm-10">
                            <select name="categories_id" data-placeholder="Choose a categories..." class="chosen-select" style="width:350px;" tabindex="2">
                                @if($help_centre)
                                    <option value="0">no categories</option>
                                @else
                                    <option value="0" selected="selected">no categories</option>
                                @endif
                                @foreach ($categories as $value)
                                    @if ($help_centre && $value->id == $help_centre->categories_id)
                                        <option value="{{$value->id}}" selected="selected">{{$value->name}}</option>
                                    @else
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endif
                                @endforeach
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
    CKEDITOR.replace('helpcentre_editor', {
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