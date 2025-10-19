<!-- AUTOMATIONS HEADER (OVERLAPPING TOP SEARCH BAR) -->
<div class="d-flex align-items-center bg-white shadow-sm sticky-section">
  <div>
    <h4 class="fw-bold text-dark mb-0 ps-3">Automations</h4>
  </div>
  <div class="d-flex gap-2 ms-auto pe-3">
    <button class="btn btn-outline-secondary">Build from scratch</button>
    <button class="btn btn-primary">Choose flow template</button>
  </div>
</div>

<style>
/* Sticky header overlapping top search bar */
.sticky-section {
    position: sticky;      
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
    box-sizing: border-box;
    height: auto;
}

/* Buttons styling */
.btn-outline-secondary {
    color: #6f42c1;
    border-color: #6f42c1;
}

.btn-outline-secondary:hover {
    background-color: #6f42c1;
    color: #ffffff;
    border-color: #6f42c1;
}

.btn-outline-secondary:active,
.btn-outline-secondary:focus {
    background-color: #5936a8;
    color: #ffffff;
    border-color: #5936a8;
}

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
    background-color: #4b2d91;
    color: #ffffff;
    border-color: #4b2d91;
}
</style>
