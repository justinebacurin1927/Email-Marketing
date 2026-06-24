<x-layouts.app>

<div class="campaign-layout d-flex" style="height: calc(100vh - 3.5rem); overflow: hidden;">

  {{-- Center Queue Column --}}
  <div class="center-queue d-flex flex-column border-end" id="center-queue" style="width: 360px; min-width: 320px; background: #f8f9fa;">

    <div class="p-3 border-bottom bg-white">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <h5 class="fw-bold mb-0" style="color: #1a1a2e;">Templates</h5>
        <div class="d-flex gap-1">
          <a href="{{ route('templates.create') }}" class="btn btn-sm d-flex align-items-center gap-1 text-white fw-medium" style="background: #e94560; border: none; border-radius: 8px; padding: 0.3rem 0.8rem; font-size: 0.8rem; text-decoration: none;">
            <i class="bi bi-plus-lg"></i> New
          </a>
        </div>
      </div>
      <div class="d-flex gap-2 flex-wrap">
        <button class="btn btn-sm filter-pill active-filter-pill" data-filter="all">All</button>
        <button class="btn btn-sm filter-pill" data-filter="recent">Recent</button>
      </div>
      <input type="text" id="template-search" class="form-control form-control-sm mt-2" placeholder="Search templates..." style="background: #f1f3f5; border: none; border-radius: 8px;">
    </div>

    <div class="overflow-auto flex-grow-1" id="template-list">
      @forelse($templates as $template)
      <div class="campaign-card p-3 border-bottom {{ $loop->first ? 'selected-card' : '' }}"
           data-id="{{ $template->id }}"
           data-name="{{ strtolower($template->name) }}"
           data-created="{{ $template->created_at }}">
        <div class="fw-bold mb-1" style="color: #1a1a2e; font-size: 1rem;">{{ $template->name }}</div>
        <div class="text-muted mb-1" style="font-size: 0.85rem;">
          <i class="bi bi-envelope me-1"></i>{{ Str::limit($template->subject, 50) }}
        </div>
        <div class="text-muted" style="font-size: 0.8rem;">
          <i class="bi bi-calendar me-1"></i>Created {{ $template->created_at->format('M d, Y') }}
        </div>
      </div>
      @empty
      <div class="d-flex align-items-center justify-content-center flex-grow-1 text-muted" style="min-height: 300px;">
        <div class="text-center">
          <div style="font-size: 3rem; margin-bottom: 0.5rem; color: #e94560;"><i class="bi bi-file-text"></i></div>
          <p class="fw-semibold" style="font-size: 1rem;">No templates yet</p>
          <a href="{{ route('templates.create') }}" class="btn btn-sm" style="background: #e94560; color: white; border-radius: 8px;">Create your first template</a>
        </div>
      </div>
      @endforelse
    </div>
  </div>

  {{-- Right Canvas --}}
  <div class="right-canvas d-flex flex-column bg-white" id="right-canvas" style="flex: 1 1 0%; min-width: 0; transition: flex 0.3s ease, opacity 0.3s ease;">
    @if($templates->isNotEmpty())
    @php $selected = $templates->first(); @endphp

    <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom" style="min-height: 60px;">
      <div class="d-flex align-items-center gap-3" style="min-width: 0;">
        <button class="btn btn-sm btn-outline-secondary border-0 d-none d-xl-inline-flex" id="panel-toggle" title="Toggle panel" style="padding: 0.15rem 0.3rem;"><i class="bi bi-chevron-right"></i></button>
        <h5 class="fw-bold mb-0 text-truncate" id="detail-title" style="color: #1a1a2e; max-width: 400px;">{{ $selected->name }}</h5>
      </div>
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-outline-secondary border-0 d-xl-none" id="panel-close-mobile" title="Close panel"><i class="bi bi-x"></i></button>
        <a href="{{ route('templates.edit', $selected->id) }}" class="btn btn-sm d-flex align-items-center gap-1 text-white" id="detail-edit-btn" style="background: #e94560; border: none; border-radius: 8px; padding: 0.35rem 0.85rem; text-decoration: none;">
          <i class="bi bi-pencil-square"></i> Edit
        </a>
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary border-0" data-bs-toggle="dropdown" style="font-size: 1.3rem; line-height: 1;"><i class="bi bi-three-dots"></i></button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $selected->id }}"><i class="bi bi-eye me-2"></i>View</button></li>
            <li><a class="dropdown-item" id="detail-edit-link" href="{{ route('templates.edit', $selected->id) }}"><i class="bi bi-pencil-square me-2"></i>Edit</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="{{ route('templates.destroy', $selected->id) }}" method="POST" onsubmit="return confirm('Delete this template?')" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Delete</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="d-flex align-items-center gap-4 px-4 py-2 border-bottom" style="background: #fafafa; font-size: 0.9rem;">
      <div class="d-flex align-items-center gap-2 text-muted">
        <i class="bi bi-calendar"></i>
        <span>Created <span id="detail-created">{{ $selected->created_at->format('M d, Y') }}</span></span>
      </div>
      <div class="d-flex align-items-center gap-2 text-muted">
        <i class="bi bi-arrow-repeat"></i>
        <span>Updated <span id="detail-updated">{{ $selected->updated_at->diffForHumans() }}</span></span>
      </div>
    </div>

    <div class="overflow-auto flex-grow-1 px-4 py-3" id="detail-scroll">
      <div class="mb-3">
        <label class="fw-semibold text-muted small mb-1">Subject</label>
        <div class="p-3 rounded" style="background: #f8f9fa; font-size: 0.95rem;" id="detail-subject">{{ $selected->subject }}</div>
      </div>

      <div class="mb-3">
        <label class="fw-semibold text-muted small mb-1">Body</label>
        <div class="p-3 rounded" style="background: #f8f9fa; font-size: 0.9rem; white-space: pre-wrap; min-height: 200px; line-height: 1.6;" id="detail-body">{{ $selected->body }}</div>
      </div>

      <div class="d-flex flex-column mt-4" style="min-height: 200px;">
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="fw-semibold text-muted" style="font-size: 0.9rem;"><i class="bi bi-chat-dots me-1"></i>Comments</span>
          <span class="text-muted" id="comment-count" style="font-size: 0.85rem;">0 comments</span>
        </div>
        <div class="flex-grow-1 mb-2" id="comments-container" style="max-height: 300px; overflow-y: auto;">
        </div>
        <div class="d-flex gap-2">
          <input type="text" id="comment-input" class="form-control form-control-sm" placeholder="Write a comment..." style="background: #f1f3f5; border: none; border-radius: 8px;">
          <button class="btn btn-sm d-flex align-items-center justify-content-center text-white" id="comment-send" style="background: #e94560; border: none; border-radius: 8px; width: 34px; height: 34px;"><i class="bi bi-send"></i></button>
        </div>
      </div>
    </div>

    @else
    <div class="d-flex align-items-center justify-content-center flex-grow-1 text-muted">
      <div class="text-center">
        <div style="font-size: 4rem; margin-bottom: 1rem; color: #e94560;"><i class="bi bi-file-text"></i></div>
        <p class="fw-bold" style="font-size: 1.2rem;">No templates yet</p>
        <a href="{{ route('templates.create') }}" class="btn btn-sm" style="background: #e94560; color: white; border-radius: 8px;">Create your first template</a>
      </div>
    </div>
    @endif
  </div>

  {{-- Right Rail --}}
  <div class="right-rail d-flex flex-column align-items-center py-3 gap-3" style="width: 44px; min-width: 44px; background: #1a1a2e;">
    <a href="#" class="text-decoration-none rail-icon" title="Notifications" style="color: #8899aa; font-size: 1.1rem;"><i class="bi bi-bell"></i></a>
    <a href="#" class="text-decoration-none rail-icon" title="Help" style="color: #8899aa; font-size: 1.1rem;"><i class="bi bi-question-circle"></i></a>
    <a href="#" class="text-decoration-none rail-icon" title="Settings" style="color: #8899aa; font-size: 1.1rem;"><i class="bi bi-gear"></i></a>
    <a href="#" class="text-decoration-none rail-icon mt-auto" title="Expand" style="color: #8899aa; font-size: 1.1rem;"><i class="bi bi-arrows-expand"></i></a>
  </div>
</div>

{{-- View Modals --}}
@foreach($templates as $template)
<div class="modal fade" id="viewModal-{{ $template->id }}" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background: #e94560; color: white;">
        <h5 class="modal-title">{{ $template->name }}</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <strong class="text-muted small">Subject:</strong>
          <p class="mb-0">{{ $template->subject }}</p>
        </div>
        <strong class="text-muted small">Body:</strong>
        <p style="white-space: pre-wrap;">{{ $template->body }}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<style>
  .campaign-card {
    cursor: pointer;
    transition: all 0.15s;
    background: #fff;
  }
  .campaign-card:hover {
    background: #f1f3f5;
  }
  .campaign-card.selected-card {
    background: #fff0f0;
    border-left: 3px solid #e94560;
    padding-left: calc(1rem - 3px) !important;
  }
  .filter-pill {
    background: transparent;
    border: 1px solid #dee2e6;
    color: #6c757d;
    font-size: 0.85rem;
    border-radius: 20px;
    padding: 0.3rem 0.9rem;
    transition: all 0.15s;
  }
  .filter-pill:hover {
    background: #f1f3f5;
  }
  .filter-pill.active-filter-pill {
    background: #e94560;
    border-color: #e94560;
    color: #fff;
  }
  .rail-icon:hover {
    color: #e94560 !important;
  }
  #detail-scroll::-webkit-scrollbar,
  #template-list::-webkit-scrollbar {
    width: 6px;
  }
  #detail-scroll::-webkit-scrollbar-thumb,
  #template-list::-webkit-scrollbar-thumb {
    background: #dee2e6;
    border-radius: 3px;
  }
  .comment-item {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f1f3f5;
  }
  .comment-item:last-child {
    border-bottom: none;
  }
  .panel-collapsed #right-canvas {
    flex: 0 0 0 !important;
    overflow: hidden;
    opacity: 0;
    pointer-events: none;
  }
  .panel-collapsed #center-queue {
    flex: 1 1 0%;
    width: auto !important;
    min-width: 0 !important;
  }
</style>

<script>
  @php
    $templatesJs = $templates->map(function($t) {
      return [
        'id' => $t->id,
        'name' => $t->name,
        'subject' => $t->subject,
        'body' => $t->body,
        'created_at' => $t->created_at->format('M d, Y'),
        'updated_diff' => $t->updated_at->diffForHumans(),
        'edit_url' => route('templates.edit', $t->id),
        'view_modal_id' => 'viewModal-' . $t->id,
      ];
    });
  @endphp
  document.addEventListener('DOMContentLoaded', function() {
    const templatesData = @json($templatesJs);

    let currentId = templatesData.length > 0 ? templatesData[0].id : null;

    // ---------- Comments ----------
    let comments = [];
    const commentsContainer = document.getElementById('comments-container');
    const commentInput = document.getElementById('comment-input');
    const commentSend = document.getElementById('comment-send');
    const commentCount = document.getElementById('comment-count');

    function renderComments() {
      if (!commentsContainer) return;
      if (comments.length === 0) {
        commentsContainer.innerHTML = '<div class="text-muted text-center py-4" style="font-size: 0.9rem;">No comments yet. Start the conversation!</div>';
        return;
      }
      commentsContainer.innerHTML = comments.map(c =>
        `<div class="comment-item d-flex gap-2">
          <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
            style="width: 32px; height: 32px; background: #e94560; font-size: 0.75rem; flex-shrink: 0;">
            ${c.avatar}
          </div>
          <div class="flex-grow-1">
            <div class="d-flex align-items-center gap-2">
              <strong style="font-size: 0.9rem;">${c.author}</strong>
              <span class="text-muted" style="font-size: 0.75rem;">${c.time}</span>
            </div>
            <div class="text-muted" style="font-size: 0.85rem;">${c.text}</div>
          </div>
        </div>`
      ).join('');
    }

    if (commentSend) {
      commentSend.addEventListener('click', function() {
        const text = commentInput.value.trim();
        if (!text) return;
        const user = '{{ auth()->user()->name ?? 'User' }}';
        const initial = '{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}';
        comments.push({ author: user, avatar: initial, text: text, time: 'Just now' });
        commentInput.value = '';
        renderComments();
        commentCount.textContent = comments.length + ' comment' + (comments.length !== 1 ? 's' : '');
        commentsContainer.scrollTop = commentsContainer.scrollHeight;
      });
      commentInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') commentSend.click();
      });
    }

    // ---------- Panel Collapse Toggle ----------
    const layout = document.querySelector('.campaign-layout');
    const toggleBtn = document.getElementById('panel-toggle');
    const closeBtn = document.getElementById('panel-close-mobile');

    function expandPanel() {
      layout.classList.remove('panel-collapsed');
      if (toggleBtn) toggleBtn.innerHTML = '<i class="bi bi-chevron-right"></i>';
    }
    function collapsePanel() {
      layout.classList.add('panel-collapsed');
      if (toggleBtn) toggleBtn.innerHTML = '<i class="bi bi-chevron-left"></i>';
    }
    function togglePanel() {
      layout.classList.contains('panel-collapsed') ? expandPanel() : collapsePanel();
    }
    if (toggleBtn) toggleBtn.addEventListener('click', togglePanel);
    if (closeBtn) closeBtn.addEventListener('click', collapsePanel);

    // ---------- Template Selection ----------
    function selectTemplate(id, toggle) {
      const wasCollapsed = layout.classList.contains('panel-collapsed');
      const wasSameCard = currentId === id;

      if (wasSameCard && toggle !== false) {
        togglePanel();
        return;
      }
      if (wasCollapsed) expandPanel();

      currentId = id;
      document.querySelectorAll('.campaign-card').forEach(c => {
        c.classList.toggle('selected-card', parseInt(c.dataset.id) === id);
      });

      const data = templatesData.find(t => t.id === id);
      if (!data) return;

      document.getElementById('detail-title').textContent = data.name;
      document.getElementById('detail-created').textContent = data.created_at;
      document.getElementById('detail-updated').textContent = data.updated_diff;
      document.getElementById('detail-subject').textContent = data.subject;
      document.getElementById('detail-body').textContent = data.body;
      document.getElementById('detail-edit-link').href = data.edit_url;
      document.getElementById('detail-edit-btn').href = data.edit_url;

      document.querySelectorAll('.dropdown-item[data-bs-toggle="modal"]').forEach(el => {
        el.dataset.bsTarget = '#' + data.view_modal_id;
      });
    }

    document.querySelectorAll('.campaign-card').forEach(card => {
      card.addEventListener('click', function() {
        selectTemplate(parseInt(this.dataset.id), true);
      });
    });

    // ---------- Search ----------
    const searchInput = document.getElementById('template-search');
    if (searchInput) {
      searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.campaign-card').forEach(card => {
          card.style.display = card.dataset.name.includes(query) ? '' : 'none';
        });
      });
    }

    // ---------- Filter Pills ----------
    document.querySelectorAll('.filter-pill').forEach(pill => {
      pill.addEventListener('click', function() {
        document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active-filter-pill'));
        this.classList.add('active-filter-pill');
      });
    });
  });
</script>

</x-layouts.app>
