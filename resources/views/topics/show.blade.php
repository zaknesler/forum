@extends('layouts.app')

@section('title', 'Topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $topic->title }}</h4>

            <h4>
                <small>
                    {{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->getNameOrUsername() }}</a>
                </small>
            </h4>

            <div class="panel panel-default">
                <div class="panel-body">
                    @markdown($topic->body)
                </div>

                @if (auth()->user()->can('update', $topic) || auth()->user()->can('delete', $topic))
                    <div class="panel-footer clearfix">
                        @can ('update', $topic)
                            <a href="{{ route('topics.edit', $topic->id) }}" class="pull-left btn btn-primary">
                                Edit
                            </a>
                        @endcan

                        @can ('delete', $topic)
                            <a href="#" onclick="event.preventDefault();document.getElementById('topic-delete-form').submit();" class="pull-right btn btn-danger">
                                Delete
                            </a>

                            <form method="POST" action="{{ route('topics.destroy', $topic->id) }}" id="topic-delete-form" style="display: none;">
                                {{ csrf_field() }}

                                {{ method_field('DELETE') }}
                            </form>
                        @endcan
                    </div>
                @endif
            </div>

            @foreach ($posts as $post)
                <h4>
                    <small>
                        {{ $post->created_at->diffForHumans() }} by <a href="#">{{ $post->user->getNameOrUsername() }}</a>
                    </small>
                </h4>

                <div class="panel panel-default">
                    <div class="panel-body">
                        @markdown($post->body)
                    </div>
                </div>
            @endforeach

            <h4>Reply to this topic</h4>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" method="post" action="{{ route('posts.store', [$topic->id]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->first('body', ' has-error') }}">
                            <label for="body" class="control-label">Body</label>

                            <textarea name="body" id="body" rows="15" class="form-control" required>{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
