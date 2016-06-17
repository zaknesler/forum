@extends('layouts.app')

@section('title', $topic->name)

@section('content')
<div class="container">
    <div class="topic-title">
        <div class="pull-left">
            {{ $topic->name }}
        </div>
        <div class="pull-right">
            <small>
                @if ($topic->hide && auth()->user()->hasRole(['moderator', 'admin', 'owner']))
                    <span class="label label-warning">Hidden</span>
                @endif
                @if ($topic->locked)
                    <span class="label label-success">Locked</span>
                @endif
                <span><a href="{{ route('forum.section.show', ['slug' => $topic->section->slug, 'id' => $topic->section->id]) }}" class="label label-info">{{ $topic->section->name }}</a></span>
            </small>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="topic-container">
        <div class="head">
            <div class="date pull-left text-muted">{{ $topic->created_at->diffForHumans() }} by <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}" class="text-muted dark">{{ $topic->user->getFullNameOrUsername() }}</a></div>
            <div class="clearfix"></div>
        </div>
        <div class="border">
            <div class="body">
                {!! Markdown::convertToHtml($topic->body) !!}
            </div>
            @if (Auth::user())
                <div class="foot">
                    <div class="pull-left">
                        <ul class="list-inline list-inline-no-margin">
                            @if (!(Auth::user()->id == $topic->user->id) && !Auth::user()->hasRole(['moderator','admin','owner']))
                                <li>
                                    <a href="{{ route('forum.topic.report', ['id' => $topic->id]) }}">Report</a>
                                </li>
                            @endif
                            @if ((Auth::user()->id == $topic->user->id) || Auth::user()->hasRole(['moderator','admin','owner']))
                                <li>
                                    <a href="{{ route('forum.topic.edit', ['id' => $topic->id]) }}">Edit</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="pull-right">
                        @if (Auth::user()->hasRole(['moderator','admin','owner']))
                            <span class="label label-primary">{{ $topic->reportCountText() }}</span>
                            @if ($topic->reports)
                                <a href="{{ route('forum.topic.report.clear', ['id' => $topic->id]) }}" class="label label-info">Clear</a>
                            @endif
                        @endif
                    </div>
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
                        <a href="{{ route('user.profile', ['username' => $post->user->username]) }}" class="text-muted dark">
                            {{ $post->user->getFullNameOrUsername() }}
                        </a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="border">
                    <div class="body">
                        {!! Markdown::convertToHtml($post->body) !!}
                    </div>
                    @if (Auth::user())
                        <div class="foot">
                            <div class="pull-left">
                                <ul class="list-inline list-inline-no-margin">
                                    @if (!(Auth::user()->id == $post->user->id) && !Auth::user()->hasRole(['moderator','admin','owner']))
                                        <li>
                                            <a href="{{ route('forum.post.report', ['id' => $post->id]) }}">Report</a>
                                        </li>
                                    @endif
                                    @if ((Auth::user()->id == $post->user->id) || Auth::user()->hasRole(['moderator','admin','owner']))
                                        <li>
                                            <a href="{{ route('forum.post.edit', ['id' => $post->id]) }}">Edit</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="pull-right">
                                @if (Auth::user()->hasRole(['moderator','admin','owner']))
                                    <span class="label label-primary">{{ $post->reportCountText() }}</span>
                                    @if ($post->reports)
                                        <a href="{{ route('forum.post.report.clear', ['id' => $post->id]) }}" class="label label-info">Clear</a>
                                    @endif
                                @endif
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
    @if (Auth::user() && (!$topic->locked || Auth::user()->hasRole(['moderator', 'admin', 'owner'])))
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
    @elseif (!Auth::user())
        <p class="text-muted">To reply to this topic, please <a href="{{ route('auth.login') }}" class="text-muted dark">sign in</a> or <a href="{{ route('auth.register') }}" class="text-muted dark">sign up</a>.</p>
    @elseif ($topic->locked)
        <p class="text-muted">This topic is locked from any further replies.</p>
    @endif
</div>
@endsection
