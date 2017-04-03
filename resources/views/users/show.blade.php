@extends('layouts.app')

@section('title', '@' . $user->username)

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            {{ '@' . $user->username }}
        </div>
    @endcomponent
@endsection

@section('content')
    <h2>{{ $user->name ?? $user->username }} <small class="text-light">joined {{ $user->created_at->diffForHumans() }}</small></h2>

    <div class="avatar avatar-huge">
        <div style="background-image: url({{ $user->getAvatar() }})"></div>
    </div>
@endsection
