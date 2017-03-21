@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        Topics
    @endcomponent
@endsection

@section('content')
    <topics></topics>
@endsection
