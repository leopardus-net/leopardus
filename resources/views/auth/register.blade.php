@extends('layouts.auth')

@section('title')
    @lang('register.title')
@stop

@section('content')
  <style>
        .background-gradient {
            background: #f62d51;
            background: -moz-linear-gradient(left, #f62d51 0%, #660fb5 100%);
            background: -webkit-linear-gradient(left, #f62d51 0%, #660fb5 100%);
            background: linear-gradient(to right, #f62d51 0%, #660fb5 100%);
        }

        .logo-content {
            position: absolute;
            top:0;
            left:0;
            width:calc(100% - 400px);
            height: 100%
        }

        .logo-text {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            font-size:5em;
            font-weight: 800;
            font-family: Arial;
            text-transform: uppercase;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
  <section id="wrapper" class="login-register login-sidebar background-gradient">
      <div class="logo-content">
          <div class="logo-text text-white">
              <span class="d-none d-sm-none d-md-block">{{ $settings->name }}</span>
          </div>
      </div>
      <div class="login-box card">
        <div class="card-body" style="overflow: auto;">
          @if($errors->any())
              <div class="alert alert-danger">
                  <ul class="no-margin" style="margin: 0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              <br>
          @endif
          <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('register') }}">
            @csrf
            <a href="{{ url('/') }}" class="text-center db">
                <img src="{{ asset( $settings->logo_icon ? $settings->logo_icon : '/assets/images/logo-icon.png') }}" alt="Logo" /><br/>
                <img src="{{ asset(  $settings->logo_text ? $settings->logo_text : '/assets/images/logo-text.png') }}" alt="Logo" />
            </a>
            <h3 class="box-title m-t-40 m-b-0">{{ trans('register.form.now') }}</h3><small>{{ trans('register.form.text') }}</small> 
            <div class="form-group m-t-20">
              <div class="col-xs-12">
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" autofocus placeholder="{{ trans('register.form.name') }}">
              </div>
            </div>
            <div class="form-group ">
              <div class="col-xs-12">
                <input class="form-control" type="text" name="email" value="{{ old('email') }}" required="" placeholder="{{ trans('register.form.email') }}">
              </div>
            </div>
            <div class="form-group ">
              <div class="col-xs-12">
                <input class="form-control" type="password" name="password" required="" placeholder="{{ trans('register.form.pass') }}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                <input class="form-control" type="password" required="" name="password_confirmation" placeholder="{{ trans('register.form.confirm_pass') }}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-12">
                  <select class="form-control" required="" name="lang" >
                    <option value="">@lang('register.select-lang')</option>
                    @foreach( $languajes as $lang)
                      <option value="{{ $lang->id }}">@lang("languaje-list.$lang->slug")</option>
                    @endforeach
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="">
                <div class="checkbox checkbox-primary p-t-0">
                  <input name="terms" value="1" id="checkbox-signup" type="checkbox">
                  <label for="checkbox-signup">{{ trans('register.form.accept_terms') }} 
                    <a href="{{ url('terms') }}">{{ trans('register.terms') }}</a>
                  </label>
                </div>
              </div>
            </div>
            <div class="form-group text-center m-t-20">
              <div class="col-xs-12">
                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ trans('register.submit') }}</button>
              </div>
            </div>
            <div class="form-group m-b-0">
              <div class="col-sm-12 text-center">
                {{ trans('register.have_account') }} <a href="{{ url('login') }}" class="text-info m-l-5"><b>{{ trans('register.identificate') }}</b></a>
              </div>
            </div>
          </form>

          <div class="mt-4 w-100"></div>
        </div>
      </div>
  </section>
@endsection
