<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img style="max-width: 48px;" src="{{ asset( $settings->logo_icon ? $settings->logo_icon : 'assets/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img style="max-width: 48px;" src="{{ asset( $settings->logo_icon ? $settings->logo_icon : 'assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="{{ asset( $settings->logo_text ? $settings->logo_text : 'assets/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo text -->    
                    <img src="{{ asset( $settings->logo_text ? $settings->logo_text : 'assets/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                </span>
            </a>
        </div>
       
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0">
                <!-- This is  -->
                <li class="nav-item">
                    <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
                <!-- Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset(auth()->user()->avatar ? auth()->user()->avatar . '_60.jpg': 'assets/images/avatar.jpg') }}" alt="user" class="profile-pic" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        <ul class="dropdown-user" style="width: auto;min-width: 295px">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-img"><img src="{{ asset(auth()->user()->avatar ? auth()->user()->avatar . '_160.jpg' : 'assets/images/avatar.jpg') }}" alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ auth()->user()->name }}</h4>
                                        <p class="text-muted" style="margin-top: 5px">{{ auth()->user()->email }}</p>
                                        <a href="{{ route('profile') }}" style="margin-top: 4px;margin-bottom: 0px" class="btn btn-rounded btn-danger btn-sm">
                                            {{ trans('header.view-profile') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                            @foreach($headerProfileItems as $profileItem)
                                @if($profileItem->type === 1)
                                    <li role="separator" class="divider"></li>   
                                @else
                                    <li>
                                        <a href="{{ $profileItem->url }}">
                                            @if($profileItem->icon)
                                                <i class="ti-settings"></i>
                                            @endif 
                                            {{ trans("header-profile-items-list." . $profileItem->slug) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="{{ route('profile.settings') }}">
                                    <i class="ti-settings"></i> {{ trans('header.account-settings') }}
                                </a>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> {{ trans('header.logout') }}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Language -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                        <i @if( $selectedLang->icon ) 
                            class="{{ $selectedLang->icon }}" 
                        @else 
                            class="flag-icon flag-icon-{{ $selectedLang->iso }}" 
                        @endif></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right scale-up">
                        @foreach( $languajes as $lang ) 
                            <a class="dropdown-item" href="{{ url("lang/$lang->iso") }}">
                                <i @if( $lang->icon) 
                                        class="{{ $lang->icon }}" 
                                    @else 
                                        class="flag-icon flag-icon-{{ $lang->iso }}" 
                                    @endif></i> 
                                @lang("languaje-list.$lang->slug")
                            </a>
                        @endforeach
                    </div>
                </li>

                
            </ul>
        </div>
    </nav>
</header>