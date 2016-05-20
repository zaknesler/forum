@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Post new topic</div>
                <div class="panel-body">
                    <form action="{{ route('forum.topic.new') }}" method="post" autocomplete="off">
                        <div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
                            <label for="section_id">Section</label>
                            <select class="form-control" name="section_id" id="section_id">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->title }}</option>
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
                            <input type="text" class="form-control" name="title" id="title" placeholder="Hello, world!" value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
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
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-primary">Post topic</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection