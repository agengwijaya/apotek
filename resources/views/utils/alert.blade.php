<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 999999999999999;">
  <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    @if ($message = Session::get('success'))
      <div class="toast-header bg-success text-white">
        <strong class="me-auto">Success!</strong>
        <small>{{ tanggal_indonesia(date('Y-m-d H:i:s')) }}</small>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ $message }}
      </div>
    @endif
    @if ($message = Session::get('error'))
      <div class="toast-header bg-danger text-white">
        <strong class="me-auto">Error!</strong>
        <small>{{ tanggal_indonesia(date('Y-m-d H:i:s')) }}</small>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ $message }}
      </div>
    @endif
    @if ($message = Session::get('warning'))
      <div class="toast-header bg-warning text-white">
        <strong class="me-auto">Warning!</strong>
        <small>{{ tanggal_indonesia(date('Y-m-d H:i:s')) }}</small>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        {{ $message }}
      </div>
    @endif
  </div>
</div>
