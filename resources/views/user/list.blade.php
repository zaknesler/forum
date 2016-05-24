@extends('layouts.app')

@section('content')
<div class="container">
    <h3>All users</h3>
    <div class="row">
        <div class="col-md-10">
            @if ($users->count())
                <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item"><h4>
                            <a href="{{ route('user.profile', ['username' => $user->username]) }}">{{ $user->username }}</a>
                        </h4></li>
                    @endforeach
                </ul>
                {{ $users->render() }}
            @else
                <hr>
                <p>No registered users.</p>
            @endif
        </div>
    </div>
</div>
@endsection
