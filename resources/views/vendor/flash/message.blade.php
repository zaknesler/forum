@foreach (session('flash_notification', collect())->toArray() as $message)
    <div class="z-50 fixed pin-b pin-r m-4 p-4 bg-indigo text-white rounded font-medium shadow-md">
        {!! $message['message'] !!}
    </div>
@endforeach

{{ session()->forget('flash_notification') }}
