@extends('layouts.admin')

@section('content')


<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/gallery/cat/save') }}">
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{empty($title) ?  'Homula' : $title}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('admin/gallery')}}">Gallery</a>
                </li>
                @if($cat)
                 
                <li class="active">
                    <strong>Edit - {{$cat->title}}</strong>
                </li>
                @else
                <li class="active">
                    <strong>Add Article</strong>
                </li>
                @endif
            </ol>
        </div>
        <div class="col-lg-2">
            <br>
            <div class="pull-right tooltip-demo">
                <button class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Save Category"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/gallery/')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Discard</a>

            </div>
        </div>
    </div>

    {{ csrf_field() }}
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">                
                    <div class="ibox-content">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">     
                                Id
                            </label>
                            <div class="col-sm-10">
                                <input type="hidden" name="id"  value="{{$cat ? $cat->id : ''}}" />
                                {{$cat ? $cat->id : ""}}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="form-group">

                            <label class="col-sm-2 control-label">     
                                Title
                            </label>
                            <div class="col-sm-10">

                                <input name="title" class='form-control' value="{{ old('title') ?  old('title') : ($cat ? $cat->title  :'')}}" />
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>



                        <div class="form-group">
                            <label class="col-sm-2 control-label">     
                                updated
                            </label>
                            <div class="col-sm-10">
                                {{$cat ? $cat->updated : ''}}
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection