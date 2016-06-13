@extends('layouts.app')

@section('title', 'Reports')

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
                        <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->name }}</a>
                        <br />
                        <small>by {{ $topic->user->username }}</small>
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
                        <a href="{{ route('forum.topic.show', ['slug' => $post->topic->slug, 'id' => $post->topic->id]) }}#post-{{ $post->id }}">{{ $post->topic->name }}</a>
                        <span class="text-muted"><small>post {{ $post->id }}</small></span>
                        <br />
                        <small>by {{ $post->user->username }}</small>
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
