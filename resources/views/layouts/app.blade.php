<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Home') &middot; {{ config('app.name', 'Laravel') }}</title>

        <link href="{{ elixir('assets/css/app.css') }}" rel="stylesheet">

        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body>
        @include('layouts.partials.navbar')

        @include('layouts.partials.flash')

        @yield('content')

        <script src="{{ elixir('assets/js/app.js') }}"></script>

        @yield('scripts')
    </body>
</html>
