<style>
/* Buttons styling */
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

/* Sticky bar below top search bar */
.sticky-bar {
  position: sticky;      /* sticks on scroll */
  top: 70px;             /* height of top search bar */
  left: 0;
  right: 0;
  z-index: 1030;
  width: 100%;           
  margin: 0; 
  margin-left: 0rem;       
  padding-top: 1.25rem;   /* adjust this to overlap more or less */
  padding-bottom: 1.25rem;
  padding-left: 1.25rem;
  padding-right: 1.25rem;     
    background-color: #fff;
  box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  box-sizing: border-box;
}

/* Make Home button look like h4 */
.sticky-bar .home-btn {
  font-size: 1.5rem;     
  font-weight: 700;
  text-decoration: none;
  padding: 0;
  margin: 0;
}

/* Add bottom spacing to prevent overlap with content below */
.sticky-bar-spacer {
  height: calc(1rem + 1.50rem * 2); /* same as sticky-bar padding top+bottom */
}
</style>

<!-- Sticky bar -->
<div class="sticky-bar d-flex justify-content-between align-items-center px-3">
  <a href="/" class="home-btn">Home</a>

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

<!-- Spacer to respect sticky bar height -->
<div class="sticky-bar-spacer"></div>

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
