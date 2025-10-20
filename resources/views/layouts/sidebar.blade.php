<!-- FIXED SIDEBAR -->
<aside id="sidebar"
  class="d-flex flex-column bg-white border-end position-fixed"
  style="top: 0; left: 0; height: 100vh; width: 16rem; transition: all 0.3s; overflow-y: auto; z-index: 1040;">
  
  <nav class="flex-grow-1" style="margin-top: 6rem; padding-top: 1rem;">
    <ul class="list-unstyled px-2 mb-0">
      <li class="mb-3">
        <button class="btn w-100 text-start" style="border: 1px solid #ccc; background-color: white; color: black;">
          ➕ <span class="sidebar-text">Create</span>
        </button>
      </li>

      <li><a href="/" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">🏠 <span class="sidebar-text">Home</span></a></li>
      <li><a href="/campaigns" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">📣 <span class="sidebar-text">Campaigns</span></a></li>
      <li><a href="/automation" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">⚙️ <span class="sidebar-text">Automations</span></a></li>
      <li><a href="#" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">🧾 <span class="sidebar-text">Forms</span></a></li>

      <!-- Audience (with collapsible submenu) -->
      <li class="audience-item">
        <a href="javascript:void(0)" id="audienceToggle"
          class="d-flex justify-content-between align-items-center p-2 rounded text-decoration-none text-dark hover-bg-light">
          <span>👥 <span class="sidebar-text">Audience</span></span>
          <i class="bi bi-chevron-right small" id="audienceArrow"></i>
        </a>

        <ul id="audienceSubmenu" class="list-unstyled ms-4 mt-1 collapse-menu">
          <li><a href="/audience" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">📂 <span class="sidebar-text">Contacts</span></a></li>
          <li><a href="/audience/tags" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">🏷️ <span class="sidebar-text">Tags</span></a></li>
          <li><a href="/audience/surveys" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">🧩 <span class="sidebar-text">Surveys</span></a></li>
          <li><a href="/audience/preferences" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">⚙️ <span class="sidebar-text">Preferences</span></a></li>
          <li><a href="/audience/inbox" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">📥 <span class="sidebar-text">Inbox</span></a></li>
        </ul>
      </li>

      <li><a href="#" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">📊 <span class="sidebar-text">Analytics</span></a></li>
      <li><a href="#" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">🌐 <span class="sidebar-text">Website</span></a></li>
      <li><a href="#" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">📝 <span class="sidebar-text">Content</span></a></li>
      <li><a href="#" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">🔌 <span class="sidebar-text">Integrations</span></a></li>
    </ul>
  </nav>

  <div class="p-3 border-top bg-white mt-auto">
    <button id="toggleSidebar" class="btn w-100 mb-2" style="border: 1px solid red; color: red; background-color: white;">
      <span id="toggleText">Toggle</span> <i class="bi bi-chevron-left" id="toggleIcon"></i>
    </button>

    <div id="announcement" class="text-sm">
      <p class="mb-2">89 days left for discount</p>
      <button class="btn btn-warning w-100">Upgrade</button>
    </div>
  </div>
</aside>

<!-- MAIN CONTENT WRAPPER -->
<div style="margin-left: 16rem;">
  @yield('content')
</div>

<style>
  #toggleSidebar:hover {
    background-color: red;
    color: white;
  }

  .hover-bg-light:hover {
    background-color: #f8f9fa;
  }

  body {
    overflow-x: hidden;
  }

  /* Submenu hidden by default */
  .collapse-menu {
    display: none;
    transition: all 0.3s ease;
  }

  .collapse-menu.show {
    display: block;
  }

  /* Rotate arrow when expanded */
  .rotate {
    transform: rotate(90deg);
    transition: transform 0.3s ease;
  }

  .ms-4 {
    margin-left: 1.5rem !important;
  }
</style>

<script>
  // SIDEBAR COLLAPSE
  const toggleSidebar = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const toggleIcon = document.getElementById('toggleIcon');
  const toggleText = document.getElementById('toggleText');
  const textElements = document.querySelectorAll('.sidebar-text');
  const announcement = document.getElementById('announcement');

  let collapsed = false;

  toggleSidebar.addEventListener('click', () => {
    collapsed = !collapsed;
    if (collapsed) {
      sidebar.style.width = '6rem';
      document.querySelector('div[style*="margin-left"]').style.marginLeft = '6rem';
      textElements.forEach(el => el.style.display = 'none');
      announcement.style.display = 'none';
      toggleText.textContent = '➡️';
      toggleIcon.style.display = 'none';
    } else {
      sidebar.style.width = '16rem';
      document.querySelector('div[style*="margin-left"]').style.marginLeft = '16rem';
      textElements.forEach(el => el.style.display = 'inline');
      announcement.style.display = 'block';
      toggleText.textContent = 'Toggle';
      toggleIcon.style.display = 'inline';
    }
  });

  // AUDIENCE COLLAPSIBLE MENU
  const audienceToggle = document.getElementById('audienceToggle');
  const audienceSubmenu = document.getElementById('audienceSubmenu');
  const audienceArrow = document.getElementById('audienceArrow');

  audienceToggle.addEventListener('click', () => {
    audienceSubmenu.classList.toggle('show');
    audienceArrow.classList.toggle('rotate');
  });
</script>