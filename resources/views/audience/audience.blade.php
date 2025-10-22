<x-layouts.app>
  <x-topbar />

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
              <a class="dropdown-item" href="#">Import contacts</a>
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
            <input type="search" placeholder="Search tags..." />
            <label class="dropdown-item"><input type="checkbox" /> Premium</label>
            <label class="dropdown-item"><input type="checkbox" /> Trial</label>
            <label class="dropdown-item"><input type="checkbox" /> Promo</label>
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
        {{ $contacts->count() }} total contact{{ $contacts->count() !== 1 ? 's' : '' }}.
        {{ $contacts->count() }} email subscriber{{ $contacts->count() !== 1 ? 's' : '' }}.
      </p>

      <div id="searchBarWrapper" class="input-group mb-4" style="max-width: 350px;">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control border-start-0" placeholder="Search contacts" />
      </div>

      <div id="deleteBarWrapper" class="d-none mb-4">
        <form id="deleteSelectedForm" action="{{ route('contacts.deleteSelected') }}" method="POST" onsubmit="return confirm('Delete selected contacts?');">
          @csrf
          @method('DELETE')
          <button id="deleteSelected" type="submit" class="btn d-none" style="border: 1px solid red; background: none; color: red;">
            <i class="bi bi-trash"></i> Delete Selected
          </button>
        </form>
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
                <td>-</td>
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
        </form>
      </div>
    </div>
  </div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.contact-checkbox');
    const searchGroup = document.querySelector('#searchBarWrapper');
    const deleteBtn = document.getElementById('deleteSelected');
    const deleteBar = document.getElementById('deleteBarWrapper');

    function updateDeleteButton() {
      const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
      if (anyChecked) {
        searchGroup.classList.add('d-none');
        deleteBar.classList.remove('d-none');
        deleteBtn.classList.remove('d-none');
      } else {
        searchGroup.classList.remove('d-none');
        deleteBar.classList.add('d-none');
        deleteBtn.classList.add('d-none');
      }
    }

    selectAll.addEventListener('change', function() {
      checkboxes.forEach(cb => cb.checked = this.checked);
      updateDeleteButton();
    });

    checkboxes.forEach(cb => {
      cb.addEventListener('change', function() {
        if (!this.checked) selectAll.checked = false;
        else if (Array.from(checkboxes).every(c => c.checked)) selectAll.checked = true;
        updateDeleteButton();
      });
    });

    // delete submit
    const deleteForm = document.getElementById('deleteSelectedForm');
    const contactsForm = document.getElementById('contactsForm');

    deleteForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const confirmed = confirm('Delete selected contacts?');
      if (!confirmed) return;

      const formData = new FormData(contactsForm);
      fetch(deleteForm.action, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-HTTP-Method-Override': 'DELETE' },
        body: formData
      }).then(() => location.reload());
    });

    // dropdown logic
    (function () {
      const closeAll = () => {
        document.querySelectorAll(".dropdown-menu.show").forEach((menu) => {
          menu.classList.remove("show");
          const btn = menu.closest(".dropdown")?.querySelector(".dropdown-toggle");
          if (btn) btn.setAttribute("aria-expanded", "false");
        });
      };

      document.addEventListener("click", (e) => {
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
        if (insideMenu) {
          if (e.target.tagName === "A") closeAll();
          return;
        }

        closeAll();
      });

      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeAll();
      });

      document.addEventListener("input", (e) => {
        const input = e.target;
        if (!input.matches('.dropdown-menu input[type="search"]')) return;
        const term = input.value.toLowerCase();
        input.parentElement.querySelectorAll(".dropdown-item").forEach((item) => {
          item.style.display = item.textContent.toLowerCase().includes(term)
            ? ""
            : "none";
        });
      });
    })();
  });
</script>
</x-layouts.app>