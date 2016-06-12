@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1><strong>{{ $user->getFullName() }} </strong> <small>{{ '@' . $user->username }}</small></h1>
        <p>{{ $user->about }}</p>
        <hr>
        <div class="row">
            <div class="col-xs-8">
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
                        @role (['moderator', 'admin', 'owner'])
                            <dt>Email</dt>
                            <dd>{{ $user->email }}</dd>
                        @endrole
                    </dl>
                </h4>
            </div>
            <div class="col-xs-4">
                <div class="pull-right">
                    <img src="{{ $user->avatarUrl(['size' => 250]) }}" alt="User image" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
