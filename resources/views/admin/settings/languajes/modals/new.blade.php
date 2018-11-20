<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mySmallModalLabel">
                    {{ trans('languajes.add_languaje') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body"> 
                <form id="languaje-form" 
                    action="{{ route('languajes.store') }}"
                    method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="languaje-name" class="control-label"> {{ trans('languajes.form.name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="languaje-name" required>
                    </div>

                    <div class="form-group">
                        <label for="languaje-iso" class="control-label"> {{ trans('languajes.form.iso') }}</label>
                        <input type="text" name="iso" value="{{ old('iso') }}" class="form-control" id="languaje-iso" required>
                    </div>

                    <div class="form-group">
                        <label for="languaje-icon" class="control-label"> {{ trans('languajes.form.icon') }}</label>
                        <input type="text" name="icon" value="{{ old('icon') }}" class="form-control" id="languaje-icon">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">{{ trans('languajes.form.cancel') }}</button>
                <button onclick="event.preventDefault(); document.getElementById('languaje-form').submit();" type="button" class="btn btn-danger waves-effect waves-light">{{ trans('languajes.form.submit') }}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>