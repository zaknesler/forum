@extends('layouts.app')

@section('title', $topic->title)

@section('content')
<div class="container">
    <div class="topic-title">
        {{ $topic->title }}
    </div>
    <div class="topic-container">
        <div class="head">
            <div class="date pull-left text-muted">{{ $topic->created_at->diffForHumans() }} by <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}">{{ $topic->user->username }}</a></div>
            <div class="clearfix"></div>
        </div>
        <div class="border">
            <div class="body">
                {!! $topic->body !!}
            </div>
            @if (Auth::user())
                <div class="foot">
                    <div class="pull-left">
                        @if (Auth::user()->hasRole(['moderator','admin','owner']))
                            <span class="label label-primary">{{ $topic->reportCountText() }}</span>
                            @if ($topic->reports->count())
                                <a href="{{ route('forum.topic.report.destroy', ['id' => $topic->id]) }}" class="label label-info">Clear</a>
                            @endif
                        @else
                            <a href="{{ route('forum.topic.report', ['id' => $topic->id]) }}">Report</a>
                        @endif
                    </div>
                    @if ((Auth::user()->id == $topic->user->id) || Auth::user()->hasRole(['moderator','admin','owner']))
                        <div class="pull-right">
                            <a href="{{ route('forum.topic.edit', ['id' => $topic->id]) }}">Edit</a>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            @endif
        </div>
    </div>
    
    @if ($posts->count())
        <div class="general-title">
            Replies
        </div>
        @foreach ($posts as $post)
            <div class="topic-container" id="post-{{ $post->id }}">
                <div class="head">
                    <div class="date pull-left text-muted">
                        {{ $post->created_at->diffForHumans() }} by
                        <a href="{{ route('user.profile', ['username' => $post->user->username]) }}">
                            {{ $post->user->username }}
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="border">
                    <div class="body">
                        {!! $post->body !!}
                    </div>
                    @if (Auth::user())
                        <div class="foot">
                            <div class="pull-left">
                                @if (Auth::user()->hasRole(['moderator','admin','owner']))
                                    <span class="label label-primary">{{ $post->reportCountText() }}</span>
                                    @if ($post->reports->count())
                                        <a href="{{ route('forum.post.report.destroy', ['id' => $post->id]) }}" class="label label-info">Clear</a>
                                    @endif
                                @else
                                    <a href="{{ route('forum.post.report', ['id' => $post->id]) }}">Report</a>
                                @endif
                            </div>
                            @if (Auth::user()->hasRole(['moderator','admin','owner']))
                                <div class="pull-right">
                                    <a class="text-danger" href="{{ route('moderation.post.destroy', ['id' => $post->id]) }}">Delete</a>
                                </div>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    @if (Auth::user())
        <div class="general-title">
            Leave a reply
        </div>
        <div class="box">
            <form action="{{ route('forum.topic.post', ['id' => $topic->id]) }}" method="post" autocomplete="off">
                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                    <textarea class="form-control" name="body" id="body" rows="5">{{ old('body') }}</textarea>
                    @if ($errors->has('body'))
                        <span class="help-block">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>
            </form>
        </div>
    @else
        <p class="text-muted">To reply to this topic, please <a href="{{ route('auth.login') }}">sign in</a> or <a href="{{ route('auth.register') }}">sign up</a>.</p>
    @endif
</div>
@endsection
