@extends('layouts.app')

@section('title', 'Topic')

@section('content')
    <div class="container">
        {{-- Display the actual topic. --}}
        @include('topics.partials.topic', $topic)

        {{-- Loop through each post and display it. --}}
        @foreach ($posts as $post)
            @include('topics.partials.post', $post)
        @endforeach

        {{-- Show the form to create a new post in reply to the current topic. --}}
        @can ('create', \Forum\Post::class)
            <h4>Reply to this topic</h4>

            @include('posts.partials.create', $topic)
        @else
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <p>You must be <a href="{{ route('login') }}">signed in</a> to post a reply.</p>
                </div>
            </div>
        @endcan
    </div>
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.6.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
