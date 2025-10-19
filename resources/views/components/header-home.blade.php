<style>
  .btn-primary {
    background-color: #6f42c1;
    color: #ffffff;
    border-color: #6f42c1;
  }

  .btn-primary:hover {
    background-color: #5936a8;
    color: #ffffff;
    border-color: #5936a8;
  }

  .btn-primary:active,
  .btn-primary:focus {
    background-color: #4b2f8b;
    color: #ffffff;
    border-color: #4b2f8b;
  }
</style>

<div class="mt-5">
  <div class="bg-white border-bottom px-3 py-2 d-flex justify-content-between align-items-center">
    <a href="/" class="btn btn-link text-decoration-none fs-5 fw-bold">Home</a>

    <div class="d-flex align-items-center gap-2 position-relative">
      <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" id="quickActionsBtn">Quick actions</button>
        <ul class="dropdown-menu" id="quickActionsMenu" style="display: none; position: absolute; right: 0; top: 100%; min-width: 200px;">
          <li><a class="dropdown-item" href="#">Import contacts</a></li>
          <li><a class="dropdown-item" href="#">Add a single contact</a></li>
          <li><a class="dropdown-item" href="#">Connect integration</a></li>
          <li><a class="dropdown-item" href="#">Create automation</a></li>
        </ul>
      </div>

      <button class="btn btn-primary">Create email</button>
    </div>
  </div>
</div>

<script>
  const quickActionsBtn = document.getElementById('quickActionsBtn');
  const quickActionsMenu = document.getElementById('quickActionsMenu');

  document.addEventListener('click', (event) => {
    if (quickActionsBtn.contains(event.target)) {
      quickActionsMenu.style.display = quickActionsMenu.style.display === 'none' ? 'block' : 'none';
    } else if (!quickActionsMenu.contains(event.target)) {
      quickActionsMenu.style.display = 'none';
    }
  });
</script>
