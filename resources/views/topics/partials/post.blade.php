<div class="bg-white border border-grey-lighter shadow rounded p-4 mb-4">
    <div class="flex items-center mb-4">
        <img src="{{ $post->user->getAvatar(50) }}" alt="Avatar" class="w-12 h-12 rounded-full border border-grey-lighter">

        <div class="ml-2 text-grey-dark">
            <a href="{{ route('users.show', $post->user->username) }}" class="text-indigo hover:text-indigo-dark no-underline">
                {{ $post->user->getNameOrUsername() }}
            </a>

            posted {{ $post->created_at->diffForHumans() }}

            @can('update', $post)
                &mdash;
                <a href="{{ route('posts.edit', [$topic->id, $post->id]) }}" class="text-indigo hover:text-indigo-dark no-underline">
                    Edit
                </a>
            @endcan
        </div>
    </div>

    <div>
        @parsedown($post->body)
    </div>
</div>
