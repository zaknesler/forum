@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            {{ number_format($topics->total()) }} {{ str_plural('Topic', $topics->total()) }}
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
                    <strong>
                        <a href="{{ route('topics.show', $topic->slug) }}">{{ $topic->title }}</a>
                    </strong>

                    <div class="text-light">
                        by
                        <a href="#">
                            {{ $topic->user->getNameOrUsername() }}
                        </a>
                        &mdash; {{ $topic->created_at->diffForHumans() }}
                    </div>
                </div>
            @endforeach
        </div>

        {{ $topics->render() }}
    @else
        <p>There are no topics to show.</p>
    @endif
@endsection
