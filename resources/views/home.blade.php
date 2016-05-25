@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All sections</h3>
    <div class="row">
        <div class="col-md-10">
            @if ($sections->count())
                <ul class="list-group">
                    @foreach ($sections as $section)
                        <li class="list-group-item"><h4>
                            <span class="label label-primary pull-right">{{ $section->topicCountText() }}</span>
                            <a href="{{ route('forum.section.show', ['slug' => $section->slug]) }}">{{ $section->title }}</a>
                            @if ($section->description)
                                <br />
                                <small>{{ $section->description }}</small>
                            @endif
                        </h4></li>
                    @endforeach
                </ul>
                {{ $sections->render() }}
            @else
                <hr>
                <p>No sections to show.</p>
            @endif
        </div>
        <div class="col-md-2">
            @role (['admin', 'owner'])
            <a href="{{ route('moderation.section.create') }}" class="btn btn-warning btn-block">Create section</a>
            <hr>
            @endrole
            <a href="{{ route('forum.topic.create') }}" class="btn btn-info btn-block">Create topic</a>
        </div>
    </div>
</div>
@endsection
