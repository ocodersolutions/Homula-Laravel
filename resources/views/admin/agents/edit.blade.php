@extends('layouts.admin')

@section('content')
@php( $agents = isset($agents) ? $agents : false)

<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/agents/save') }}">

    <input  type="hidden" name='id' value="{{ $agents ? $agents->id : '' }}">

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>{{ $agents ? "Edit" : 'Create' }} Agents</h2>
            
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/admin')}}">Home</a>
                </li>
                <li>
                    <a href="{{url('/admin/agents')}}">Agents</a>
                </li>
                <li class="active">
                    <strong>{{ $agents ? "Edit" : 'Create' }} Agents</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-3">
            <br>
            <br>
            <div class="pull-right tooltip-demo">
                <button  class="btn btn-sm btn-primary dim" data-toggle="tooltip" data-placement="top" title="Add new Agents"><i class="fa fa-plus"></i> Save</button>
                <a href="{{url('/admin/agents')}}" class="btn btn-danger btn-sm dim" data-toggle="tooltip" data-placement="top" title="" data-original-title="Cancel Edit"><i class="fa fa-times"></i> Back</a>
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
                            <input class="form-control" type="text" name='name' value="{{old('name') ? old('name') : ($agents ? $agents->name : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">     
                            Email
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="email" name='email' value="{{old('email') ? old('email') : ($agents ? $agents->email : '') }}" required>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Alias
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='alias' value="{{old('alias') ? old('alias') : ($agents ? $agents->alias : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Thumbnail
                        </label>
                        <div class="col-sm-10">
                            @php ($value = (old('thumbnail') ? old('thumbnail') : ($agents ? $agents->thumbnail : '')))
                            {!! App\Library\SelectImageHelper::GenerateIcon($value, 'id_of_the_target_input', URL::asset("/filemanager/index.html"), 'thumbnail') !!}
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Area work
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='area_work' value="{{old('area_work') ? old('area_work') : ($agents ? $agents->area_work : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Spoken language
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='spoken_language' value="{{old('spoken_language') ? old('spoken_language') : ($agents ? $agents->spoken_language : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>    

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Experience
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='experience' value="{{old('experience') ? old('experience') : ($agents ? $agents->experience : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            About
                        </label>
                        <div class="col-sm-10">
                            <textarea id="agents_editor1" class="form-control" type="text" name='about' >{!! old('about') ? old('about') : ($agents ? $agents->about : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Properties
                        </label>
                        <div class="col-sm-10">
                            <textarea id="agents_editor2" class="form-control" type="text" name='properties' >{!! old('properties') ? old('properties') : ($agents ? $agents->properties : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Rate
                        </label>
                        <div class="col-sm-10">
                            <textarea id="agents_editor3" class="form-control" type="text" name='rate' >{!! old('rate') ? old('rate') : ($agents ? $agents->rate : '') !!}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div> 

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Link Facebook
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='facebook' value="{{old('facebook') ? old('facebook') : ($agents ? $agents->facebook : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Link Skype
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='skype' value="{{old('skype') ? old('skype') : ($agents ? $agents->skype : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Link Google Plus
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='google' value="{{old('google') ? old('google') : ($agents ? $agents->google : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Keyword
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='keyword' value="{{old('keyword') ? old('keyword') : ($agents ? $agents->keyword : '') }}">
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>   

                    <div class="form-group">
                        <label class="col-sm-2 control-label">   
                            Description
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name='description' value="{{old('description') ? old('description') : ($agents ? $agents->description : '') }}">
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
    CKEDITOR.replace('agents_editor1', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });
    CKEDITOR.replace('agents_editor2', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });
    CKEDITOR.replace('agents_editor3', {
        filebrowserBrowseUrl: '{{URL::asset("filemanager")}}/index.html',
    });
    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, {color: '#1AB394'});
</script>
@endsection