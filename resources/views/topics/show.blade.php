@extends('layouts.app')

@section('title', 'Topic')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4 class="clearfix">
                {{ $topic->title }}

                <small class="pull-right">
                    {{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->getNameOrUsername() }}</a>
                </small>
            </h4>

            <div class="panel panel-default">
                <div class="panel-body">
                    @markdown($topic->body)
                </div>

                @if (auth()->user()->can('update', $topic) || auth()->user()->can('delete', $topic))
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
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
