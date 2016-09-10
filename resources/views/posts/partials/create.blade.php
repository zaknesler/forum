<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" method="post" action="{{ route('posts.store', [$topic->id]) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->first('body', ' has-error') }}">
                <label for="body" class="control-label">Body</label>

                <textarea name="body" id="body" rows="15" class="form-control" required>{{ old('body') }}</textarea>

                @if ($errors->has('body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Post
                </button>
            </div>
        </form>
    </div>
</div>
