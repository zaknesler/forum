@extends('layouts.app')

@section('title', 'Topics')

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
        @include('topics.partials.topic-list', $topics)

        {{ $topics->render() }}
    @else
        <p class="text-light">There are no topics to show.</p>
    @endif
@endsection
