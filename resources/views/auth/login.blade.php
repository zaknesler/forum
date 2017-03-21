@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        Login
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="content-wrap container">
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <div class="form">
                    <div class="form-group{{ $errors->first('email', ' has-error') }}">
                        <div class="form-label">E-mail</div>

                        <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" />

                        @if ($errors->has('email'))
                            <div class="form-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->first('password', ' has-error') }}">
                        <div class="form-label">Password</div>

                        <input type="password" name="password" required class="form-input" />

                        @if ($errors->has('password'))
                            <div class="form-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" value="Login" class="button button-large" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
