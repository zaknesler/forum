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

    <h4>Reply to this topic</h4>

    {{-- Show the form to create a new post in reply to the current topic. --}}
    @include('posts.partials.create', $topic)
</div>
@endsection

@section('scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.6.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@endsection
