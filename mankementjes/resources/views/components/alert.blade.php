
    <div class="c-alert c-alert-{{ $type }}" role="alert">
    @if ($type == 'danger')
        <i class="bi bi-exclamation-triangle"></i>
    @elseif ($type == 'success')
        <i class="bi bi-check-circle"></i>
    @elseif ($type == 'info')
        <i class="bi bi-info-circle"></i>
    @endif
    &nbsp;
        {{ $message }}
    </div>