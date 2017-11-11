<div class="font-medium text-lg mb-4">Privacy</div>

<div class="bg-white border border-grey-lighter shadow rounded p-4">
    <form action="{{ route('settings.privacy.update') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="mb-4">
            <label for="show_email" class="flex items-center select-none">
                <input type="checkbox" id="show_email" name="show_email" {{ $user->privacy->show_email ? 'checked' : '' }} />

                <span class="ml-2">Show email on profile</span>
            </label>
        </div>

        <div class="text-right">
            <button type="submit" class="cursor-pointer bg-indigo hover:bg-indigo-dark border-none text-white font-medium py-3 px-6 rounded shadow">Update</button>
        </div>
    </form>
</div>
