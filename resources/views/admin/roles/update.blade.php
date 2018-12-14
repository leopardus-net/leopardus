@extends('layouts.app')

@section('title')
	{{ trans('roles.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('roles.update.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item">{{ trans('breadcrumb.security') }}</li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.roles') }}</li>
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
                    <h4 class="card-title">{{ trans('roles.update.title') }}</h4>
                    <hr>
                    <form id="role-form" 
                        action="{{ route('roles.update', $role->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="roles-name" class="control-label">{{ trans('roles.modal.name') }}</label>
                            <input type="text" name="name" value="{{ trans('roles-list.'.$role->name) }}" class="form-control" id="roles-name">
                        </div>
                        <div class="form-group">
                            <label for="roles-name" class="control-label">{{ trans('roles.modal.slug') }}</label>
                            <input @if($role->id <= 2) disabled @endif type="text" name="slug" value="{{ $role->name }}" class="form-control" id="roles-slug">
                            @if($role->id <= 2) <input type="hidden" name="slug" value="{{$role->name}}"> @endif
                        </div>
                        <div class="form-group">
                            <label for="roles-route" class="control-label">{{ trans('roles.modal.route') }}</label>
                            <input type="text" name="route" value="{{ $role->route }}" class="form-control" id="roles-route">
                        </div>

                        <button type="submit" class="btn btn-danger waves-effect waves-light">{{ trans('roles.modal.save') }}</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect">{{ trans('roles.back') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
