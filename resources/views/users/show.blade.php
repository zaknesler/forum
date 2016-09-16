@extends('layouts.app')

@section('title', '@' . $user->username)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Profile of <strong>{{ '@' . $user->username }}</strong>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="user-avatar">
                                    <img src="{{ $user->getAvatar(150) }}" alt="Avatar" class="img-responsive user-avatar__image center-block" />
                                </div>
                            </div>

                            <div class="col-md-9">
                                @if ($user->name)
                                    <strong>Name</strong>
                                    <p>{{ $user->name }}</p>
                                @endif

                                <strong>Email</strong>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
