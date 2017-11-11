<div class="font-medium text-lg mb-4">Profile</div>

<div class="bg-white border border-grey-lighter shadow rounded p-4">
    <form action="{{ route('settings.profile.update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="name">
                Name
            </label>

            <input autofocus autocomplete="off" class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('name', ' border-red') }}" id="name" type="text" name="name" value="{{ old('name') ?? $user->name }}" />

            @if ($errors->has('name'))
                <div class="text-red font-medium mt-2">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-medium mb-2" for="email">
                E-Mail
            </label>

            <input required class="appearance-none leading-normal block w-full rounded p-3 bg-grey-lighter text-grey-darker border border-grey-light {{ $errors->first('email', ' border-red') }}" id="email" type="email" name="email" value="{{ old('email') ?? $user->email }}" />

            @if ($errors->has('email'))
                <div class="text-red font-medium mt-2">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="text-right">
            <button type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Update</button>
        </div>
    </form>
</div>
