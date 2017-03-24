@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Settings
        </div>
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xs-12">
            @include('settings.partials.profile')
        </div>

        <div class="col-md-6 col-xs-12">
            @include('settings.partials.password')
        </div>
    </div>
@endsection
