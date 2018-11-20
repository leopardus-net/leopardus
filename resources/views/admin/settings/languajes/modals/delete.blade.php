<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('modal-confirm.title') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>{{ trans('modal-confirm.confirm') }}</p>
            </div>
            <div class="modal-footer">
                <button onclick="deleteconfirm();" type="button" class="btn btn-sm btn-primary" id="delete-btn">{{ trans('modal-confirm.delete') }}</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">{{ trans('modal-confirm.close') }}</button>
            </div>
        </div>
    </div>
</div>