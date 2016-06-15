@extends('layouts.app')

@section('title', 'Sign up')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <div class="general-title small">Create an account</div>
            <div class="box">
                <form action="{{ route('auth.register') }}" method="post" autocomplete="off">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">First name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Alex" value="{{ old('first_name') }}" autofocus>
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Smith" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you{{'@'}}domain.com" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
                        @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
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
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary btn-block">Create account</button>
                    </div>
                </form>
            </div>
            <div class="text-center">
                <ul class="list-inline">
                    <li><strong><a href="{{ route('auth.login') }}">Sign in</a></strong></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
