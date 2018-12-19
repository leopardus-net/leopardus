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
                <li class="breadcrumb-item active">{{ trans('breadcrumb.security') }}</li>
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
        <div class="col-sm-12">
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

            @if(session('action'))
                <div class="alert alert-success">
                    {{ trans('permissions.alerts.' . session('action')) }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                    @foreach($permissions as $group)
                        <table class="table table-striped table-bordered" data-form="deleteForm">
                            <thead>
                                <tr>
                                    <th width="40%">{{ trans('permissions-group-list.' . $group->slug) }}</th>
                                    <th></th>
                                    <th width="21%" class="text-nowrap"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $group->permissions as $perm )
                                    <tr>
                                        <td width="40%" class="text-center">{{ trans("permissions-list.$perm->name") }}</td>
                                        <td>{{ $perm->name }}</td>
                                        <td width="21%">
                                            <form class="form-delete text-center" method="POST" style="display: inline-block;margin-right:5px" 
                                                action="{{ route('permissions.destroy', $perm->id) }}"> 
                                                @csrf
                                                @method('delete')
                                                <button name="delete-modal" data-toggle="tooltip" 
                                                    data-original-title="@lang('permissions.delete-btn')" 
                                                    class="btn text-white btn-danger"> 
                                                    <i class="fas fa-trash"></i> 
                                                </button>
                                            </form>  
                                            <a class="btn btn-warning" 
                                                href="{{ route('permissions.modify', $perm->id) }}" 
                                                data-toggle="tooltip" 
                                                data-original-title="@lang('permissions.update-btn')">
                                                <i class="fas fa-pencil-alt text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">{{ trans('permissions.empty') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('modals.confirm-delete')

    @include('admin.permissions.modals.new')
@stop

@section('scripts')
    <script>

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

        $('#permission-name').bind( "keyup", function() {
            $string = string_to_slug($(this).val(), '-');
            $('#permission-slug').val($string);
        });
    </script>
@stop