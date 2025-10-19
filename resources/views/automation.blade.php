<x-layouts.app>
  <x-topbar />
  <x-top-auto />

  <div class="container-fluid px-4 py-5 mt-4">

<!-- FILTERING DROPDOWNS (Multi-select with checkboxes + 'All' option) -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
  <!-- LEFT SIDE FILTERS -->
  <div class="d-flex flex-wrap gap-2">
    
    <!-- Channels Dropdown -->
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Channels
      </button>
      <ul class="dropdown-menu p-2" id="channelDropdown">
        <li><label><input type="checkbox" value="All" class="form-check-input me-2 all-checkbox">All</label></li>
        <li><label><input type="checkbox" value="Email" class="form-check-input me-2">Email</label></li>
        <li><label><input type="checkbox" value="SMS" class="form-check-input me-2">SMS</label></li>
        <li><label><input type="checkbox" value="Facebook" class="form-check-input me-2">Facebook</label></li>
        <li><label><input type="checkbox" value="Instagram" class="form-check-input me-2">Instagram</label></li>
        <li><label><input type="checkbox" value="Shopify" class="form-check-input me-2">Shopify</label></li>
        <li><label><input type="checkbox" value="Microsoft Office" class="form-check-input me-2">Microsoft Office</label></li>
        <li><label><input type="checkbox" value="Slack" class="form-check-input me-2">Slack</label></li>
      </ul>
    </div>

    <!-- Topics Dropdown -->
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Topics
      </button>
      <ul class="dropdown-menu p-2" id="topicDropdown">
        <li><label><input type="checkbox" value="All" class="form-check-input me-2 all-checkbox">All</label></li>
        <li><label><input type="checkbox" value="Welcome" class="form-check-input me-2">Welcome</label></li>
        <li><label><input type="checkbox" value="Re-engage" class="form-check-input me-2">Re-engage</label></li>
        <li><label><input type="checkbox" value="Abandoned Cart" class="form-check-input me-2">Abandoned Cart</label></li>
        <li><label><input type="checkbox" value="Promotions" class="form-check-input me-2">Promotions</label></li>
      </ul>
    </div>

    <!-- Apps & Integrations Dropdown -->
    <div class="dropdown">
      <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
        Apps & Integrations
      </button>
      <ul class="dropdown-menu p-2" id="integrationDropdown">
        <li><label><input type="checkbox" value="All" class="form-check-input me-2 all-checkbox">All</label></li>
        <li><label><input type="checkbox" value="Shopify" class="form-check-input me-2">Shopify</label></li>
        <li><label><input type="checkbox" value="WooCommerce" class="form-check-input me-2">WooCommerce</label></li>
        <li><label><input type="checkbox" value="Zapier" class="form-check-input me-2">Zapier</label></li>
        <li><label><input type="checkbox" value="Instagram" class="form-check-input me-2">Instagram</label></li>
        <li><label><input type="checkbox" value="Slack" class="form-check-input me-2">Slack</label></li>
        <li><label><input type="checkbox" value="ReferralCandy" class="form-check-input me-2">ReferralCandy</label></li>
        <li><label><input type="checkbox" value="Smile.io" class="form-check-input me-2">Smile.io</label></li>
      </ul>
    </div>
  </div>

  <!-- RIGHT SIDE SORT DROPDOWN -->
  <div class="dropdown ms-auto">
    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
      Sort
    </button>
    <ul class="dropdown-menu p-2" id="sortDropdown">
      <li><a class="dropdown-item sort-option" data-sort="popular" href="#">Popular</a></li>
      <li><a class="dropdown-item sort-option" data-sort="recent" href="#">Recently Added</a></li>
    </ul>
  </div>
</div>

<!-- RECOMMENDED FLOW TEMPLATES -->
<div class="card border-0 shadow-sm mb-4">
  <div class="card-body">
    <h6 class="fw-bold mb-3">Recommended flow templates for Jaycee</h6>
    <p class="text-muted small mb-4">Based on your industry and connected integrations</p>

    <!-- Template Cards -->
    <div class="row g-3 mt-2">

      <!-- Welcome new contacts -->
      <div class="col-md-4 flow-card" 
           data-channels="Email,Shopify" 
           data-topics="Welcome" 
           data-integrations="Shopify" 
           data-popularity="90" 
           data-added="2025-09-25">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">
            <i class="bi bi-envelope me-2"></i>Welcome new contacts
          </h6>
          <p class="text-muted small mb-3">
            Increase engagement from new subscribers with a personalized hello.
          </p>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Share exclusive content with new leads -->
      <div class="col-md-4 flow-card" 
           data-channels="Email,Facebook" 
           data-topics="Welcome,Promotions" 
           data-integrations="Instagram,Shopify" 
           data-popularity="75" 
           data-added="2025-10-05">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">
            <i class="bi bi-envelope me-2"></i>Share exclusive content with new leads
          </h6>
          <p class="text-muted small mb-3">
            Welcome new contacts acquired through Meta lead ads. Once approved, engage them automatically via email.
          </p>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Facebook</span>
            <span class="badge bg-light text-dark border">Instagram</span>
          </div>
        </div>
      </div>

      <!-- Celebrate sign-up anniversaries -->
      <div class="col-md-4 flow-card" 
           data-channels="Email,SMS" 
           data-topics="Re-engage,Promotions" 
           data-integrations="Smile.io" 
           data-popularity="65" 
           data-added="2025-10-10">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">
            <i class="bi bi-envelope me-2"></i>Celebrate sign-up anniversaries with your contacts
          </h6>
          <p class="text-muted small mb-3">
            Offer promotions or well wishes that help contacts feel closer to your brand.
          </p>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Smile.io</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- FULLY CARD: Try these recommended flows -->
<div class="card border-0 shadow-sm mb-5">
  <div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Try these recommended flows</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">

      <!-- Welcome new contacts -->
      <div class="col flow-card" data-channels="Email,Shopify" data-topics="Welcome" data-integrations="Shopify">
        <div class="borde<!-- FULLY CARD: Try these recommended flows -->r rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-envelope me-2"></i>Welcome new contacts</h6>
          <p class="text-muted small mb-3">Increase engagement from new subscribers with a personalized hello.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
          <span class="badge bg-success mb-3">Popular</span>
        </div>
      </div>

      <!-- Welcome via pop-up -->
      <div class="col flow-card" data-channels="Email" data-topics="Welcome" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-envelope me-2"></i>Welcome contacts via pop-up form</h6>
          <p class="text-muted small mb-3">Greet new subscribers who joined through your website form.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

      <!-- Multi-channel welcome -->
      <div class="col flow-card" data-channels="Email,SMS,Shopify" data-topics="Welcome" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-envelope me-2"></i>Welcome new contacts with SMS and email</h6>
          <p class="text-muted small mb-3">Send multi-channel welcome messages to engage instantly.</p>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
          <span class="badge bg-success mb-3">Popular</span>
        </div>
      </div>

      <!-- Firewards referrals -->
      <div class="col flow-card" data-channels="SMS,Instagram,Zapier" data-topics="Re-engage" data-integrations="Zapier">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-person-plus me-2"></i>Find new contacts using Firewards referrals</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Zapier</span>
            <span class="badge bg-light text-dark border">Instagram</span>
            <span class="badge bg-light text-dark border">SMS</span>
          </div>
        </div>
      </div>

      <!-- Instagram Lead Ads -->
      <div class="col flow-card" data-channels="Email,Zapier" data-topics="Promotions" data-integrations="Instagram,Zapier">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-instagram me-2"></i>Find new contacts through Instagram Lead Ads</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Zapier</span>
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

      <!-- Add from Excel -->
      <div class="col flow-card" data-channels="Email,LinkedIn" data-topics="Abandoned Cart" data-integrations="Microsoft Office">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-file-earmark-excel me-2"></i>Add contacts from Microsoft Excel</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">LinkedIn</span>
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

      <!-- LinkedIn Lead Gen -->
      <div class="col flow-card" data-channels="Zapier" data-topics="Re-engage" data-integrations="LinkedIn">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-linkedin me-2"></i>Find new contacts through LinkedIn Lead Gen Forms</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Microsoft Office</span>
            <span class="badge bg-light text-dark border">Zapier</span>
          </div>
        </div>
      </div>

      <!-- Microsoft Teams -->
      <div class="col flow-card" data-channels="Email" data-topics="Welcome" data-integrations="Microsoft Office,Smile.io">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-microsoft me-2"></i>Receive Microsoft Teams messages when contacts subscribe</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Smile.io</span>
          </div>
        </div>
      </div>

      <!-- Smile.io referrals -->
      <div class="col flow-card" data-channels="Email,SMS" data-topics="Re-engage" data-integrations="Smile.io,ReferralCandy">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-emoji-smile me-2"></i>Find new contacts using Smile.io referrals</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">ReferralCandy</span>
            <span class="badge bg-light text-dark border">SMS</span>
          </div>
        </div>
      </div>

      <!-- ReferralCandy -->
      <div class="col flow-card" data-channels="SMS,Shopify" data-topics="Promotions" data-integrations="ReferralCandy">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-gift me-2"></i>Find new contacts using ReferralCandy referrals</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
        </div>
      </div>

      <!-- Send SMS welcome -->
      <div class="col flow-card" data-channels="SMS,Facebook" data-topics="Welcome" data-integrations="Twilio">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-chat-dots me-2"></i>Send SMS messages to welcome your contacts</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Facebook</span>
            <span class="badge bg-light text-dark border">SMS</span>
          </div>
        </div>
      </div>

      <!-- Facebook Custom Audiences -->
      <div class="col flow-card" data-channels="Email,Slack" data-topics="Promotions" data-integrations="Facebook">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1"><i class="bi bi-facebook me-2"></i>Add contacts to Facebook Custom Audiences</h6>
          <div class="d-flex flex-wrap gap-2">
            <span class="badge bg-light text-dark border">Slack</span>
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- NURTURE LEADS SECTION -->
<div class="card border-0 shadow-sm mb-5">
  <div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Nurture leads</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">

      <!-- Recover abandoned carts -->
      <div class="col flow-card" data-channels="Email" data-topics="Abandoned Cart" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Recover abandoned carts</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Email tagged customers -->
      <div class="col flow-card" data-channels="Email" data-topics="Tagging" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Email tagged customers</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Celebrate customer birthdays -->
      <div class="col flow-card" data-channels="SMS,Shopify,WooCommerce" data-topics="Celebration" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Celebrate customer birthdays</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+18</span>
          </div>
        </div>
      </div>

      <!-- Recover abandoned cart with SMS -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Abandoned Cart" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Recover abandoned cart with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+18</span>
          </div>
        </div>
      </div>

      <!-- Send abandoned cart emails for high-value products -->
      <div class="col flow-card" data-channels="Email" data-topics="Abandoned Cart" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send abandoned cart emails for high-value products</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

      <!-- Celebrate annual events -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Celebration" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Celebrate annual events</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Create repeat customers -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Create repeat customers</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+18</span>
          </div>
        </div>
      </div>

      <!-- Notify low inventory -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Notifications" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Notify customers when a product in their cart has low inventory</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+18</span>
          </div>
        </div>
      </div>

      <!-- Notify back in stock -->
      <div class="col flow-card" data-channels="Email,SMS,Shopify" data-topics="Notifications" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Notify customers when a product in their cart is back in stock</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Recover abandoned carts with SMS and email -->
      <div class="col flow-card" data-channels="Email,SMS,Shopify" data-topics="Abandoned Cart" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Recover abandoned carts with SMS and email</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">+18</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- RE-ENGAGE CONTACTS SECTION -->
<div class="card border-0 shadow-sm mb-5">
  <div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Re-engage contacts</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
      
      <!-- Re-engage contacts -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Re-engage contacts</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Recover lost customers -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Recover lost customers</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+18</span>
          </div>
        </div>
      </div>

      <!-- Win back series -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Win back series</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Abandoned cart series -->
      <div class="col flow-card" data-channels="Email,Shopify" data-topics="Abandoned Cart" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Abandoned cart series</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Drive repeat business in Shopify store with email -->
      <div class="col flow-card" data-channels="Email,SMS,Shopify" data-topics="Retention" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Drive repeat business in your Shopify store with email</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
          <span class="badge bg-success">Popular</span>
        </div>
      </div>

      <!-- Drive repeat business with email & SMS -->
      <div class="col flow-card" data-channels="SMS,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Drive repeat business in your Shopify store with email & SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Engage inactive customers with SMS -->
      <div class="col flow-card" data-channels="SMS,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Engage customers who haven't made a purchase in x months with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+17</span>
          </div>
        </div>
      </div>

      <!-- Remind customers to reorder with SMS -->
      <div class="col flow-card" data-channels="Email" data-topics="Retention" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Remind customers to reorder with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

      <!-- Send emails to missed contacts -->
      <div class="col flow-card" data-channels="Email" data-topics="Notifications" data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send emails to contacts who might’ve missed important news</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
          </div>
        </div>
      </div>

      <!-- Target unengaged contacts -->
      <div class="col flow-card" data-channels="Email,Shopify,WooCommerce" data-topics="Retention" data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Target contacts who haven’t engaged with a specific email</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- SUPPORT AND MANAGE CONTACTS SECTION -->
<div class="card border-0 shadow-sm mb-5">
  <div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Support and manage contacts</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">
      
      <!-- Collect post-purchase feedback from customers -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Collect post-purchase feedback from customers</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">E-mail</span>
            <span class="badge bg-light text-dark border">Facebook</span>
            <span class="badge bg-light text-dark border">Instagram</span>
          </div>
        </div>
      </div>

      <!-- Share exclusive content with new leads -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Share exclusive content with new leads</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
        </div>
      </div>

      <!-- Send texts to customers who view products -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send texts to customers who view products in your Shopify store</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Thank repeat customers with SMS -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Thank repeat customers with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Send refund confirmation with SMS -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send refund confirmation with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Promote cross-sell opportunities with SMS -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Promote cross-sell opportunities with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Recover lost customers with SMS -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Recover lost customers with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Create repeat customers with SMS -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Create repeat customers with SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">BigCommerce</span>
            <span class="badge bg-light text-dark border">+19</span>
          </div>
        </div>
      </div>

      <!-- Receive Microsoft Teams messages -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Receive Microsoft Teams messages when customers make purchases</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Facebook</span>
          </div>
        </div>
      </div>

      <!-- Remove contacts from Facebook Custom Audiences -->
      <div class="col">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Remove contacts from Facebook Custom Audiences</h6>
        </div>
      </div>

    </div>
  </div>
</div>  

<!-- TRANSACTIONAL SECTION -->
<div class="card border-0 shadow-sm mb-5">
  <div class="card-body">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
      <h4 class="fw-bold mb-0">Transactional</h4>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">

      <!-- Send order delivered confirmation -->
      <div class="col flow-card"
           data-channels="Email,Shopify"
           data-topics="Transactional"
           data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send order delivered confirmation</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
        </div>
      </div>

      <!-- Send order confirmation SMS -->
      <div class="col flow-card"
           data-channels="Email,SMS,Shopify"
           data-topics="Transactional"
           data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send order confirmation SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
        </div>
      </div>

      <!-- Send shipping confirmation SMS -->
      <div class="col flow-card"
           data-channels="Email,SMS,Shopify"
           data-topics="Transactional"
           data-integrations="Shopify">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send shipping confirmation SMS</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">SMS</span>
            <span class="badge bg-light text-dark border">Shopify</span>
          </div>
        </div>
      </div>

      <!-- Send refund confirmation -->
      <div class="col flow-card"
           data-channels="Email,Shopify,WooCommerce"
           data-topics="Transactional"
           data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send refund confirmation</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+17</span>
          </div>
        </div>
      </div>

      <!-- Send cancellation confirmation -->
      <div class="col flow-card"
           data-channels="Email,Shopify,WooCommerce"
           data-topics="Transactional"
           data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send cancellation confirmation</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+17</span>
          </div>
        </div>
      </div>

      <!-- Send shipping confirmation -->
      <div class="col flow-card"
           data-channels="Shopify,WooCommerce,BigCommerce"
           data-topics="Transactional"
           data-integrations="Shopify,WooCommerce,BigCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send shipping confirmation</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">BigCommerce</span>
            <span class="badge bg-light text-dark border">+16</span>
          </div>
        </div>
      </div>

      <!-- Send payment confirmation -->
      <div class="col flow-card"
           data-channels="Email,Shopify,WooCommerce"
           data-topics="Transactional"
           data-integrations="Shopify,WooCommerce">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send payment confirmation</h6>
          <div class="d-flex flex-wrap gap-2 mb-2">
            <span class="badge bg-light text-dark border">Email</span>
            <span class="badge bg-light text-dark border">Shopify</span>
            <span class="badge bg-light text-dark border">WooCommerce</span>
            <span class="badge bg-light text-dark border">+17</span>
          </div>
        </div>
      </div>

      <!-- Send order confirmation -->
      <div class="col flow-card"
           data-channels="Email"
           data-topics="Transactional"
           data-integrations="">
        <div class="border rounded-3 p-3 h-100 hover-shadow">
          <h6 class="fw-semibold mb-1">Send order confirmation</h6>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
  const flowCards = document.querySelectorAll(".flow-card");

  // 🔹 Collect all distinct parent containers for later
  const containers = [...new Set([...flowCards].map(c => c.parentElement))];

  // Helper: get checked checkbox values (excluding "All")
  function getCheckedValues(selector) {
    return Array.from(document.querySelectorAll(`${selector} input[type="checkbox"]:checked`))
      .filter(cb => cb.value !== "All")
      .map(cb => cb.value.trim());
  }

  // 🔹 FILTER LOGIC
  function filterCards() {
    const selectedChannels = getCheckedValues("#channelDropdown");
    const selectedTopics = getCheckedValues("#topicDropdown");
    const selectedIntegrations = getCheckedValues("#integrationDropdown");

    flowCards.forEach(card => {
      const cardChannels = (card.dataset.channels || "").split(",").map(v => v.trim());
      const cardTopics = (card.dataset.topics || "").split(",").map(v => v.trim());
      const cardIntegrations = (card.dataset.integrations || "").split(",").map(v => v.trim());

      const matchChannel = selectedChannels.length === 0 || selectedChannels.some(c => cardChannels.includes(c));
      const matchTopic = selectedTopics.length === 0 || selectedTopics.some(t => cardTopics.includes(t));
      const matchIntegration = selectedIntegrations.length === 0 || selectedIntegrations.some(i => cardIntegrations.includes(i));

      // 🔹 Show or hide card
      card.style.display = (matchChannel && matchTopic && matchIntegration) ? "" : "none";
    });
  }

  // 🔹 HANDLE CHECKBOX LOGIC (All + Individual)
  document.querySelectorAll(".dropdown-menu").forEach(menu => {
    const allCheckbox = menu.querySelector(".all-checkbox");
    const checkboxes = menu.querySelectorAll('input[type="checkbox"]:not(.all-checkbox)');

    if (allCheckbox) {
      allCheckbox.addEventListener("change", () => {
        checkboxes.forEach(cb => (cb.checked = allCheckbox.checked));
        filterCards();
      });
    }

    checkboxes.forEach(cb => {
      cb.addEventListener("change", () => {
        if (!cb.checked) allCheckbox.checked = false;
        else if ([...checkboxes].every(x => x.checked)) allCheckbox.checked = true;
        filterCards();
      });
    });
  });

  // 🔹 SORTING LOGIC
  document.querySelectorAll(".sort-option").forEach(option => {
    option.addEventListener("click", e => {
      e.preventDefault();
      const sortType = option.dataset.sort;

      // Sort cards globally, but grouped by section container
      containers.forEach(container => {
        const sectionCards = [...container.querySelectorAll(".flow-card")];

        sectionCards.sort((a, b) => {
          if (sortType === "popular") {
            return (b.dataset.popularity || 0) - (a.dataset.popularity || 0);
          } else if (sortType === "recent") {
            return new Date(b.dataset.added || 0) - new Date(a.dataset.added || 0);
          }
          return 0;
        });

        sectionCards.forEach(card => container.appendChild(card));
      });
    });
  });
});
</script>


<style>
.hover-shadow {
  transition: all 0.2s ease-in-out;
  cursor: pointer;
}
.hover-shadow:hover {
  border-color: #0d6efd !important;
  box-shadow: 0 0 0.5rem rgba(13, 110, 253, 0.3);
  transform: translateY(-3px);
}

/* Dropdown hover */
.dropdown-menu .dropdown-item {
  transition: background-color 0.2s ease, color 0.2s ease;
}
.dropdown-menu .dropdown-item:hover {
  background-color: #e7f1ff;
  color: #0d6efd;
}

/* Button hover */
.btn-primary:hover, .btn-primary:focus {
  background-color: #0b5ed7 !important;
  border-color: #0a58ca !important;
  color: #fff !important;
}

</style>

</x-layouts.app>