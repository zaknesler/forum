@foreach (session('flash_notification', collect())->toArray() as $message)
    <div class="flash">
        <div class="flash-wrap container">
            <div class="alert alert-{{ $message['level'] }}" role="alert">
                {!! $message['message'] !!}
            </div>
        </div>
    </div>
@endforeach

{{ session()->forget('flash_notification') }}
