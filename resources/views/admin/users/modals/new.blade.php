<!-- sample modal content -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('users.modal-new.title') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="role-name" class="control-label">
                            @lang('users.modal-new.name')
                        </label>
                        <input type="text" name="name" class="form-control" id="role-name">
                    </div>
                    <div class="form-group">
                        <label for="role-email" class="control-label">
                            @lang('users.modal-new.email')
                        </label>
                        <input type="email" name="email" class="form-control" id="role-email">
                    </div>
                    <div class="form-group">
                        <label for="role-email" class="control-label">
                            @lang('users.modal-new.roles')
                        </label>
                        <select name="role" class="form-control">
                            <option selected>{{trans('users.select_role')}}</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">
                                    @lang("roles-list.$rol->name")
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role-email" class="control-label">
                            @lang('users.modal-new.lang')
                        </label>
                        <select name="lang" class="form-control">
                            <option selected>{{trans('users.select_lang')}}</option>
                            @foreach($languajes as $lang)
                                <option value="{{ $lang->id }}">
                                    @lang("languaje-list.$lang->slug")
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="role-password" class="control-label">
                            @lang('users.modal-new.password')
                        </label>
                        <input type="password" name="password" class="form-control" id="role-password">
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                    {{ trans('users.modal-new.close') }}
                </button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">
                    {{ trans('users.modal-new.save') }}
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>