@extends('layouts.app')

@section('title')
    {{ trans('permissions.title') }}
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
        <div class="col-md-5 col-12 align-self-center">
            <h3 class="text-themecolor">{{ trans('permissions.breadcrumb.title') }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('breadcrumb.system') }}</li>
            </ol>
        </div>
        <div class="col-md-7 col-4 align-self-center">
            <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                    <button data-toggle="modal" id="newRole" data-target=".bs-example-modal-sm" class=" waves-effect waves-light btn-success btn  pull-right m-l-10"><i class="ti-plus text-white"></i> {{ trans('permissions.new') }}</button>
                </div>
                
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row">
        @if( isset( $role ) )
            <div class="col-xs-12 col-lg-12">
                <h4>Rol seleccionado: <strong>@lang("roles-list.$role->name")</strong></h4>
                <br>
            </div>
        @endif
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th>{{ trans('permissions.list_rol') }}</th>
                                    <th width="130px" class="text-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $roles as $rol )
                                <tr>
                                    <td>
                                        <a href="{{ route('roles.get', [$rol->id]) }}">
                                            @if( $rol->id == $role->id)
                                                <strong>@lang("roles-list.$rol->name")</strong>
                                            @else
                                                @lang("roles-list.$rol->name")
                                            @endif
                                        </a>
                                    </td>
                                    <td width="130px">
                                    @if( $rol->id != 1 )
                                        <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-info btn-xs" style="float:left;">{{ trans('permissions.edit') }}</a>

                                        {!! \Form::model($rol, ['method' => 'delete', 'route' => ['roles.destroy', $rol->id], 'class' =>'form-inline form-delete']) !!}
                                        {!! \Form::hidden('id', $rol->id) !!}
                                        {!! \Form::submit(trans('permissions.delete'), ['class' => 'btn btn-xs btn-danger delete', 'name' => 'delete_modal']) !!}
                                        {!! \Form::close() !!}
                                    @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2">{{ trans('permissions.empty') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="100%">{{ trans('permissions.list_permission') }}</th>
                                    <th class="text-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $permission as $perm )
                                    <tr>
                                        <td>{{ trans("permissions-list.$perm->name") }}</td>
                                        <td class="text-nowrap">
                                            <div class="switch">
                                                <label>OFF
                                                    <input @if($perm->checked) checked="" @endif type="checkbox" onclick="setPermissionRole({{ $perm->id }}, {{ $role->id }})"><span class="lever"></span>ON</label>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">{{ trans('permissions.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('modals.confirm-delete')

    @include('admin.permissions.modals.new')

    @if( isset($update) && $update  )
        @include('admin.permissions.modals.update')
    @endif

@stop

@section('scripts')
    <script>
        @if( isset($update) && $update )
            $('#updateModal').modal('show')
        @endif

        $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
            e.preventDefault();
            var $form=$(this);
            $('#confirm').modal({ backdrop: 'static', keyboard: false })
                .on('click', '#delete-btn', function(){
                    $form.submit();
                });
        });

        jQuery(document).ready(function(){
            jQuery.ajaxSetup({
                beforeSend: function(xhr, settings) {
                    console.log('beforesend');
                    settings.data += "&_token=<?php echo csrf_token() ?>";
                }
            });
        });

        function setPermissionRole(permission, role) {
            jQuery.ajax({
                url: "{{ url('/admin/permissions/setPermissionRole') }}",
                method: 'post',
                data: {
                    permission: permission,
                    role: role,
                },
                success: function(result){
                    console.log(result);
                }
            });
        }
    </script>
@stop