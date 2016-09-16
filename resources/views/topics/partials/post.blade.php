<div class="row">
    <div class="col-md-1 hidden-xs hidden-sm col-no-pad clearfix">
        <div class="user-avatar user-avatar--forum pull-right">
            <img src="{{ $post->user->getAvatar(40) }}" alt="User Avatar" class="user-avatar__image">
        </div>
    </div>

    <div class="col-md-11">
        <h4>
            <small>
                {{ $post->created_at->diffForHumans() }} by <a href="{{ route('users.show', $post->user->username) }}">{{ $post->user->getNameOrUsername() }}</a>
            </small>
        </h4>

        <div class="panel panel-default">
            <div class="panel-body">
                @markdown($post->body)
            </div>

            @can ('update', $post)
                <div class="panel-footer">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-default">
                        Edit
                    </a>
                </div>
            @endcan
        </div>
    </div>
</div>
