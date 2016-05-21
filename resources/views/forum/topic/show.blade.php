@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="topic">
        <h2>{{ $topic->title }}</h2>
        <h4>{{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->username }}</a></h4>
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
                        <a href="#">{{ $post->user->username }}</a> - {{ $post->created_at->diffForHumans() }}
                    </div>
                    {!! $post->body !!}
                </div>
            </div>
        @endforeach
        
    @endif

    <hr>

    <div class="topic__post">
        <div class="row">
            <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Post a reply</div>
                    <div class="panel-body">
                        <form action="{{ route('forum.topic.reply', ['id' => $topic->id]) }}" method="post" autocomplete="off">
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label for="body">Body</label>
                                <textarea class="form-control" name="body" id="body" rows="10" placeholder="Reply to this topic">{{ old('body') }}</textarea>
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
    </div>
</div>
@endsection
