<form action="{{ route('settings.password.update') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

    <div class="form">
        <div class="form-title">
            Password Settings
        </div>

        <div class="form-group{{ $errors->first('old_password', ' has-error') }}">
            <div class="form-label">Old Password</div>

            <input type="password" name="old_password" required class="form-input" />

            @if ($errors->has('old_password'))
                <div class="form-message">{{ $errors->first('old_password') }}</div>
            @endif
        </div>

        <div class="form-group{{ $errors->first('password', ' has-error') }}">
            <div class="form-label">New Password</div>

            <input type="password" name="password" required class="form-input" />

            @if ($errors->has('password'))
                <div class="form-message">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="form-group{{ $errors->first('password_confirmation', ' has-error') }}">
            <div class="form-label">Confirm New Password</div>

            <input type="password" name="password_confirmation" required class="form-input" />

            @if ($errors->has('password_confirmation'))
                <div class="form-message">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="form-group">
            <input type="submit" value="Update Password" class="button button-large" />
        </div>
    </div>
</form>
