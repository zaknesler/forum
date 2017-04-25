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
    <h2>{{ $user->name ?? $user->username }} <small class="text-light">(joined {{ $user->created_at->diffForHumans() }})</small></h2>

    @if ($topics->total())
        @include('topics.partials.topic-list', [$topics, 'user' => $user])

        {{ $topics->render() }}
    @else
        <p class="text-light">This user has not posted any topics.</p>
    @endif
@endsection
