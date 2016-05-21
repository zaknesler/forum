@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>{{ $section->title }} <small>all topics</small></h3>
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <a class="list-group-item" href="{{ route('forum.topic.show', ['id' => $topic->id]) }}">
                            <h4>
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            {{ $topic->title }}
                            </h4>
                        </a>
                    @endforeach
                </ul>
            @else
                <hr>
                <p>No topics under this section.</p>
            @endif
        </div>
    </div>
</div>
@endsection
