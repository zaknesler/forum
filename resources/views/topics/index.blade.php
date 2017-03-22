@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            Topics
        </div>

        <div class="banner-action">
            @if (auth()->check())
                <a href="{{ route('topics.create') }}" class="button button-large button-light">Create Topic</a>
            @endif
        </div>
    @endcomponent
@endsection

@section('content')
    @if ($topics->total())
        <div class="list-group">
            @foreach ($topics as $topic)
                <div class="list-group-item">
                    <strong><a href="/topics/{{ $topic->slug }}">{{ $topic->title }}</a></strong>
                    <br />
                    by <a href="#">{{ $topic->user->getNameOrUsername() }}</a>
                </div>
            @endforeach
        </div>
    @else
        <p>There are no topics to show.</p>
    @endif
@endsection
