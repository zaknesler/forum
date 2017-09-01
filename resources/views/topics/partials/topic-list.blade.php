<div class="list-group">
    @foreach ($topics as $topic)
        <div class="list-group-item">
            <strong>
                <a href="{{ route('topics.show', $topic->slug) }}">{{ $topic->title }}</a>
            </strong>

            <div class="text-light">
                by

                @isset($user)
                    <a href="{{ route('users.show', $user->username) }}">
                        {{ $user->getNameOrUsername() }}
                    </a>
                @else
                    <a href="{{ route('users.show', $topic->user->username) }}">
                        {{ $topic->user->getNameOrUsername() }}
                    </a>
                @endisset

                &mdash; {{ $topic->created_at->diffForHumans() }}
            </div>
        </div>
    @endforeach
</div>
