@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        Reset Password
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="content-wrap container">
            <form action="{{ route('password.email') }}" method="POST">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}" />

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

                    <div class="form-group text-right">
                        <input type="submit" value="Send Reset Link" class="button button-large" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
