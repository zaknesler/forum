@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        Reset Password
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="content-wrap container">
            <form action="{{ route('password.request') }}" method="POST">
                {{ csrf_field() }}

                @if ($token)
                    <input type="hidden" name="token" value="{{ $token }}" />
                @endif

                <div class="form">
                    @if (session('status'))
                        <div class="form-title">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group{{ $errors->first('email', ' has-error') }}">
                        <div class="form-label">E-mail</div>

                        <input type="email" name="email" value="{{ $email or old('email') }}" required autofocus class="form-input" />

                        @if ($errors->has('email'))
                            <div class="form-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->first('password', ' has-error') }}">
                        <div class="form-label">New Password</div>

                        <input type="password" name="password" required class="form-input" />

                        @if ($errors->has('password'))
                            <div class="form-message">{{ $errors->first('password') }}</div>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->first('password_confirmation', ' has-error') }}">
                        <div class="form-label">Confirm New Password</div>

                        <input type="password" name="password_confirmation" required class="form-input" />

                        @if ($errors->has('password_confirmation'))
                            <div class="form-message">{{ $errors->first('password_confirmation') }}</div>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <input type="submit" value="Reset Password" class="button button-large" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
