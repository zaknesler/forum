@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $section->title }} <small>all topics</small></h3>
    <div class="row">
        <div class="col-md-12">            
            @if ($topics->count())
                <ul class="list-group">
                    @foreach ($topics as $topic)
                        <a class="list-group-item" href="{{ route('forum.topic.show', ['slug' => $topic->slug, 'id' => $topic->id]) }}">
                            <h4>
                            <span class="label label-primary pull-right">{{ $topic->replyCountText() }}</span>
                            {{ $topic->title }}
                            </h4>
                        </a>
                    @endforeach
                </ul>
                {{ $topics->render() }}
            @else
                <hr>
                <p>No topics under this section.</p>
            @endif
        </div>
    </div>
</div>
@endsection
