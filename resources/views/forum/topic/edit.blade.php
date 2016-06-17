@extends('layouts.app')

@section('title', 'Edit topic')

@section('content')
<div class="container">
    <div class="row">
        @if (Auth::user()->hasRole(['moderator', 'admin', 'owner']))
        <div class="col-md-10">
        @else
        <div class="col-md-12">
        @endif
            <div class="general-title small">Edit topic</div>
            <div class="box">
                <form action="{{ route('forum.topic.edit', ['id' => $topic->id]) }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Hello, world!" value="{{ $topic->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="20">{{ $topic->body }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update topic</button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
        @role (['moderator', 'admin', 'owner'])
            <div class="col-md-2">
                <div class="general-title small">Topic actions</div>
                <div class="box">
                    <form action="{{ route('forum.topic.destroy', ['id' => $topic->id]) }}" method="post" id="swal-confirm-submit">
                        <button type="submit" class="btn btn-danger btn-block">Delete</button>
                        {!! csrf_field() !!}
                    </form>
                </div>
                <div class="box">
                    @if ($topic->hide)
                        <form action="{{ route('forum.topic.unhide', ['id' => $topic->id]) }}" method="post" id="swal-confirm-submit">
                            <button type="submit" class="btn btn-info btn-block">Unhide</button>
                            {!! csrf_field() !!}
                        </form>
                    @else
                        <form action="{{ route('forum.topic.hide', ['id' => $topic->id]) }}" method="post" id="swal-confirm-submit">
                            <button type="submit" class="btn btn-warning btn-block">Hide</button>
                            {!! csrf_field() !!}
                        </form>
                    @endif
                </div>
            </div>
        @endrole
    </div>
</div>
</div>
@endsection
