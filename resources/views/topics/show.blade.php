@extends('layouts.app')

@section('title', $topic->title)

@section('content')
    <div class="container mx-auto px-4 font-medium text-lg">{{ $topic->title }}</div>

    <div class="bg-grey-lighter text-grey-darker">
        <div class="container mx-auto p-4">
            @include('topics.partials.topic', $topic)

            @foreach($topic->posts as $post)
                @include('topics.partials.post', [$post, $topic])
            @endforeach

            @auth
                @include('posts.partials.create')
            @else
                <div class="text-grey-dark">
                    <a href="{{ route('login') }}" class="text-indigo hover:text-indigo-dark no-underline">Sign in</a> to reply to this topic.
                </div>
            @endauth
        </div>
    </div>
@endsection
