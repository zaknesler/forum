@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            {{ $topic->title }}
        </div>
    @endcomponent
@endsection

@section('content')
    @include('topics.partials.topic', $topic)

    @each('topics.partials.post', $topic->posts, 'post')

    @if (auth()->check())
        @include('posts.partials.create')
    @else
        <p class="text-light">To reply to this topic, you must <a href="{{ route('login') }}">login</a>.</p>
    @endif
@endsection
