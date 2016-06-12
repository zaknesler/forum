@extends('layouts.app')

@section('title', 'Create new topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Post new topic</div>
                <div class="panel-body">
                    <form action="{{ route('forum.topic.create') }}" method="post" autocomplete="off">
                        <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
                            <label for="section_id">Section</label>
                            <select class="form-control" name="section_id" id="section_id">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}" @if (($id == $section->id) || (old('section_id') == $section->id)) selected @endif>{{ $section->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('section_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('section_id') }}</strong>
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
</div>
@endsection
