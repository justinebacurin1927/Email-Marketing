<x-layouts.bp-inbox>
  <x-topbar/>

  <title>Add Message Template</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f6f7f8;
    }
    .main-content {
      margin-left: 20rem;
      padding: 2rem;
      margin-top: 4.2rem;
    }
    .form-box {
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 1300px;
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
    .header-title {
      font-weight: 700;
      color: #212529;
      font-size: 1.75rem;
      margin-top: 0.75rem;
    }
  </style>

  <div class="main-content">
      <a href="/audience/inbox" class="back-link">
        <i class="bi bi-arrow-left me-1"></i> Back to messages
      </a>

      <h1 class="header-title">Add essage Templates</h1>
    

    <div class="form-box shadow-sm">
      <form action="{{ route('templates.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label">Name</label>
<input type="text" name="name" class="form-control" placeholder="Template name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Subject</label>
          <input type="text" name="subject" class="form-control" placeholder="Subject" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Body</label>
          <div class="border rounded p-2">
<textarea name="body" class="form-control" rows="10" placeholder="Type your message here..." required>{{ old('body') }}</textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/message-temp" class="btn btn-outline-secondary ms-2">Cancel</a>
      </form>
    </div>
  </div>
</x-layouts.bp-inbox>

