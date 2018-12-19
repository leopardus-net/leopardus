<div class="card-body">
    <form action="{{ route('profile.update.settings') }}" method="POST" 
        class="form-horizontal form-bordered"  enctype="multipart/form-data"
        >
        @method('PUT')
        @csrf
        <div class="form-body">
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.name')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="name" type="text" value="{{ $user->name }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.email')
                </label>
                <div class="col-md-9">
                    <input disabled class="form-control" name="email" type="text" value="{{ $user->email }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.biography')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="biography" type="text" value="{{ data_get($profile, 'biography') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.phone')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="phone" type="text" value="{{ data_get($profile, 'phone') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.birthday')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="birthday" type="date" value="{{ data_get($profile, 'birthday') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.country')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="country" type="text" value="{{ data_get($profile, 'country') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.province')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="province" type="text" value="{{ data_get($profile, 'province') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.city')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="city" type="text" value="{{ data_get($profile, 'city') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.address')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="address" type="text" value="{{ data_get($profile, 'address') }}">
                </div>
            </div>
            <div class="form-group row">
                <label class="control-label text-right col-md-3">
                    @lang('account.form.postal_code')
                </label>
                <div class="col-md-9">
                    <input class="form-control" name="postal_code" type="text" value="{{ data_get($profile, 'postal_code') }}">
                </div>
            </div>
        </div>
        <div class="form-actions">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="offset-sm-4 col-md-8">
                            <button type="submit" class="btn btn-success"> 
                                <i class="fa fa-check"></i> @lang('account.form.submit')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>