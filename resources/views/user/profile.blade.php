@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="jumbotron">
        @if ($user->view_profile || Auth::user()->hasRole(['moderator', 'admin', 'owner']))
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
            @role (['owner', 'admin'])
                <h4><a href="{{ route('user.edit', ['id' => $user->id]) }}" class="label label-warning">Edit</a></h4>
                <h4><span class="label label-info">User's profile is private</span></h4>
            @endrole
        @else
            <h3 class="text-muted">This user's profile is private.</h3>
        @endif
    </div>
</div>
@endsection
