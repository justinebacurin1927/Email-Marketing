<x-layouts.app>
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
  .labels-page { margin-top: 80px; }
  ::-webkit-scrollbar { height: 8px; width: 8px; }
  ::-webkit-scrollbar-track { background: transparent; border-radius: 10px; }
  ::-webkit-scrollbar-thumb { background: #c7c9cc; border-radius: 10px; }
  * { scrollbar-width: thin; scrollbar-color: #c7c9cc transparent; }
  .modal { z-index: 1060 !important; }
  .modal-backdrop { z-index: 1050 !important; }

  .labels-table { border-collapse: separate; border-spacing: 0 6px; }
  .labels-table thead th {
    border: none;
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    padding: 8px 16px;
    background: transparent;
  }
  .labels-table tbody tr {
    border-radius: 8px;
    transition: box-shadow 0.15s;
  }
  .labels-table tbody tr:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .labels-table tbody td {
    padding: 14px 16px;
    border: none;
    vertical-align: middle;
  }
  .labels-table tbody td:first-child { border-radius: 8px 0 0 8px; }
  .labels-table tbody td:last-child { border-radius: 0 8px 8px 0; }
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

<div class="card border-0 shadow-sm mb-5 labels-page">
  <div class="card-body p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Manage Labels</h4>
      <span class="badge rounded-pill" style="background: rgba(233,69,96,0.12); color: #e94560; font-size: 0.8rem;">
        {{ $labels->count() }} label{{ $labels->count() !== 1 ? 's' : '' }}
      </span>
    </div>

    {{-- Add Label Form --}}
    <form action="{{ route('labels.add') }}" method="POST" class="d-flex gap-2 align-items-end mb-4">
      @csrf
      <div class="flex-grow-1">
        <label for="label_name" class="form-label fw-semibold small">Add a new label</label>
        <input type="text" name="name" id="label_name" class="form-control" placeholder="Enter label name" required>
      </div>
      <button type="submit" class="btn d-flex align-items-center gap-1" style="background: #2d6a4f; color: #fff; padding: 0.375rem 1rem;">
        <i class="bi bi-plus-lg"></i> Add
      </button>
    </form>

    {{-- Labels Table --}}
    @if($labels->isEmpty())
      <div class="text-center py-5">
        <i class="bi bi-tags" style="font-size: 2.5rem; color: #dee2e6;"></i>
        <p class="text-secondary mt-2 mb-0">No labels yet. Add one above.</p>
      </div>
    @else
      <div class="table-container">
        <table class="labels-table w-100">
          <thead>
            <tr>
              <th>Name</th>
              <th>Created</th>
              <th style="width: 140px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($labels as $i => $label)
              <tr style="background: {{ $rowColors[$i % count($rowColors)] }};">
                <td class="fw-semibold" style="color: #1a1a2e;">{{ $label->name }}</td>
                <td class="text-secondary" style="font-size: 0.85rem;">{{ $label->created_at ? $label->created_at->format('M d, Y') : '—' }}</td>
                <td>
                  <div class="d-flex gap-1">
                    <button class="btn btn-sm d-flex align-items-center gap-1 rename-btn"
                      data-id="{{ $label->id }}"
                      data-name="{{ $label->name }}"
                      style="background: rgba(45, 106, 79, 0.15); color: #2d6a4f;">
                      <i class="bi bi-pencil"></i> Rename
                    </button>
                    <button class="btn btn-sm d-flex align-items-center gap-1 delete-btn"
                      data-id="{{ $label->id }}"
                      data-name="{{ $label->name }}"
                      style="background: rgba(233, 69, 96, 0.15); color: #e94560;">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>
</div>

{{-- Rename Modal --}}
<div class="modal fade" id="renameModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Rename Label</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="renameForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <input type="text" name="name" id="renameInput" class="form-control" required>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn" style="background: #2d6a4f; color: #fff;">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow">
      <div class="modal-body text-center py-4">
        <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: #e94560;"></i>
        <p class="fw-bold mt-2 mb-0">Delete this label?</p>
        <p class="small text-secondary mb-3" id="deleteLabelName"></p>
        <form id="deleteForm" method="POST">
          @csrf
          @method('DELETE')
          <div class="d-flex gap-2 justify-content-center">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn" style="background: #e94560; color: #fff;">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Rename modal
    document.querySelectorAll('.rename-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;
        document.getElementById('renameInput').value = name;
        document.getElementById('renameForm').action = '/audience/rename-label/' + id;
        new bootstrap.Modal(document.getElementById('renameModal')).show();
      });
    });

    // Delete modal
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;
        document.getElementById('deleteLabelName').textContent = '"' + name + '"';
        document.getElementById('deleteForm').action = '/audience/delete-label/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
      });
    });
  });
</script>
</x-layouts.app>
