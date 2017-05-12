<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') &middot; {{ config('app.name') }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script defer src="{{ mix('/js/app.js') }}"></script>
</head>
<body>
    <div id="root">
        @include('layouts.partials.header')

        @yield('banner')

        @include('flash::message')

        @include('layouts.partials.content')
    </div>
</body>
</html>
