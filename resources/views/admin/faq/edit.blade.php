@extends('layouts.admin')

@section('content')
@php( $faq = isset($faq) ? $faq : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/faq/save') }}">

    <input  type="hidden" name='id' value="{{ $faq ? $faq->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $faq ? "Edit" : 'Create' }} Faq</h2>


            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/faq')}}">faq</a>
                </li>
                <li class="active">
                    <strong>{{ $faq ? "Edit" : 'Create' }} Faq</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Faq"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/faq')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
                            <input class="form-control" type="text" name='question' value="{{old('question') ? old('question') : ($faq? $faq->question : '')}}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Answer
                        </label>
                        <div class="col-sm-10">
                            <textarea id="faq_editor" class="form-control" type="text" name='answer' >{!! old('answer') ? old('answer') : ($faq ? $faq->answer : '') !!}</textarea>
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
    CKEDITOR.replace('faq_editor', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });

    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {color: '#1AB394'});
</script>
@endsection