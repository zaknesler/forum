@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $section->title }} <small>all topics</small></h3>
    <div class="row">
        <div class="col-md-12">
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <li class="list-group-item"><h4>
                            @ability ('owner,admin', 'topic-destroy')
                            <a class="label label-danger pull-right" href="{{ route('moderation.topic.destroy', ['id' => $topic->id]) }}"><i class="fa fa-times"></i></a>
                            @endability
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->title }}</a>
                        </h4></li>
                    @endforeach
                </ul>
                {{ $topics->render() }}
            @else
                <hr>
                <p>No topics under this section.</p>
            @endif
        </div>
    </div>
</div>
@endsection
