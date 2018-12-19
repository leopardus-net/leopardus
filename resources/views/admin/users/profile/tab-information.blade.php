<div class="card-body">
    <div class="row">
        <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('profile.tab-information.name')</strong>
            <br>
            <p class="text-muted">{{ $user->name }}</p>
        </div>
        <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('profile.tab-information.email')</strong>
            <br>
            <p class="text-muted">{{ $user->email }}</p>
        </div>
        <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('profile.tab-information.phone')</strong>
            <br>
            <p class="text-muted">{{ ($profile) ? $profile->phone : '-' }}</p>
        </div>
        <div class="col-md-3 col-xs-6"> <strong>@lang('profile.tab-information.birthday')</strong>
            <br>
            <p class="text-muted">{{ ($profile) ? $profile->birthday : '-' }}</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('profile.tab-information.country')</strong>
            <br>
            <p class="text-muted">{{ ($profile) ? $profile->country : '-' }}</p>
        </div>
        <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('profile.tab-information.province')</strong>
            <br>
            <p class="text-muted">{{ ($profile) ? $profile->province : '-' }}</p>
        </div>
        <div class="col-md-3 col-xs-6 b-r"> <strong>@lang('profile.tab-information.city')</strong>
            <br>
            <p class="text-muted">{{ ($profile) ? $profile->city : '-' }}</p>
        </div>
        <div class="col-md-3 col-xs-6"> <strong>@lang('profile.tab-information.member_since')</strong>
            <br>
            <p class="text-muted">{{ $user->created_at }}</p>
        </div>
    </div>
    <hr>
    @if( $profile && $profile->biography )
    	<h4 class="font-medium">@lang('profile.tab-information.biography')</h4>
    	<p class="m-t-30">{{ $profile->biography }}</p>
    @endif
</div>