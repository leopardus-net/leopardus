@extends('layouts.app')

@section('title')
	{{ trans('languajes.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('languajes.update.title') }} {{ trans("languaje-list.$languaje->slug") }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item">{{ trans('breadcrumb.config') }}</li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.languajes') }}</li>
            </ol>
        </div>
    </div>
          
    <!-- Countries table -->
    <div class="row">
        <div class="col-12">
            @if($errors->any())
              <div class="alert alert-danger">
                  <ul class="no-margin" style="margin: 0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              <br>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ trans('languajes.update.title') }} <strong>{{ trans("languaje-list.$languaje->slug") }}</strong></h4>
                    <form id="languaje-form" 
                    action="{{ route('languajes.update', ['id' => $languaje->id]) }}"
                    method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="languaje-name" class="control-label"> {{ trans('languajes.form.name') }}</label>
                        <input type="text" name="name" value="{{ trans("languaje-list.$languaje->slug") }}" class="form-control" id="languaje-name" required>
                    </div>

                    <div class="form-group">
                        <label for="languaje-iso" class="control-label"> {{ trans('languajes.form.iso') }}</label>
                        <input type="text" name="iso" value="{{ $languaje->iso }}" class="form-control" id="languaje-iso" required>
                    </div>

                    <div class="form-group">
                        <label for="languaje-icon" class="control-label"> {{ trans('languajes.form.icon') }}</label>
                        <input type="text" name="icon" value="{{ $languaje->icon }}" class="form-control" id="languaje-icon">
                    </div>

                    <a href="{{ route('languajes.index') }}" type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('languajes.form.cancel') }}</a>
                    <button onclick="event.preventDefault(); document.getElementById('languaje-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('languajes.form.submit') }}</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop
