@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
    <div class="bg-grey-lighter text-grey-darker">
        <div class="container mx-auto px-4 pt-0">
            <div class="mx-auto w-full md:w-2/3 lg:w-1/3">
                <div class="mb-4 font-medium text-lg">Reset Password</div>

                <div class="bg-white border border-grey-lighter shadow rounded p-4 mb-4">
                    <form action="{{ route('password.request') }}" method="POST">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="email">
                                E-Mail
                            </label>

                            <input required tabindex="1" class="appearance-none block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('email', ' border-red') }}" id="email" type="email" name="email" value="{{ $email or old('email') }}" />

                            @if ($errors->has('email'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('email') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password">
                                New Password
                            </label>

                            <input required tabindex="2" class="appearance-none block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password', ' border-red') }}" id="password" type="password" name="password" />

                            @if ($errors->has('password'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('password') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password_confirmation">
                                Confirm New Password
                            </label>

                            <input required tabindex="3" class="appearance-none block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password_confirmation', ' border-red') }}" id="password_confirmation" type="password" name="password_confirmation" />

                            @if ($errors->has('password_confirmation'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>

                        <div class="text-right">
                            <button tabindex="4" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
