@extends('layouts.app')

@section('title', 'Topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $topic->title }}</div>

                <div class="panel-body">
                    @markdown($topic->body)
                </div>

                @can (['update', 'delete'], $topic)
                    <div class="panel-footer clearfix">
                        @can ('update', $topic)
                            <a href="{{ route('topics.edit', $topic->id) }}" class="pull-left btn btn-primary">
                                Edit
                            </a>
                        @endcan

                        @can ('delete', $topic)
                            <a href="#" onclick="event.preventDefault();document.getElementById('topic-delete-form').submit();" class="pull-right btn btn-danger">
                                Delete
                            </a>

                            <form method="POST" action="{{ route('topics.destroy', $topic->id) }}" id="topic-delete-form" style="display: none;">
                                {{ csrf_field() }}

                                {{ method_field('DELETE') }}
                            </form>
                        @endcan
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
