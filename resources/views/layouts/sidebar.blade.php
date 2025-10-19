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
      <li><a href="/audience" class="d-block p-2 rounded text-decoration-none text-dark hover-bg-light">👥 <span class="sidebar-text">Audience</span></a></li>
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

<!-- Add this wrapper to push your main content right -->
<div style="margin-left: 16rem;">
  @yield('content') <!-- or your main container -->
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
</style>

<script>
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
</script>
