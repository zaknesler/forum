@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>All topics</h3>
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <li class="list-group-item"><h4>
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            <a href="{{ route('forum.topic.show', ['id' => $topic->id]) }}">{{ $topic->title }}</a>
                            <small>by {{ $topic->user->username }}</small>
                        </h4></li>
                    @endforeach
                </ul>
                {{ $topics->render() }}
            @else
                <hr>
                <p>No topics to show.</p>
                <hr>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('forum.topic.new') }}" class="btn btn-primary">New topic</a>
        </div>
    </div>
</div>
@endsection
