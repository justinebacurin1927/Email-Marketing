<header class="border-bottom px-3 py-2"
  style="position: fixed; top: 0; left: 16rem; right: 0; z-index: 1050; background-color: #ffffff;">

  <div class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <span class="text-muted small" id="liveDateTime"></span>
    </div>
    <div class="d-flex align-items-center gap-3">
      <button onclick="openNotificationPanel()" class="btn btn-sm position-relative bg-transparent border-0 p-1" style="font-size: 1.2rem;">
        <i class="bi bi-bell text-muted"></i>
        <span id="notificationBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill d-none"
          style="background: #e94560; font-size: 0.6rem; min-width: 18px; height: 18px; line-height: 18px; padding: 0 4px;">0</span>
      </button>
      @php $user = auth()->user(); @endphp
      <a href="{{ route('profile.index') }}" class="d-flex align-items-center gap-3 text-decoration-none">
      <span class="text-muted small">{{ $user->name ?? 'Guest' }}</span>
      @if($user && $user->avatar_url)
        <img src="{{ $user->avatar_url }}" alt="Avatar"
          class="rounded-circle" style="width: 2.2rem; height: 2.2rem; object-fit: cover;">
      @else
        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
          style="width: 2.2rem; height: 2.2rem; background-color: #1a1a2e; font-size: 0.85rem;">
          {{ substr($user->name ?? 'G', 0, 1) }}
        </div>
      @endif
    </a>
  </div>
</header>

<script>
  function updateClock() {
    const now = new Date();
    document.getElementById('liveDateTime').textContent = now.toLocaleDateString('en-US', {
      weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    }) + ' | ' + now.toLocaleTimeString('en-US', {
      hour: '2-digit', minute: '2-digit', second: '2-digit'
    });
  }
  updateClock();
  setInterval(updateClock, 1000);
</script>
