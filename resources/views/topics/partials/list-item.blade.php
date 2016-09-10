<li class="list-group-item clearfix">
    <a href="{{ route('topics.show', [$topic->slug, $topic->id]) }}">{{ $topic->title }}</a>

    <span class="pull-right">
        {{ str_plural_text('post', $topic->posts->count()) }}
    </span>

    <br />

    <small>
        {{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->getNameOrUsername() }}</a>
    </small>
</li>
