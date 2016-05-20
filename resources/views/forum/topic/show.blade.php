@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href="{{ route('forum.topic.all') }}">Back to all topics</a></p>

    @if ($topic)
        <h1>{{ $topic->title }}</h1>
        {!! $topic->body !!}
    @endif
</div>
@endsection
