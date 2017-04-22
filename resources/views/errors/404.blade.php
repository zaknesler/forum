@extends('layouts.app')

@section('title', '404 Not Found')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            404 Not Found
        </div>
    @endcomponent
@endsection

@section('content')
    <p>The page you are looking for cannot be found.</p>
@endsection
