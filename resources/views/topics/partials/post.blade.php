<div class="post">
    <div class="post-header">
        <div class="post-author">
            <a href="{{ route('users.show', $post->user->username) }}" class="post-author_image" style="background-image: url({{ $post->user->getAvatar(50) }})"></a>

            <div class="post-author_info">
                <a href="{{ route('users.show', $post->user->username) }}">
                    {{ $post->user->getNameOrUsername() }}
                </a> <br /> {{ $post->created_at->diffForHumans() }}

                @can('update', $post)
                    &mdash; <a href="{{ route('posts.edit', [$post->topic->id, $post->id]) }}">Edit</a>
                @endcan
            </div>
        </div>
    </div>

    <div class="post-body">{!! Markdown::text($post->body) !!}</div>
</div>
