<div class="card-body">
<form action="{{ route('profile.update.password') }}" method="POST" 
        class="form-horizontal form-bordered">
        @method('PUT')
        @csrf
        <div class="form-body">
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.security.form.old_password')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="old" type="password">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.security.form.new_password')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="password" type="password">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.security.form.repeat_password')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="password_confirmation" type="password">
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="offset-sm-4 col-md-8">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> @lang('account.security.form.submit')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>