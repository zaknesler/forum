<form action="{{ route('settings.profile.update') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form">
        <div class="form-group{{ $errors->first('name', ' has-error') }}">
            <div class="form-label">Name</div>

            <input type="text" name="name" value="{{ old('name') ?? $user->name }}" autofocus class="form-input" />

            @if ($errors->has('name'))
                <div class="form-message">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="form-group{{ $errors->first('email', ' has-error') }}">
            <div class="form-label">E-mail</div>

            <input type="email" name="email" value="{{ old('email') ?? $user->email }}" required class="form-input" />

            @if ($errors->has('email'))
                <div class="form-message">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="form-group">
            <input type="submit" value="Update Profile" class="button button-large" />
        </div>
    </div>
</form>
