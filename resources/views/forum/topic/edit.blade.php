@extends('layouts.app')

@section('title', 'Edit topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit topic</div>
                <div class="panel-body">
                    <form action="{{ route('forum.topic.edit', ['id' => $topic->id]) }}" method="post" autocomplete="off">
                        <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
                            <label for="section_id">Section</label>
                            <select class="form-control" name="section_id" id="section_id">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" @if ($topic->section->id == $section->id) selected @endif>{{ $section->title }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('section_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('section_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Hello, world!" value="{{ $topic->title }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="10">{{ $topic->raw_body }}</textarea>
                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">Update topic</button>
                            @role (['admin', 'owner'])
                            <a class="btn btn-danger pull-right" href="{{ route('moderation.topic.destroy', ['id' => $topic->id]) }}">Delete</a>
                            @endrole
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
