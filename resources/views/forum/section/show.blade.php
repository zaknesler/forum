@extends('layouts.app')

@section('content')
<div class="container">
    <p><a href="{{ route('forum.section.all') }}">Back to all sections</a></p>

    @if ($section)
        <h1>{{ $section->title }} <small>all topics</small></h1>

        <div class="well">
            @if ($topics->count())
                @foreach ($topics as $topic)
                    <h3><a href="{{ route('forum.topic.show', ['id' => $topic->id]) }}">{{ $topic->title }}</a></h3>
                @endforeach
            @else
            <p>No topics under this section.</p>
            @endif
        </div>
    @endif
</div>
@endsection
