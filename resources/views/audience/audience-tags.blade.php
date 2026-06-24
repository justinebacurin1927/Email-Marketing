<x-layouts.app>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  .tags-page { margin-top: 80px; }
  ::-webkit-scrollbar { height: 8px; width: 8px; }
  ::-webkit-scrollbar-track { background: transparent; border-radius: 10px; }
  ::-webkit-scrollbar-thumb { background: #c7c9cc; border-radius: 10px; }
  * { scrollbar-width: thin; scrollbar-color: #c7c9cc transparent; }
  .table-scroll { overflow-x: auto; width: 100%; }
  .modal { z-index: 1060 !important; }
  .modal-backdrop { z-index: 1050 !important; }

  .tags-table { border-collapse: separate; border-spacing: 0 6px; }
  .tags-table thead th {
    border: none;
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    padding: 8px 16px;
    background: transparent;
  }
  .tags-table tbody tr {
    border-radius: 8px;
    transition: box-shadow 0.15s;
    cursor: pointer;
  }
  .tags-table tbody tr:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .tags-table tbody td {
    padding: 14px 16px;
    border: none;
    vertical-align: middle;
  }
  .tags-table tbody td:first-child { border-radius: 8px 0 0 8px; }
  .tags-table tbody td:last-child { border-radius: 0 8px 8px 0; }
  .tags-table tbody tr.row-selected { box-shadow: inset 0 0 0 2px #e94560; }
  .tags-table tbody tr.row-selected td:first-child { box-shadow: inset 2px 0 0 0 #e94560; }
</style>

@php
  $rowColors = [
    'rgba(233, 69, 96, 0.15)',
    'rgba(15, 52, 96, 0.12)',
    'rgba(26, 26, 46, 0.10)',
    'rgba(83, 52, 131, 0.12)',
    'rgba(22, 33, 62, 0.10)',
    'rgba(233, 69, 96, 0.08)',
    'rgba(15, 52, 96, 0.07)',
    'rgba(26, 26, 46, 0.07)',
  ];
@endphp

<div class="card border-0 shadow-sm mb-5 tags-page">
  <div class="card-body">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold mb-0">Tags</h4>
      <button class="btn d-flex align-items-center gap-1" style="background: #e94560; color: #fff;" data-bs-toggle="modal" data-bs-target="#createTagModal">
        <i class="bi bi-plus-lg"></i> Create new tag
      </button>
    </div>

    {{-- Bulk actions bar --}}
    <div class="d-flex align-items-center gap-2 mb-3">
      <button class="btn d-flex align-items-center gap-2" id="selectAllBtn" style="background: #2d6a4f; color: #fff; border: none; padding: 8px 18px;">
        <i class="bi bi-check2-square"></i> <span id="selectAllText" style="font-size: 0.85rem;">Select All</span>
      </button>
      <button class="btn d-flex align-items-center gap-2" id="deleteSelected" style="background: #e94560; color: #fff; border: none; padding: 8px 18px;">
        <i class="bi bi-trash"></i> <span style="font-size: 0.85rem;">Delete</span>
      </button>
    </div>

    {{-- Search --}}
    <div class="mb-3">
      <div class="input-group" style="max-width: 350px;">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input type="text" id="searchTags" class="form-control" placeholder="Search tags..." />
      </div>
    </div>

    {{-- Table --}}
    <div class="table-scroll">
      <table class="tags-table align-middle w-100" id="tagsTable">
        <thead>
          <tr>
            <th style="width: 40px;"></th>
            <th>Tag Name</th>
            <th>Created Date</th>
            <th style="width: 180px;"></th>
          </tr>
        </thead>
        <tbody id="tagsContainer">
          @forelse($tags as $index => $tag)
          <tr data-tag-id="{{ $tag->id }}" style="background: {{ $rowColors[$index % count($rowColors)] }};">
            <td><input class="form-check-input tag-checkbox" type="checkbox" value="{{ $tag->id }}"></td>
            <td><span class="fw-bold" style="color: #000;">{{ $tag->name }}</span></td>
            <td style="color: #6c757d;">{{ $tag->created_at->format('F j, Y') }}</td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn btn-sm rename-tag d-flex align-items-center gap-1" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}" style="background: #2d6a4f; color: #fff; border: none; font-size: 0.8rem; border-radius: 5px; padding: 6px 12px;">
                  <i class="bi bi-pencil"></i> Rename
                </button>
                <button class="btn btn-sm delete-tag d-flex align-items-center gap-1" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}" style="background: #e94560; color: #fff; border: none; font-size: 0.8rem; border-radius: 5px; padding: 6px 12px;">
                  <i class="bi bi-trash"></i> Delete
                </button>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="4" class="text-center text-muted py-4" style="background: transparent;">No tags created yet.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
      {{ $tags->links('pagination::bootstrap-5') }}
    </div>

  </div>
</div>

{{-- Create Tag Modal --}}
<div class="modal fade" id="createTagModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" style="color: #2d6a4f;">What should we name this tag?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="tagAlert" class="alert d-none" role="alert"></div>
        <label class="form-label">Tag name</label>
        <input type="text" class="form-control" id="tagName" placeholder="Enter tag name">
        <small class="text-muted mt-1 d-block">Example: Conference Lead, Influencer, or Donor</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn" id="createTagBtn" style="background: #e94560; color: #fff;">Create</button>
      </div>
    </div>
  </div>
</div>

{{-- Rename Tag Modal --}}
<div class="modal fade" id="renameTagModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" style="color: #2d6a4f;">Rename tag</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="renameTagAlert" class="alert d-none" role="alert"></div>
        <label class="form-label">Tag name</label>
        <input type="text" class="form-control" id="renameTagName" placeholder="Enter new tag name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn" id="renameTagBtn" style="background: #e94560; color: #fff;">Rename</button>
      </div>
    </div>
  </div>
</div>

{{-- Delete Tag Modal --}}
<div class="modal fade" id="deleteTagModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" style="color: #2d6a4f;">Delete Tag</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="deleteTagAlert" class="alert d-none" role="alert"></div>
        <p>Are you sure you want to delete "<span id="deleteTagName" class="fw-bold"></span>"?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="deleteTagBtn">Delete</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let currentTagId = null;

    // ========== SELECT ALL ==========
    let allSelected = false;
    document.getElementById('selectAllBtn').addEventListener('click', function () {
      allSelected = !allSelected;
      document.querySelectorAll('.tag-checkbox').forEach(cb => {
        cb.checked = allSelected;
        cb.closest('tr')?.classList.toggle('row-selected', allSelected);
      });
      document.getElementById('selectAllText').textContent = allSelected ? 'Deselect All' : 'Select All';
      document.getElementById('selectAllBtn').style.background = allSelected ? '#e94560' : '#2d6a4f';
    });

    document.addEventListener('change', function (e) {
      if (e.target.matches('.tag-checkbox')) {
        const tr = e.target.closest('tr');
        if (tr) tr.classList.toggle('row-selected', e.target.checked);
        const checked = document.querySelectorAll('.tag-checkbox:checked');
        if (checked.length === 0) {
          allSelected = false;
          document.getElementById('selectAllText').textContent = 'Select All';
          document.getElementById('selectAllBtn').style.background = '#2d6a4f';
        }
      }
    });

    // ========== SEARCH ==========
    document.getElementById('searchTags').addEventListener('input', function () {
      const term = this.value.toLowerCase();
      document.querySelectorAll('#tagsContainer tr').forEach(row => {
        const name = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
        row.style.display = name.includes(term) ? '' : 'none';
      });
    });

    // ========== INLINE ACTIONS (Rename/Delete) ==========
    document.addEventListener('click', function (e) {
      const renameBtn = e.target.closest('.rename-tag');
      if (renameBtn) {
        currentTagId = renameBtn.dataset.tagId;
        document.getElementById('renameTagName').value = renameBtn.dataset.tagName;
        new bootstrap.Modal(document.getElementById('renameTagModal')).show();
        return;
      }

      const deleteBtn = e.target.closest('.delete-tag');
      if (deleteBtn) {
        currentTagId = deleteBtn.dataset.tagId;
        document.getElementById('deleteTagName').textContent = deleteBtn.dataset.tagName;
        new bootstrap.Modal(document.getElementById('deleteTagModal')).show();
      }
    });

    // ========== CREATE TAG ==========
    const createModalEl = document.getElementById('createTagModal');
    const createBtn = document.getElementById('createTagBtn');
    const tagInput = document.getElementById('tagName');
    const tagAlert = document.getElementById('tagAlert');

    createModalEl.addEventListener('show.bs.modal', () => {
      tagAlert.classList.add('d-none');
      tagInput.value = '';
      tagInput.focus();
    });

    createBtn.addEventListener('click', async () => {
      const name = tagInput.value.trim();
      if (!name) return;
      createBtn.disabled = true;
      createBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Creating...';
      try {
        const res = await fetch('/tags', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
          body: JSON.stringify({ name })
        });
        const data = await res.json();
        if (data.success) {
          location.reload();
        } else {
          tagAlert.classList.remove('d-none', 'alert-success');
          tagAlert.classList.add('alert-danger');
          tagAlert.textContent = data.message || 'Failed to create tag';
        }
      } catch (e) {
        tagAlert.classList.remove('d-none');
        tagAlert.classList.add('alert-danger');
        tagAlert.textContent = 'Failed to create tag';
      } finally {
        createBtn.disabled = false;
        createBtn.textContent = 'Create';
      }
    });

    // ========== RENAME TAG ==========
    const renameModalEl = document.getElementById('renameTagModal');
    const renameBtn = document.getElementById('renameTagBtn');
    const renameInput = document.getElementById('renameTagName');
    const renameAlert = document.getElementById('renameTagAlert');

    renameModalEl.addEventListener('shown.bs.modal', () => renameInput.select());

    renameBtn.addEventListener('click', async () => {
      const name = renameInput.value.trim();
      if (!name) return;
      renameBtn.disabled = true;
      renameBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Renaming...';
      try {
        const res = await fetch('/tags/' + currentTagId, {
          method: 'PUT',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
          body: JSON.stringify({ name })
        });
        const data = await res.json();
        if (data.success) {
          location.reload();
        } else {
          renameAlert.classList.remove('d-none');
          renameAlert.classList.add('alert-danger');
          renameAlert.textContent = data.message || 'Failed to rename tag';
        }
      } catch (e) {
        renameAlert.classList.remove('d-none');
        renameAlert.classList.add('alert-danger');
        renameAlert.textContent = 'Failed to rename tag';
      } finally {
        renameBtn.disabled = false;
        renameBtn.textContent = 'Rename';
      }
    });

    // ========== DELETE TAG ==========
    const deleteModalEl = document.getElementById('deleteTagModal');
    const deleteBtn = document.getElementById('deleteTagBtn');
    const deleteAlert = document.getElementById('deleteTagAlert');

    deleteBtn.addEventListener('click', async () => {
      deleteBtn.disabled = true;
      deleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Deleting...';
      try {
        const res = await fetch('/tags/' + currentTagId, {
          method: 'DELETE',
          headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
        });
        const data = await res.json();
        if (data.success) {
          location.reload();
        } else {
          deleteAlert.classList.remove('d-none');
          deleteAlert.classList.add('alert-danger');
          deleteAlert.textContent = data.message || 'Failed to delete tag';
        }
      } catch (e) {
        deleteAlert.classList.remove('d-none');
        deleteAlert.classList.add('alert-danger');
        deleteAlert.textContent = 'Failed to delete tag';
      } finally {
        deleteBtn.disabled = false;
        deleteBtn.textContent = 'Delete';
      }
    });

    // ========== BULK DELETE ==========
    document.getElementById('deleteSelected').addEventListener('click', async function () {
      const checked = document.querySelectorAll('.tag-checkbox:checked');
      if (!checked.length) return alert('Select at least one tag to delete.');
      if (!confirm('Delete ' + checked.length + ' tag(s)?')) return;

      const ids = Array.from(checked).map(cb => cb.value);
      this.disabled = true;
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Deleting...';
      try {
        const res = await fetch('/tags/bulk-delete', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
          body: JSON.stringify({ ids })
        });
        const data = await res.json();
        if (data.success) location.reload();
        else alert(data.message || 'Failed to delete tags');
      } catch (e) {
        alert('Failed to delete tags');
      } finally {
        this.disabled = false;
        this.textContent = 'Delete';
      }
    });
  });
</script>
</x-layouts.app>
