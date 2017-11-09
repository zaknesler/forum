@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap flex-col-reverse md:flex-row -mx-4">
            <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                @include('settings.partials.profile')
            </div>

            <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                @include('settings.partials.password')
            </div>

            <div class="w-full md:w-1/2 lg:w-1/3 px-4">
                @include('settings.partials.avatar')
            </div>
        </div>
    </div>

    <div class="hidden row">
        <div class="col col-md-7 col-xs-12">
            <div class="box">
                <div class="box-header display-flex">
                    <span>Profile</span>

                    <span><a href="{{ route('users.show', $user->username) }}">View Profile</a></span>
                </div>

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
                <div class="box-header display-flex">
                    <span>Avatar</span>

                    @if (auth()->user()->avatar)
                        <span><avatar-delete></avatar-delete></span>
                    @endif
                </div>

                <div class="box-body">
                    @include('settings.partials.avatar')
                </div>
            </div>
        </div>
    </div>
@endsection
