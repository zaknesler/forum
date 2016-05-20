@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All topics</h3>
    <div class="well">
        @if ($topics->count())
            @foreach ($topics as $topic)
                <h3><a href="{{ route('forum.topic.show', ['id' => $topic->id]) }}">{{ $topic->title }}</a></h3>
            @endforeach
        @else
            <h3>No topics to show.</h3>
        @endif
    </div>
</div>
@endsection
