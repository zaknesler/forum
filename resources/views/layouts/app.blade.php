<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') &middot; {{ config('app.name') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script defer src="{{ mix('/js/app.js') }}"></script>
    <script>window.Forum = {!! json_encode(['csrfToken' => csrf_token()]) !!};</script>
</head>
<body>
    <div id="root" v-cloak>
        @include('layouts.partials.header')

        @yield('banner')

        @include('flash::message')

        @include('layouts.partials.content')
    </div>
</body>
</html>
