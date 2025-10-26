<x-layouts.app>
  <title>Tags</title>
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">



<link href="{{ asset('style/tag.css') }}" rel="stylesheet">
<script src="{{ asset('javascript/tag.js') }}"></script>
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


</x-layouts.app>>