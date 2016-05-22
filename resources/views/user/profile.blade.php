@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1><strong>{{ $user->username }}</strong> <small>{{ $user->getFullName() }}</small></h1>
        <p>{{ $user->about }}</p>
        <hr>
        <div class="row">
            <div class="col-xs-9">
                @if ($user->location)
                    <p>
                        <i class="fa fa-location-arrow profile-icon" title="Location"></i>
                        {{ $user->location }}
                    </p>
                @endif
                <p>
                    <i class="fa fa-clock-o profile-icon" title="Member since"></i>
                    {{ $user->created_at->diffForHumans() }}
                </p>
                @if ($user->website)
                    <p>
                        <i class="fa fa-link profile-icon" title="Website"></i>
                        <a href="{{ $user->website }}">{{ $user->website }}</a>
                    </p>
                @endif

                @ability ('moderator,admin,owner', 'can-see-users-email')
                <p>
                    <i class="fa fa-envelope-o profile-icon" title="User email"></i>
                    {{ $user->email }}
                </p>
                @endability
            </div>
            <div class="col-xs-3">
                <div class="text-right">
                    <img src="{{ $user->avatarUrl(['size' => 250]) }}" alt="User image" class="img-responsive img-circle">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
