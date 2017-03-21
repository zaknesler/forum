<div class="header">
    <div class="header-wrap container">
        <div class="header-top">
            <div class="header-brand">{{ config('app.name', 'Forum') }}</div>

            <div class="header-toggle" id="toggle">
                <a href="#"><span></span><span></span><span></span></a>
            </div>
        </div>

        <div class="header-nav" id="nav">
            <ul class="left">
                <li><a href="/">Home</a></li>
            </ul>

            <ul class="right">
                @if (auth()->guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a href="#">Account</a></li>
                    <li><a href="#" @click.prevent="logout">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
