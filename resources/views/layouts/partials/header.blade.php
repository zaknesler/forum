<div class="bg-white text-indigo shadow">
    <div class="container mx-auto p-4 flex flex-wrap justify-between items-center">
        <a href="{{ route('home') }}" class="font-medium text-lg md:mr-4 no-underline text-indigo hover:text-indigo-darker">{{ config('app.name', 'Forum') }}</a>

        <div class="block md:hidden">
            <button @click.prevent="responsiveNav = !responsiveNav" class="appearance-none flex items-center text-indigo no-underline">
                <svg class="fill-current text-indigo w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>

        <div :class="{'hidden': !responsiveNav}" class="w-full flex-grow -mb-4 mt-4 md:-mr-4 md:mb-0 md:mt-0 md:flex md:items-center md:w-auto">
            <div class="md:inline-flex md:items-center md:flex-grow">
                {{-- <a href="#" class="block mb-4 md:inline md:mr-4 md:mb-0 no-underline text-indigo hover:text-indigo-darker">Admin</a> --}}
            </div>

            <div class="md:inline-flex md:items-center">
                @auth
                    <a href="{{ route('settings.index') }}" class="block mb-4 md:inline md:mr-4 md:mb-0 no-underline text-indigo hover:text-indigo-darker">Settings</a>
                    <logout path="{{ route('logout') }}" classes="block mb-4 md:inline md:mr-4 md:mb-0 no-underline text-indigo hover:text-indigo-darker"></logout>
                @else
                    <a href="{{ route('login') }}" class="block mb-4 md:inline md:mr-4 md:mb-0 no-underline text-indigo hover:text-indigo-darker">Login</a>
                    <a href="{{ route('register') }}" class="block mb-4 md:inline md:mr-4 md:mb-0 no-underline text-indigo hover:text-indigo-darker">Register</a>
                @endauth
            </div>
        </div>
    </div>
</div>
