@extends('layouts.app')

@section('content')
<div class="container">    
    <div class="topic">
        <h2>{{ $topic->title }}</h2>
        <h4>{{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->username }}</a></h4>
        <hr>
        {!! $topic->body !!}
    </div>
    
    @if ($topic->posts->count())
        <hr>
        @foreach ($topic->posts as $post)
        <div class="topic_reply">
            <h5>{{ $post->created_at->diffForHumans() }} by <a href="#">{{ $post->user->username }}</a></h5>
            {!! $post->body !!}
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
