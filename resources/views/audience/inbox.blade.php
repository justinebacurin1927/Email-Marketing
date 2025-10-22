<x-layouts.bp-inbox>
  <x-topbar/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <div class="d-flex flex-grow-1" style="margin-left: 16rem; margin-top: 4rem; height: calc(100vh - 4rem);">

    <!-- MESSAGE LIST -->
    <div class="border-end bg-white d-flex flex-column" style="width: 380px; overflow-y: auto;">
      <div class="p-3 border-bottom">
        <div class="d-flex align-items-center gap-2">
          <input type="text" id="searchBar" class="form-control" placeholder="Search for a message">
          <button id="filterToggle" class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-1">
            <i class="bi bi-sliders"></i>
            <span>Filter</span>
          </button>
        </div>

        <div id="filterSection" class="mt-3" style="display: none;">
          <label class="form-label small mb-1 fw-semibold">Source</label>
          <select id="sourceSelect" class="form-select mb-2 form-select-sm">
            <option selected>Any</option>
            <option value="emailMarketingReplies">Email Marketing Replies</option>
            <option value="contactForm">Contact Form</option>
          </select>

          <label class="form-label small mb-1 fw-semibold">Labels</label>
          <select class="form-select mb-3 form-select-sm">
            <option selected disabled>Choose</option>
          </select>

          <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-sm btn-primary">Apply</button>
            <button class="btn btn-sm btn-outline-secondary" id="cancelFilter">Cancel</button>
          </div>
        </div>
      </div>

      <div class="px-3 pt-2 border-bottom d-flex gap-3 small text-secondary">
        <a href="#" class="tab-link text-dark fw-semibold text-decoration-none" data-tab="todo">To Do</a>
        <a href="#" class="tab-link text-secondary text-decoration-none" data-tab="done">Done</a>
        <a href="#" class="tab-link text-secondary text-decoration-none" data-tab="trash">Trash</a>
        <a href="#" class="tab-link text-secondary text-decoration-none" data-tab="all">All</a>
      </div>

      <div id="messageList" class="p-3 flex-grow-1 overflow-auto"></div>
    </div>

    <!-- MESSAGE VIEW AREA -->
    <div id="messageView" class="flex-grow-1 d-flex flex-column justify-content-center align-items-center bg-light text-center">
      <div style="font-size: 4rem;">📬</div>
      <h5 class="fw-bold mt-3">Manage one-to-one conversations with your audience using Inbox</h5>
      <p class="text-secondary small mx-auto" style="max-width: 420px;">
        Reply to email conversations, respond to Survey feedback, or forward messages from an existing
        address. Learn how to use your Inbox to manage your conversations or give it a spin by messaging yourself.
      </p>
    <a href="/add-source" class="btn btn-primary mt-2">Add Sources</a>
    </div>
  </div>

<style>
  .message-item {
    cursor: pointer;
    transition: background-color 0.2s;
  }
  .message-item:hover {
    background-color: #f8f9fa;
  }
  .message-item.active {
    background-color: #e9ecef;
    border-left: 3px solid #0d6efd;
  }
</style>

<script>
  // Sample message data
  const messages = {
    todo: [
      { name: 'Customer 1', text: 'Please update my order.', source: 'emailMarketingReplies' },
      { name: 'Customer 2', text: 'Can I change my email address?', source: 'contactForm' }
    ],
    done: [
      { name: 'Customer 3', text: 'Thank you for the quick reply!', source: 'emailMarketingReplies' },
      { name: 'Customer 4', text: 'All good now, appreciate the help.', source: 'contactForm' }
    ],
    trash: [
      { name: 'Customer 5', text: 'Spam message example.', source: 'contactForm' }
    ],
    all: []
  };

  messages.all = [...messages.todo, ...messages.done, ...messages.trash];

  const messageList = document.getElementById('messageList');
  const messageView = document.getElementById('messageView');
  const tabLinks = document.querySelectorAll('.tab-link');
  const filterToggle = document.getElementById('filterToggle');
  const filterSection = document.getElementById('filterSection');
  const sourceSelect = document.getElementById('sourceSelect');
  const cancelFilter = document.getElementById('cancelFilter');

  let currentTab = 'todo';
  let currentSource = 'any';

  filterToggle.addEventListener('click', () => {
    filterSection.style.display = filterSection.style.display === 'none' ? 'block' : 'none';
  });

  cancelFilter.addEventListener('click', () => {
    filterSection.style.display = 'none';
  });

  // Render messages based on current tab and source
  function renderMessages(tab) {
    messageList.innerHTML = '';
    let filtered = messages[tab];
    if (currentSource !== 'any') {
      filtered = filtered.filter(msg => msg.source === currentSource);
    }
    filtered.forEach((msg) => {
      const div = document.createElement('div');
      div.className = 'border-bottom py-2 message-item';
      div.innerHTML = `
        <div class="fw-semibold">${msg.name}</div>
        <div class="small text-secondary">"${msg.text}"</div>
      `;
      div.addEventListener('click', () => {
        document.querySelectorAll('.message-item').forEach(i => i.classList.remove('active'));
        div.classList.add('active');
        openMessage(msg);
      });
      messageList.appendChild(div);
    });
  }

  function openMessage(msg) {
    messageView.innerHTML = `
      <div class="p-5 text-start bg-white w-100 h-100 overflow-auto">
        <h5 class="fw-bold mb-3">${msg.name}</h5>
        <p class="text-secondary">Message content:</p>
        <div class="border p-3 rounded bg-light">${msg.text}</div>
        <button class="btn btn-outline-secondary mt-3" id="backBtn">Back to list</button>
      </div>
    `;
    document.getElementById('backBtn').addEventListener('click', () => renderMessages(currentTab));
  }

  // Tab switching
  tabLinks.forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      tabLinks.forEach(l => l.classList.remove('text-dark', 'fw-semibold'));
      tabLinks.forEach(l => l.classList.add('text-secondary'));
      link.classList.remove('text-secondary');
      link.classList.add('text-dark', 'fw-semibold');
      currentTab = link.dataset.tab;
      renderMessages(currentTab);
    });
  });

  // Filter source selection
  sourceSelect.addEventListener('change', e => {
    currentSource = e.target.value || 'any';
    renderMessages(currentTab);
  });

  renderMessages(currentTab);

  // Connect sidebar links (from your other layout)
  document.querySelectorAll('#inboxSidebar a.d-block.py-1.text-dark.text-decoration-none').forEach(link => {
    link.addEventListener('click', e => {
      e.preventDefault();
      const text = link.textContent.trim();
      if (text === 'All') currentSource = 'any';
      else if (text === 'Email Marketing Replies') currentSource = 'emailMarketingReplies';
      else if (text === 'Contact Form') currentSource = 'contactForm';
      renderMessages(currentTab);
    });
  });
</script>
</x-layouts.bp-inbox>
