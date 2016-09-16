@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Post</div>

                <div class="panel-body">
                    <form role="form" method="post" action="{{ route('posts.update', $post->id) }}">
                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->first('body', ' has-error') }}">
                            <label for="body" class="control-label">Body</label>

                            <textarea name="body" id="body" rows="15" class="form-control" required>{{ old('body') ?? $post->body }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group clearfix">
                            <button type="submit" class="pull-left btn btn-primary">
                                Update
                            </button>

                            @can ('delete', $post)
                                <a href="#" onclick="event.preventDefault();document.getElementById('post-delete-form').submit();" class="pull-right btn btn-danger">
                                    Delete
                                </a>
                            @endcan
                        </div>
                    </form>

                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}" id="post-delete-form" style="display: none;">
                        {{ csrf_field() }}

                        {{ method_field('DELETE') }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
