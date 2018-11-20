@extends('layouts.auth')

@section('title')
    @lang('login.title')
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
            <div class="card-body" style="overflow:auto">
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
                <form class="form-horizontal form-material" id="loginform" method="POST" action="{{ route('login') }}">
                    @csrf
                    <a href="{{ url('/') }}" class="text-center db">
                        <img src="{{ asset( $settings->logo_icon ? $settings->logo_icon : '/assets/images/logo-icon.png') }}" alt="Logo" /><br/>
                        <img src="{{ asset(  $settings->logo_text ? $settings->logo_text : '/assets/images/logo-text.png') }}" alt="Logo" />
                    </a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="email" required="" 
                                    placeholder="@lang('login.placeholder.email')">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" required="" 
                                    placeholder="@lang('login.placeholder.password')">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex no-block align-items-center">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup"> @lang('login.remember') </label>
                            </div>
                            <div class="ml-auto">
                                <a href="javascript:void(0)" id="to-recover" class="text-muted">
                                    <i class="fa fa-lock m-r-5"></i> @lang('login.forgot_pass')
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ trans('login.submit') }}</button>
                        </div>
                    </div>
                    
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            {{ trans('login.have_account') }} <a href="{{ url('/register') }}" class="text-primary m-l-5"><b>{{ trans('login.register') }}</b></a>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>{{ trans('login.recover.forgot') }}</h3>
                            <p class="text-muted">{{ trans('login.recover.text') }}</p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="email" required="" placeholder="{{ trans('login.recover.email') }}">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">{{ trans('login.recover.submit') }}</button>
                        </div>
                    </div>
                </form>
                <div class="mt-4 w-100"></div>
            </div>
        </div>
    </section>
@endsection
