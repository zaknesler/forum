@extends('layouts.app')

@section('title', 'Topics')

@section('content')
    <div class="bg-grey-lighter text-grey-darker">
        <div class="container mx-auto px-4 pt-0">
            <div class="mb-4 font-medium text-lg">Topics</div>

            @if ($topics->total())
                <div class="flex flex-wrap flex-col-reverse lg:flex-row -mx-4">
                    @auth
                        <div class="w-full lg:w-4/5 px-4">
                            @include('topics.partials.topic-list', $topics)
                        </div>

                        <div class="w-full lg:w-1/5 px-4">
                            <a href="{{ route('topics.create') }}" class="block no-underline bg-indigo hover:bg-indigo-dark text-white rounded py-3 px-6 text-center font-medium text-lg w-full cursor-pointer shadow mb-4">Create Topic</a>
                        </div>
                    @else
                        <div class="w-full px-4">
                            @include('topics.partials.topic-list', $topics)
                        </div>
                    @endauth
                </div>

                {{ $topics->render() }}
            @else
                <div class="bg-white border border-grey-lighter shadow rounded p-8 text-center">
                    <svg class="w-16 h-16 text-grey mb-8 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                    <div class="text-lg font-medium">There are no topics to display.</div>

                    @auth
                        <p class="mt-8">
                            <a href="{{ route('topics.create') }}" class="inline-block no-underline bg-indigo hover:bg-indigo-dark text-white rounded py-3 px-6 text-center font-medium text-lg cursor-pointer shadow">
                                Create Topic
                            </a>
                        </p>
                    @endauth
                </div>
            @endif
        </div>
    </div>
@endsection
