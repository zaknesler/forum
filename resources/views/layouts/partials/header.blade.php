<div class="header">
    <div class="header-wrap container">
        <div class="header-top">
            <div class="header-brand">
                <a href="/">{{ config('app.name', 'Forum') }}</a>
            </div>

            <div class="header-toggle">
                <a href="#" @click.prevent="responsiveNavVisible = !responsiveNavVisible"><span></span><span></span><span></span></a>
            </div>
        </div>

        <div class="header-nav" :class="{ visible: responsiveNavVisible }">
            <ul class="left"></ul>

            <ul class="right">
                @if (auth()->guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li>{{ auth()->user()->getNameOrUsername() }}</li>
                    <li><a href="{{ route('settings.index') }}">Settings</a></li>
                    <li><a href="#" @click.prevent="logout">Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>
