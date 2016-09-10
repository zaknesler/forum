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
                {{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->getNameOrUsername() }}</a>
            </small>
        </h4>

        <div class="panel panel-default">
            <div class="panel-body">
                @markdown($topic->body)
            </div>

            @if (auth()->user()->can('update', $topic) || auth()->user()->can('delete', $topic))
                <div class="panel-footer clearfix">
                    @can ('update', $topic)
                        <a href="{{ route('topics.edit', $topic->id) }}" class="pull-left btn btn-sm btn-default">
                            Edit
                        </a>
                    @endcan

                    @can ('delete', $topic)
                        <a href="#" onclick="event.preventDefault();document.getElementById('topic-delete-form').submit();" class="pull-right btn btn-sm btn-danger">
                            Delete
                        </a>

                        <form method="POST" action="{{ route('topics.destroy', $topic->id) }}" id="topic-delete-form" style="display: none;">
                            {{ csrf_field() }}

                            {{ method_field('DELETE') }}
                        </form>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</div>
