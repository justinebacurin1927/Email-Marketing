let notificationPollInterval = null;

function openNotificationPanel() {
  document.getElementById('notificationOverlay').classList.remove('d-none');
  document.getElementById('notificationPanel').classList.add('open');
  fetchNotifications();
  document.body.style.overflow = 'hidden';
}

function closeNotificationPanel() {
  document.getElementById('notificationOverlay').classList.add('d-none');
  document.getElementById('notificationPanel').classList.remove('open');
  document.body.style.overflow = '';
}

function fetchNotifications() {
  fetch('/notifications')
    .then(r => r.json())
    .then(notifications => {
      const list = document.getElementById('notificationList');
      const empty = document.getElementById('notificationEmpty');

      if (notifications.length === 0) {
        list.innerHTML = '';
        list.appendChild(empty);
        return;
      }

      list.innerHTML = '';
      notifications.forEach(n => {
        const data = typeof n.data === 'string' ? JSON.parse(n.data) : n.data;
        const isUnread = !n.read_at;
        const div = document.createElement('div');
        div.className = `notification-item d-flex align-items-start gap-2 ${isUnread ? 'unread' : ''}`;
        div.innerHTML = `
          <i class="bi ${data.icon || 'bi-bell'} mt-1" style="color: #e94560; font-size: 1rem;"></i>
          <div class="flex-grow-1 min-width-0">
            <div class="small text-dark">${data.message || ''}</div>
            <small class="text-muted">${timeAgo(n.created_at)}</small>
          </div>
          ${isUnread ? '<span class="notification-dot mt-1"></span>' : ''}
        `;
        div.onclick = () => markAsRead(n.id, data.url || '#');
        list.appendChild(div);
      });
    });
}

function markAsRead(id, url) {
  fetch(`/notifications/${id}/read`, { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken } })
    .then(() => {
      updateUnreadCount();
      if (url && url !== '#') window.location.href = url;
    });
}

function markAllRead() {
  fetch('/notifications/read-all', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrfToken } })
    .then(() => {
      document.querySelectorAll('.notification-item.unread').forEach(el => el.classList.remove('unread'));
      document.querySelectorAll('.notification-dot').forEach(el => el.remove());
      updateUnreadCount();
    });
}

function updateUnreadCount() {
  fetch('/notifications/unread-count')
    .then(r => r.json())
    .then(data => {
      const badge = document.getElementById('notificationBadge');
      if (data.count > 0) {
        badge.textContent = data.count;
        badge.classList.remove('d-none');
      } else {
        badge.classList.add('d-none');
      }
    });
}

function timeAgo(dateStr) {
  const now = new Date();
  const date = new Date(dateStr);
  const seconds = Math.floor((now - date) / 1000);

  if (seconds < 60) return 'just now';
  const minutes = Math.floor(seconds / 60);
  if (minutes < 60) return `${minutes}m ago`;
  const hours = Math.floor(minutes / 60);
  if (hours < 24) return `${hours}h ago`;
  const days = Math.floor(hours / 24);
  if (days < 7) return `${days}d ago`;
  return date.toLocaleDateString();
}

// Poll for unread count every 30 seconds
if (notificationPollInterval) clearInterval(notificationPollInterval);
notificationPollInterval = setInterval(updateUnreadCount, 30000);

// Initial load
updateUnreadCount();
