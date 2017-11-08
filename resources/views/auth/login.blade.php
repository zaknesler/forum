@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="bg-grey-lighter text-grey-darker">
        <div class="container mx-auto px-4 pt-0">
            <div class="mx-auto w-full md:w-2/3 lg:w-1/3">
                <div class="mb-4 font-medium text-lg">Login</div>

                <div class="bg-white border border-grey-lighter shadow rounded p-4 mb-4">
                    <form action="{{ route('login') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="email">
                                E-Mail Address
                            </label>

                            <input required autofocus tabindex="1" class="appearance-none block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('email', ' border-red') }}" id="email" type="email" name="email" placeholder="example@domain.com" value="{{ old('email') }}" />

                            @if ($errors->has('email'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password">
                                Password
                            </label>

                            <input required tabindex="2" class="appearance-none block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password', ' border-red') }}" id="password" type="password" name="password" />

                            @if ($errors->has('password'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="flex justify-between items-center">
                            <label for="remember" class="flex items-center select-none">
                                <input tabindex="3" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />

                                <span class="ml-2">Keep me signed in</span>
                            </label>

                            <button tabindex="4" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Login</button>
                        </div>
                    </form>
                </div>

                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-indigo hover:text-indigo-dark no-underline">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
