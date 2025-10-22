    document.addEventListener('DOMContentLoaded', function() {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      let currentTagId = null;
      
      // ========== EVENT DELEGATION FOR DROPDOWN ACTIONS ==========
      // This handles clicks on rename and delete links in dropdowns
      document.addEventListener('click', function(e) {
        // Handle rename tag clicks
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
        
        // Handle delete tag clicks
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
        field: 'name', // 'name' or 'date'
        direction: 'asc' // 'asc' or 'desc'
      };

      // ========== SORTING FUNCTIONALITY ==========
      const sortSelect = document.getElementById('sortTags');
      const sortDirectionBtn = document.getElementById('sortDirectionBtn');
      const sortArrow = sortDirectionBtn.querySelector('.sort-arrow');

      // Initialize sort direction
      updateSortDirection();

      // Sort when field changes
      sortSelect.addEventListener('change', function() {
        sortState.field = this.value;
        sortTags();
      });

      // Toggle sort direction when arrow button is clicked
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
        
        // Visual feedback
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
        
        // Re-append rows in sorted order
        rows.forEach(r => tbody.appendChild(r));
      }

      // ========== CREATE TAG FUNCTIONALITY ==========
      const createBtn = document.getElementById('createTagBtn');
      const tagInput = document.getElementById('tagName');
      const tagAlert = document.getElementById('tagAlert');
      const modalEl = document.getElementById('createTagModal');

      modalEl.addEventListener('show.bs.modal', () => {
        tagAlert.classList.add('d-none');
        tagAlert.textContent = '';
        tagAlert.classList.remove('alert-success','alert-danger');
        tagInput.value = '';
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
            
            // Add new tag to the table
            addTagToTable(data.tag);
            
            setTimeout(() => {
              const modal = bootstrap.Modal.getInstance(modalEl);
              modal.hide();
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
            
            // Update the tag in table
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
            
            // Remove tag from table
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
            // Remove all selected tags from table
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
        
        // Re-sort after adding new tag
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
        
        // Re-sort after renaming tag
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