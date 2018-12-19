@extends('layouts.app')

@section('title')
    {{ trans('users.title') }}
@stop

@section('content')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 col-12 align-self-center">
        <h3 class="text-themecolor">{{ trans('users.title') }}</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('breadcrumb.system') }}</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                <button data-toggle="modal" id="newUser" data-target=".bs-example-modal-sm" class="waves-effect waves-light btn-outline-success btn-rounded btn pull-right m-l-10"><i class="ti-plus"></i> @lang('users.new-user')</button>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
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

        @if(session('action'))
            <div class="alert alert-success">
                {{ trans('currency::currency.alerts.' . session('action')) }}
            </div>
        @endif

        <div class="card">
            <!-- .left-right-aside-column-->
            <div class="contact-page-aside">
                <!-- .left-aside-column-->
                <div class="left-aside">
                    <ul class="list-style-none">
                        <li class="box-label">
                        	<a href="{{ url('admin/users') }}">
                        		@lang('users.all-users') <span>{{ $user_all_count }}</span>
                        	</a>
                        </li>
                        <li class="divider"></li>
                        @foreach($roles as $role)
                        	<li class="active">
                        		<a href="{{ url('/admin/users?role=' . $role->name) }}">
                        			@lang("roles-list.$role->name") <span>{{ $role->user_count }}</span>
                        		</a>
                        	</li>
                        @endforeach
                        
                    </ul>
                </div>
                <!-- /.left-aside-column-->
                <div class="right-aside">
                    <div class="right-page-header">
                        <div class="d-flex">
                            <div class="align-self-center">
                                <h4 class="card-title m-t-10">@lang('users.list-users') </h4></div>
                            <div class="ml-auto">
                                <input type="text" id="demo-input-search2" placeholder="search contacts" class="form-control"> </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('users.table.name')</th>
                                    <th>@lang('users.table.email')</th>
                                    <th>@lang('users.table.phone')</th>
                                    <th>@lang('users.table.role')</th>
                                    <th>@lang('users.table.age')</th>
                                    <th>@lang('users.table.join-date')</th>
                                    <th>@lang('users.table.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@forelse( $users as $user )
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <a href="{{ route('admin.user-details', $user->id) }}">
                                        	<img src="{{ asset($user->avatar ? $user->avatar . '_60.jpg': 'assets/images/avatar.jpg') }}" 
                                        		alt="user" class="img-circle" /> 
                                        	{{ $user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ ($user->profile) ? $user->profile->phone : ''}}</td>
                                    <td>
										<form method="POST" style="width: auto;" 
											action="{{ route('users.change-role') }}" 
			                            	id="select_role-{{$user->id}}">
				                            @csrf
				                            <input type="hidden" name="user_id" value="{{ $user->id }}">
				                                <select name="role" style="width: 180px;"
				                                    onchange="send_role('#select_role-{{$user->id}}');">
				                                    <option>{{trans('users.select_role')}}</option>
				                                    @foreach($roles as $rol)
				                                        <option value="{{ $rol->id }}" @if( $user->roles->first() && $user->roles->first()->id == $rol->id ) selected @endif>
				                                            @lang("roles-list.$rol->name")
				                                        </option>
				                                    @endforeach
				                                </select>
				                         </form>
                                    </td>
                                    <td>{{ ($user->profile) ? $user->profile->age : '' }}</td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" onclick="$('#deleteform{{$user->id}}').click();" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                        <a href="{{ route('admin.user-settings', $user->id) }}" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" onclick="$('#deleteform{{$user->id}}').click();" data-toggle="tooltip" data-original-title="Settings"><i class="ti-settings" aria-hidden="true"></i></a>
                                        <form  method="POST" action="{{ route('users.destroy', $user->id )}}"><button id="deleteform{{$user->id}}" type="submit" hidden="hidden"></button>
		                                @csrf</form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center text-danger">@lang('users.table.empty')</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="text-right">
                                            {{ $users->links() }}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- .left-aside-column-->
                </div>
                <!-- /.left-right-aside-column-->
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- MODALS -->
<!-- ============================================================== -->
@include('admin.users.modals.new')
@stop

@section("scripts")
    <script type="text/javascript">
        var send_role = function (select) {
            $(select).submit();
        }
    </script>
@stop