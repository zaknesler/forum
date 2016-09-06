@extends('layouts.app')

@section('title', 'Edit Topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Topic</div>

                <div class="panel-body">
                    <form role="form" method="post" action="{{ route('topics.update', $topic->id) }}">
                        {{ csrf_field() }}

                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->first('title', ' has-error') }}">
                            <label for="title" class="control-label">Title</label>

                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $topic->title }}" required autofocus />

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->first('body', ' has-error') }}">
                            <label for="body" class="control-label">Body</label>

                            <textarea name="body" id="body" rows="15" class="form-control" required>{{ old('body') ?? $topic->body }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
