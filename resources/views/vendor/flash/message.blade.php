@if (session()->has('flash_notification.message'))
    <div class="flash">
        <div class="flash-wrap container">
            <div class="alert alert-{{ session('flash_notification.level') }}">
                {!! session('flash_notification.message') !!}
            </div>
        </div>
    </div>
@endif
