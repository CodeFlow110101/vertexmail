<div>
    {!! $template !!}
    <img src="{{ route('email.open', ['id' => $id]) }}" width="1" height="1" alt="" style="display: none;">
    <!-- <img src="{{ route('email.open', ['id' => $id]) }}" width="100" height="100" alt="Tracking Pixel"> -->
</div>