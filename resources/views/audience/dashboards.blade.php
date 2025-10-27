<x-layouts.app>
  <div class="px-4 py-4 mt-5">
<!-- PAGE HEADER -->
<header class="mb-4 mt-4 d-flex justify-content-between align-items-center">
  <h2 class="fw-bold fs-2 mb-0">
    <a href="#" class="text-dark text-decoration-none"
       tabindex="0"
       data-bs-toggle="popover"
       data-bs-trigger="focus"
       title="About Audience"
       data-bs-content="All the contacts you pay to store in Mailchimp. These chargeable contacts (subscribed, non-subscribed, and unsubscribed) are eligible to receive at least one type of marketing from you. We also refer to the container where all your chargeable contacts are stored as your audience. This is where you can manage and see all your contact data with the help of our CRM tools.">
      Audience
    </a>
  </h2>
</header>

<!-- AUDIENCE INFO AND BUTTONS -->
<div class="d-flex justify-content-between align-items-center mb-4">
  <div>
    <p class="text-secondary fs-5 mb-0">
      <strong>Jaycee</strong><br>
      <span class="text-primary fw-semibold fs-4">2</span> total contacts.
      <span class="text-primary fw-semibold fs-4">2</span> email subscribers.
    </p>
  </div>

  <div class="d-flex gap-3">
    <button class="btn btn-outline-secondary px-4 py-2">View Contacts</button>
    <div class="dropdown">
      <button class="btn btn-outline-secondary px-4 py-2 dropdown-toggle" data-bs-toggle="dropdown">
        Manage Audience
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">Import Contacts</a></li>
        <li><a class="dropdown-item" href="#">Export Contacts</a></li>
        <li><a class="dropdown-item" href="#">Delete Audience</a></li>
      </ul>
    </div>
  </div>
</div>


    <!-- DASHBOARD CARDS -->
    <div class="row g-4">
      <!-- MESSAGES INBOX -->
      <div class="col-12">
        <div class="card border-0 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold mb-2">
              <i class="bi bi-envelope me-2"></i>Messages Inbox
            </h5>
            <p class="text-secondary mb-0">You’ve received 0 messages in the last 30 days.</p>
            <div class="text-end mt-2">
              <a href="#" class="text-decoration-none fw-semibold small">View Inbox</a>
            </div>
          </div>
        </div>
      </div>

      <!-- RECENT GROWTH -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body">
            <h5 class="fw-bold mb-3">
              <i class="bi bi-bar-chart-line me-2"></i>Recent growth
            </h5>
            <p class="text-secondary small">New contacts added to this audience in the last 30 days.</p>

            <div class="d-flex justify-content-between fw-semibold mb-2">
              <span>2 New Contacts</span>
              <span class="text-success">2 Subscribed</span>
            </div>

            <div class="progress mb-3" style="height: 8px;">
              <div class="progress-bar bg-warning" style="width: 45%;"></div>
              <div class="progress-bar bg-purple" style="width: 55%;"></div>
            </div>

            <p class="small text-muted mb-0">From September 26, 2025 to October 26, 2025</p>
          </div>
        </div>
      </div>

      <!-- TAGS -->
      <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center">
            <h5 class="fw-bold mb-3">
              <i class="bi bi-tag me-2"></i>Tags
            </h5>
            <p class="text-secondary small">Tags will show up here.</p>
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" width="80" class="mb-3" alt="Tags illustration">
            <p class="small text-muted">Organize and target your audience based on what you know</p>
            <button class="btn btn-outline-primary btn-sm">Start Tagging Contacts</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- POPPER + BOOTSTRAP JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

  <!-- POPOVER INIT -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
      popoverTriggerList.forEach(function (popoverTriggerEl) {
        new bootstrap.Popover(popoverTriggerEl)
      })
    })
  </script>

  <!-- POPPER + BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

<!-- POPOVER INIT -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    popoverTriggerList.forEach(function (popoverTriggerEl) {
      new bootstrap.Popover(popoverTriggerEl)
    })
  })
</script>
</x-layouts.app>
