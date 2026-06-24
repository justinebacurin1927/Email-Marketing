<x-layouts.app>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  .inbox-page { margin-top: 4rem; height: calc(100vh - 4rem); overflow: hidden; }
  .message-list-panel { width: 380px; min-width: 380px; border-right: 1px solid #e9ecef; display: flex; flex-direction: column; transition: flex 0.3s ease, width 0.3s ease, min-width 0.3s ease; }
  .detail-panel { flex: 1; display: flex; flex-direction: column; transition: flex 0.3s ease, width 0.3s ease, opacity 0.3s ease; overflow: hidden; }
  .panel-collapsed .message-list-panel { flex: 1 1 0%; width: auto; min-width: 0; }
  .panel-collapsed .detail-panel { flex: 0 0 0; width: 0; opacity: 0; pointer-events: none; overflow: hidden; }
  .message-item { cursor: pointer; transition: background 0.15s; border-radius: 8px; padding: 12px; }
  .message-item:hover { background: rgba(233, 69, 96, 0.06); }
  .message-item.active { background: rgba(233, 69, 96, 0.10); border-left: 3px solid #e94560; }
  .tab-link { font-size: 0.85rem; padding-bottom: 8px; border-bottom: 2px solid transparent; transition: all 0.15s; cursor: pointer; }
  .tab-link.active { color: #e94560 !important; font-weight: 600; border-bottom-color: #e94560; }
  .tab-link:hover { color: #e94560 !important; }
  ::-webkit-scrollbar { height: 6px; width: 6px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: #c7c9cc; border-radius: 10px; }
  * { scrollbar-width: thin; scrollbar-color: #c7c9cc transparent; }
</style>

<div class="d-flex inbox-page" id="inboxLayout">

  {{-- Message List Panel --}}
  <div class="message-list-panel">
    <div class="p-3 border-bottom">
      <div class="d-flex align-items-center gap-2">
        <div class="input-group">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input type="text" id="searchBar" class="form-control" placeholder="Search messages...">
        </div>
        <button id="filterToggle" class="btn btn-outline-secondary d-flex align-items-center gap-1" style="font-size: 0.85rem;">
          <i class="bi bi-sliders"></i>
        </button>
      </div>

      <div id="filterSection" class="mt-3" style="display: none;">
        <div class="row g-2">
          <div class="col-6">
            <label class="small fw-semibold mb-1">Source</label>
            <select id="sourceSelect" class="form-select form-select-sm">
              <option value="any">Any</option>
              <option value="emailMarketingReplies">Email Marketing</option>
              <option value="contactForm">Contact Form</option>
            </select>
          </div>
          <div class="col-6">
            <label class="small fw-semibold mb-1">Label</label>
            <select class="form-select form-select-sm" id="labelSelect">
              <option value="">All</option>
              @php $labels = \App\Models\Label::all(); @endphp
              @foreach($labels as $label)
                <option value="{{ $label->id }}">{{ $label->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="d-flex justify-content-end gap-2 mt-2">
          <button class="btn btn-sm btn-outline-secondary" id="cancelFilter">Cancel</button>
        </div>
      </div>
    </div>

    <div class="px-3 pt-3 border-bottom d-flex gap-3">
      <a href="#" class="tab-link active text-decoration-none text-dark" data-tab="todo">To Do</a>
      <a href="#" class="tab-link text-decoration-none text-secondary" data-tab="done">Done</a>
      <a href="#" class="tab-link text-decoration-none text-secondary" data-tab="trash">Trash</a>
      <a href="#" class="tab-link text-decoration-none text-secondary" data-tab="all">All</a>
    </div>

    <div id="messageList" class="p-2 flex-grow-1 overflow-auto"></div>
  </div>

  {{-- Detail Panel (with toggle button) --}}
  <div class="detail-panel" id="detailPanel">
    <div class="d-flex align-items-center px-4 py-3 border-bottom" style="min-height: 60px;">
      <button class="btn btn-sm btn-outline-secondary border-0 d-flex align-items-center justify-content-center" id="panelToggle" title="Toggle panel" style="padding: 0.15rem 0.3rem; width: 28px; height: 28px;">
        <i class="bi bi-chevron-right" style="font-size: 0.85rem; color: #e94560;"></i>
      </button>
      <span class="ms-2 fw-semibold" style="color: #1a1a2e;">Message</span>
    </div>
    <div id="messageView" class="flex-grow-1 d-flex flex-column justify-content-center align-items-center bg-light">
      <div style="font-size: 4rem;">📬</div>
      <h5 class="fw-bold mt-3" style="color: #1a1a2e;">Manage one-to-one conversations with your audience</h5>
      <p class="text-secondary small mx-auto text-center" style="max-width: 420px;">
        Reply to email conversations, respond to feedback, or forward messages from an existing address.
      </p>
      <div class="d-flex gap-2 mt-2">
        <a href="/add-source" class="btn" style="background: #e94560; color: #fff;">Add Sources</a>
        <a href="/audience" class="btn btn-outline-secondary">Go to Contacts</a>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const messages = {
      todo: [
        { name: 'Sarah Johnson', text: 'Please update my order #4829, I need to change the shipping address.', source: 'emailMarketingReplies', email: 'sarah@example.com' },
        { name: 'Mike Chen', text: 'Can I change my email address associated with my account?', source: 'contactForm', email: 'mike@example.com' },
        { name: 'Emily Davis', text: 'When will the new collection be available?', source: 'emailMarketingReplies', email: 'emily@example.com' },
      ],
      done: [
        { name: 'Alex Rivera', text: 'Thank you for the quick response, everything works now!', source: 'emailMarketingReplies', email: 'alex@example.com' },
        { name: 'Lisa Park', text: 'All good now, appreciate the help with my account.', source: 'contactForm', email: 'lisa@example.com' },
      ],
      trash: [
        { name: 'Spam User', text: 'Claim your free prize now!!!', source: 'contactForm', email: 'spam@example.com' },
      ],
      all: []
    };
    messages.all = [...messages.todo, ...messages.done, ...messages.trash];

    const layout = document.getElementById('inboxLayout');
    const toggleBtn = document.getElementById('panelToggle');
    const toggleIcon = toggleBtn.querySelector('i');
    const messageList = document.getElementById('messageList');
    const messageView = document.getElementById('messageView');
    const tabLinks = document.querySelectorAll('.tab-link');
    const filterToggle = document.getElementById('filterToggle');
    const filterSection = document.getElementById('filterSection');
    const sourceSelect = document.getElementById('sourceSelect');
    const cancelFilter = document.getElementById('cancelFilter');
    const searchBar = document.getElementById('searchBar');

    let isCollapsed = false;
    let currentTab = 'todo';
    let currentSource = 'any';
    let searchTerm = '';

    function isPanelCollapsed() {
      return layout.classList.contains('panel-collapsed');
    }

    function expandPanel() {
      layout.classList.remove('panel-collapsed');
      isCollapsed = false;
      toggleIcon.className = 'bi bi-chevron-right';
    }

    toggleBtn.addEventListener('click', () => {
      isCollapsed = !isCollapsed;
      layout.classList.toggle('panel-collapsed', isCollapsed);
      toggleIcon.className = isCollapsed ? 'bi bi-chevron-left' : 'bi bi-chevron-right';
    });

    filterToggle.addEventListener('click', () => {
      filterSection.style.display = filterSection.style.display === 'none' ? 'block' : 'none';
    });

    cancelFilter.addEventListener('click', () => {
      filterSection.style.display = 'none';
    });

    function renderMessages() {
      messageList.innerHTML = '';
      let filtered = messages[currentTab];

      if (currentSource !== 'any') {
        filtered = filtered.filter(msg => msg.source === currentSource);
      }

      if (searchTerm) {
        const term = searchTerm.toLowerCase();
        filtered = filtered.filter(msg =>
          msg.name.toLowerCase().includes(term) || msg.text.toLowerCase().includes(term)
        );
      }

      if (filtered.length === 0) {
        messageList.innerHTML = '<div class="text-center text-muted small py-5">No messages found.</div>';
        return;
      }

      filtered.forEach((msg) => {
        const div = document.createElement('div');
        div.className = 'message-item mb-1';
        div.innerHTML = `
          <div class="d-flex justify-content-between align-items-center mb-1">
            <span class="fw-semibold" style="color: #1a1a2e; font-size: 0.9rem;">${msg.name}</span>
            <span class="small text-secondary">${msg.email}</span>
          </div>
          <div class="small text-secondary text-truncate">"${msg.text}"</div>
        `;
        div.addEventListener('click', () => {
          document.querySelectorAll('.message-item').forEach(i => i.classList.remove('active'));
          div.classList.add('active');
          openMessage(msg);
          if (isPanelCollapsed()) expandPanel();
        });
        messageList.appendChild(div);
      });
    }

    function openMessage(msg) {
      messageView.innerHTML = `
        <div class="p-4 h-100 w-100 overflow-auto d-flex flex-column" style="background: #fff;">
          <button class="btn btn-sm btn-outline-secondary align-self-start mb-3 d-flex align-items-center gap-1" id="backBtn" style="font-size: 0.8rem;">
            <i class="bi bi-arrow-left"></i> Back
          </button>
          <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
              <h5 class="fw-bold mb-1" style="color: #1a1a2e;">${msg.name}</h5>
              <span class="text-secondary" style="font-size: 0.85rem;">${msg.email}</span>
            </div>
            <span class="badge rounded-pill" style="background: ${msg.source === 'emailMarketingReplies' ? '#533483' : '#0f3460'}; font-size: 0.7rem;">
              ${msg.source === 'emailMarketingReplies' ? 'Email Marketing' : 'Contact Form'}
            </span>
          </div>
          <div class="border rounded p-4 bg-light flex-grow-1">
            <p style="color: #1a1a2e;">${msg.text}</p>
          </div>
          <div class="mt-3">
            <div class="input-group">
              <textarea class="form-control" rows="2" placeholder="Type your reply..."></textarea>
              <button class="btn" style="background: #e94560; color: #fff;">Send</button>
            </div>
          </div>
        </div>
      `;
      document.getElementById('backBtn').addEventListener('click', () => {
        document.querySelectorAll('.message-item').forEach(i => i.classList.remove('active'));
        renderMessages();
      });
    }

    tabLinks.forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        tabLinks.forEach(l => {
          l.classList.remove('active');
          l.classList.add('text-secondary');
        });
        link.classList.add('active');
        link.classList.remove('text-secondary');
        currentTab = link.dataset.tab;
        renderMessages();
      });
    });

    sourceSelect.addEventListener('change', () => {
      currentSource = sourceSelect.value;
      renderMessages();
    });

    searchBar.addEventListener('input', () => {
      searchTerm = searchBar.value;
      renderMessages();
    });

    renderMessages();
  });
</script>
</x-layouts.app>
