<x-layouts.app>
  <x-topbar />
  <x-header-home />

  <style>
  /* Buttons hover effect */
  .btn-outline-primary:hover {
    background-color: #0d6efd; /* new background color */
    color: #ffffff; /* text color on hover */
    border-color: #0d6efd; /* optional: change border color to match background */
  }

  /* Optional: active/click effect */
  .btn-outline-primary:active, .btn-outline-primary:focus {
    background-color: #0a58ca;
    color: #ffffff;
    border-color: #0a58ca;
  }
</style>


  <!-- Dashboard Tasks Section -->
  <div class="px-3 px-md-4">
    <header class="mb-4">
      <h1 class="h4 fw-bold text-dark">Dashboard</h1>
      <p class="text-secondary small">Manage your email templates and campaigns</p>
    </header>

    <section class="mb-4">
      <h2 class="h6 fw-semibold mb-3">Tasks</h2>
      <div class="row g-3">
        <div class="col-12 col-md-6 col-lg-4">
          <x-task-card title="Design new email" time="2h ago" />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
          <x-task-card title="Send campaign" time="1h ago" />
        </div>
      </div>
    </section>
  </div>

  <div class="px-3 px-md-4 mb-4">
    <h4>Finish setting up your account</h4>
    <div class="progress" style="height: 8px;">
      <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <small class="text-muted d-block mt-2 mb-3">0 of 4 tasks completed</small>

    <!-- Task Slider -->
    <div class="d-flex overflow-auto gap-3" style="padding-bottom: 1px;">
      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Add your contacts</h6>
          <p class="card-text small">Upload your list of subscribers or import them from another app.</p>
          <small class="text-muted">4 min</small>
        </div>
      </div>

      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Connect an integration</h6>
          <p class="card-text small">Leverage data to create more automated, personalized omni-channel marketing communications.</p>
          <small class="text-muted">2 min</small>
        </div>
      </div>

      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Import your brand</h6>
          <p class="card-text small">We’ll create email designs using your fonts, logos, colors, and images.</p>
          <small class="text-muted">2 seconds</small>
        </div>
      </div>

      <div class="card flex-shrink-0" style="width: 250px;">
        <div class="card-body">
          <h6 class="card-title">Authenticate your email domain</h6>
          <p class="card-text small">Strongly recommended to improve deliverability, avoid spam folders, and build your sender reputation.</p>
          <small class="text-muted">4 min</small>
        </div>
      </div>
    </div>
  </div>

  <!-- Templates Section -->
  <div class="px-3 px-md-4">
    <section class="mb-4">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h2 class="h6 fw-semibold mb-0">Start with a template</h2>
        <a href="#" class="text-decoration-none">View all templates</a>
      </div>

      <div class="d-flex gap-2 mb-3 flex-wrap">
        <button class="btn btn-outline-primary">All</button>
        <button class="btn btn-outline-primary">Email</button>
        <button class="btn btn-outline-primary">Automation</button>
      </div>

      <div class="row g-3">
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <x-template-card title="Custom email design" type="Free" image="/img/template1.png" />
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <x-template-card title="Start from scratch" type="Email" image="/img/template2.png" />
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <x-template-card title="Welcome new contacts" type="Automation" image="/img/template3.png" />
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <x-template-card title="1:3:1 Column" type="Email" image="/img/template4.png" />
        </div>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <x-template-card title="Minimal" type="Email" image="/img/template5.png" />
        </div>
      </div>

      <div class="mt-3 text-end">
        <button class="btn btn-outline-primary">Start from Scratch</button>
      </div>
    </section>
  </div>

  <x-popup-cards :cards="[
    ['image'=>'/img/popup1.png','alt'=>'Discount popup','icon'=>'bi bi-tag','title'=>'Discount popup','text'=>'Offer a discount to new subscribers','link'=>'#','linkText'=>'See discount templates'],
    ['image'=>'/img/popup2.png','alt'=>'Newsletter popup','icon'=>'bi bi-send','title'=>'Newsletter popup','text'=>'Stay in the know','link'=>'#','linkText'=>'See newsletter templates'],
    ['image'=>'/img/popup3.png','alt'=>'Free content popup','icon'=>'bi bi-file-earmark-text','title'=>'Free content popup','text'=>'Download an e-book or guide','link'=>'#','linkText'=>'See free content templates'],
    ['image'=>'/img/popup4.png','alt'=>'Free consultation','icon'=>'bi bi-calendar-check','title'=>'Free consultation','text'=>'Set up an initial meeting','link'=>'#','linkText'=>'See free consultation templates']
  ]" />
</x-layouts.app>
