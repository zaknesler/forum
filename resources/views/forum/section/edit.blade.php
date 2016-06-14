@extends('layouts.app')

@section('title', 'Edit section')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="general-title small">Edit section</div>
            <div class="box">
                <form action="{{ route('forum.section.edit', ['id' => $section->id]) }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $section->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{ $section->slug }}">
                        @if ($errors->has('slug'))
                            <span class="help-block">
                                <strong>{{ $errors->first('slug') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control">{{ $section->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-primary">Update section</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-2 col-md-offset-2">
            <div class="general-title small">Section actions</div>
            <div class="box">
                <form action="{{ route('forum.section.destroy', ['id' => $section->id]) }}" method="post" id="swal-confirm-submit">
                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                    {!! csrf_field() !!}
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
