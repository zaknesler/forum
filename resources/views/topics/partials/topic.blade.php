<div class="bg-white border border-grey-lighter shadow rounded p-4 mb-4">
    <div class="font-medium text-lg mb-4">{{ $topic->title }}</div>

    <div class="flex items-center mb-4">
        <img src="{{ $topic->user->getAvatar(50) }}" alt="Avatar" class="w-12 h-12 rounded-full border border-grey-lighter pointer-events-none">

        <div class="ml-2 text-grey-dark">
            <a href="{{ route('users.show', $topic->user->username) }}" class="text-indigo-dark hover:text-indigo-darkest no-underline">
                {{ $topic->user->getNameOrUsername() }}
            </a>

            posted {{ $topic->created_at->diffForHumans() }}

            @can('update', $topic)
                &mdash;
                <a href="{{ route('topics.edit', $topic) }}" class="text-indigo hover:text-indigo-dark no-underline">
                    Edit
                </a>
            @endcan
        </div>
    </div>

    <div class="markdown">
        {!! Markdown::convertToHtml($topic->body) !!}
    </div>
</div>
