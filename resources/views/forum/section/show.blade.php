@extends('layouts.app')

@section('title', $section->title)

@section('content')
<div class="container">
    <h3>{{ $section->title }} <small>all topics</small></h3>
    <div class="row">
        @if (Auth::user())
        <div class="col-md-10">
        @else
        <div class="col-md-12">
        @endif
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <li class="list-group-item"><h4>
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->title }}</a>
                            <br />
                            <small class="text-muted">
                                by {{ $topic->user->username }}
                            </small>
                        </h4></li>
                    @endforeach
                </ul>
                {{ $topics->render() }}
            @else
                <hr>
                <p>No topics under this section.</p>
            @endif
        </div>
        @if (Auth::user())
        <div class="col-md-2">
            @role (['admin', 'owner'])
            <a class="btn btn-warning btn-block" href="{{ route('moderation.section.edit', ['id' => $section->id]) }}">Edit section</a>
            @endrole
            <a class="btn btn-info btn-block" href="{{ route('forum.topic.create') }}?section_id={{ $section->id }}">Create topic</a>
        </div>
        @endif
    </div>
</div>
@endsection
