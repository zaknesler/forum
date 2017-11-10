@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mx-auto w-full md:w-2/3 lg:w-1/3">
            <div class="font-medium text-lg mb-4">Register</div>

            <div class="bg-white border border-grey-lighter shadow rounded p-4">
                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="mb-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="username">
                            Username
                        </label>

                        <input required autofocus tabindex="1" autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('username', ' border-red') }}" id="username" type="text" name="username" value="{{ old('username') }}" />

                        @if ($errors->has('username'))
                            <div class="text-red font-medium mt-2">{{ $errors->first('username') }}</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="email">
                            E-Mail
                        </label>

                        <input required tabindex="2" autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('email', ' border-red') }}" id="email" type="email" name="email" value="{{ old('email') }}" />

                        @if ($errors->has('email'))
                            <div class="text-red font-medium mt-2">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password">
                            Password
                        </label>

                        <input required tabindex="3" autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password', ' border-red') }}" id="password" type="password" name="password" />

                        @if ($errors->has('password'))
                            <div class="text-red font-medium mt-2">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password_confirmation">
                            Confirm Password
                        </label>

                        <input required tabindex="4" autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password_confirmation', ' border-red') }}" id="password_confirmation" type="password" name="password_confirmation" />

                        @if ($errors->has('password_confirmation'))
                            <div class="text-red font-medium mt-2">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <div class="text-right">
                        <button tabindex="5" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
