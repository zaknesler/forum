@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="jumbotron">
        @if ($user->profileIsNotPrivate() || Auth::user()->hasRole(['moderator', 'admin', 'owner']))
            @if ($user->suspended)
                <div class="alert alert-danger">
                    User has been suspended.
                </div>
            @endif
            <h1><strong>{{ $user->getFullName() }} </strong> <small>{{ '@' . $user->username }}</small></h1>
            <p>{{ $user->about }}</p>
            <hr>
            <div class="row">
                <div class="col-xs-7">
                    <h4>
                        <dl class="spaced">
                            @if ($user->location)
                                <dt>Location</dt>
                                <dd>{{ $user->location }}</dd>
                            @endif
                            <dt>Joined</dt>
                            <dd>{{ $user->created_at->diffForHumans() }}</dd>
                            @if ($user->last_login_at)
                                <dt>Last login</dt>
                                <dd>{{ $user->last_login_at->diffForHumans() }}</dd>
                            @endif
                            @if ($user->website)
                                <dt>Website</dt>
                                <dd><a href="{{ $user->website }}">{{ $user->website }}</a></dd>
                            @endif
                            @if ($user->view_profile_email || Auth::user()->hasRole(['moderator', 'admin', 'owner']))
                                <dt>Email</dt>
                                <dd>{{ $user->email }}</dd>
                            @endif
                        </dl>
                    </h4>
                </div>
                <div class="col-xs-5">
                    <div class="pull-right">
                        <img src="{{ $user->avatarUrl(['size' => 250]) }}" alt="User image" class="img-responsive">
                    </div>
                </div>
            </div>
            @role (['admin', 'owner'])
                <h4><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="label label-warning">Edit</a></h4>
                @if ($user->profileIsPrivate())
                    <h4><span class="label label-info">User's profile is private</span></h4>
                @endif
            @endrole
        @else
            <h2 class="text-muted"><strong>Oops!</strong></h2>
            <h3 class="text-muted">This user's profile is private.</h3>
            <hr>
            <p><a href="{{ route('home') }}">Return home</a></p>
        @endif
    </div>
</div>
@endsection
