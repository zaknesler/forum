@extends('layouts.app')

@section('title', 'Profile settings')

@section('content')
<div class="container">
    <div class="row">
        @if (auth()->user()->hasRole(['admin', 'owner']))
        <div class="col-md-8">
        @else
        <div class="col-md-8 col-md-offset-2">
        @endif
            <div class="general-title small">Update user profile</div>
            <div class="box">
                <form action="{{ route('user.edit', ['id' => $user->id]) }}" method="post" autocomplete="off" id="has-upload">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name">First name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Alex" value="{{ $user->first_name }}">
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
                                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Smith" value="{{ $user->last_name }}">
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
                                <input type="text" class="form-control" name="location" id="location" placeholder="London, England" value="{{ $user->location }}">
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="website">Website url</label>
                                <input type="url" class="form-control" name="website" id="website" placeholder="https://google.com" value="{{ $user->website }}">
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
                                <textarea name="about" class="form-control" id="about" maxlength="300" cols="10" rows="5">{{ $user->about }}</textarea>
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
                        <button type="submit" class="btn btn-primary">Update user</button>
                    </div>
                </form>
            </div>
        </div>
        @role (['admin', 'owner'])
            <div class="col-md-4">
                @role (['admin', 'owner'])
                    <div class="general-title small">Update user password</div>
                    <div class="box">
                        <form action="{{ route('user.edit.password', ['id' => $user->id]) }}" method="post" autocomplete="off">
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
                    <div class="general-title small">Update user's privacy</div>
                    <div class="box">
                        <form action="{{ route('user.edit.privacy', ['id' => $user->id]) }}" method="post" autocomplete="off">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="view_profile" @if ($user->view_profile) checked="checked" @endif>Keep profile private</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="view_profile_email" @if ($user->view_profile_email) checked="checked" @endif>Show email on profile</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update settings</button>
                                {!! csrf_field() !!}
                            </div>
                        </form>
                    </div>
                    @if (auth()->user()->id !== $user->id)
                        <div class="general-title small">Suspension actions</div>
                        <div class="box">
                            @if ($user->suspended)
                                <form action="{{ route('user.edit.unsuspend', ['id' => $user->id]) }}" method="post">
                                    <button type="submit" class="btn btn-info">Unsuspend user</button>
                                    {!! csrf_field() !!}
                                </form>
                            @else
                                <form action="{{ route('user.edit.suspend', ['id' => $user->id]) }}" method="post">
                                    <button type="submit" class="btn btn-danger">Suspend user</button>
                                    {!! csrf_field() !!}
                                </form>
                            @endif
                        </div>
                    @endif
                @endrole
                @role (['owner'])
                <div class="general-title small">Update user role</div>
                    <div class="box">
                        <form action="{{ route('user.edit.role', ['id' => $user->id]) }}" method="post" autocomplete="off" id="swal-confirm-submit">
                            <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if (($user->roles->first()->id == $role->id) || (old('role') == $role->id)) selected @endif>{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                {!! csrf_field() !!}
                                <button type="submit" class="btn btn-primary">Change role</button>
                            </div>
                        </form>
                    </div>
                @endrole
            </div>
        @endrole
    </div>
</div>
@endsection
