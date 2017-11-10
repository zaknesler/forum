<div class="font-medium text-lg mb-4">Password</div>

<div class="bg-white border border-grey-lighter shadow rounded p-4">
    <form action="{{ route('settings.password.update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="old_password">
                Old Password
            </label>

            <input required autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('old_password', ' border-red') }}" id="old_password" type="password" name="old_password" />

            @if ($errors->has('old_password'))
                <div class="text-red font-medium mt-2">{{ $errors->first('old_password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password">
                New Password
            </label>

            <input required autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password', ' border-red') }}" id="password" type="password" name="password" />

            @if ($errors->has('password'))
                <div class="text-red font-medium mt-2">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="password_confirmation">
                Confirm New Password
            </label>

            <input required autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('password_confirmation', ' border-red') }}" id="password_confirmation" type="password" name="password_confirmation" />

            @if ($errors->has('password_confirmation'))
                <div class="text-red font-medium mt-2">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="text-right">
            <button type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Update</button>
        </div>
    </form>
</div>
