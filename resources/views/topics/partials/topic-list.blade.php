@foreach ($topics as $topic)
    <div class="relative bg-white border border-grey-lighter shadow rounded p-4 mb-4 flex items-center justify-between">
        <div>
            <div class="font-medium text-lg mb-2">
                <a href="{{ route('topics.show', $topic->slug) }}" class="no-underline text-grey-darker hover:text-grey-darkest">
                    {{ $topic->title }}
                </a>
            </div>

            <div class="inline-flex items-center">
                <a href="{{ route('users.show', $topic->user->username) }}" class="text-indigo hover:text-indigo-dark no-underline inline-flex items-center mr-1">
                    <img src="{{ $topic->user->getAvatar() }}" alt="Avatar" class="w-6 h-6 rounded-full border border-grey-lighter mr-1 pointer-events-none">
                    <span>{{ $topic->user->getNameOrUsername() }}</span>
                </a>

                posted {{ $topic->created_at->diffForHumans() }}
            </div>
        </div>

        <div class="font-medium text-grey-darkest pl-4 hidden sm:flex items-center" title="{{ $topic->posts->count() . ' ' . str_plural('reply', $topic->posts->count()) }}">
            <svg class="w-4 h-4 mr-1 fill-current text-grey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17 11v3l-3-3H8a2 2 0 0 1-2-2V2c0-1.1.9-2 2-2h10a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-1zm-3 2v2a2 2 0 0 1-2 2H6l-3 3v-3H2a2 2 0 0 1-2-2V8c0-1.1.9-2 2-2h2v3a4 4 0 0 0 4 4h6z"/></svg>
            <span>{{ $topic->posts->count() }}</span>
        </div>
    </div>
@endforeach
