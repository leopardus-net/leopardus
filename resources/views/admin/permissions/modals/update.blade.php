<div class="modal fade bs-update-modal-sm" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                        {{ trans('permissions.modal.update') }} @lang("roles-list.$role->name")
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                
                <form id="role-form-update" 
                    action="{{ url('admin/permissions/store/' . $role->id) }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="role-name" class="control-label">{{ trans('permissions.modal.name') }}</label>
                        <input type="text" value="@lang("roles-list.$role->name")" name="name" class="form-control" id="role-name">
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('permissions.modal.close') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form-update').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('permissions.modal.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
