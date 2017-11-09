<div class="mt-8 mb-4 font-medium text-lg">Leave a Reply</div>

<div class="bg-white border border-grey-lighter shadow rounded p-4">
    <form action="{{ route('posts.store', $topic) }}" method="POST">
        {{ csrf_field() }}

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="body">
                Body
            </label>

            <textarea required tabindex="1" class="appearance-none leading-normal resize-y block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('body', ' border-red') }}" id="body" type="text" name="body" rows="7" v-autosize>{{ old('body') }}</textarea>

            @if ($errors->has('body'))
                <div class="text-red font-medium mt-2">{{ $errors->first('body') }}</div>
            @endif
        </div>

        <div class="text-right">
            <button tabindex="2" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Create Post</button>
        </div>
    </form>
</div>
