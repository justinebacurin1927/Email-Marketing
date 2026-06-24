<x-layouts.app>

@if (session('success'))
<div id="successAlert" class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 mx-3 shadow" role="alert" style="z-index: 1050;">
  <i class="bi bi-check-circle-fill me-2"></i>
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const alert = document.getElementById('successAlert');
    if (alert) setTimeout(() => { bootstrap.Alert.getOrCreateInstance(alert).close() }, 5000);
  });
</script>
@endif

<style>
  .contacts-page { margin-top: 80px; }
  ::-webkit-scrollbar { height: 8px; width: 8px; }
  ::-webkit-scrollbar-track { background: transparent; border-radius: 10px; }
  ::-webkit-scrollbar-thumb { background: #c7c9cc; border-radius: 10px; }
  * { scrollbar-width: thin; scrollbar-color: #c7c9cc transparent; }
  .table-scroll { overflow-x: auto; width: 100%; }
  .dropdown-menu { position: absolute; top: calc(100% + 6px); left: 0; min-width: 220px; background: #fff; border: 1px solid #ddd; border-radius: 6px; box-shadow: 0 6px 16px rgba(0,0,0,0.15); padding: 8px; z-index: 9999; }
  .dropdown-menu.show { display: block !important; }
  .dropdown-menu input[type="search"] { width: 100%; padding: 6px 8px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 6px; }
  .dropdown-item { display: flex; align-items: center; gap: 8px; padding: 4px 6px; cursor: pointer; }
  .dropdown-item input[type="checkbox"] { margin: 0; }
  .contact-name { font-weight: 600; color: #1a1a2e; }
  .contacts-table { border-collapse: separate; border-spacing: 0 6px; }
  .contacts-table thead th {
    border: none;
    font-weight: 700;
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    padding: 8px 16px;
    background: transparent;
  }
  .contacts-table tbody tr {
    border-radius: 8px;
    transition: box-shadow 0.15s;
  }
  .contacts-table tbody tr:hover { box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
  .contacts-table tbody td {
    padding: 14px 16px;
    border: none;
    vertical-align: middle;
  }
  .contacts-table tbody td:first-child { border-radius: 8px 0 0 8px; }
  .contacts-table tbody td:last-child { border-radius: 0 8px 8px 0; }
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

<div class="card border-0 shadow-sm mb-5 contacts-page">
  <div class="card-body">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="fw-bold mb-0">Contacts</h4>
      <div class="dropdown">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1" data-bs-toggle="dropdown">
          <i class="bi bi-plus-lg"></i> Add contacts
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/add-contact"><i class="bi bi-person-plus me-2"></i>Add a single contact</a>
          <a class="dropdown-item" href="/import-contacts"><i class="bi bi-upload me-2"></i>Import contacts</a>
        </div>
      </div>
    </div>

    {{-- Filters --}}
    <div class="d-flex gap-2 mb-3 align-items-center flex-wrap">
      <div class="dropdown">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1" data-bs-toggle="dropdown">
          <i class="bi bi-tag"></i> Tags
        </button>
        <div class="dropdown-menu">
          <input type="search" placeholder="Search tags..." class="tag-search" />
          @foreach($tags as $tag)
            <label class="dropdown-item">
              <input type="checkbox" class="tag-checkbox" data-tag="{{ $tag->name }}" />
              {{ $tag->name }}
            </label>
          @endforeach
          <hr class="my-2">
          <a href="{{ url('/audience/audience-tags') }}" class="btn btn-sm btn-outline-primary w-100">Manage all tags</a>
        </div>
      </div>

      <div class="dropdown">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1" data-bs-toggle="dropdown">
          <i class="bi bi-person-check"></i> Status
        </button>
        <div class="dropdown-menu">
          <label class="dropdown-item"><input type="checkbox" class="status-filter" data-status="subscribed" checked /> Subscribed</label>
          <label class="dropdown-item"><input type="checkbox" class="status-filter" data-status="unsubscribed" checked /> Unsubscribed</label>
          <label class="dropdown-item"><input type="checkbox" class="status-filter" data-status="non-subscribed" checked /> Non-subscribed</label>
        </div>
      </div>
    </div>

    {{-- Count + Search --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <p class="text-muted mb-0">
        {{ $totalContacts }} contact{{ $totalContacts !== 1 ? 's' : '' }}.
        {{ $totalSubscribers }} subscriber{{ $totalSubscribers !== 1 ? 's' : '' }}.
      </p>
      <div class="d-flex align-items-center gap-2">
        <div class="input-group" style="max-width: 280px;">
          <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
          <input type="text" id="searchInput" class="form-control" placeholder="Search contacts..." />
        </div>
        <a href="{{ route('contacts.export') }}" class="btn btn-outline-secondary d-flex align-items-center gap-1">
          <i class="bi bi-download"></i> Export
        </a>
      </div>
    </div>

    {{-- Action bar (shown when contacts are selected) --}}
    <div id="actionBar" class="d-none mb-3 d-flex gap-2 align-items-center">
      <span id="selectedCount" class="fw-semibold me-2" style="color: #1a1a2e;"></span>
      <form id="deleteForm" action="{{ route('contacts.deleteSelected') }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
          <i class="bi bi-trash"></i> Delete
        </button>
      </form>
      <button id="editBtn" type="button" class="btn btn-outline-primary btn-sm d-flex align-items-center gap-1 d-none" data-bs-toggle="modal" data-bs-target="#editContactModal">
        <i class="bi bi-pencil"></i> Edit
      </button>
      <button id="cancelSelection" class="btn btn-sm btn-link text-decoration-none">Cancel</button>
    </div>

    {{-- Table --}}
    <div class="table-scroll">
      <table class="contacts-table w-100" id="contactsTable">
        <thead>
          <tr>
            <th style="width: 40px;"><input type="checkbox" id="selectAll"></th>
            <th>Email</th>
            <th>Name</th>
            <th>Tags</th>
            <th>Status</th>
            <th>Created</th>
            <th style="width: 80px;"></th>
          </tr>
        </thead>
        <tbody>
          @forelse($contacts as $i => $contact)
          <tr style="background: {{ $rowColors[$i % count($rowColors)] }};" data-id="{{ $contact->id }}" data-email="{{ $contact->email }}" data-first="{{ $contact->first_name }}" data-last="{{ $contact->last_name }}" data-phone="{{ $contact->phone }}" data-company="{{ $contact->company }}" data-birthday="{{ $contact->birthday }}" data-address="{{ $contact->street }}" data-tags="{{ $contact->tags->pluck('name')->implode(',') }}" data-subscribed="{{ $contact->subscribed ? '1' : '0' }}">
            <td><input type="checkbox" class="contact-checkbox" value="{{ $contact->id }}"></td>
            <td class="text-primary fw-semibold">{{ $contact->email }}</td>
            <td class="contact-name">{{ $contact->first_name }} {{ $contact->last_name }}</td>
            <td>
              @forelse($contact->tags as $tag)
                <span class="badge rounded-pill" style="background: #e94560; font-size: 0.7rem;">{{ $tag->name }}</span>
              @empty
                <span class="text-muted" style="font-size: 0.75rem;">—</span>
              @endforelse
            </td>
            <td>
              @if($contact->subscribed)
                <span class="badge rounded-pill" style="background: #198754; font-size: 0.7rem;">Subscribed</span>
              @else
                <span class="badge rounded-pill" style="background: #6c757d; font-size: 0.7rem;">Unsubscribed</span>
              @endif
            </td>
            <td style="color: #6c757d; font-size: 0.85rem;">{{ $contact->created_at->format('M d, Y') }}</td>
            <td>
              <button class="btn btn-sm btn-outline-secondary edit-single border-0" data-id="{{ $contact->id }}" title="Edit" data-bs-toggle="modal" data-bs-target="#editContactModal">
                <i class="bi bi-pencil"></i>
              </button>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted py-4">No contacts found.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
      {{ $contacts->links('pagination::bootstrap-5') }}
    </div>

  </div>
</div>

{{-- Edit Contact Modal --}}
<div class="modal fade" id="editContactModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editContactForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title fw-bold" style="color: #1a1a2e;">Edit Contact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="contact_id" id="editContactId">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" id="editEmail" name="email" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Company</label>
              <input type="text" class="form-control" id="editCompany" name="company">
            </div>
            <div class="col-md-6">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" id="editFirstName" name="first_name">
            </div>
            <div class="col-md-6">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" id="editLastName" name="last_name">
            </div>
            <div class="col-md-6">
              <label class="form-label">Phone</label>
              <input type="text" class="form-control" id="editPhone" name="phone">
            </div>
            <div class="col-md-6">
              <label class="form-label">Birthday</label>
              <input type="date" class="form-control" id="editBirthday" name="birthday">
            </div>
            <div class="col-12">
              <label class="form-label">Address</label>
              <textarea class="form-control" id="editAddress" name="address" rows="2"></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Tags (comma separated)</label>
              <input type="text" class="form-control" id="editTags" name="tags" placeholder="e.g. VIP, Newsletter">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" style="background: #e94560; border-color: #e94560;">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('selectAll');
    const searchInput = document.getElementById('searchInput');
    const actionBar = document.getElementById('actionBar');
    const selectedCount = document.getElementById('selectedCount');
    const deleteForm = document.getElementById('deleteForm');
    const editBtn = document.getElementById('editBtn');
    const cancelSelection = document.getElementById('cancelSelection');
    const tableRows = document.querySelectorAll('#contactsTable tbody tr');
    const modal = document.getElementById('editContactModal');

    // -----------------------
    // Select all
    // -----------------------
    selectAll.addEventListener('change', function () {
      document.querySelectorAll('.contact-checkbox').forEach(cb => cb.checked = this.checked);
      updateActionBar();
    });

    // -----------------------
    // Individual checkboxes
    // -----------------------
    document.addEventListener('change', function (e) {
      if (e.target.matches('.contact-checkbox')) {
        const all = document.querySelectorAll('.contact-checkbox');
        selectAll.checked = Array.from(all).every(cb => cb.checked);
        updateActionBar();
      }
    });

    // -----------------------
    // Update action bar
    // -----------------------
    function updateActionBar() {
      const checked = document.querySelectorAll('.contact-checkbox:checked');
      const count = checked.length;
      if (count > 0) {
        actionBar.classList.remove('d-none');
        selectedCount.textContent = count + ' selected';
        editBtn.classList.toggle('d-none', count !== 1);
      } else {
        actionBar.classList.add('d-none');
      }
    }

    // -----------------------
    // Cancel selection
    // -----------------------
    cancelSelection.addEventListener('click', function () {
      document.querySelectorAll('.contact-checkbox:checked').forEach(cb => cb.checked = false);
      selectAll.checked = false;
      updateActionBar();
    });

    // -----------------------
    // Delete
    // -----------------------
    deleteForm.addEventListener('submit', function (e) {
      const checked = document.querySelectorAll('.contact-checkbox:checked');
      if (checked.length === 0) {
        e.preventDefault();
        return;
      }
      if (!confirm('Delete ' + checked.length + ' selected contact' + (checked.length !== 1 ? 's' : '') + '?')) {
        e.preventDefault();
        return;
      }
      checked.forEach(cb => {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'selected_contacts[]';
        hidden.value = cb.value;
        this.appendChild(hidden);
      });
    });

    // -----------------------
    // Edit modal — single click (pencil icon)
    // -----------------------
    document.querySelectorAll('.edit-single').forEach(btn => {
      btn.addEventListener('click', function () {
        populateEditModal(this.closest('tr'));
      });
    });

    // Edit modal — from action bar
    editBtn.addEventListener('click', function () {
      const checked = document.querySelector('.contact-checkbox:checked');
      if (checked) populateEditModal(checked.closest('tr'));
    });

    function populateEditModal(row) {
      document.getElementById('editContactId').value = row.dataset.id;
      document.getElementById('editEmail').value = row.dataset.email;
      document.getElementById('editFirstName').value = row.dataset.first;
      document.getElementById('editLastName').value = row.dataset.last;
      document.getElementById('editPhone').value = row.dataset.phone;
      document.getElementById('editCompany').value = row.dataset.company;
      document.getElementById('editBirthday').value = row.dataset.birthday;
      document.getElementById('editAddress').value = row.dataset.address;
      document.getElementById('editTags').value = row.dataset.tags;
    }

    // -----------------------
    // Edit form submit
    // -----------------------
    document.getElementById('editContactForm').addEventListener('submit', function (e) {
      e.preventDefault();
      const formData = new FormData(this);
      fetch('/contacts/' + formData.get('contact_id'), {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-HTTP-Method-Override': 'PUT' },
        body: formData,
      })
      .then(res => res.json())
      .then(() => location.reload());
    });

    // -----------------------
    // Search
    // -----------------------
    searchInput.addEventListener('input', function () {
      const term = this.value.toLowerCase();
      tableRows.forEach(row => {
        if (row.cells.length < 2) return;
        row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
      });
    });

    // -----------------------
    // Tag filter
    // -----------------------
    document.querySelectorAll('.tag-checkbox').forEach(cb => {
      cb.addEventListener('change', filterTable);
    });
    document.querySelector('.tag-search')?.addEventListener('input', function () {
      const term = this.value.toLowerCase();
      document.querySelectorAll('.tag-checkbox').forEach(cb => {
        cb.closest('.dropdown-item').style.display = cb.dataset.tag.toLowerCase().includes(term) ? '' : 'none';
      });
    });

    // -----------------------
    // Keep dropdown open when clicking inside
    // -----------------------
    document.addEventListener('click', function (e) {
      if (e.target.closest('.dropdown-menu')) e.stopPropagation();
    });

    // -----------------------
    // Status filter
    // -----------------------
    document.querySelectorAll('.status-filter').forEach(cb => {
      cb.addEventListener('change', filterTable);
    });

    function filterTable() {
      const selectedTags = Array.from(document.querySelectorAll('.tag-checkbox:checked')).map(cb => cb.dataset.tag.toLowerCase());
      const activeStatuses = Array.from(document.querySelectorAll('.status-filter:checked')).map(cb => cb.dataset.status);

      tableRows.forEach(row => {
        if (row.cells.length < 2) return;
        const rowTags = Array.from(row.querySelectorAll('.badge')).map(b => b.textContent.toLowerCase());
        const rowStatus = row.dataset.subscribed === '1' ? 'subscribed' : (row.dataset.subscribed === '0' ? 'unsubscribed' : 'non-subscribed');

        const tagMatch = selectedTags.length === 0 || selectedTags.some(t => rowTags.includes(t));
        const statusMatch = activeStatuses.includes(rowStatus);

        row.style.display = (tagMatch && statusMatch) ? '' : 'none';
      });
    }

  });
</script>

</x-layouts.app>
