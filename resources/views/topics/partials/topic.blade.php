<div class="row">
    <div class="col-md-1 hidden-xs hidden-sm col-no-pad clearfix">
        <div class="user-avatar user-avatar--forum pull-right">
            <img src="{{ $topic->user->getAvatar(40) }}" alt="User Avatar" class="user-avatar__image">
        </div>
    </div>

    <div class="col-md-11">
        <h4>{{ $topic->title }}</h4>

        <h4>
            <small>
                {{ $topic->created_at->diffForHumans() }} by <a href="{{ route('users.show', $topic->user->username) }}">{{ $topic->user->getNameOrUsername() }}</a>
            </small>
        </h4>

        <div class="panel panel-default">
            <div class="panel-body">
                @markdown($topic->body)
            </div>

            @can ('update', $topic)
                <div class="panel-footer">
                    <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-sm btn-default">
                        Edit
                    </a>
                </div>
            @endcan
        </div>
    </div>
</div>
