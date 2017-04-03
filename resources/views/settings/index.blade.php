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
        <div class="col col-md-7 col-xs-12">
            <div class="box">
                <div class="box-header">Profile</div>
                <div class="box-body">
                    @include('settings.partials.profile')
                </div>
            </div>

            <div class="box">
                <div class="box-header">Password</div>
                <div class="box-body">
                    @include('settings.partials.password')
                </div>
            </div>
        </div>

        <div class="col col-md-5 col-xs-12">
            <div class="box">
                <div class="box-header">Avatar</div>
                <div class="box-body">
                    @include('settings.partials.avatar')
                </div>
            </div>
        </div>
    </div>
@endsection
