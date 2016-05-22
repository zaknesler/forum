@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="topic">
        <div class="row">
            <h3 class="col-md-9">{{ $topic->title }}</h3>
            <div class="col-md-3 text-right">
                <h3><small>{{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->username }}</a></small></h3>
            </div>
        </div>
        <hr>

        {!! $topic->body !!}
    </div>
    
    @if ($posts->count())
        <hr>
        <h4>Comments</h4>
        @foreach ($posts as $post)
            <div class="media">
                <div class="media-left">
                    <a href="#"><img src="{{ $post->user->avatarUrl(['size' => 50]) }}" alt="User avatar" class="media-object"></a>
                </div>
                <div class="media-body">
                    <div class="media-heading">
                        {{ $post->created_at->diffForHumans() }} by <a href="#">{{ $post->user->username }}</a>
                    </div>
                    {!! $post->body !!}
                </div>
            </div>
        @endforeach
        
    @endif

    <hr>

    <div class="topic__post">
        <div class="panel panel-default">
            <div class="panel-heading">Post a reply</div>
            <div class="panel-body">
                <form action="{{ route('forum.topic.post', ['id' => $topic->id]) }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <textarea class="form-control" name="body" id="body" rows="10" placeholder="Reply to this topic">{{ old('body') }}</textarea>
                        <p class="text-right">Markdown is supported</p>
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
    </div>
</div>
@endsection
