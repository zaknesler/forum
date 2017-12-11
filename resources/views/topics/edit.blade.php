@extends('layouts.app')

@section('title', 'Edit Topic')

@section('content')
    <div class="container mx-auto p-4">
        <div class="mx-auto w-full">
            <div class="font-medium text-lg mb-4">Edit Topic</div>

            <div class="bg-white border border-grey-lighter shadow rounded p-4">
                <form action="{{ route('topics.update', $topic->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="mb-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="title">
                            Title
                        </label>

                        <input required autofocus tabindex="1" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('title', ' border-red') }}" id="title" type="text" name="title" value="{{ old('title') ?? $topic->title }}" />

                        @if ($errors->has('title'))
                            <div class="text-red font-medium mt-2">{{ $errors->first('title') }}</div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="body">
                            Body
                        </label>

                        <textarea-autosize v-pre required tabindex="2" rows="10" id="body" name="body" value="{{ old('body') ?? $topic->body }}" classes="appearance-none leading-normal resize-y block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('body', ' border-red') }}"></textarea-autosize>

                        @if ($errors->has('body'))
                            <div class="text-red font-medium mt-2">{{ $errors->first('body') }}</div>
                        @endif
                    </div>

                    <div class="text-right">
                        @can ('delete', $topic)
                            <topic-delete topic="{{ $topic->id }}" classes="no-underline text-indigo hover:text-indigo-dark font-medium mr-4"></topic-delete>
                        @endcan

                        <button tabindex="3" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
