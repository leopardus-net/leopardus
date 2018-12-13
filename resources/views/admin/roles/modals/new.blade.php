<!-- sample modal content -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('roles.new') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="role-form" 
                    action="{{ route('roles.store') }}"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="role-name" class="control-label">{{ trans('roles.modal.name') }}</label>
                        <input type="text" name="name" class="form-control" id="role-name">
                    </div>
                    <div class="form-group">
                        <label for="role-slug" class="control-label">{{ trans('roles.modal.slug') }}</label>
                        <input type="text" name="slug" class="form-control" id="role-slug">
                    </div>
                    <div class="form-group">
                        <label for="role-route" class="control-label">{{ trans('roles.modal.route') }}</label>
                        <input type="text" name="route" value="/" class="form-control" id="role-route">
                    </div>
                </form>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('roles.modal.close') }}</button>
                <button onclick="event.preventDefault();document.getElementById('role-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('roles.modal.save') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>