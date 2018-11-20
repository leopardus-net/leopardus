@extends('install::layouts.master')

@section('title')
    @lang('install::page.title')
@endsection

@section('content')
    <div class="container">
		<h1 class="text-center" style="margin: 40px 0">Leopardus <strong>v{{ $settings->version }}</strong></h1>
        
        @switch($step)
            @case(1)
                @include('install::steps.first')
                @break

            @case(2)
                @include('install::steps.second')
                @break

            @default
                @include('install::steps.first')
        @endswitch
    </div>
@stop
