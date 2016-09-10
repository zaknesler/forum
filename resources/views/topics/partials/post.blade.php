<div class="row">
    <div class="col-md-1 hidden-xs hidden-sm col-no-pad clearfix">
        <div class="user-avatar user-avatar--forum pull-right">
            <img src="{{ $post->user->getAvatar(40) }}" alt="User Avatar" class="user-avatar__image">
        </div>
    </div>

    <div class="col-md-11">
        <h4>
            <small>
                {{ $post->created_at->diffForHumans() }} by <a href="#">{{ $post->user->getNameOrUsername() }}</a>
            </small>
        </h4>

        <div class="panel panel-default">
            <div class="panel-body">
                @markdown($post->body)
            </div>

            @if (auth()->user()->can('update', $post) || auth()->user()->can('delete', $post))
                <div class="panel-footer clearfix">
                    @can ('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}" class="pull-left btn btn-sm btn-default">
                            Edit
                        </a>
                    @endcan

                    @can ('delete', $post)
                        <a href="#" onclick="event.preventDefault();document.getElementById('post-delete-form').submit();" class="pull-right btn btn-sm btn-danger">
                            Delete
                        </a>

                        <form method="POST" action="{{ route('posts.destroy', $post->id) }}" id="post-delete-form" style="display: none;">
                            {{ csrf_field() }}

                            {{ method_field('DELETE') }}
                        </form>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</div>
