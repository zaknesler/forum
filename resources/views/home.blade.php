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
                            @ability ('owner,admin', 'section-destroy')
                            <a class="label label-danger pull-right" href="{{ route('moderation.section.destroy', ['id' => $section->id]) }}"><i class="fa fa-times"></i></a>
                            @endability
                            <span class="label label-primary pull-right">{{ $section->topicCountText() }}</span>
                            <a href="{{ route('forum.section.show', ['slug' => $section->slug]) }}">{{ $section->title }}</a>
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
            <a href="{{ route('forum.topic.create') }}" class="btn btn-info btn-block">Create topic</a>
            @ability ('admin,owner', 'section-create')
            <a href="{{ route('moderation.section.create') }}" class="btn btn-warning btn-block">Create section</a>
            @endability
        </div>
    </div>
</div>
@endsection
