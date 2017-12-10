<div class="font-medium text-lg mb-4 mt-8">Leave a Reply</div>

<div class="bg-white border border-grey-lighter shadow rounded p-4">
    <form action="{{ route('posts.store', $topic) }}" method="POST">
        {{ csrf_field() }}

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="body">
                Body
            </label>

            <textarea-autosize v-pre required tabindex="1" rows="5" id="body" name="body" value="{{ old('body') }}" classes="appearance-none leading-normal resize-y block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('body', ' border-red') }}"></textarea-autosize>

            @if ($errors->has('body'))
                <div class="text-red font-medium mt-2">{{ $errors->first('body') }}</div>
            @endif
        </div>

        <div class="text-right">
            <button tabindex="2" type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Reply</button>
        </div>
    </form>
</div>
