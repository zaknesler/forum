@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($sections->count())
                @foreach ($sections as $section)
                    <h3>{{ $section->title }} <small>all topics</small></h3>
                    @if ($section->topicCount())
                        <ul class="list-group">
                            @foreach ($section->topics()->get() as $topic)
                                <li class="list-group-item"><h4>
                                    <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                                    <a href="{{ route('forum.topic.show', ['id' => $topic->id]) }}">{{ $topic->title }}</a>
                                    <small>by {{ $topic->user->username }}</small>
                                </h4></li>
                            @endforeach
                        </ul>
                    @else
                        <ul class="list-group">
                            <li class="list-group-item">No topics under this section.</li>
                        </ul>
                    @endif
                @endforeach
            @else
                <hr>
                <p>No sections to show.</p>
            @endif
        </div>
    </div>
</div>
@endsection