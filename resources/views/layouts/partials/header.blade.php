<div class="bg-white shadow">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <div class="font-medium text-2xl">
            <a href="/" class="no-underline text-indigo hover:text-indigo-darker">{{ config('app.name', 'Forum') }}</a>
        </div>

        <div class="inline -mr-4">
            @auth
                <a href="{{ route('settings.index') }}" class="no-underline text-indigo hover:text-indigo-darker mr-4">Settings</a>
                <logout path="{{ route('logout') }}" classes="no-underline text-indigo hover:text-indigo-darker mr-4"></logout>
            @else
                <a href="{{ route('login') }}" class="no-underline text-indigo hover:text-indigo-darker mr-4">Login</a>
                <a href="{{ route('register') }}" class="no-underline text-indigo hover:text-indigo-darker mr-4">Register</a>
            @endauth
        </div>
    </div>
</div>
