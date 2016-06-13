@extends('layouts.app')

@section('title', 'Create new topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="general-title small">Create topic</div>
            <div class="box">
                <form action="{{ route('forum.topic.create') }}" method="post" autocomplete="off">
                    <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <label for="id">Section</label>
                        <select class="form-control" name="id" id="id">
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}" @if (($id == $section->id) || (old('id') == $section->id)) selected @endif>{{ $section->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Hello, world!" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="10">{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong>{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Create topic</button>
                        {!! csrf_field() !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
