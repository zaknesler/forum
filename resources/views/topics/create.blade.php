@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Create Topic
        </div>
    @endcomponent
@endsection

@section('content')
    <form action="{{ route('topics.store') }}" method="POST">
        {{ csrf_field() }}

        <div class="form">
            <div class="form-group{{ $errors->first('title', ' has-error') }}">
                <div class="form-label">Title</div>

                <input type="text" name="title" value="{{ old('title') }}" required autofocus class="form-input" />

                @if ($errors->has('title'))
                    <div class="form-message">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="form-group{{ $errors->first('body', ' has-error') }}">
                <div class="form-label">Body</div>

                <textarea name="body" rows="10" class="form-input" v-autosize>{{ old('body') }}</textarea>

                @if ($errors->has('body'))
                    <div class="form-message">{{ $errors->first('body') }}</div>
                @endif
            </div>

            <div class="form-group text-right">
                <input type="submit" value="Create Topic" class="button button-large" />
            </div>
        </div>
    </form>
@endsection
