@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="general-title">Reported topics</div>
            @if ($topics->count())
                <ul class="list-group">
                @foreach ($topics as $topic)
                <li class="list-group-item">
                    <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->title }}</a>
                </li>
                @endforeach
                </ul>
            @else
            <div class="box">
                <p>No reported topics.</p>
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="general-title">Reported posts</div>
            @if ($posts->count())
                <ul class="list-group">
                @foreach ($posts as $post)
                <li class="list-group-item">
                    <a href="{{ route('forum.topic.show', ['slug' => $post->topic->slug, 'id' => $post->topic->id]) }}#post-{{ $post->id }}">{{ $post->topic->title }} / {{ $post->id }}</a>
                </li>
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
