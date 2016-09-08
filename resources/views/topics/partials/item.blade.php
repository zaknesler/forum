<li class="list-group-item">
    <a href="{{ route('topics.show', [$topic->slug, $topic->id]) }}">{{ $topic->title }}</a>

    <br />
    <small>
        {{ $topic->created_at->diffForHumans() }} by <a href="#">{{ $topic->user->getNameOrUsername() }}</a>
    </small>
</li>
