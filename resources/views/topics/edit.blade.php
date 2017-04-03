@extends('layouts.app')

@section('title', 'Edit Topic')

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

                <textarea name="body" rows="10" class="form-input" v-autosize>{{ old('body') ?? $topic->body }}</textarea>

                @if ($errors->has('body'))
                    <div class="form-message">{{ $errors->first('body') }}</div>
                @endif
            </div>

            <div class="form-group form-flex text-right">
                @can ('delete', $topic)
                    <topic-delete topic="{{ $topic->id }}"></topic-delete>
                @endcan

                <input type="submit" value="Update" class="button button-large" />
            </div>
        </div>
    </form>
@endsection
