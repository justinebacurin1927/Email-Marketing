<aside id="sidebar"
  class="d-flex flex-column text-white position-fixed"
  style="top: 0; left: 0; height: 100vh; width: 16rem; transition: all 0.3s; overflow-y: auto; z-index: 1040; background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);">

  <div class="p-3 border-bottom border-secondary">
    <h5 class="fw-bold mb-0" style="color: #e94560;">SendFlow</h5>
    <small class="text-secondary" style="color: #8899aa !important;">Email Marketing</small>
  </div>

  <nav class="flex-grow-1 py-2">
    <ul class="list-unstyled px-2 mb-0">
      <li class="mb-1">
        <a href="/" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">🏠</span>
          <span class="sidebar-text">Home</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/campaigns" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">📨</span>
          <span class="sidebar-text">Campaigns</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/message-temp" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">📄</span>
          <span class="sidebar-text">Templates</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="{{ route('automations.index') }}" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">⚡</span>
          <span class="sidebar-text">Automations</span>
        </a>
      </li>

      <li class="mt-3 mb-1">
        <small class="text-secondary px-2" style="color: #8899aa !important; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Audience</small>
      </li>
      <li class="mb-1">
        <a href="/audience/dashboards" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">📊</span>
          <span class="sidebar-text">Dashboard</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/audience" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">👥</span>
          <span class="sidebar-text">Contacts</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/audience/audience-tags" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">🏷️</span>
          <span class="sidebar-text">Tags</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/audience/inbox" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">📬</span>
          <span class="sidebar-text">Inbox</span>
        </a>
      </li>

      <li class="mt-3 mb-1">
        <small class="text-secondary px-2" style="color: #8899aa !important; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px;">Settings</small>
      </li>
      <li class="mb-1">
        <a href="/audience/add-labels" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">🏷️</span>
          <span class="sidebar-text">Labels</span>
        </a>
      </li>
      <li class="mb-1">
        <a href="/add-source" class="d-flex align-items-center gap-2 p-2 rounded text-decoration-none sidebar-link">
          <span style="width: 20px; text-align: center;">📡</span>
          <span class="sidebar-text">Sources</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="p-3 border-top border-secondary">
    <a href="/add-contact" class="btn w-100 mb-2" style="background-color: #e94560; color: white; border: none;">
      + New Contact
    </a>
    <a href="/campaigns/create" class="btn w-100" style="background-color: transparent; color: #e94560; border: 1px solid #e94560;">
      + New Campaign
    </a>
  </div>
</aside>

<div style="margin-left: 16rem;">
  @yield('content')
</div>

<style>
  .sidebar-link {
    color: #c4c4d4;
    transition: all 0.2s;
    font-size: 0.9rem;
  }
  .sidebar-link:hover {
    background-color: rgba(233, 69, 96, 0.15);
    color: #e94560;
  }
  body { overflow-x: hidden; }
</style>
