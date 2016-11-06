@extends('layouts.app')

@section('title', 'Topics')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Topics

                        <div class="pull-right text-muted">
                            {{ str_plural_text('topic', $topics->total()) }}
                        </div>
                    </div>

                    <div class="panel-body">
                        @if ($topics->count())
                            <ul class="list-group">
                                {{-- Loop through each topic and display a list item for it. --}}
                                @foreach ($topics as $topic)
                                    @include('topics.partials.list-item', $topic)
                                @endforeach
                            </ul>

                            {{ $topics->links() }}
                        @else
                            <p>There are no topics to display.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                @can ('create', Forum\Models\Topic::class)
                    <a href="{{ route('topics.create') }}" class="btn btn-block btn-primary">
                        Create Topic
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
