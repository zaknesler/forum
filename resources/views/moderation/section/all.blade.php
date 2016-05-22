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
                            <a href="{{ route('moderation.section.show', ['slug' => $section->slug]) }}">{{ $section->title }}</a>
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
            @ability ('admin,owner', 'section-create')
            <a class="btn btn-info btn-block" href="{{ route('moderation.section.create') }}">Create section</a>
            @endability
        </div>
    </div>
</div>
@endsection
