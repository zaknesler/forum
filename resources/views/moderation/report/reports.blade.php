@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="general-title">Topics</div>
            @if ($topics->count())
                <ul class="list-group">
                @foreach ($topics as $topic)
                    <li class="list-group-item"><h4>
                        <span class="label label-primary pull-right">{{ $topic->reportCountText() }}</span>
                        <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->title }}</a>
                    </h4></li>
                @endforeach
                </ul>
            @else
            <div class="box">
                <p>No reported topics.</p>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="general-title">Posts</div>
            @if ($posts->count())
                <ul class="list-group">
                @foreach ($posts as $post)
                    <li class="list-group-item"><h4>
                        <span class="label label-primary pull-right">{{ $post->reportCountText() }}</span>
                        <div class="text-muted"><a href="{{ route('forum.topic.show', ['slug' => $post->topic->slug, 'id' => $post->topic->id]) }}#post-{{ $post->id }}">{{ $post->topic->title }}</a></div>
                    </h4></li>
                @endforeach
                </ul>
            @else
            <div class="box">
                <p>No reported posts.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
