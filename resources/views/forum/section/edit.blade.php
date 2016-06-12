@extends('layouts.app')

@section('title', 'Edit section')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit section</div>
                <div class="panel-body">
                    <form action="{{ route('moderation.section.edit', ['id' => $section->id]) }}" method="post" autocomplete="off">
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
                            <input type="text" class="form-control" name="description" id="description" value="{{ $section->description }}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            @role (['admin', 'owner'])
                            <a class="btn btn-danger pull-right" href="{{ route('moderation.section.destroy', ['id' => $section->id]) }}">Delete</a>
                            @endrole
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
