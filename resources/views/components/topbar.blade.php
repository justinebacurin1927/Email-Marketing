<style>
  .btn-outline-secondary {
    color: #6f42c1;
    border-color: #6f42c1;
  }

  .btn-outline-secondary:hover {
    background-color: #6f42c1; /* purple background on hover */
    color: #ffffff; /* white text on hover */
    border-color: #6f42c1;
  }

  .btn-outline-secondary:active,
  .btn-outline-secondary:focus {
    background-color: #5936a8; /* darker purple when active/focused */
    color: #ffffff;
    border-color: #5936a8;
  }
</style>

<header class="bg-white border-bottom px-3 py-2"
  style="position: fixed; top: 0; left: 0; right: 0; z-index: 1100; width: 100%;">
  <div class="d-flex align-items-center justify-content-between">
    <div class="rounded-circle bg-secondary" style="width: 3rem; height: 3rem;"></div>
    <input type="text" placeholder="Search..." class="form-control mx-3"
      style="max-width: 1000px; height: 3rem; font-size: 1.25rem;">
    <div class="d-flex align-items-center gap-3">
      <button class="btn btn-outline-secondary">Help</button>
      <div class="rounded-circle bg-primary" style="width: 3rem; height: 3rem;"></div>
    </div>
  </div>
</header>
