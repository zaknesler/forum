@extends('layouts.app')

@section('title', '404 Not Found')

@section('content')
    <div class="container mx-auto p-4">
        <div class="font-medium text-lg mb-4">404 Not Found</div>

        <div class="bg-white border border-grey-lighter shadow rounded p-8 text-center text-lg font-medium">
            <svg class="w-16 h-16 fill-current text-grey mb-8 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/></svg>
            <div class="mb-4">That page could not be found.</div>
            <a href="{{ route('home') }}" class="text-indigo hover:text-indigo-dark no-underline">&larr; Home</a>
        </div>
    </div>
@endsection
