<x-layouts.bp-inbox>
  <x-topbar/>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f6f7f8;
    }
    .main-content {
      margin-left: 18rem;
      padding: 2rem;
      margin-top: 4rem;
    }
    .card-section {
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 1.5rem 2rem;
      margin-bottom: 1.5rem;
    }
    h2.page-title {
      font-weight: 700;
      font-size: 1.75rem;
      margin-bottom: 1.5rem;
    }
    h6.section-title {
      font-weight: 600;
      font-size: 1rem;
      margin-bottom: 0.5rem;
    }
    p.text-secondary {
      font-size: 0.875rem;
      margin-bottom: 0.5rem;
    }
    .form-check-label {
      font-size: 0.9rem;
    }
    .btn-group {
      margin-top: 1rem;
    }
.back-link {
  color: #008c8c;
  text-decoration: none;
  font-weight: 500;
  font-size: 0.95rem;
  display: inline-flex;
  align-items: center;
}
.back-link i {
  margin-right: 0.25rem;
}
.back-link:hover {
  color: #005757; /* darker teal on hover */
  text-decoration: none;
}
  </style>

  <div class="main-content">
<a href="/audience/inbox" class="back-link">
  <i class="bi bi-arrow-left"></i> Back to messages
</a>



    <h2 class="page-title">Inbox Notification Settings</h2>

    <div class="card-section">
      <h6 class="section-title">Browser notifications</h6>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" id="browserNotifications">
        <label class="form-check-label text-secondary" for="browserNotifications">
          Receive a web browser notification each time someone sends you a message
        </label>
      </div>
    </div>

    <div class="card-section">
      <h6 class="section-title">Email notifications</h6>
      <p class="text-secondary mb-2">
        Select which teammates receive an email notification when someone messages you.
      </p>

      <div class="form-check mb-2">
        <input class="form-check-input" type="checkbox" id="emailNotification" checked>
        <label class="form-check-label" for="emailNotification">
          Justine Cane Bacurin (justinecane.bacuring250811@gmail.com)
        </label>
      </div>

      <p class="text-secondary">
        Add and manage your <a href="#" class="text-decoration-none text-primary">teammates</a>.
      </p>
    </div>

    <div class="btn-group">
      <button class="btn btn-primary me-2">Save</button>
      <button class="btn btn-outline-secondary">Cancel</button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</x-layouts.bp-inbox>
