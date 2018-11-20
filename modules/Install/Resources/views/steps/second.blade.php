<div class="col-sm-8" style="margin:auto;">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('install::second_step.title')</h4>
            <h6 class="card-subtitle mb-2 text-muted">@lang('install::second_step.subtitle')</h6>

            <div class="row mb-3 mt-3" style="border-bottom: 1px solid rgba(120, 130, 140, 0.13);"></div>
            
            <!-- BEGIN FORM-->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="row mb-3 mt-3" style="border-bottom: 1px solid rgba(120, 130, 140, 0.13);"></div>
            @endif

            <!-- BEGIN FORM-->
            <form method="POST" class="form-horizontal form-bordered">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <input name="step" type="hidden" value="{{ $step }}"/>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.title.label')</label>
                        <div class="col-md-9">
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="@lang('install::second_step.form.title.placeholder')" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.slogan.label')</label>
                        <div class="col-md-9">
                            <input type="text" name="slogan" value="{{ old('slogan') }}" placeholder="Slogan del sitio web" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.url.label')</label>
                        <div class="col-md-9">
                            <input type="text" name="url" value="{{ old('url') ? old('url') : url('/') }}" placeholder="@lang('install::second_step.form.url.placeholder')" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.description.label')</label>
                        <div class="col-md-9">
                            <textarea name="description" value="{{ old('description') }}" class="form-control" placeholder="@lang('install::second_step.form.description.placeholder')" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.name.label')</label>
                        <div class="col-md-9">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="@lang('install::second_step.form.name.placeholder')" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.email.label')</label>
                        <div class="col-md-9">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="@lang('install::second_step.form.email.placeholder')" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.password.label')</label>
                        <div class="col-md-9">
                            <input type="password" name="password" placeholder="@lang('install::second_step.form.password.placeholder')" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::second_step.form.password-confirm.label')</label>
                        <div class="col-md-9">
                            <input type="password" name="password_confirmation" placeholder="@lang('install::second_step.form.password-confirm.placeholder')" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="pull-right">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> @lang('install::second_step.form.submit')</button>
                        <a href="{{ url('/') }}" class="btn default">@lang('install::second_step.form.cancel')</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
            <!-- END FORM-->
    </div>
</div>