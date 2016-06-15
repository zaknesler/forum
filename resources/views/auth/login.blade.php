@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <div class="general-title small">Sign in</div>
            <div class="box">
                <form action="{{ route('auth.login') }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you{{'@'}}domain.com" value="{{ old('email') }}" autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox" name="remember">Keep me logged in</label>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </div>
                </form>
            </div>
            <div class="text-center">
                <ul class="list-inline">
                    <li><strong><a href="{{ route('auth.register') }}">Create account</a></strong></li>
                    <li></li>
                    <li><a href="{{ route('auth.password.email') }}">Forgot password</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
