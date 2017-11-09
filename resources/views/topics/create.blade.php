@extends('layouts.app')

@section('title', 'Create Topic')

@section('content')
    <div class="bg-grey-lighter text-grey-darker">
        <div class="container mx-auto px-4 pt-0">
            <div class="mx-auto w-full md:w-4/5 lg:w-2/3">
                <div class="mb-4 font-medium text-lg">Create Topic</div>

                <div class="bg-white border border-grey-lighter shadow rounded p-4">
                    <form action="{{ route('topics.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="title">
                                Title
                            </label>

                            <input required autofocus tabindex="1" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('title', ' border-red') }}" id="title" type="text" name="title" value="{{ old('title') }}" />

                            @if ($errors->has('title'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('title') }}</div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="body">
                                Body
                            </label>

                            <textarea required tabindex="2" class="appearance-none leading-normal resize-y block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('body', ' border-red') }}" id="body" type="text" name="body" rows="10" v-autosize>{{ old('body') }}</textarea>

                            @if ($errors->has('body'))
                                <div class="text-red font-medium mt-2">{{ $errors->first('body') }}</div>
                            @endif
                        </div>

                        <div class="text-right">
                            <button tabindex="3" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Create Topic</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
