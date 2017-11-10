@extends('layouts.app')

@section('title', '@' . $user->username)

@section('content')
    <div class="bg-grey-lighter text-grey-darker">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap lg:flex-row -m-4">
                <div class="w-full md:w-2/5 lg:w-1/5 p-4">
                    <div class="mb-4 font-medium text-lg">Profile</div>

                    <div class="bg-white border border-grey-lighter shadow rounded p-4">
                        <div class="text-center">
                            <img src="{{ $user->getAvatar() }}" alt="Avatar" class="w-2/3 md:w-full pointer-events-none mb-4" />
                        </div>

                        <div>
                            <div class="text-xl font-medium">{{ $user->name ?? ('@' . $user->username) }}</div>
                            <div class="text-sm text-grey-dark">Joined {{ $user->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-3/5 lg:w-4/5 p-4">
                    <div class="mb-4 font-medium text-lg">Topics</div>

                    @if ($topics->total())
                        <div class="-mb-4">
                            @include('topics.partials.topic-list', $topics)
                        </div>

                        {{ $topics->render() }}
                    @else
                        <div class="bg-white border border-grey-lighter shadow rounded p-8 text-center">
                            <svg class="w-16 h-16 text-grey mb-8 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                            <div class="text-lg font-medium">This user has not posted any topics.</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
