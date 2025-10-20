<x-layouts.bp-inbox>
  <x-topbar/>

  <title>Manage Sources</title>
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
      padding: 1rem 1.5rem;
      margin-top: 0.5rem;
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
  </style>

  <body>
    <div class="main-content">
      <a href="/audience/inbox" class="back-link">
        <i class="bi bi-arrow-left me-1"></i> Back to messages
      </a>

      <div class="header-title-section">
        <h1 class="header-title">Manage Sources</h1>
      </div>

      {{-- Add email form --}}
      <div class="content-box shadow-sm">
        <form action="{{ route('sources.add') }}" method="POST">
          @csrf
          <label for="email" class="form-label fw-bold">Forward mail to Inbox</label>
          <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Enter email address" required>
          <button type="submit" class="btn btn-primary">Add Email</button>
        </form>
      </div>

      {{-- Dynamic sources list --}}
      <div class="content-box shadow-sm mt-3">
        <h5 class="fw-bold">Your Sources</h5>
        @if($sources->isEmpty())
          <p class="text-muted">No sources added yet.</p>
        @else
          <ul class="list-group list-group-flush">
            @foreach($sources as $source)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $source->email }}
                <form action="{{ route('sources.delete', $source->id) }}" method="POST" onsubmit="return confirm('Delete this source?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </li>
            @endforeach
          </ul>
        @endif
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</x-layouts.bp-inbox>
