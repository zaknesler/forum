<form action="{{ route('posts.store', $topic) }}" method="POST">
    {{ csrf_field() }}

    <div class="form">
        <div class="form-title">Leave a reply</div>

        <div class="form-group{{ $errors->first('body', ' has-error') }}">
            <textarea name="body" rows="5" class="form-input" placeholder="I have something to say..." v-autosize>{{ old('body') }}</textarea>

            @if ($errors->has('body'))
                <div class="form-message">{{ $errors->first('body') }}</div>
            @endif
        </div>

        <div class="form-group text-right">
            <input type="submit" value="Create Post" class="button button-large" />
        </div>
    </div>
</form>
