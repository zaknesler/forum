@extends('layouts.app')

@section('title', '@' . $user->username)

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex flex-wrap lg:flex-row -m-4">
            <div class="w-full md:w-auto p-4">
                <div class="font-medium text-lg mb-4">Profile</div>

                <div class="bg-white border border-grey-lighter shadow rounded flex flex-row md:flex-col p-4">
                    <div class="text-center">
                        <img src="{{ $user->getAvatar() }}" alt="Avatar" class="rounded shadow h-auto w-full pointer-events-none mb-0 md:mb-4" />
                    </div>

                    <div class="ml-4 md:ml-0">
                        <div class="text-xl font-medium">{{ $user->name ?? ('@' . $user->username) }}</div>
                        <div class="text-sm text-grey-dark">Joined {{ $user->created_at->diffForHumans() }}</div>

                        @if ($user->privacy->show_email)
                            <div class="text-sm text-grey-darker flex items-center mt-4">
                                <svg class="text-grey w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/></svg>
                                <div class="ml-2 break-words">{{ $user->email }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex-grow p-4">
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
@endsection
