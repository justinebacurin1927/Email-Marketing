<x-layouts.app>
  <x-topbar />

  @if (session('success'))
<div id="successAlert" class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 mx-3 shadow" role="alert" style="z-index: 1050;">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const alert = document.getElementById('successAlert');
    if (!alert) return;

    // Auto dismiss after 5 seconds
    setTimeout(() => {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
        bsAlert.close();
    }, 5000);
});
</script>
@endif


  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    .contacts-section {
      margin-top: 80px;
    }

    ::-webkit-scrollbar {
      height: 8px;
      width: 8px;
    }
    ::-webkit-scrollbar-track {
      background: transparent;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background: #c7c9cc;
      border-radius: 10px;
      transition: background 0.3s ease;
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #a3a6aa;
    }
    * {
      scrollbar-width: thin;
      scrollbar-color: #c7c9cc transparent;
    }

    .table-scroll {
      overflow-x: auto;
      overflow-y: hidden;
      width: 100%;
      max-width: 100%;
    }

    .table thead th {
      position: sticky;
      top: 0;
      background: #f8f9fa;
      z-index: 3;
    }

    .filter-scroll-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .dropdown-menu {
      position: absolute;
      top: calc(100% + 6px);
      left: 0;
      min-width: 220px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 6px;
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
      padding: 8px;
      z-index: 9999;
    }

    .dropdown-menu.show {
      display: block !important;
    }

    .dropdown-menu input[type="search"] {
      width: 100%;
      padding: 6px 8px;
      border: 1px solid #ddd;
      border-radius: 4px;
      margin-bottom: 6px;
    }

    .dropdown-item {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 4px 6px;
      cursor: pointer;
    }

    .dropdown-item input[type="checkbox"] {
      margin: 0;
    }
  </style>

  <div class="card border-0 shadow-sm mb-5 contacts-section">
    <div class="card-body position-relative">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Contacts</h4>
        <div class="header-actions d-flex gap-2">
          <div class="dropdown">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              More options <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="#">Audience settings</a>
              <a class="dropdown-item" href="#">Audience fields and merge tags</a>
              <a class="dropdown-item" href="#">Unsubscribe emails</a>
              <a class="dropdown-item" href="#">Groups</a>
              <a class="dropdown-item" href="#">Audience overview</a>
              <a class="dropdown-item" href="#">Archive contacts</a>
              <a class="dropdown-item" href="#">Import history</a>
              <a class="dropdown-item" href="#">Export history</a>
            </div>
          </div>

          <div class="dropdown">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              Add contacts <i class="bi bi-chevron-down"></i>
            </button>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="/import-contacts">Import contacts</a>
              <a class="dropdown-item" href="/add-contact">Add a single contact</a>
            </div>
          </div>
        </div>
      </div>

      <div class="d-flex gap-2 mb-3 align-items-center filter-scroll-container">
        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Segments <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <input type="search" placeholder="Search segments..." />
            <label class="dropdown-item"><input type="checkbox" /> VIP Customers</label>
            <label class="dropdown-item"><input type="checkbox" /> Newsletter</label>
            <label class="dropdown-item"><input type="checkbox" /> Recent Buyers</label>
          </div>
        </div>

        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Subscription status <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <label class="dropdown-item"><input type="checkbox" /> Email subscribed</label>
            <label class="dropdown-item"><input type="checkbox" /> Email unsubscribed</label>
            <label class="dropdown-item"><input type="checkbox" /> Email non-subscribed</label>
            <label class="dropdown-item"><input type="checkbox" /> Email cleaned</label>
          </div>
        </div>

<div class="dropdown">
  <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Tags <i class="bi bi-chevron-down"></i>
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
    <div class="text-center">
      <a href="{{ url('/audience/audience-tags') }}" class="btn btn-sm btn-outline-primary w-100">
        <i>Manage all tags</i>
      </a>
    </div>
  </div>
</div>

        <div class="dropdown">
          <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            Signup source <i class="bi bi-chevron-down"></i>
          </button>
          <div class="dropdown-menu">
            <input type="search" placeholder="Search source..." />
            <label class="dropdown-item"><input type="checkbox" /> Website</label>
            <label class="dropdown-item"><input type="checkbox" /> Shopify</label>
            <label class="dropdown-item"><input type="checkbox" /> Manual Add</label>
          </div>
        </div>

        <button class="btn btn-outline-secondary">
          <i class="bi bi-sliders"></i> Advanced filters
        </button>
      </div>

<p class="text-muted mb-3">
  {{ $contacts->total() }} total contact{{ $contacts->total() !== 1 ? 's' : '' }}.
  {{ $contacts->total() }} email subscriber{{ $contacts->total() !== 1 ? 's' : '' }}.
</p>

<div class="d-flex justify-content-between align-items-center mb-4">
  <div id="searchBarWrapper" class="input-group" style="max-width: 350px;">
    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
    <input type="text" id="globalSearchInput" class="form-control border-start-0" placeholder="Search contacts" />
  </div>

  <a href="{{ route('contacts.export') }}" class="btn" style="background-color: teal; color: white;">
    Export CSV
  </a>
</div>


<div id="deleteBarWrapper" class="d-none mb-4 d-flex gap-2">
  <form id="deleteSelectedForm" action="{{ route('contacts.deleteSelected') }}" method="POST" onsubmit="return confirm('Delete selected contacts?');">
    @csrf
    @method('DELETE')
    <button id="deleteSelected" type="submit" class="btn btn-outline-danger d-none">
      <i class="bi bi-trash"></i> Delete Selected
    </button>
  </form>

  <button id="editSelected" type="button" class="btn btn-outline-primary d-none" data-bs-toggle="modal" data-bs-target="#editContactModal">
    <i class="bi bi-pencil"></i> Edit Selected
  </button>
</div>
      <div class="table-scroll">
        <form id="contactsForm">
          <table class="table align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th><input type="checkbox" id="selectAll"></th>
                <th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Birthday</th>
                <th>Company</th>
                <th>Tags</th>
                <th>Email Marketing</th>
                <th>Source</th>
                <th>Rating</th>
                <th>Date Added</th>
                <th>Last Changed</th>
              </tr>
            </thead>
<tbody>
  @forelse($contacts as $contact)
  <tr>
    <td><input type="checkbox" class="contact-checkbox" name="selected_contacts[]" value="{{ $contact->id }}"></td>
    <td class="text-primary fw-semibold">{{ $contact->email }}</td>
    <td>{{ $contact->first_name }}</td>
    <td>{{ $contact->last_name }}</td>
    <td>
      {{ $contact->street }}<br>
      {{ $contact->address2 }}<br>
      {{ $contact->city }} {{ $contact->region }} {{ $contact->postal }}<br>
      {{ $contact->country }}
    </td>
    <td>{{ $contact->phone }}</td>
    <td>{{ $contact->birthday }}</td>
    <td>{{ $contact->company }}</td>
    <td>
@forelse($contact->tags ?? [] as $tag)
    <span class="badge bg-primary me-1">{{ $tag->name }}</span>
@empty
    -
@endforelse

    </td>
    <td><span class="badge bg-success-subtle text-success border">Subscribed</span></td>
    <td>Manual Add</td>
    <td><span class="text-warning">★</span></td>
    <td>{{ $contact->created_at->format('m/d') }}</td>
    <td>{{ $contact->updated_at->diffForHumans() }}</td>
  </tr>
  @empty
  <tr>
    <td colspan="14" class="text-center text-muted">No contacts found.</td>
  </tr>
  @endforelse
</tbody>

          </table>
<div class="card-footer bg-white border-0">
  <div class="d-flex justify-content-center">
    {{ $contacts->links('pagination::bootstrap-5') }}
  </div>
</div>


        </form>
      </div>
    </div>
  </div>

<div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editContactForm">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="contact_id" id="editContactId">

          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" name="email" required>
          </div>

          <div class="mb-3">
            <label for="editFirstName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="editFirstName" name="first_name">
          </div>

          <div class="mb-3">
            <label for="editLastName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="editLastName" name="last_name">
          </div>

          <div class="mb-3">
            <label for="editPhone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="editPhone" name="phone">
          </div>

          <div class="mb-3">
            <label for="editAddress" class="form-label">Address</label>
            <textarea class="form-control" id="editAddress" name="address"></textarea>
          </div>

          <div class="mb-3">
            <label for="editCompany" class="form-label">Company</label>
            <input type="text" class="form-control" id="editCompany" name="company">
          </div>

          <div class="mb-3">
            <label for="editBirthday" class="form-label">Birthday</label>
            <input type="date" class="form-control" id="editBirthday" name="birthday">
          </div>

          <div class="mb-3">
            <label for="editTags" class="form-label">Tags (comma separated)</label>
            <input type="text" class="form-control" id="editTags" name="tags">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const deleteForm = document.getElementById('deleteSelectedForm');

  deleteForm.addEventListener('submit', function (e) {
    // Remove any existing hidden inputs
    this.querySelectorAll('input[name="selected_contacts[]"]').forEach(el => el.remove());

    // Collect checked boxes
    const checked = document.querySelectorAll('.contact-checkbox:checked');

    // If nothing selected, stop
    if (checked.length === 0) {
      e.preventDefault();
      alert('No contacts selected for deletion.');
      return;
    }

    // Append hidden inputs for selected IDs
    checked.forEach(chk => {
      const hidden = document.createElement('input');
      hidden.type = 'hidden';
      hidden.name = 'selected_contacts[]';
      hidden.value = chk.value;
      this.appendChild(hidden);
    });

    // Ask for confirmation again for safety
    if (!confirm('Delete selected contacts?')) {
      e.preventDefault();
    }
  });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function() {
  // --------------------------
  // DOM elements
  // --------------------------
  const selectAll = document.getElementById('selectAll');
  const searchGroup = document.getElementById('searchBarWrapper');
  const deleteBar = document.getElementById('deleteBarWrapper');
  const deleteBtn = document.getElementById('deleteSelected');
  const editBtn = document.getElementById('editSelected');
  const contactsForm = document.getElementById('contactsForm');
  const deleteForm = document.getElementById('deleteSelectedForm');
  const searchInput = document.querySelector('#searchBarWrapper input');
  const tagCheckboxes = document.querySelectorAll('.tag-checkbox');
  const tagSearchInput = document.querySelector('.tag-search');
  const tableRows = document.querySelectorAll('#contactsForm table tbody tr');

  // --------------------------
  // Utility: update buttons
  // --------------------------
  function updateButtons() {
  const checkboxes = document.querySelectorAll('.contact-checkbox');
  const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);
  const anyChecked = checkedBoxes.length > 0;

  const exportBtn = document.querySelector('a[href="{{ route('contacts.export') }}"]');

  if (anyChecked) {
    searchGroup.classList.add('d-none');
    deleteBar.classList.remove('d-none');
    deleteBtn.classList.remove('d-none');
    editBtn.classList.toggle('d-none', checkedBoxes.length !== 1);
    if (exportBtn) exportBtn.classList.add('d-none');
  } else {
    searchGroup.classList.remove('d-none');
    deleteBar.classList.add('d-none');
    deleteBtn.classList.add('d-none');
    editBtn.classList.add('d-none');
    if (exportBtn) exportBtn.classList.remove('d-none');
  }
}


  // --------------------------
  // Select all checkbox
  // --------------------------
  selectAll.addEventListener('change', function() {
    document.querySelectorAll('.contact-checkbox').forEach(cb => cb.checked = this.checked);
    updateButtons();
  });

  // --------------------------
  // Individual contact checkboxes
  // --------------------------
  document.addEventListener('change', function(e) {
    if (e.target.matches('.contact-checkbox')) {
      const allCheckboxes = document.querySelectorAll('.contact-checkbox');
      selectAll.checked = Array.from(allCheckboxes).every(cb => cb.checked);
      updateButtons();
    }
  });

  // --------------------------
  // Delete selected contacts
  // --------------------------
  deleteForm.addEventListener('submit', function(e) {
    e.preventDefault();
    if (!confirm('Delete selected contacts?')) return;

    const formData = new FormData(contactsForm);
    fetch(deleteForm.action, {
      method: 'POST',
      headers: { 
        'X-CSRF-TOKEN': '{{ csrf_token() }}', 
        'X-HTTP-Method-Override': 'DELETE' 
      },
      body: formData
    }).then(() => location.reload());
  });

  // --------------------------
  // Edit selected contact (modal)
  // --------------------------
  editBtn.addEventListener('click', function() {
  const checkedBox = document.querySelector('.contact-checkbox:checked');
  if (!checkedBox) return;

  const row = checkedBox.closest('tr');
  const contactId = checkedBox.value;

  // Populate modal fields
  document.getElementById('editContactId').value = contactId;
  document.getElementById('editEmail').value = row.children[1].textContent.trim();
  document.getElementById('editFirstName').value = row.children[2].textContent.trim();
  document.getElementById('editLastName').value = row.children[3].textContent.trim();
  document.getElementById('editAddress').value = row.children[4].textContent.trim();
  document.getElementById('editPhone').value = row.children[5].textContent.trim();
  document.getElementById('editBirthday').value = row.children[6].textContent.trim();
  document.getElementById('editCompany').value = row.children[7].textContent.trim();

  // Tags
  const tags = Array.from(row.querySelectorAll('td:nth-child(9) .badge'))
                .map(b => b.textContent.trim())
                .join(', ');
  document.getElementById('editTags').value = tags;

  const modal = new bootstrap.Modal(document.getElementById('editContactModal'));
  modal.show();
});

document.getElementById('editContactForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);

  fetch(`/contacts/${formData.get('contact_id')}`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token() }}',
      'X-HTTP-Method-Override': 'PUT'
    },
    body: formData
  })
  .then(res => res.json())
  .then(() => {
    const modalEl = document.getElementById('editContactModal');
    const modalInstance = bootstrap.Modal.getInstance(modalEl);
    modalInstance.hide(); // close modal properly
    location.reload();    // reload to reflect changes
  });
});


  // --------------------------
  // Contact search input
  // --------------------------
  searchInput.addEventListener('input', function() {
    const term = this.value.toLowerCase();
    tableRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(term) ? '' : 'none';
    });
  });

  // --------------------------
  // Filter by tags
  // --------------------------
  function filterByTags() {
    const selectedTags = Array.from(document.querySelectorAll('.tag-checkbox:checked'))
      .map(cb => cb.dataset.tag.toLowerCase());

    tableRows.forEach(row => {
      const rowTags = Array.from(row.querySelectorAll('td:nth-child(9) .badge'))
        .map(b => b.textContent.toLowerCase());
      row.style.display = (selectedTags.length === 0 || selectedTags.some(tag => rowTags.includes(tag))) ? '' : 'none';
    });
  }

  tagCheckboxes.forEach(cb => cb.addEventListener('change', filterByTags));

  tagSearchInput.addEventListener('input', function() {
    const term = this.value.toLowerCase();
    tagCheckboxes.forEach(cb => {
      const itemText = cb.dataset.tag.toLowerCase();
      cb.closest('.dropdown-item').style.display = itemText.includes(term) ? '' : 'none';
    });
  });

  // --------------------------
  // Dropdown toggle logic
  // --------------------------
  (function() {
    const closeAll = () => {
      document.querySelectorAll(".dropdown-menu.show").forEach(menu => {
        menu.classList.remove("show");
        const btn = menu.closest(".dropdown")?.querySelector(".dropdown-toggle");
        if (btn) btn.setAttribute("aria-expanded", "false");
      });
    };

    document.addEventListener("click", e => {
      const toggle = e.target.closest(".dropdown-toggle");
      if (toggle) {
        e.preventDefault();
        e.stopPropagation();
        const dropdown = toggle.closest(".dropdown");
        const menu = dropdown.querySelector(".dropdown-menu");
        const isOpen = menu.classList.contains("show");
        closeAll();
        if (!isOpen) {
          menu.classList.add("show");
          toggle.setAttribute("aria-expanded", "true");
        }
        return;
      }

      const insideMenu = e.target.closest(".dropdown-menu");
      if (insideMenu && e.target.tagName === "A") closeAll();
      if (!insideMenu) closeAll();
    });

    document.addEventListener("keydown", e => {
      if (e.key === "Escape") closeAll();
    });
  })();

});

  // --------------------------
  // For Delete Function
  // --------------------------

document.getElementById('deleteSelectedForm').addEventListener('submit', function (e) {
    // Remove any existing hidden inputs (to avoid duplicates)
    this.querySelectorAll('input[name="selected_contacts[]"]').forEach(el => el.remove());

    // Add hidden inputs for each selected checkbox
    document.querySelectorAll('.contact-checkbox:checked').forEach(chk => {
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'selected_contacts[]';
        hidden.value = chk.value;
        this.appendChild(hidden);
    });

    // Optional: prevent submission if nothing is selected
    if (this.querySelectorAll('input[name="selected_contacts[]"]').length === 0) {
        e.preventDefault();
        alert('No contacts selected for deletion.');
    }
});
</script>
</x-layouts.app>