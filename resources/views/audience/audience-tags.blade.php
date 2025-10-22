<x-layouts.app>
  <title>Tags</title>
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


<!--  <link href="{{ asset('style/tag.css') }}" rel="stylesheet">
  <script src="{{ asset('javascript/tag.js') }}"></script> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <div class="page-content">
    <div class="tags-header">
      <h5 class="fw-bold mb-0">Tags</h5>
      <div>
        <button class="btn btn-outline-secondary btn-sm">Bulk tag</button>
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#createTagModal">Create new tag</button>
      </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
      <input type="text" class="form-control w-50" placeholder="Search tags" id="searchTags">
    </div>

    <div class="table-controls">
      <div class="form-check d-flex align-items-center gap-2">
        <input class="form-check-input" type="checkbox" id="selectAll">
        <label class="form-check-label mb-0" for="selectAll">Select All</label>
      </div>
      
      <div class="sort-container">
        <select class="form-select form-select-sm" id="sortTags" style="width: 150px;">
          <option value="name">Sort by Name</option>
          <option value="date">Sort by Date</option>
        </select>
        <button class="sort-arrow-btn" id="sortDirectionBtn" title="Toggle sort direction">
          <span class="sort-arrow">↓</span>
        </button>
      </div>
      
      <button class="btn btn-danger btn-sm" id="deleteSelected">Delete</button>
    </div>

    <table class="tags-table">
      <thead>
        <tr>
          <th style="width: 40px;"></th>
          <th>Tag Name</th>
          <th>Created Date</th>
          <th style="width: 150px;">Actions</th>
        </tr>
      </thead>
      <tbody id="tagsContainer">
        @foreach($tags as $tag)
        <tr data-tag-id="{{ $tag->id }}">
          <td>
            <input class="form-check-input tag-checkbox" type="checkbox" value="{{ $tag->id }}">
          </td>
          <td>
            <span class="tag-name">{{ $tag->name }}</span>
          </td>
          <td>
            <span class="tag-date">{{ $tag->created_at->format('F j, Y') }}</span>
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <button class="btn btn-light btn-sm border">View</button>
              <div class="dropdown">
                <button class="btn btn-secondary btn-sm border dropdown-toggle" type="button" id="actionsDropdown{{ $tag->id }}" data-bs-toggle="dropdown"
                aria-expanded="false" >
                  Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionsDropdown{{ $tag->id }}">
                  <li><a class="dropdown-item rename-tag" href="#" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}">Rename</a></li>
                  <li><a class="dropdown-item delete-tag text-danger" href="#" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}">Delete</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Export as CSV</a></li>
                  <li><a class="dropdown-item" href="#">Send as Regular Email</a></li>
                  <li><a class="dropdown-item" href="#">Send A/B Testing Campaign</a></li>
                  <li><a class="dropdown-item" href="#">Send Plain-text Email</a></li>
                  <li><a class="dropdown-item" href="#">Send RSS Email</a></li>
                </ul>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <nav aria-label="Tag table pagination" class="mt-3">
      <ul class="pagination justify-content-end">
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>

  <!-- Create Tag Modal -->
  <div class="modal fade" id="createTagModal" tabindex="-1" aria-labelledby="createTagModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createTagModalLabel">What should we name this tag?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="tagAlert" class="alert d-none" role="alert"></div>
          <label for="tagName" class="form-label">Tag name</label>
          <input type="text" class="form-control mb-2" id="tagName" placeholder="Enter tag name">
          <small class="text-muted">Example: Conference Lead, Influencer, or Donor</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" id="createTagBtn">Create</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Rename Tag Modal -->
  <div class="modal fade" id="renameTagModal" tabindex="-1" aria-labelledby="renameTagModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="renameTagModalLabel">What should we rename this tag?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="renameTagAlert" class="alert d-none" role="alert"></div>
          <label for="renameTagName" class="form-label">Tag name</label>
          <input type="text" class="form-control mb-2" id="renameTagName" placeholder="Enter new tag name">
          <small class="text-muted">Example: Conference Lead, Influencer, or Donor</small>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-success" id="renameTagBtn">Rename</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Tag Modal -->
  <div class="modal fade" id="deleteTagModal" tabindex="-1" aria-labelledby="deleteTagModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteTagModalLabel">Delete Tag</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="deleteTagAlert" class="alert d-none" role="alert"></div>
          <p>Are you sure you want to delete the tag "<span id="deleteTagName" class="fw-bold">Marketing</span>"? This action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="deleteTagBtn">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <style>
    body { 
      background-color: #fff; 
    }
    
    .page-content { 
      margin: 80px 20px 0 20px; 
      width: calc(100% - 40px); 
      position: relative;
      z-index: 1;
    }

    .tags-header { 
      display: flex; 
      justify-content: space-between; 
      align-items: center; 
      margin-bottom: 1rem; 
    }
    
    .tags-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 8px;
      background-color: transparent;
    }
    
    .tags-table thead th {
      border: none;
      background-color: transparent;
      font-weight: 600;
      padding: 12px 15px;
      color: #6c757d;
    }
    
    .tags-table tbody tr {
      background-color: #fff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    
    .tags-table tbody td {
      padding: 15px;
      vertical-align: middle;
      border: none;
      border-top: 1px solid #dee2e6;
      border-bottom: 1px solid #dee2e6;
    }
    
    .tags-table tbody td:first-child {
      border-left: 1px solid #dee2e6;
      border-radius: 8px 0 0 8px;
    }
    
    .tags-table tbody td:last-child {
      border-right: 1px solid #dee2e6;
      border-radius: 0 8px 8px 0;
    }
    
    .tag-name {
      font-weight: 500;
    }
    
    .tag-date { 
      font-size: 13px; 
      color: #6c757d; 
    }
    
    /* Dropdown fixes for table layout */
    .dropdown {
      position: relative;
    }
    
    .dropdown-menu {
      position: absolute !important;
      z-index: 1050 !important;
      right: 0;
      left: auto;
      top: 100%;
    }
    
    .table-controls {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 15px;
    }

    .sort-container {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .sort-arrow-btn {
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #dee2e6;
      background: white;
      border-radius: 4px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .sort-arrow-btn:hover {
      background: #f8f9fa;
      border-color: #6c757d;
    }

    .sort-arrow-btn.active {
      background: #007bff;
      border-color: #007bff;
      color: white;
    }

    .sort-arrow {
      font-size: 12px;
      font-weight: bold;
    }

    /* FIXED: Modal z-index issues */
    .modal {
      z-index: 1060 !important; /* Higher than topbar */
    }

    .modal-backdrop {
      z-index: 1050 !important; /* Behind modal but above everything else */
    }

    /* Ensure topbar has proper z-index */
    .topbar {
      z-index: 1040 !important; /* Lower than modal backdrop */
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let currentTagId = null;
      
      // ========== EVENT DELEGATION FOR DROPDOWN ACTIONS ==========
      document.addEventListener('click', function(e) {
        if (e.target.classList.contains('rename-tag') || e.target.closest('.rename-tag')) {
          e.preventDefault();
          const renameLink = e.target.classList.contains('rename-tag') ? e.target : e.target.closest('.rename-tag');
          const tagId = renameLink.getAttribute('data-tag-id');
          const tagName = renameLink.getAttribute('data-tag-name');
          
          currentTagId = tagId;
          document.getElementById('renameTagName').value = tagName;
          const renameModal = new bootstrap.Modal(document.getElementById('renameTagModal'));
          renameModal.show();
        }
        
        if (e.target.classList.contains('delete-tag') || e.target.closest('.delete-tag')) {
          e.preventDefault();
          const deleteLink = e.target.classList.contains('delete-tag') ? e.target : e.target.closest('.delete-tag');
          const tagId = deleteLink.getAttribute('data-tag-id');
          const tagName = deleteLink.getAttribute('data-tag-name');
          
          currentTagId = tagId;
          document.getElementById('deleteTagName').textContent = tagName;
          const deleteModal = new bootstrap.Modal(document.getElementById('deleteTagModal'));
          deleteModal.show();
        }
      });

      // ========== SORTING STATE ==========
      let sortState = {
        field: 'name',
        direction: 'asc'
      };

      // ========== SORTING FUNCTIONALITY ==========
      const sortSelect = document.getElementById('sortTags');
      const sortDirectionBtn = document.getElementById('sortDirectionBtn');
      const sortArrow = sortDirectionBtn.querySelector('.sort-arrow');

      updateSortDirection();

      sortSelect.addEventListener('change', function() {
        sortState.field = this.value;
        sortTags();
      });

      sortDirectionBtn.addEventListener('click', function() {
        sortState.direction = sortState.direction === 'asc' ? 'desc' : 'asc';
        updateSortDirection();
        sortTags();
      });

      function updateSortDirection() {
        if (sortState.direction === 'asc') {
          sortArrow.textContent = '↑';
          sortDirectionBtn.title = 'Sort ascending (click to switch to descending)';
        } else {
          sortArrow.textContent = '↓';
          sortDirectionBtn.title = 'Sort descending (click to switch to ascending)';
        }
        
        sortDirectionBtn.classList.add('active');
        setTimeout(() => {
          sortDirectionBtn.classList.remove('active');
        }, 200);
      }

      function sortTags() {
        const tbody = document.getElementById('tagsContainer');
        const rows = Array.from(tbody.querySelectorAll('tr'));
        
        if (sortState.field === 'name') {
          rows.sort((a, b) => {
            const nameA = a.querySelector('.tag-name').textContent.toLowerCase();
            const nameB = b.querySelector('.tag-name').textContent.toLowerCase();
            const comparison = nameA.localeCompare(nameB);
            return sortState.direction === 'asc' ? comparison : -comparison;
          });
        } else if (sortState.field === 'date') {
          rows.sort((a, b) => {
            const dateA = new Date(a.querySelector('.tag-date').textContent);
            const dateB = new Date(b.querySelector('.tag-date').textContent);
            const comparison = dateA - dateB;
            return sortState.direction === 'asc' ? comparison : -comparison;
          });
        }
        
        rows.forEach(r => tbody.appendChild(r));
      }

      // ========== CREATE TAG FUNCTIONALITY ==========
      const createBtn = document.getElementById('createTagBtn');
      const tagInput = document.getElementById('tagName');
      const tagAlert = document.getElementById('tagAlert');
      const createModalEl = document.getElementById('createTagModal');
      let createModalInstance = null;

      createModalEl.addEventListener('show.bs.modal', () => {
        tagAlert.classList.add('d-none');
        tagAlert.textContent = '';
        tagAlert.classList.remove('alert-success','alert-danger');
        tagInput.value = '';
      });

      createModalEl.addEventListener('shown.bs.modal', () => {
        tagInput.focus();
      });

      createBtn.addEventListener('click', async () => {
        const newTag = tagInput.value.trim();
        if (!newTag) return;

        createBtn.disabled = true;
        createBtn.textContent = 'Creating...';

        try {
          const response = await fetch('/tags', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
            },
            body: JSON.stringify({ name: newTag })
          });

          const data = await response.json();

          if (data.success) {
            tagAlert.classList.remove('d-none');
            tagAlert.classList.add('alert-success');
            tagAlert.textContent = data.message;
            
            addTagToTable(data.tag);
            
            setTimeout(() => {
              const modal = bootstrap.Modal.getInstance(createModalEl);
              modal.hide();
              // Clear the form after modal is hidden
              setTimeout(() => {
                tagInput.value = '';
                tagAlert.classList.add('d-none');
              }, 300);
            }, 1000);
          } else {
            throw new Error(data.message || 'Failed to create tag');
          }
        } catch (error) {
          tagAlert.classList.remove('d-none');
          tagAlert.classList.add('alert-danger');
          tagAlert.textContent = error.message || 'Tag already exists!';
        } finally {
          createBtn.disabled = false;
          createBtn.textContent = 'Create';
        }
      });

      // ========== RENAME TAG FUNCTIONALITY ==========
      const renameTagBtn = document.getElementById('renameTagBtn');
      const renameTagInput = document.getElementById('renameTagName');
      const renameTagAlert = document.getElementById('renameTagAlert');
      const renameModalEl = document.getElementById('renameTagModal');

      renameModalEl.addEventListener('show.bs.modal', () => {
        renameTagAlert.classList.add('d-none');
        renameTagAlert.textContent = '';
        renameTagAlert.classList.remove('alert-success', 'alert-danger');
      });

      renameModalEl.addEventListener('shown.bs.modal', () => {
        renameTagInput.focus();
        renameTagInput.select();
      });

      renameTagBtn.addEventListener('click', async () => {
        const newTagName = renameTagInput.value.trim();
        
        if (!newTagName) return;

        renameTagBtn.disabled = true;
        renameTagBtn.textContent = 'Renaming...';

        try {
          const response = await fetch(`/tags/${currentTagId}`, {
            method: 'PUT',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
            },
            body: JSON.stringify({ name: newTagName })
          });

          const data = await response.json();

          if (data.success) {
            renameTagAlert.classList.remove('d-none');
            renameTagAlert.classList.add('alert-success');
            renameTagAlert.textContent = data.message;
            
            updateTagInTable(currentTagId, newTagName);
            
            setTimeout(() => {
              const renameModal = bootstrap.Modal.getInstance(renameModalEl);
              renameModal.hide();
            }, 1000);
          } else {
            throw new Error(data.message || 'Failed to rename tag');
          }
        } catch (error) {
          renameTagAlert.classList.remove('d-none');
          renameTagAlert.classList.add('alert-danger');
          renameTagAlert.textContent = error.message || 'Tag name already exists!';
        } finally {
          renameTagBtn.disabled = false;
          renameTagBtn.textContent = 'Rename';
        }
      });

      // ========== DELETE TAG FUNCTIONALITY ==========
      const deleteTagBtn = document.getElementById('deleteTagBtn');
      const deleteTagAlert = document.getElementById('deleteTagAlert');
      const deleteModalEl = document.getElementById('deleteTagModal');

      deleteModalEl.addEventListener('show.bs.modal', () => {
        deleteTagAlert.classList.add('d-none');
        deleteTagAlert.textContent = '';
        deleteTagAlert.classList.remove('alert-success', 'alert-danger');
      });

      deleteTagBtn.addEventListener('click', async () => {
        deleteTagBtn.disabled = true;
        deleteTagBtn.textContent = 'Deleting...';

        try {
          const response = await fetch(`/tags/${currentTagId}`, {
            method: 'DELETE',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
            }
          });

          const data = await response.json();

          if (data.success) {
            deleteTagAlert.classList.remove('d-none');
            deleteTagAlert.classList.add('alert-success');
            deleteTagAlert.textContent = data.message;
            
            removeTagFromTable(currentTagId);
            
            setTimeout(() => {
              const deleteModal = bootstrap.Modal.getInstance(deleteModalEl);
              deleteModal.hide();
            }, 1000);
          } else {
            throw new Error(data.message || 'Failed to delete tag');
          }
        } catch (error) {
          deleteTagAlert.classList.remove('d-none');
          deleteTagAlert.classList.add('alert-danger');
          deleteTagAlert.textContent = error.message || 'Failed to delete tag!';
        } finally {
          deleteTagBtn.disabled = false;
          deleteTagBtn.textContent = 'Delete';
        }
      });

      // ========== BULK DELETE FUNCTIONALITY ==========
      const selectAllCheckbox = document.getElementById('selectAll');
      const deleteBtn = document.getElementById('deleteSelected');

      selectAllCheckbox.addEventListener('change', () => {
        const tagCheckboxes = document.querySelectorAll('.tag-checkbox');
        tagCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
      });

      deleteBtn.addEventListener('click', async () => {
        const checkedBoxes = document.querySelectorAll('.tag-checkbox:checked');
        if (checkedBoxes.length === 0) {
          alert('Please select at least one tag to delete');
          return;
        }

        const tagIds = Array.from(checkedBoxes).map(cb => cb.value);
        
        if (!confirm(`Are you sure you want to delete ${tagIds.length} tag(s)?`)) {
          return;
        }

        deleteBtn.disabled = true;
        deleteBtn.textContent = 'Deleting...';

        try {
          const response = await fetch('/tags/bulk-delete', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'Accept': 'application/json'
            },
            body: JSON.stringify({ ids: tagIds })
          });

          const data = await response.json();

          if (data.success) {
            tagIds.forEach(tagId => removeTagFromTable(tagId));
            selectAllCheckbox.checked = false;
            alert(data.message);
          } else {
            throw new Error(data.message || 'Failed to delete tags');
          }
        } catch (error) {
          alert(error.message || 'Failed to delete tags!');
        } finally {
          deleteBtn.disabled = false;
          deleteBtn.textContent = 'Delete';
        }
      });

      // ========== HELPER FUNCTIONS ==========
      function addTagToTable(tag) {
        const tbody = document.getElementById('tagsContainer');
        const newRow = document.createElement('tr');
        newRow.setAttribute('data-tag-id', tag.id);
        
        newRow.innerHTML = `
          <td>
            <input class="form-check-input tag-checkbox" type="checkbox" value="${tag.id}">
          </td>
          <td>
            <span class="tag-name">${tag.name}</span>
          </td>
          <td>
            <span class="tag-date">${new Date(tag.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <button class="btn btn-light btn-sm border">View</button>
              <div class="dropdown">
                <button class="btn btn-secondary btn-sm border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                  Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item rename-tag" href="#" data-tag-id="${tag.id}" data-tag-name="${tag.name}">Rename</a></li>
                  <li><a class="dropdown-item delete-tag text-danger" href="#" data-tag-id="${tag.id}" data-tag-name="${tag.name}">Delete</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="#">Export as CSV</a></li>
                  <li><a class="dropdown-item" href="#">Send as Regular Email</a></li>
                  <li><a class="dropdown-item" href="#">Send A/B Testing Campaign</a></li>
                  <li><a class="dropdown-item" href="#">Send Plain-text Email</a></li>
                  <li><a class="dropdown-item" href="#">Send RSS Email</a></li>
                </ul>
              </div>
            </div>
          </td>
        `;

        tbody.appendChild(newRow);
        sortTags();
      }

      function updateTagInTable(tagId, newName) {
        const row = document.querySelector(`tr[data-tag-id="${tagId}"]`);
        if (row) {
          const tagNameCell = row.querySelector('.tag-name');
          const renameLink = row.querySelector('.rename-tag');
          const deleteLink = row.querySelector('.delete-tag');
          
          tagNameCell.textContent = newName;
          renameLink.setAttribute('data-tag-name', newName);
          deleteLink.setAttribute('data-tag-name', newName);
        }
        sortTags();
      }

      function removeTagFromTable(tagId) {
        const row = document.querySelector(`tr[data-tag-id="${tagId}"]`);
        if (row) {
          row.remove();
        }
      }

      // ========== SEARCH FUNCTIONALITY ==========
      const searchInput = document.getElementById('searchTags');
      searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tagsContainer tr');
        
        rows.forEach(row => {
          const tagName = row.querySelector('.tag-name').textContent.toLowerCase();
          if (tagName.includes(searchTerm)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    });
  </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const testDropdown = document.querySelector('[data-bs-toggle="dropdown"]');
    if (testDropdown) {
      console.log('Bootstrap dropdown initialized:', typeof bootstrap !== 'undefined');
    }
  });
</script>

</x-layouts.app>