<!-- FIXED INBOX SIDEBAR -->
<aside id="inboxSidebar"
  class="d-flex flex-column bg-white border-end position-fixed"
  style="top: 4rem; left: 0; height: calc(100vh - 4rem); width: 16rem; transition: all 0.3s; overflow-y: auto; z-index: 1040;">

  <!-- COMPOSE BUTTON -->
<div class="p-3 border-bottom d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-2">
      <a href="/audience" class="btn btn-sm btn-outline-secondary d-flex align-items-center" style="font-size: 0.875rem;">
        ←
      </a>
      <h5 class="fw-bold mb-0">📥 Inbox</h5>
    </div>
  </div>


    <div>
    <button class="btn btn-dark w-100">✉️ Compose</button>
  </div>

  <!-- SOURCES -->
  <div class="p-3 border-bottom">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <strong>Sources</strong>
      <a href="#" class="small text-decoration-none text-primary">Manage</a>
    </div>
    <ul class="list-unstyled mb-0">
      <li><a href="#" class="d-block py-1 text-dark text-decoration-none">All</a></li>
      <li><a href="#" class="d-block py-1 text-dark text-decoration-none">Email Marketing Replies</a></li>
      <li><a href="#" class="d-block py-1 text-dark text-decoration-none">Contact Form</a></li>
    </ul>
  </div>

  <!-- LABELS -->
  <div class="p-3 border-bottom">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <strong>Labels</strong>
      <a href="#" class="small text-decoration-none text-primary">Manage</a>
    </div>
    <p class="text-secondary small mb-0">No labels</p>
  </div>

  <!-- SETTINGS LINKS -->
  <div class="p-3 flex-grow-1">
    <a href="#" class="d-block mb-2 small text-decoration-none text-dark">Notification Settings</a>
    <a href="#" class="d-block mb-2 small text-decoration-none text-dark">Message Templates</a>
    <a href="#" class="d-block mt-3 text-decoration-none text-primary fw-semibold">➕ Add source</a>
  </div>

  <!-- FOOTER -->
  <div class="p-3 border-top small text-secondary">
    Have feedback? <a href="#" class="text-decoration-none text-primary">Let us know.</a>
  </div>
</aside>

<style>
  /* SCROLLBAR STYLING */
  #inboxSidebar::-webkit-scrollbar {
    width: 8px;
  }
  #inboxSidebar::-webkit-scrollbar-thumb {
    background: #c7c9cc;
    border-radius: 10px;
  }
  #inboxSidebar::-webkit-scrollbar-thumb:hover {
    background: #a3a6aa;
  }
  #inboxSidebar {
    scrollbar-width: thin;
    scrollbar-color: #c7c9cc transparent;
  }
</style>
