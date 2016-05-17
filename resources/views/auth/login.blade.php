@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">Sign in</div>
                <div class="panel-body">
                    <form action="{{ route('auth.login') }}" method="post">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="you{{'@'}}domain.com" value="{{ old('email') }}">
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
                                <label><input type="checkbox" name="remember">Remember me</label>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('auth.password.email') }}">Forgot password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
