@extends('layouts.app')

@section('content')
<div class="container">
    @if ($sections->count())
        @foreach ($sections as $section)
            <h3><a href="{{ route('forum.section.show', ['id' => $section->id]) }}">{{ $section->title }}</a></h3>
        @endforeach
    @else
        <h4>No sections to show.</h4>
    @endif
</div>
@endsection
