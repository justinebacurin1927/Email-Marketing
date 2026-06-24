<x-layouts.app>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
  .sources-page { margin-top: 80px; }
  ::-webkit-scrollbar { height: 8px; width: 8px; }
  ::-webkit-scrollbar-track { background: transparent; border-radius: 10px; }
  ::-webkit-scrollbar-thumb { background: #c7c9cc; border-radius: 10px; }
  * { scrollbar-width: thin; scrollbar-color: #c7c9cc transparent; }
  .modal { z-index: 1060 !important; }
  .modal-backdrop { z-index: 1050 !important; }

  .sources-table { border-collapse: separate; border-spacing: 0 6px; }
  .sources-table thead th {
    border: none;
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    padding: 8px 16px;
    background: transparent;
  }
  .sources-table tbody tr {
    border-radius: 8px;
    transition: box-shadow 0.15s;
  }
  .sources-table tbody tr:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .sources-table tbody td {
    padding: 14px 16px;
    border: none;
    vertical-align: middle;
  }
  .sources-table tbody td:first-child { border-radius: 8px 0 0 8px; }
  .sources-table tbody td:last-child { border-radius: 0 8px 8px 0; }
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

<div class="card border-0 shadow-sm mb-5 sources-page">
  <div class="card-body p-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Manage Sources</h4>
      <span class="badge rounded-pill" style="background: rgba(233,69,96,0.12); color: #e94560; font-size: 0.8rem;">
        {{ $sources->count() }} source{{ $sources->count() !== 1 ? 's' : '' }}
      </span>
    </div>

    {{-- Add Source Form --}}
    <form action="{{ route('sources.add') }}" method="POST" class="d-flex gap-2 align-items-end mb-4">
      @csrf
      <div class="flex-grow-1">
        <label for="email" class="form-label fw-semibold small">Forward mail to Inbox</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" required>
      </div>
      <button type="submit" class="btn d-flex align-items-center gap-1" style="background: #2d6a4f; color: #fff; padding: 0.375rem 1rem;">
        <i class="bi bi-plus-lg"></i> Add
      </button>
    </form>

    {{-- Sources Table --}}
    @if($sources->isEmpty())
      <div class="text-center py-5">
        <i class="bi bi-wifi" style="font-size: 2.5rem; color: #dee2e6;"></i>
        <p class="text-secondary mt-2 mb-0">No sources yet. Add one above.</p>
      </div>
    @else
      <div class="table-container">
        <table class="sources-table w-100">
          <thead>
            <tr>
              <th>Email</th>
              <th>Added</th>
              <th style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($sources as $i => $source)
              <tr style="background: {{ $rowColors[$i % count($rowColors)] }};">
                <td class="fw-semibold" style="color: #1a1a2e;">{{ $source->email }}</td>
                <td class="text-secondary" style="font-size: 0.85rem;">{{ $source->created_at ? $source->created_at->format('M d, Y') : '—' }}</td>
                <td>
                  <button class="btn btn-sm d-flex align-items-center gap-1 delete-btn"
                    data-id="{{ $source->id }}"
                    data-email="{{ $source->email }}"
                    style="background: rgba(233, 69, 96, 0.15); color: #e94560;">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content border-0 shadow">
      <div class="modal-body text-center py-4">
        <i class="bi bi-exclamation-triangle" style="font-size: 2rem; color: #e94560;"></i>
        <p class="fw-bold mt-2 mb-0">Delete this source?</p>
        <p class="small text-secondary mb-3" id="deleteSourceEmail"></p>
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
    document.querySelectorAll('.delete-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const email = this.dataset.email;
        document.getElementById('deleteSourceEmail').textContent = '"' + email + '"';
        document.getElementById('deleteForm').action = '/delete-source/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
      });
    });
  });
</script>
</x-layouts.app>
