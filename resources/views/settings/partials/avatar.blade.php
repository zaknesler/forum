<div class="font-medium text-lg mb-4">Avatar</div>

<div class="bg-white border border-grey-lighter shadow rounded p-4">
    <form action="{{ route('settings.avatar.update') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="mb-4">
            <div class="text-center">
                <img src="{{ $user->getAvatar() }}" alt="Avatar" class="w-1/2 h-auto rounded shadow mb-4 pointer-events-none" />
            </div>

            <input required type="file" name="avatar" />

            @if ($errors->has('avatar'))
                <div class="text-red font-medium mt-2">{{ $errors->first('avatar') }}</div>
            @endif
        </div>

        <div class="text-right">
            @if (auth()->user()->avatar)
                <avatar-delete classes="no-underline text-indigo hover:text-indigo-dark font-medium mr-4"></avatar-delete>
            @endif

            <button type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Update</button>
        </div>
    </form>
</div>
