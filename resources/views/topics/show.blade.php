@extends('layouts.app')

@section('title', $topic->title)

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            {{ $topic->title }}
        </div>
    @endcomponent
@endsection

@section('content')
    @include('topics.partials.topic', $topic)

    @foreach($topic->posts as $post)
        @include('topics.partials.post', [$post, $topic])
    @endforeach

    @auth
        @include('posts.partials.create')
    @else
        <p class="text-light">To reply to this topic, you must <a href="{{ route('login') }}">login</a>.</p>
    @endauth
@endsection
