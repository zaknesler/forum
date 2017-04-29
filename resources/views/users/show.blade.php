@extends('layouts.app')

@section('title', 'Profile of @' . $user->username)

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Profile of {{ '@' . $user->username }}
        </div>
    @endcomponent
@endsection

@section('content')
    <div class="profile">
        <div class="profile-info">
            <div class="profile-name">{{ $user->name ?? $user->username }}</div>
            <div class="profile-date text-light">joined {{ $user->created_at->diffForHumans() }}</div>
        </div>

        <div class="profile-image">
            <div class="avatar avatar-small">
                <div style="background-image: url({{ $user->getAvatar() }})"></div>
            </div>
        </div>
    </div>

    @if ($topics->total())
        @include('topics.partials.topic-list', [$topics, 'user' => $user])

        {{ $topics->render() }}
    @else
        <p class="text-light">This user has not posted any topics.</p>
    @endif
@endsection
