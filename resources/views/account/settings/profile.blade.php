@extends('layouts.app')

@section('title', 'Profile settings')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="general-title small">Update profile settings</div>
            <div class="box">
                <form action="{{ route('account.settings.profile') }}" method="post" autocomplete="off" id="has-upload">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name">First name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Alex" value="{{ Auth::user()->first_name }}">
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
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Smith" value="{{ Auth::user()->last_name }}">
                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location" id="location" placeholder="London, England" value="{{ Auth::user()->location }}">
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="website">Website url</label>
                                <input type="url" class="form-control" name="website" id="website" placeholder="https://google.com" value="{{ Auth::user()->website }}">
                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                <label for="about">About you</label>
                                <textarea name="about" class="form-control" id="about" maxlength="300" cols="10" rows="5">{{ Auth::user()->about }}</textarea>
                                @if ($errors->has('about'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Profile image</label><br />
                                <input type="hidden" class="form-control" data-images-only name="image" id="image" role="uploadcare-uploader" data-crop="disabled" data-path-value="false" />
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary">Update profile</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="general-title small">Change password</div>
            <div class="box">
                <form action="{{ route('account.settings.password') }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                        <label for="old_password">Old password</label>
                        <input type="password" class="form-control" name="old_password" id="old_password">
                        @if ($errors->has('old_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">New password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation">Confirm new password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Change password</button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
