@if (session('error'))
  <div class="flash flash-error">{{ session('error') }}</div>
@endif

@if (session('info'))
  <div class="flash flash-info">{{ session('info') }}</div>
@endif
