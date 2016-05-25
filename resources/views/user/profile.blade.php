@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1><strong>{{ $user->username }}</strong> <small>{{ $user->getFullName() }}</small></h1>
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

                        @if ($user->website)
                            <dt>Website</dt>
                            <dd><a href="{{ $user->website }}">{{ $user->website }}</a></dd>
                        @endif

                        @ability ('moderator,admin,owner', 'can-see-users-email')
                            <dt>Email</dt>
                            <dd>{{ $user->email }}</dd>
                        @endability
                    </dl>
                </h4>
            </div>
            <div class="col-xs-4">
                <div class="text-right">
                    <img src="{{ $user->avatarUrl(['size' => 250]) }}" alt="User image" class="img-responsive img-circle">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
