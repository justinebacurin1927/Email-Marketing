<div id="notificationOverlay" class="notification-overlay d-none" onclick="closeNotificationPanel()"></div>

<div id="notificationPanel" class="notification-panel shadow-lg">
  <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom">
    <h6 class="mb-0 fw-bold">Notifications</h6>
    <div class="d-flex align-items-center gap-2">
      <button class="btn btn-sm text-primary p-0 border-0 bg-transparent small fw-medium" onclick="markAllRead()">Mark all read</button>
      <button class="btn btn-sm p-0 border-0 bg-transparent" onclick="closeNotificationPanel()" style="font-size: 1.2rem; color: #6c757d;">&times;</button>
    </div>
  </div>

  <div class="notification-list" id="notificationList">
    <div class="text-center text-muted small py-5" id="notificationEmpty">
      <i class="bi bi-bell" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
      No notifications yet
    </div>
  </div>
</div>

<style>
  .notification-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.3);
    z-index: 1055;
  }
  .notification-panel {
    position: fixed;
    top: 0; right: 0;
    width: 380px;
    height: 100vh;
    background: #fff;
    z-index: 1060;
    transform: translateX(100%);
    transition: transform 0.25s ease;
    display: flex;
    flex-direction: column;
  }
  .notification-panel.open {
    transform: translateX(0);
  }
  .notification-list {
    flex: 1;
    overflow-y: auto;
  }
  .notification-item {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
    transition: background 0.15s;
  }
  .notification-item:hover {
    background: #f8f9fa;
  }
  .notification-item.unread {
    border-left: 3px solid #e94560;
    background: #fff5f6;
  }
  .notification-item.unread:hover {
    background: #ffe8ea;
  }
  .notification-dot {
    width: 8px; height: 8px;
    background: #e94560;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
  }
</style>
