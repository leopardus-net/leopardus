<!-- sample modal content -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('permissions.new') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('permissions.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="permission-name" class="control-label">{{ trans('permissions.modal.name') }}</label>
                        <input type="text" name="name" class="form-control" id="permission-name">
                    </div>
                    <div class="form-group">
                        <label for="permission-name" class="control-label">{{ trans('permissions.modal.slug') }}</label>
                        <input type="text" name="slug" class="form-control" id="permission-slug">
                    </div>
                    <div class="form-group">
                        <label for="permission-group" class="control-label">
                            @lang('permissions.modal.group')
                        </label>
                        <select id="permission-group" name="group" class="form-control">
                            <option selected>{{ trans('permissions.modal.select-group') }}</option>
                            @foreach($permissions as $group)
                                <option value="{{ $group->id }}">
                                    {{ trans('permissions-group-list.' . $group->slug) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('permissions.modal.close') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('permissions.modal.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>