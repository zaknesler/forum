@extends('layouts.app')

@section('content')
<div class="container">
    <div class="general-title">All sections</div>
    <div class="row">
        @if (Auth::user() && ($count || Auth::user()->hasRole(['admin', 'owner'])))
        <div class="col-md-10">
        @else
        <div class="col-md-12">
        @endif
            @if ($sections->count())
                <ul class="list-group">
                    @foreach ($sections as $section)
                        <li class="list-group-item"><h4>
                            <span class="label label-primary pull-right">{{ $section->topicCountText() }}</span>
                            <a href="{{ route('forum.section.show', ['slug' => $section->slug, 'id' => $section->id]) }}">{{ $section->name }}</a>
                            @if ($section->description || $section->topics->count())
                                <br />
                                <small>
                                    @if ($section->description)
                                        {{ $section->description }}
                                    @endif
                                    @if ($section->topics->count())
                                        Last topic <a href="{{ route('forum.topic.show', ['id' => $section->getLatestTopic($section->id)->id, 'slug' => $section->getLatestTopic($section->id)->slug]) }}" class="text-muted dark">{{ $section->last_topic_at->diffForHumans() }}</a>.
                                    @endif
                                </small>
                            @endif
                        </h4></li>
                    @endforeach
                </ul>
                {{ $sections->render() }}
            @else
                <div class="box">
                    <p>No sections to show.</p>
                </div>
            @endif
        </div>
        @if (Auth::user() && ($count || Auth::user()->hasRole(['admin', 'owner'])))
        <div class="col-md-2">
            @if ($count)
                <a href="{{ route('forum.topic.create') }}" class="btn btn-info btn-block">Create topic</a>
            @endif
            @role (['admin', 'owner'])
                <a href="{{ route('forum.section.create') }}" class="btn btn-warning btn-block">Create section</a>
            @endrole
        </div>
        @endif
    </div>
</div>
@endsection
