@extends('layouts.app')

@section('title', 'Edit Post')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Edit Post
        </div>
    @endcomponent
@endsection

@section('content')
    <form action="{{ route('posts.update', [$topic->id, $post->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="form">
            <div class="form-group{{ $errors->first('body', ' has-error') }}">
                <div class="form-label">Body</div>

                <textarea name="body" rows="10" class="form-input" v-autosize>{{ old('body') ?? $post->body }}</textarea>

                @if ($errors->has('body'))
                    <div class="form-message">{{ $errors->first('body') }}</div>
                @endif
            </div>

            <div class="form-group form-flex text-right">
                @can ('delete', $post)
                    <post-delete topic="{{ $topic->id }}" post="{{ $post->id }}"></post-delete>
                @endcan

                <input type="submit" value="Update" class="button button-large" />
            </div>
        </div>
    </form>
@endsection
