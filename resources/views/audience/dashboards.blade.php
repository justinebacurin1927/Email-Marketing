<x-layouts.app>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="px-4 py-4 mt-5 mx-5">

  <!-- PAGE HEADER -->
  <header class="mb-4 mt-4 d-flex justify-content-between align-items-center">
    <h2 class="fw-bold fs-2 mb-0">
      <a href="javascript:void(0)" class="text-dark text-decoration-none" tabindex="0"
         data-bs-toggle="popover" data-bs-trigger="focus"
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
        <strong>{{ $audienceName }}</strong><br>
        <a href="{{ url('/audience') }}" class="text-primary fw-semibold fs-4 text-decoration-none">
          {{ $totalContacts }}
        </a> total contacts.
        <a href="{{ url('/audience') }}" class="text-primary fw-semibold fs-4 text-decoration-none">
          {{ $totalSubscribers }}
        </a> email subscribers.
      </p>
    </div>

    <div class="d-flex gap-3">
      <a href="{{ url('/audience') }}" class="btn btn-outline-secondary px-4 py-2">View Contacts</a>
      <div class="dropdown">
        <button class="btn btn-outline-secondary px-4 py-2 dropdown-toggle" data-bs-toggle="dropdown">
          Manage Audience
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ url('/add-contact') }}">Add a Subscriber</a></li>
          <li><a class="dropdown-item" href="{{ url('/import-contacts') }}">Import Contacts</a></li>
          <li><a class="dropdown-item" href="{{ url('/signup-forms') }}">Signup Forms</a></li>
          <li><a class="dropdown-item" href="{{ url('/surveys') }}">Surveys</a></li>
          <li><a class="dropdown-item" href="{{ url('/inbox') }}">Inbox</a></li>
          <li><a class="dropdown-item" href="{{ url('/settings') }}">Settings</a></li>
          <li><a class="dropdown-item" href="{{ url('/view') }}">View Audience</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- DASHBOARD CARDS -->
  <div class="row g-4">

    <!-- MESSAGES INBOX -->
    <div class="col-12">
      <div class="card border-0 shadow rounded-3">
        <div class="card-body">
          <h5 class="fw-bold mb-2">
            <i class="bi bi-envelope me-2"></i>Messages Inbox
          </h5>
          <p class="text-secondary mb-0">You’ve received 0 messages in the last 30 days.</p>
          <div class="text-end mt-2">
            <a href="{{ url('/audience/inbox') }}" class="text-decoration-none fw-semibold small">View Inbox</a>
          </div>
        </div>
      </div>
    </div>

    <!-- RECENT GROWTH -->
    <div class="col-md-6">
      <div class="card border-0 shadow rounded-3 h-100">
        <div class="card-body">
          <h5 class="fw-bold mb-3">
            <a href="javascript:void(0)" class="text-dark text-decoration-none" tabindex="0"
               data-bs-toggle="popover" data-bs-trigger="focus"
               title="About Recent Growth"
               data-bs-content="An overview of audience growth over the last 30 days.">
              <i class="bi bi-bar-chart-line me-2"></i>Recent growth
            </a>
          </h5>

          <p class="text-secondary small">New contacts added in the last 30 days.</p>

          <div class="d-flex justify-content-between fw-semibold mb-2">
            <div>
              <span class="fs-5 text-primary fw-bold">{{ $totalContacts }}</span>
              <span class="text-secondary">New Contacts</span>
            </div>
            <div>
              <span class="fs-5 text-primary fw-bold">{{ $totalSubscribers }}</span>
              <span class="text-secondary">Subscribed</span>
            </div>
            <div>
              <span class="fs-5 text-primary fw-bold">0</span>
              <span class="text-secondary">Non-Subscribed</span>
            </div>
          </div>

          <p class="small text-muted mb-3">From September 28, 2025 to October 28, 2025</p>
          <hr>

          <p class="fw-semibold mb-3">Where your contacts came from:</p>

          <div class="progress mb-4 position-relative">
            <div id="bar-admin" class="progress-bar" style="background-color: #ff6f3c; width: 50%;"></div>
            <div id="bar-import" class="progress-bar" style="background-color: #4b0055; width: 50%;"></div>
          </div>

          <div class="source-item d-flex align-items-center justify-content-between border-top py-4"
               onmouseover="highlightBar('bar-admin')" onmouseout="resetBars()">
            <div class="d-flex align-items-center">
              <span class="me-2" style="width: 18px; height: 18px; background-color: #ff6f3c; border-radius: 50%; display: inline-block;"></span>
              <div>
                <span class="fw-bold fs-5 me-2">50%</span>
                <span class="fw-semibold fs-6 source-label">Admin Add</span>
              </div>
            </div>
            <div class="airplane-container">
              <span class="campaign-text">Target Campaign</span>
              <i class="bi bi-send text-secondary fs-4 airplane-icon"></i>
            </div>
          </div>

          <div class="source-item d-flex align-items-center justify-content-between border-top py-4"
               onmouseover="highlightBar('bar-import')" onmouseout="resetBars()">
            <div class="d-flex align-items-center">
              <span class="me-2" style="width: 18px; height: 18px; background-color: #4b0055; border-radius: 50%; display: inline-block;"></span>
              <div>
                <span class="fw-bold fs-5 me-2">50%</span>
                <span class="fw-semibold fs-6 source-label">Oct 21st Import</span><br>
                <small class="text-muted source-label">Copy/Pasted File</small>
              </div>
            </div>
            <div class="airplane-container">
              <span class="campaign-text">Target Campaign</span>
              <i class="bi bi-send text-secondary fs-4 airplane-icon"></i>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- TAGS -->
    <div class="col-md-6">
      <div class="card border-0 shadow rounded-3 h-100">
        <div class="card-body text-center">
          <h5 class="fw-bold mb-3">
            <a href="javascript:void(0)" class="text-dark text-decoration-none" tabindex="0"
               data-bs-toggle="popover" data-bs-trigger="focus"
               title="About Tags"
               data-bs-content="Tags are customizable labels you can apply to your contacts to help organize your audience in a way that makes the most sense to you. You can use tags as the basis for building audience segments for sending to targeted audiences or even create an automation that triggers when a specific tag is added to a contact.">
              <i class="bi bi-tag me-2"></i>Tags
            </a>
          </h5>
          <p class="text-secondary small">Tags will show up here.</p>
          <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" width="80" class="mb-3" alt="Tags illustration">
          <p class="small text-muted">Organize and target your audience based on what you know.</p>
          <button class="btn btn-outline-primary btn-sm">Start Tagging Contacts</button>
        </div>
      </div>
    </div>

    <!-- PREDICTED DEMOGRAPHICS -->
    <div class="col-12">
      <div class="card border-1 shadow rounded-3 text-center">
        <div class="card-body">
          <h5 class="fw-bold mb-3">
            <a href="javascript:void(0)" class="text-dark text-decoration-none" tabindex="0"
               data-bs-toggle="popover" data-bs-trigger="focus"
               title="About Predicted Demographics"
               data-bs-content="If you use Mailchimp Pro, or you’re a paid user with a connected online store, Mailchimp uses data science to predict the gender and age of your contacts with predicted demographics.">
              <i class="bi bi-people me-2"></i>Predicted Demographics
            </a>
          </h5>
          <p class="text-secondary small mb-3">Your contacts broken down by their predicted gender and age.</p>
          <img src="https://cdn-icons-png.flaticon.com/512/4329/4329584.png" width="80" class="mb-3" alt="Demographics illustration">
          <p class="fw-semibold">Know your people even better</p>
          <p class="text-muted small mb-3">Send targeted campaigns based on your contacts’ demographics.</p>
          <button class="btn btn-outline-primary btn-sm">View Demographics</button>
        </div>
      </div>
    </div>

<!-- ENGAGEMENT SECTION -->

<h2 class="fw-bold fs-2 mb-0">
        Engagement
</h2>

<!-- EMAIL MARKETING ENGAGEMENT -->
<div class="col-md-6 mb-4">
  <div class="card border-0 shadow rounded-3 h-100">
    <div class="card-body">
      <h5 class="fw-bold mb-3">
            <a href="javascript:void(0)" class="text-dark text-decoration-none" tabindex="0"
               data-bs-toggle="popover" data-bs-trigger="focus"
               title="About Email Marketing Engagement"
               data-bs-content="A measure of how your subscribed contacts interact with your email campaigns. We take their open and click activity, compare it to how long they’ve been in your audience, and classify them on an engagement scale.">
              <i class="bi bi-graph-up-arrow me-2"></i>Email Marketing Engagement
            </a>
          </h5>

      <p class="text-secondary small">Your subscribers’ engagement frequency.</p>

      <div class="progress mb-4 position-relative">
        <div id="bar-often" class="progress-bar" style="background-color: #0d6efd; width: 60%;"></div>
        <div id="bar-sometimes" class="progress-bar" style="background-color: #ffc107; width: 30%;"></div>
        <div id="bar-rarely" class="progress-bar" style="background-color: #dc3545; width: 10%;"></div>
      </div>

      <div class="source-item d-flex align-items-center justify-content-between border-top py-3"
           onmouseover="highlightBar('bar-often')" onmouseout="resetBars()">
        <div class="d-flex align-items-center">
          <span class="me-2" style="width: 18px; height: 18px; background-color: #0d6efd; border-radius: 50%; display: inline-block;"></span>
          <div>
            <span class="fw-bold fs-5 me-2">60%</span>
            <span class="fw-semibold fs-6 source-label">Often</span><br>
            <small class="text-muted source-label">Highly engaged subscribers</small>
          </div>
        </div>
        <div class="airplane-container">
          <span class="campaign-text">Target Campaign</span>
          <i class="bi bi-send text-secondary fs-4 airplane-icon"></i>
        </div>
      </div>

      <div class="source-item d-flex align-items-center justify-content-between border-top py-3"
           onmouseover="highlightBar('bar-sometimes')" onmouseout="resetBars()">
        <div class="d-flex align-items-center">
          <span class="me-2" style="width: 18px; height: 18px; background-color: #ffc107; border-radius: 50%; display: inline-block;"></span>
          <div>
            <span class="fw-bold fs-5 me-2">30%</span>
            <span class="fw-semibold fs-6 source-label">Sometimes</span><br>
            <small class="text-muted source-label">Moderately engaged subscribers</small>
          </div>
        </div>
        <div class="airplane-container">
          <span class="campaign-text">Target Campaign</span>
          <i class="bi bi-send text-secondary fs-4 airplane-icon"></i>
        </div>
      </div>

      <div class="source-item d-flex align-items-center justify-content-between border-top py-3"
           onmouseover="highlightBar('bar-rarely')" onmouseout="resetBars()">
        <div class="d-flex align-items-center">
          <span class="me-2" style="width: 18px; height: 18px; background-color: #dc3545; border-radius: 50%; display: inline-block;"></span>
          <div>
            <span class="fw-bold fs-5 me-2">10%</span>
            <span class="fw-semibold fs-6 source-label">Rarely</span><br>
            <small class="text-muted source-label">Low engagement subscribers</small>
          </div>
        </div>
        <div class="airplane-container">
          <span class="campaign-text">Target Campaign</span>
          <i class="bi bi-send text-secondary fs-4 airplane-icon"></i>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- TOP LOCATION SECTION -->
<div class="col-md-6 mb-4">
  <div class="card border-0 shadow rounded-3 h-100">
    <div class="card-body text-center">
      <h5 class="fw-bold mb-3">
          <a href="javascript:void(0)" class="text-dark text-decoration-none" tabindex="0"
              data-bs-toggle="popover" data-bs-trigger="focus"
              title="About Top Locations"
              data-bs-content="The top three geolocations where contacts most frequently interact with your forms and emails.">
              <i class="bi bi-geo-alt me-2"></i>Top Locations
          </a>      
      </h5>

      <img src="https://cdn-icons-png.flaticon.com/512/1063/1063192.png" width="80" class="mb-3" alt="Location icon">
      <p class="text-secondary small">See where your subscribers are most active.</p>
      <button class="btn btn-outline-primary btn-sm">View Locations</button>
    </div>
  </div>
</div>


<!-- STYLES -->
<style>
  .source-item {
    cursor: pointer;
    transition: all 0.4s ease;
  }
  .source-item:hover {
    background-color: #f8f9fa;
    transform: scale(1.02);
  }
  .progress {
    height: 28px;
    border-radius: 12px;
    overflow: hidden;
  }
  .progress-bar {
    transition: all 0.6s ease;
  }
  .airplane-icon {
    transition: transform 0.4s ease, color 0.4s ease;
    cursor: pointer;
  }
  .airplane-icon:hover {
    color: #0d6efd;
    transform: scale(1.4) rotate(-10deg);
  }
  .campaign-text {
    position: absolute;
    right: 45px;
    opacity: 0;
    font-weight: 600;
    color: #0d6efd;
    transition: opacity 0.4s ease, transform 0.4s ease;
    transform: translateX(10px);
  }
  .airplane-container {
    position: relative;
  }
  .airplane-container:hover .campaign-text {
    opacity: 1;
    transform: translateX(0);
  }
</style>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const popovers = document.querySelectorAll('[data-bs-toggle="popover"]');
    popovers.forEach(el => new bootstrap.Popover(el));
  });

  function highlightBar(id) {
    document.querySelectorAll('.progress-bar').forEach(bar => {
      bar.style.transform = 'scaleY(1)';
      bar.style.opacity = '0.4';
    });
    const active = document.getElementById(id);
    if (active) {
      active.style.transform = 'scaleY(1.3)';
      active.style.opacity = '1';
    }
  }

  function resetBars() {
    document.querySelectorAll('.progress-bar').forEach(bar => {
      bar.style.transform = 'scaleY(1)';
      bar.style.opacity = '1';
    });
  }
</script>

</x-layouts.app>
