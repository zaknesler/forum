@extends('layouts.app')

@section('banner')
    @component('layouts.components.banner')
        <div class="banner-title">
            {{ $topic->title }}
        </div>
    @endcomponent
@endsection

@section('content')
    <div class="post">
        <div class="post-header">
            <div class="post-author">
                <a href="#" class="post-author_image" style="background-image: url({{ $topic->user->getAvatar(50) }})"></a>

                <div class="post-author_info">
                    <a href="#">{{ $topic->user->getNameOrUsername() }}</a> <br /> {{ $topic->created_at->diffForHumans() }}
                </div>
            </div>
        </div>

        <div class="post-body">{!! $topic->body !!}</div>

        <div class="post-footer text-right">
            <a href="#" class="button">Report</a>
        </div>
    </div>
@endsection
