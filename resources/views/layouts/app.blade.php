<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title', 'Home') | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">{{ env('APP_NAME') }}</a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                @ability ('moderator,admin,owner', 'moderation-dropdown')
                    <!-- <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Moderation <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                
                            </ul>
                        </li>
                    </ul> -->
                @endability
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ route('auth.register') }}">Sign up</a></li>
                        <li><a href="{{ route('auth.login') }}">Sign in</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->getFullNameOrUsername() }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('account.settings.profile') }}"><i class="fa fa-btn fa-pencil-square-o"></i> Edit account</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('auth.logout') }}"><i class="fa fa-btn fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        hljs.initHighlightingOnLoad();
        @if (notify()->ready())
            swal({
                title: "{!! notify()->message() !!}",
                text: "{!! notify()->option('text') !!}",
                type: "{{ notify()->type() }}",
                @if (notify()->option('timer'))
                    timer: "{{ notify()->option('timer') }}",
                @endif
            });
        @endif
    </script>
    @yield('footer')
</body>
</html>
