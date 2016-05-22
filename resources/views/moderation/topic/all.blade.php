@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All topics</h3>
    <div class="row">
        <div class="col-md-10">            
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <li class="list-group-item"><h4>
                            @ability ('owner,admin', 'topic-destroy')
                            <a class="label label-danger pull-right" href="{{ route('moderation.topic.destroy', ['id' => $topic->id]) }}"><i class="fa fa-times"></i></a>
                            @endability
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->title }}</a>
                            <small>by {{ $topic->user->username }}</small>                            
                        </h4></li>
                    @endforeach
                </ul>
                {{ $topics->render() }}
            @else
                <hr>
                <p>No topics to show.</p>
            @endif
        </div>
        <div class="col-md-2">
            <a href="{{ route('forum.topic.create') }}" class="btn btn-info btn-block">New topic</a>
        </div>
    </div>
</div>
@endsection
