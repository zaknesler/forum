@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex flex-wrap flex-col lg:flex-row -m-4">
            <div class="w-full lg:w-1/3 p-4">
                @include('settings.partials.profile')
            </div>

            <div class="w-full lg:w-1/3 p-4">
                @include('settings.partials.password')
            </div>

            <div class="w-full lg:w-1/3 p-4">
                @include('settings.partials.avatar')

                <div class="mt-8">
                    @include('settings.partials.privacy')
                </div>
            </div>
        </div>
    </div>
@endsection
