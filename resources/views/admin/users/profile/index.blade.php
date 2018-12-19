@extends('layouts.app')

@section('title')
	@lang('profile.title') {{ $user->name }}
@stop

@section('content')
<div class="row page-titles">
    <div class="col-md-5 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">{{ $user->name }}</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item "><a href="javascript:void(0)">{{ trans('breadcrumb.admin') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('breadcrumb.system') }}</li>
            <li class="breadcrumb-item active">{{ trans('breadcrumb.users') }}</li>
        </ol>
    </div>
    <div class="col-md-7 col-4 align-self-center">
        <div class="d-flex m-t-10 justify-content-end">
            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
				@if($member->can('users.update'))
                <a href="{{ route('admin.user-settings', $user->id) }}" class="waves-effect waves-light btn-outline-success btn-rounded btn pull-right m-l-10">
                	<i class="ti-settings"></i> @lang('profile.settings')
                </a>
				@endif
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<!-- Row -->
<div class="row">
	@if($errors->any() || session('action') || session('error'))
		<div class="col-12">
			@if(session('action'))
				<div class="alert alert-success">
					{{ trans('account.alerts.' . session('action')) }}
				</div>
			@endif
		</div>
	@endif
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> 
                	<img src="{{ asset($user->avatar ? $user->avatar . '_160.jpg' : 'assets/images/avatar.jpg') }}" class="img-circle" width="160" />
                    <h4 class="card-title m-t-10">{{ $user->name }}</h4>
                    <h6 class="card-subtitle" style="margin-bottom: 0px;">@lang('roles-list.' . $user->roles->first()->name)</h6>
                </center>
            </div>
            <div><hr></div>
            <div class="card-body" style="padding-top: 0px"> 
            	<small class="text-muted">@lang('profile.email') </small>
                <h6>{{ $user->email }}</h6> 
				@if( $user->profile )
	                <small class="text-muted p-t-30 db">@lang('profile.phone')</small>
	                <h6>{{ $user->profile->phone }}</h6> 
	                <small class="text-muted p-t-30 db">@lang('profile.address')</small>
	                <h6>{{ $user->profile->address }}</h6>
                @endif
            </div>
        </div>
    </div>
    
    <!-- tabs -->
    @if($tabs->count())
	    <div class="col-lg-8 col-xlg-9 col-md-7">
	        <div class="card" id="tabs">
	            <!-- Nav tabs -->
	            <ul class="nav nav-tabs profile-tab" id="profile-tab" role="tablist">
	            	@foreach($tabs as $item)
		                <li class="nav-item"> 
		                	<a class="nav-link tab-link" 
		                		data-url="{{ route('admin.'.$item->route, $user->id) }}"  href="#{{ $item->slug }}" role="tab">
		                		@lang('profile-tabs-list.' . $item->slug)
		                	</a> 
		                </li>
	                @endforeach
	            </ul>
	            <!-- Tab panes -->
	            <div class="tab-content">
	            	@foreach($tabs as $item)
		               	<div class="tab-pane " id="{{ $item->slug }}" role="tabpanel"></div>
	                @endforeach

	                <div class="loader-content" id="spinner">
	                	<div style="width:100%;height:100%;margin: auto;align-self: center;" class="lds-ripple"><div></div><div></div></div>
	                </div>
	            </div>
	        </div>
	    </div>
    @endif
    <!-- End tabs -->
</div>
@stop

@section('scripts')
<script>
	@if($tab = $tabSelected())
		$('#{{$tab->slug}}')
			.load("{{ route('admin.'.$tab->route, $user->id) }}", function() {
				$('#spinner').hide();
			});

		$('a[href="#{{$tab->slug}}"]').tab('show');
	@endif

	$('#tabs').on('click','.tablink,#profile-tab a',function (e) {
	    e.preventDefault();
	    let url = $(this).attr("data-url");

	    if( $(this.hash).html().length <= 0 ) {
        	$('#spinner').show();
        }

	    if (typeof url !== "undefined") {
	        let pane = $(this), href = this.hash;
	        // Mostramos el tab.
    		pane.tab('show');
	        // ajax load from data-url
	        $(href).load(url,function(result){      
	            $('#spinner').hide();
	        });
	    } else {
	        $(this).tab('show');
	        $('#spinner').hide();
	    }
	});
</script>
@stop