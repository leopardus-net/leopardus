@extends('layouts.app')

@section('title')
    {{ trans('settings-basic.title') }}
@stop

@section('styles')
    <style>
        .form-delete {
            width: auto;
            float: left;
            margin-left: 10px;
        }
    </style>
@stop

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('settings-basic.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.config') }}</li>
            </ol>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

     @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    @if(session('action') === 'updated')
        <div class="alert alert-success">
            {!! trans('settings-basic.success-msg') !!} 
        </div>
    @endif

    <div class="card">
        <div class="card-body">
    		<h4 class="card-title">@lang('settings-basic.title')</h4>
    		<h6 class="card-subtitle">@lang('settings-basic.subtitle')</h6>

            <form action="{{ route('admin.settings.update') }}" method="POST" 
                class="form-horizontal form-bordered"  enctype="multipart/form-data"
                style="border-top: 1px solid rgba(120, 130, 140, 0.13);padding-top: 20px;">
                @method('PUT')
                @csrf
                <div class="form-body">
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.title')
                        </label>
                        <div class="col-md-9">
                            <input class="form-control" name="name" type="text" 
                                    value="{{ $settings->name }}">
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.title') 
                            </small> 
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.slogan')
                        </label>
                        <div class="col-md-9">
                            <input class="form-control" name="slogan" type="text"
                                    value="{{ $settings->slogan }}">
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.slogan') 
                            </small> 
                        </div>
                    </div>
                    <!--<div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.type')
                        </label>
                        <div class="col-md-9">
                            <select name="type" class="form-control">
                                <option value="0" @if( $settings->category_type == 0) selected @endif>Categoría 1</option>
                                <option value="1">Categoría 2</option>
                            </select>
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.type') 
                            </small> 
                        </div>
                    </div>-->
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.company_name')
                        </label>
                        <div class="col-md-9">
                            <input class="form-control" name="company_name" type="text"
                                    value="{{ $settings->company_name }}">
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.company_name') 
                            </small> 
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.company_email')
                        </label>
                        <div class="col-md-9">
                            <input class="form-control" name="company_email" type="text"
                                    value="{{ $settings->company_email }}">
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.company_email') 
                            </small> 
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.site_email')
                        </label>
                        <div class="col-md-9">
                            <input class="form-control" name="site_email" type="text"
                                    value="{{ $settings->site_email }}">
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.site_email') 
                            </small> 
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.description')
                        </label>
                        <div class="col-md-9">
                            <textarea name="description" id="" class="form-control" rows="3">{{ $settings->description }}</textarea>
                            <small class="form-control-feedback"> 
                                @lang('settings-basic.form.description') 
                            </small> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.maintenance')
                        </label>
                        <div class="col-md-9">
                            <select class="form-control custom-select" name="maintenance">
                                <option value="0" 
                                    @if( !$settings->maintenance ) selected @endif>Off</option>
                                <option value="1"
                                    @if( $settings->maintenance ) selected @endif>On</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.new_users')
                        </label>
                        <div class="col-md-9">
                            <select class="form-control custom-select" name="new_users">
                                <option value="0" 
                                    @if( !$settings->enable_register ) selected @endif>Off</option>
                                <option value="1"
                                    @if( $settings->enable_register ) selected @endif>On</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.roles')
                        </label>
                        <div class="col-md-9">
                            <select class="form-control custom-select" name="role">
                                <option value="">@lang('settings-basic.form.select-rol')</option>
                                @foreach( $roles as $role )
                                    <option value="{{ $role->id }}" 
                                        @if( $settings->rol_default == $role->id ) selected @endif>
                                        @lang("roles-list.$role->name")
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.languaje')
                        </label>
                        <div class="col-md-9">
                            <select class="form-control custom-select" name="languaje">
                                <option value="">@lang('settings-basic.form.select-lang')</option>
                                @foreach( $languajes as $lang )
                                    <option value="{{ $lang->id }}"
                                        @if( $settings->lang == $lang->id ) selected @endif>
                                        @lang("languaje-list.$lang->slug")
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.logo_text')
                        </label>
                        <div class="col-md-9">
                            <img src="{{ asset($settings->logo_text ? $settings->logo_text : 'assets/images/logo-text.png') }}" alt="logo" class="img-thumbnail" style="margin-bottom: 20px"><br>
                            <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                <span><i class="ion-upload m-r-5"></i>@lang('settings-basic.form.upload_logo_text')</span>
                                <input type="file" name="logo_text" class="upload">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">
                            @lang('settings-basic.form.logo_icon')
                        </label>
                        <div class="col-md-9">
                            <img src="{{ asset($settings->logo_icon ? $settings->logo_icon : 'assets/images/logo-icon.png' ) }}" alt="logo" class="img-thumbnail" style="margin-bottom: 20px"><br>
                            <div class="fileupload btn btn-danger btn-rounded waves-effect waves-light">
                                <span><i class="ion-upload m-r-5"></i>@lang('settings-basic.form.upload_logo_icon')</span>
                                <input type="file" name="logo_icon" class="upload">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="offset-sm-3 col-md-9">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> @lang('settings-basic.form.submit')</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    
@stop