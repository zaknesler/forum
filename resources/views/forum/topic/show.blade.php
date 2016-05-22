@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="topic">
        <div class="row">
            <h3 class="col-xs-12 col-sm-8 col-md-9">{{ $topic->title }}</h3>
            <div class="col-xs-12 col-sm-4 col-md-3 text-right">
                <h3><small>{{ $topic->created_at->diffForHumans() }} by <a href="{{ route('user.profile', ['username' => $topic->user->username]) }}">{{ $topic->user->username }}</a></small></h3>
            </div>
        </div>
        <hr>
        {!! $topic->body !!}
    </div>
    
    @if ($posts->count())
        <hr>
        <h4>Replies</h4>
        @foreach ($posts as $post)
            <div class="media">
                <div class="media-left">
                    <a href="{{ route('user.profile', ['username' => $post->user->username]) }}"><img src="{{ $post->user->avatarUrl(['size' => 50]) }}" alt="User avatar" class="media-object"></a>
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        <a href="{{ route('user.profile', ['username' => $post->user->username]) }}">{{ $post->user->username }}</a> {{ $post->created_at->diffForHumans() }}
                    </div>
                    {!! $post->body !!}
                </div>
            </div>
        @endforeach
        
    @endif

    <hr>

    <div class="topic__post">
        <h4>Reply to this topic</h4>
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
</div>
@endsection
