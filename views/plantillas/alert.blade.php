@isset($alertMessage)
<div class="alert alert-dismissible fade show {{ $alertMessage->getTipo() }}" role="alert">
    <span>{!! $alertMessage->getMensaje() !!}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endisset