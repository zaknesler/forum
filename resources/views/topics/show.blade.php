@extends('layouts.app')

@section('title', $topic->title)

@section('head')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/tomorrow.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection

@section('content')
    <div class="container mx-auto p-4">
        @include('topics.partials.topic', $topic)

        @if ($posts->total())
            <div class="font-medium text-lg mt-8 mb-4">Replies</div>

            @foreach($posts as $post)
                @include('topics.partials.post', [$post, $topic])
            @endforeach

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        @endif

        @auth
            @include('posts.partials.create')
        @else
            <div class="text-grey-dark mt-4">
                <a href="{{ route('login') }}" class="text-indigo hover:text-indigo-dark no-underline">Sign in</a> to reply to this topic.
            </div>
        @endauth
    </div>
@endsection
