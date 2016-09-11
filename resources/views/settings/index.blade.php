@extends('layouts.app')

@section('title', 'Settings')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Profile Settings

                        <div class="pull-right text-muted">
                            <a href="{{ route('users.show', $user->username) }}">{{ '@' . $user->username }}</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <form role="form" method="POST" action="{{ route('settings.profile.update') }}" class="form-horizontal">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->first('name', ' has-error') }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $user->name }}" autofocus />

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->first('email', ' has-error') }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ?? $user->email }}" autofocus />

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Avatar Settings</div>

                    <div class="panel-body">
                        <p>
                            By default, your avatar is pulled in via <a href="https://gravatar.com">Gravatar</a> using your current e-mail address.
                        </p>

                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <p>
                                    <img src="{{ $user->getAvatar(200) }}" alt="Avatar" class="img-responsive center-block" />
                                </p>
                            </div>
                        </div>

                        <form role="form" method="POST" action="{{ route('settings.avatar.update') }}">

                            {{ csrf_field() }}

                            <hr>

                            <div class="form-group{{ $errors->first('avatar', ' has-error') }}">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <input type="hidden" name="avatar" id="avatar" role="uploadcare-uploader" data-crop="disabled" data-path-value="false" data-images-only="" />

                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="form-group clearfix">
                                <button type="submit" class="btn btn-primary pull-left">
                                    Update Avatar
                                </button>

                                @if ($user->avatar)
                                    <a href="#" onclick="event.preventDefault();document.getElementById('avatar-delete-form').submit();" class="btn btn-danger pull-right" title="Delete current avatar and revert back to Gravatar.">
                                        Delete
                                    </a>
                                @endif
                            </div>
                        </form>

                        @if ($user->avatar)
                            <form role="form" method="POST" action="{{ route('settings.avatar.destroy') }}" id="avatar-delete-form" style="display: none;">
                                {{ csrf_field() }}

                                {{ method_field('DELETE') }}
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        UPLOADCARE_LOCALE = "en";
        UPLOADCARE_LIVE = false;
        UPLOADCARE_TABS = "file url";
        UPLOADCARE_PUBLIC_KEY = "{{ config('uploadcare.public_key') }}";
    </script>
    <script src="//ucarecdn.com/widget/2.9.0/uploadcare/uploadcare.full.min.js"></script>
@endsection
