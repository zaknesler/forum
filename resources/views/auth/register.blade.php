@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        Register
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="content-wrap container">
            <form action="{{ route('register') }}" method="POST">
                {{ csrf_field() }}

                <div class="form">
                    <div class="form-group{{ $errors->first('username', ' has-error') }}">
                        <div class="form-label">Username</div>

                        <input type="text" name="username" value="{{ old('username') }}" required autofocus class="form-input" />

                        @if ($errors->has('username'))
                            <div class="form-message">{{ $errors->first('username') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->first('email', ' has-error') }}">
                        <div class="form-label">E-mail</div>

                        <input type="email" name="email" value="{{ old('email') }}" required class="form-input" />

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

                    <div class="form-group{{ $errors->first('password_confirmation', ' has-error') }}">
                        <div class="form-label">Confrim Password</div>

                        <input type="password" name="password_confirmation" required class="form-input" />

                        @if ($errors->has('password_confirmation'))
                            <div class="form-message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" value="Register" class="button button-large" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
