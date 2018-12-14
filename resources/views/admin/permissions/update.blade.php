@extends('layouts.app')

@section('title')
	{{ trans('permissions.title') }}
@stop

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('permissions.update.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item">{{ trans('breadcrumb.security') }}</li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.permissions') }}</li>
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
                    <h4 class="card-title">{{ trans('permissions.update.title') }}</h4>
                    <hr>
                    <form id="role-form" 
                        action="{{ route('permissions.update', $permission->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="permission-name" class="control-label">{{ trans('permissions.modal.name') }}</label>
                            <input type="text" name="name" value="{{ trans('permissions-list.'.$permission->name) }}" class="form-control" id="permission-name">
                        </div>
                        <div class="form-group">
                            <label for="permission-name" class="control-label">{{ trans('permissions.modal.slug') }}</label>
                            <input type="text" name="slug" value="{{ $permission->name }}" class="form-control" id="permission-slug">
                        </div>
                        <div class="form-group">
                            <label for="permission-group" class="control-label">
                                @lang('permissions.modal.group')
                            </label>
                            <select id="permission-group" name="group" class="form-control">
                                <option selected>{{ trans('permissions.modal.select-group') }}</option>
                                @foreach($groups as $group)
                                    <option @if($group->id === $permission->group) selected @endif value="{{ $group->id }}">
                                        {{ trans('permissions-group-list.' . $group->slug) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-danger waves-effect waves-light">{{ trans('permissions.modal.save') }}</button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-dark waves-effect">{{ trans('permissions.back') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
