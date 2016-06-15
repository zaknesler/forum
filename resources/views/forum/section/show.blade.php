@extends('layouts.app')

@section('title', $section->name)

@section('content')
<div class="container">
    <div class="general-title">{{ $section->name }} <span class="small">All topics</span></div>
    <div class="row">
        @if (Auth::user())
        <div class="col-md-9">
        @else
        <div class="col-md-12">
        @endif
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <li class="list-group-item"><h4>
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            <a href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">{{ $topic->name }}</a>
                            <br />
                            <small>
                                {{ $topic->created_at->diffForHumans() }} by <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}" class="text-muted-primary">{{ $topic->user->getFullNameOrUsername() }}</a>
                            </small>
                        </h4></li>
                    @endforeach
                </ul>
                {{ $topics->render() }}
            @else
                <div class="box">
                    <p>No topics under this section.</p>
                </div>
            @endif
        </div>
        @if (Auth::user())
        <div class="col-md-3">
            <form action="{{ route('forum.section.show', ['id' => $section->id, 'slug' => $section->slug]) }}" method="get">
                <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                    <div class="input-group" title="Powered by Algolia">
                        <input type="text" placeholder="Search topics.." class="form-control" name="search" value="{{ request('search') }}">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                    @if ($errors->has('search'))
                        <span class="help-block">
                            <strong>{{ $errors->first('search') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
            <a class="btn btn-info btn-block" href="{{ route('forum.topic.create', ['id' => $section->id]) }}">Create topic</a>
            @role (['admin', 'owner'])
                <a class="btn btn-warning btn-block" href="{{ route('forum.section.edit', ['id' => $section->id]) }}">Edit section</a>
            @endrole
        </div>
        @endif
    </div>
</div>
@endsection
