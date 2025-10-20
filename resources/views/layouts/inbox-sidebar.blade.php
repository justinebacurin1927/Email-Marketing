<!-- FIXED INBOX SIDEBAR -->
<aside id="inboxSidebar"
  class="d-flex flex-column bg-white border-end position-fixed"
  style="top: 4rem; left: 0; height: calc(100vh - 4rem); width: 16rem; transition: all 0.3s; overflow-y: auto; z-index: 1040;">

  <!-- COMPOSE BUTTON --> 
   <div class="p-3 border-bottom d-flex align-items-center justify-content-between"> 
    <div class="d-flex align-items-center gap-2"> <a href="/audience" class="btn btn-sm text-secondary p-0" style="font-size: 1.25rem; border: none;"> 
      <i class="bi bi-arrow-left"></i> </a> <h5 class="fw-bold mb-0">Inbox</h5> </div> </div>

  <!-- COMPOSE BUTTON -->
  <div class="p-3 border-bottom">
    <button class="btn w-100" 
      style="width: 90%; margin: 0 auto; display: block; border: 1px solid black; background-color: transparent; color: black;"
      onmouseover="this.style.backgroundColor='black'; this.style.color='white';"
      onmouseout="this.style.backgroundColor='transparent'; this.style.color='black';">
      Compose
    </button>
  </div>

<!-- SOURCES -->
<div class="p-3 border-bottom">
  <div class="d-flex justify-content-between align-items-center mb-2">
    <strong>Sources</strong>
    <a href="/add-source" class="small text-decoration-none text-primary">Manage</a>
  </div>
  <ul class="list-unstyled mb-0">
    <!-- Static links -->
    <li><a href="audience/inbox" class="d-block py-1 text-dark text-decoration-none">All</a></li>
    <li><a href="audience/inbox?type=email-marketing" class="d-block py-1 text-dark text-decoration-none">Email Marketing Replies</a></li>
    <li><a href="audience/inbox?type=contact-form" class="d-block py-1 text-dark text-decoration-none">Contact Form</a></li>

    <!-- Dynamic sources -->
    @if(isset($sources) && $sources->count())
      @foreach($sources as $source)
        <li>
          <a href="audience/inbox?source={{ $source->id }}" class="d-block py-1 text-dark text-decoration-none fw-bold">
            {{ $source->email }}
          </a>

          <!-- Messages under each source -->
          @if($source->messages->count())
            <ul class="list-unstyled ms-3">
              @foreach($source->messages as $message)
                <li>
                  <a href="audience/inbox?message={{ $message->id }}" class="d-block py-1 text-secondary text-decoration-none small">
                    {{ Str::limit($message->body, 40) }}
                  </a>
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    @endif
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
    <a href="/inbox-settings" class="d-block mb-2 small text-decoration-none">Notification Settings</a>
    <a href="/message-temp" class="d-block mb-2 small text-decoration-none">Message Templates</a>
    <a href="/add-source" class="d-block mt-3 text-decoration-none text-primary fw-semibold">➕ Add source</a>
  </div>

  <!-- FOOTER -->
  <div class="p-3 border-top small text-secondary">
    Have feedback? <a href="#" class="text-decoration-none text-primary">Let us know.</a>
  </div>
</aside>

<style>
  #inboxSidebar a.text-decoration-none.text-primary,
  #inboxSidebar a[href="/inbox-settings"],
  #inboxSidebar a[href="/message-temp"] {
    color: #008c8c !important;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 6px;
    padding: 2px 4px;
    transition: color 0.2s, background-color 0.2s;
  }

  #inboxSidebar a.text-decoration-none.text-primary:hover,
  #inboxSidebar a[href="/inbox-settings"]:hover,
  #inboxSidebar a[href="/message-temp"]:hover {
    background-color: #e0f7f7;
  }

  #inboxSidebar a.text-decoration-none.text-primary.active,
  #inboxSidebar a[href="/inbox-settings"].active,
  #inboxSidebar a[href="/message-temp"].active {
    font-weight: 600;
    color: #008c8c !important;
  }
</style>

<script>
  const settingsLinks = document.querySelectorAll('#inboxSidebar a[href="/inbox-settings"], #inboxSidebar a[href="/message-temp"]');
  settingsLinks.forEach(link => {
    link.addEventListener('click', () => {
      settingsLinks.forEach(l => l.classList.remove('active'));
      link.classList.add('active');
    });
  });
</script>
