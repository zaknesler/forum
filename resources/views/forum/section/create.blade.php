@extends('layouts.app')

@section('title', 'Create new section')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create new section</div>
                <div class="panel-body">
                    <form action="{{ route('moderation.section.create') }}" method="post" autocomplete="off">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">Create section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
