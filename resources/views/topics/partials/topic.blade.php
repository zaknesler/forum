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
            @if (auth()->user()->isGroup(['moderator', 'administrator']) && $topic->reports->count())
                <div class="panel-heading clearfix">
                    <a href="#" onclick="event.preventDefault();document.getElementById('clear-topic-reports-form').submit();" class="pull-right btn btn-xs btn-primary">
                        Clear {{ ucwords(str_plural_text('report', $topic->reports->count())) }}
                    </a>

                    <form method="POST" action="{{ route('topics.report.destroy', $topic->id) }}" id="clear-topic-reports-form" style="display: none;">
                        {{ csrf_field() }}

                        {{ method_field('DELETE') }}
                    </form>
                </div>
            @endif

            <div class="panel-body">
                @markdown($topic->body)
            </div>

            @if (auth()->check() && (auth()->user()->can('update', $topic) || auth()->user()->can('report', $topic)))
                <div class="panel-footer clearfix">
                    @can ('update', $topic)
                        <a href="{{ route('topics.edit', $topic->id) }}" class="pull-left btn btn-sm btn-default">
                            Edit
                        </a>
                    @endcan

                    @can ('report', $topic)
                        <a href="#" onclick="event.preventDefault();document.getElementById('topic-report-form').submit();" class="pull-right btn btn-sm btn-primary">
                            {{ $topic->isReportedBy(auth()->user()) ? 'Unreport' : 'Report' }}
                        </a>

                        <form method="POST" action="{{ route('topics.report.update', $topic->id) }}" id="topic-report-form" style="display: none;">
                            {{ csrf_field() }}

                            {{ method_field('PUT') }}
                        </form>
                    @endcan
                </div>
            @endif
        </div>
    </div>
</div>
