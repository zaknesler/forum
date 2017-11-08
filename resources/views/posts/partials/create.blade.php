<form action="{{ route('posts.store', $topic) }}" method="POST">
    {{ csrf_field() }}

    <div class="font-medium mb-4 text-lg">Leave a reply</div>

    <div class="mb-4">
        <textarea class="bg-white border border-grey-lighter {{ $errors->first('body', ' border-red') }} shadow rounded p-4 appearance-none w-full" name="body" rows="5" placeholder="I have something to say..." v-autosize>{{ old('body') }}</textarea>

        @if ($errors->has('body'))
            <div class="text-red font-medium">{{ $errors->first('body') }}</div>
        @endif
    </div>

    <input type="submit" value="Create Post" class="appearance-none border-none bg-indigo hover:bg-indigo-dark text-white rounded py-3 px-6 text-center font-medium text-lg cursor-pointer shadow" />
</form>
