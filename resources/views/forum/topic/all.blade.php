@extends('layouts.app')

@section('content')
<div class="container">
    @if ($topics->count())
        @foreach ($topics as $topic)
            <h1><a href="{{ route('forum.topic.show', ['id' => $topic->id]) }}">{{ $topic->title }}</a></h1>
        @endforeach
    @else
        <h3>No topics to show.</h3>
    @endif
</div>
@endsection
