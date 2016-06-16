@extends('layouts.app')

@section('title', 'User list')

@section('content')
<div class="container">
    <div class="general-title">All users</div>
    <div class="row">
        <div class="col-md-8">
            @if ($users->count())
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item"><h4>
                            @role (['admin', 'owner'])
                            <a class="label label-warning pull-right" href="{{ route('user.edit', ['id' => $user->id]) }}">Edit</a>
                            @endrole
                            <a href="{{ route('user.profile', ['username' => $user->username]) }}">{{ $user->username }}</a>
                            <br />
                            <small>
                                {{ $user->email }}
                            </small>
                        </h4></li>
                    @endforeach
                </ul>
                {!! $users->render() !!}
            @else
                <div class="box">
                    <p>No registered users.</p>
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <form action="{{ route('user.list') }}" method="get">
                <div class="form-group{{ $errors->has('search') ? ' has-error' : '' }}">
                    <div class="input-group" title="Powered by Algolia">
                        <input type="text" placeholder="Search users.." class="form-control" name="search" value="{{ request('search') }}" required="required">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                    @if ($errors->has('search'))
                        <span class="help-block">
                            <strong>{{ $errors->first('search') }}</strong>
                        </span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
