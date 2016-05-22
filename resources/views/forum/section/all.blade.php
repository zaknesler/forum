@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>All sections</h3>
            @if ($sections->count())
                <ul class="list-group">
                    @foreach ($sections as $section)
                        <a class="list-group-item" href="{{ route('forum.section.show', ['slug' => $section->slug]) }}">
                            <h4>
                            <span class="label label-primary pull-right">{{ $section->topicCount() }} topics</span>
                            {{ $section->title }}
                            </h4>
                        </a>
                    @endforeach
                </ul>
                {{ $sections->render() }}
            @else
                <hr>
                <p>No sections to show.</p>
            @endif
        </div>
    </div>
</div>
@endsection
