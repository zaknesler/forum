@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1><strong>{{ $user->username }}</strong> <small>{{ $user->getFullName() }}</small></h1>
        <p>{{ $user->about }}</p>
        <hr>
        @if ($user->location)
        <p><i class="fa fa-location-arrow profile-icon" title="Location"></i> {{ $user->location }}</p>
        @endif
        <p><i class="fa fa-clock-o profile-icon" title="Member since"></i> {{ $user->created_at->diffForHumans() }}</p>
        @if ($user->website)
        <p><i class="fa fa-link profile-icon" title="Website"></i> <a href="{{ $user->website }}">{{ $user->website }}</a></p>
        @endif
        @ability ('moderator,admin,owner', 'can-see-users-email')
        <p><i class="fa fa-envelope-o profile-icon" title="User email"></i> {{ $user->email }}</p>
        @endability
    </div>
</div>
@endsection
