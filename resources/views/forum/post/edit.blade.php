@extends('layouts.app')

@section('title', 'Edit post')

@section('content')
<div class="container">
    <div class="row">
        @if (Auth::user()->hasRole(['moderator', 'admin', 'owner']))
        <div class="col-md-10">
        @else
        <div class="col-md-12">
        @endif
            <div class="general-title small">Edit post</div>
            <div class="box">
                <form action="{{ route('forum.post.edit', ['id' => $post->id]) }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="20">{{ $post->body }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update post</button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
        @role (['moderator', 'admin', 'owner'])
            <div class="col-md-2">
                <div class="general-title small">Post actions</div>
                <div class="box">
                    <form action="{{ route('forum.post.destroy', ['id' => $post->id]) }}" method="post" id="swal-confirm-submit">
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                        {!! csrf_field() !!}
                    </form>
                </div>
            </div>
        @endrole
    </div>
</div>
</div>
@endsection
