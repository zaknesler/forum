@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href="{{ route('forum.topic.all') }}">Back to all topics</a></p>

    @if ($topic)
        <h1>{{ $topic->title }} <small>{{ $topic->created_at->diffForHumans() }}</small></h1>
        <hr>
        {!! $topic->body !!}
    @endif
</div>
@endsection
