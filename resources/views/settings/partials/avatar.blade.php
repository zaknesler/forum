<form action="{{ route('settings.avatar.update') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form">
        <div class="form-group{{ $errors->first('avatar', ' has-error') }}">
            <div class="form-image" style="background-image: url({{ $user->getAvatar() }})"></div>

            <input type="file" name="avatar" required />

            @if ($errors->has('avatar'))
                <div class="form-message">{{ $errors->first('avatar') }}</div>
            @endif
        </div>

        <div class="form-group">
            <input type="submit" value="Update Avatar" class="button button-large" />
        </div>
    </div>
</form>
