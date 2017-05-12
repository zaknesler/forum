@extends('layouts.app')

@section('title', 'Reset Password')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Reset Password
        </div>
    @endcomponent
@endsection

@section('content')
    <div class="row center-md">
        <div class="col col-md-8 col-xs-12">
            <form action="{{ route('password.email') }}" method="POST">
                {{ csrf_field() }}

                <div class="form">
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
