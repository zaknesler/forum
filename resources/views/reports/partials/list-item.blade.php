<li class="list-group-item clearfix">
    <div class="pull-left">
        <strong>{{ $report->created_at->diffForHumans() }}</strong>

        <br />

        by

        <a href="{{ route('users.show', $report->user->username) }}">
            {{ $report->user->getNameOrUsername() }}
        </a>
    </div>

    <div class="pull-right text-right">
        <a href="{{ route('reports.destroy', $report->id) }}" onclick="event.preventDefault();document.getElementById('report-delete-form-{{ $report->id }}').submit();" class="btn btn-sm btn-danger">
            Delete
        </a>

        <form method="POST" action="{{ route('reports.destroy', $report->id) }}" id="report-delete-form-{{ $report->id }}" style="display: none;">
            {{ csrf_field() }}

            {{ method_field('DELETE') }}
        </form>
    </div>
</li>
