@extends('layouts.app')

@section('title')
	@lang('profile-settings.title')
@stop

@section('content')
<div class="row page-titles">
    <div class="col-12 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">@lang('profile-settings.title')</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('profile.breadcrumb')</a></li>
            <li class="breadcrumb-item active">{{ $user->name }}</li>
        </ol>
    </div>
</div>
<!-- Row -->
<div class="row">
	@if($errors->any() || session('error'))
		<div class="col-12">
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

			@if(session('error'))
				<div class="alert alert-danger">
					{{ trans(session('error')) }}
				</div>
			@endif
		</div>
	@endif
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class=""> 
                	<h4 class="card-title m-t-10 m-b-15">{{ $user->name }}</h4>
                	<img id="avatar-profile" src="{{ asset($user->avatar ? $user->avatar . '_250.jpg' : 'assets/images/avatar.jpg') }}" 
                		class="img-fluid img-circle" style="max-width: 160px" />
                	<div class="clearfix"></div>
                	<form name="photo" id="imageUploadForm" enctype="multipart/form-data" action="{{ route('admin.profile.upload.avatar', $user->id) }}" method="post">
                		@csrf
	                	<div class="fileupload btn btn-danger btn-rounded waves-effect waves-light m-t-15">
	                		<span><i class="ion-upload m-r-5"></i>@lang('profile-settings.upload-avatar')</span>
	                        <input type="file" name="avatar" class="upload" > 
	                    </div>
                	</form>
                </center>
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
		                		@lang('profile-settings-tabs-list.' . $item->slug)
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
	$(document).ready(function (e) {
	    $('#imageUploadForm').on('submit',(function(e) {
	        e.preventDefault();
	        var formData = new FormData(this);

	        $.ajax({
	            type:'POST',
	            url: $(this).attr('action'),
	            data:formData,
	            cache:false,
	            contentType: false,
	            processData: false,
	            success:function(data){
	                console.log("success");
	                console.log(data);

	                $('#avatar-profile').attr("src", data.image);
	            },
	            error: function(data){
	                console.log("error");
	                console.log(data);
	            }
	        });
	    }));

	    $("#imageUploadForm .upload").on("change", function() {
	        $("#imageUploadForm").submit();
	    });
	});

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
