@extends('layouts.app')

@section('title', 'Reports')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reports
                    </div>

                    <div class="panel-body">
                        @if ($reports->count())
                            <ul class="list-group">
                                {{-- Loop through each reports and display each one. --}}
                                @foreach ($reports as $report)
                                    @include('reports.partials.list-item', $report)
                                @endforeach
                            </ul>
                        @else
                            <p>There are no reports to display.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
