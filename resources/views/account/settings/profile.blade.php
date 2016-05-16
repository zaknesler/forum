@extends('layouts.app')

@section('title', 'Profile settings')

@section('breadcrumb')
    <li><a href="{{ route('home') }}">Home</a></li>
    <li><a href="{{ route('home') }}">Account</a></li>
    <li class="active">Profile settings</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update profile</div>
                <div class="panel-body">
                    <form action="{{ route('account.settings.profile') }}" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name">Display name</label>
                                    <input type="text" class="form-control" name="name" id="name" name="Alex Smith" value="{{ Auth::user()->name }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
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
                            
                            <div class="col-lg-6">
                                <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                    <label for="about">About you</label>
                                    <textarea name="about" class="form-control" id="about" maxlength="240" cols="10" rows="4">{{ Auth::user()->about }}</textarea>
                                    @if ($errors->has('about'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('about') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">Update profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
