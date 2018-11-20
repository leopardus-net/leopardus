<div class="col-sm-8" style="margin:auto;">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">@lang('install::first_step.title')</h4>
            <h6 class="card-subtitle mb-2 text-muted">@lang('install::first_step.subtitle')</h6>

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

            <form method="POST" class="form-horizontal form-bordered">
                @csrf
                <input name="step" type="hidden" value="{{ $step }}"/>
                <div class="form-group row">
                    <label class="control-label text-right col-md-3">@lang('install::first_step.form.lang')</label>
                    <div class="col-md-9">
                        <select name="lang" onchange="changeLang(event);">
                            <option @if($lang === 'es') selected @endif value="es">@lang('install::first_step.lang.es')</option>
                            <option @if($lang === 'en') selected @endif value="en">@lang('install::first_step.lang.en')</option>
                            <option @if($lang === 'pt') selected @endif value="pt">@lang('install::first_step.lang.pt')</option>
                        </select>
                    </div>
                </div>
                <div class="form-body">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::first_step.form.server')</label>
                        <div class="col-md-9">
                            <input type="text" name="host" placeholder="@lang('install::first_step.form.server')" class="form-control" value="localhost" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::first_step.form.user')</label>
                        <div class="col-md-9">
                            <input type="text" name="user" placeholder="@lang('install::first_step.form.user')" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::first_step.form.pass')</label>
                        <div class="col-md-9">
                            <input type="password" name="pass" placeholder="@lang('install::first_step.form.pass')" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::first_step.form.port')</label>
                        <div class="col-md-9">
                            <input type="text" nme="port" placeholder="@lang('install::first_step.form.port')" class="form-control" value="3306" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">@lang('install::first_step.form.db')</label>
                        <div class="col-md-9">
                            <input type="text" name="bd" placeholder="@lang('install::first_step.form.db')" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="pull-right">
                        <button type="submit" class="btn green">
                            <i class="fa fa-check"></i> @lang('install::first_step.form.submit')</button>
                        <a href="{{ url('/') }}" class="btn default">@lang('install::first_step.form.cancel')</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
</div>

<script>
    function changeLang(event) {
        //console.log(event.target.value);
        window.location.href = "{{ url('/install?lang=') }}" + event.target.value;
    }
</script>