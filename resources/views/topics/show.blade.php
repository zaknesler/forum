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
            </div>
        </div>
    </div>
</div>
@endsection
