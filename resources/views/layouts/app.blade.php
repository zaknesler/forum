<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Home') &middot; {{ config('app.name') }}</title>

        <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
        <script defer src="{{ mix('/js/app.js') }}"></script>
        <script>window.Forum = {!! json_encode(['csrfToken' => csrf_token()]) !!};</script>

        @yield('head')
    </head>
    <body class="relative leading-normal font-sans font-normal min-w-full min-h-full text-grey-darker bg-grey-lighter">
        <div id="root">
            @include('flash::message')

            @include('layouts.partials.header')

            @yield('content')
        </div>

        <!-- Modal -->
        <div class="hidden z-50 fixed pin p-4 bg-indigo text-white">
            <div class="absolute pin-t pin-r m-4">
                <a href="#" class="no-underline">
                    <svg class="fill-current text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                </a>
            </div>

            <div class="flex flex-wrap items-center justify-center h-full w-full">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt corporis natus fugiat illum ab quod, aut, asperiores eos, tempore nam officia ex velit saepe ea dicta rem quo eligendi repudiandae!
            </div>
        </div>
    </body>
</html>
