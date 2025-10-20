<x-layouts.bp-inbox>
  <x-topbar/>

  <title>Message Templates</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f6f7f8;
    }
    .main-content {
      margin-left: 18rem;
      padding: 2rem;
      margin-top: 4.2rem;
    }
    .content-box {
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 1rem 1.5rem; /* reduced padding */
      margin-top: 0.5rem; /* stacked closer */
      width: 100%;
      max-width: none;
    }
    .btn-primary {
      background-color: #008c8c;
      border-color: #008c8c;
    }
    .btn-primary:hover {
      background-color: #007474;
      border-color: #007474;
    }
    .back-link {
      display: inline-flex;
      align-items: center;
      color: #008c8c;
      text-decoration: none;
      font-size: 0.95rem;
      margin-top: 0.5rem;
    }
    .header-title-section {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 0.75rem;
      margin-bottom: 1rem;
    }
    .header-title {
      font-weight: 700;
      color: #212529;
      font-size: 1.75rem;
      margin: 0;
    }
    .template-actions {
      display: flex;
      gap: 0.5rem;
      justify-content: flex-end;
      margin-top: 0.5rem; /* smaller gap */
    }
    .template-actions .btn-sm {
      padding: 0.4rem 0.8rem;
      font-size: 0.85rem;
    }
    .modal-header-teal {
      background-color: #008c8c;
      color: white;
    }
    .modal-body {
      max-height: 60vh;
      overflow-y: auto;
      white-space: pre-line;
    }
  </style>

  <body>
    <div class="main-content">
      <a href="/audience/inbox" class="back-link">
        <i class="bi bi-arrow-left me-1"></i> Back to messages
      </a>

      <div class="header-title-section">
        <h1 class="header-title">Message Templates</h1>
        <a href="{{ route('templates.create') }}" class="btn btn-primary btn-sm">
          Add New Message Template
        </a>
      </div>

      @if($templates->isEmpty())
        <div class="content-box shadow-sm text-center">
          <h4>No templates yet</h4>
        </div>
      @else
        @foreach($templates as $template)
          <div class="content-box shadow-sm">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="mb-0 fw-bold">{{ $template->name }}</h5>
              <small class="text-muted">
                {{ $template->created_at->format('M d, Y') }}
              </small>
            </div>

            <div class="template-actions">
              <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $template->id }}">
                View
              </button>
              <a href="{{ route('templates.edit', $template->id) }}" class="btn btn-outline-secondary btn-sm">
                Edit
              </a>
              <form action="{{ route('templates.destroy', $template->id) }}" method="POST" onsubmit="return confirm('Delete?')" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm">
                  Delete
                </button>
              </form>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    @foreach($templates as $template)
      <div class="modal fade" id="viewModal-{{ $template->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header modal-header-teal">
              <h5 class="modal-title">{{ $template->name }}</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p>{{ $template->body }}</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</x-layouts.bp-inbox>
