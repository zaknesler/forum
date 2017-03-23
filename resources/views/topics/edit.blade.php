@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Edit Topic
        </div>
    @endcomponent
@endsection

@section('content')
    <form action="{{ route('topics.update', $topic->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form">
            <div class="form-group{{ $errors->first('title', ' has-error') }}">
                <div class="form-label">Title</div>

                <input type="text" name="title" value="{{ old('title') ?? $topic->title }}" required autofocus class="form-input" />

                @if ($errors->has('title'))
                    <div class="form-message">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group{{ $errors->first('body', ' has-error') }}">
                <div class="form-label">Body</div>

                <textarea name="body" rows="10" class="form-input">{{ old('body') ?? $topic->body }}</textarea>

                @if ($errors->has('body'))
                    <div class="form-message">{{ $errors->first('body') }}</div>
                @endif
            </div>

            <div class="form-group text-right">
                <input type="submit" value="Edit Topic" class="button button-large" />
            </div>
        </div>
    </form>
@endsection
