<x-layouts.app>
  <x-topbar />

  <style>
    .contacts-section {
      margin-top: 80px;
    }

    /* Filter section scrolling */
    .filter-scroll-container {
      overflow-x: auto;
      flex-wrap: nowrap !important;
      padding-bottom: 5px;
    }

    .filter-scroll-container .btn,
    .filter-scroll-container .form-select {
      flex-shrink: 0;
    }

    .filter-scroll-container::-webkit-scrollbar {
      height: 6px;
    }

    .filter-scroll-container::-webkit-scrollbar-thumb {
      background-color: #d1d1d1;
      border-radius: 6px;
    }

    .filter-scroll-container::-webkit-scrollbar-track {
      background-color: transparent;
    }

    /* Table scroll wrapper */
    .table-scroll {
      overflow-x: auto;
      overflow-y: hidden;
      width: 100%;
      white-space: nowrap;
      border-radius: 6px;
      scroll-behavior: smooth;
    }

    /* --- Beautiful, integrated horizontal scrollbar --- */
    .table-scroll::-webkit-scrollbar {
      height: 8px;
    }

    .table-scroll::-webkit-scrollbar-thumb {
      background-color: #bdbdbd;
      border-radius: 6px;
      transition: background-color 0.2s ease;
    }

    .table-scroll::-webkit-scrollbar-thumb:hover {
      background-color: #9e9e9e;
    }

    .table-scroll::-webkit-scrollbar-track {
      background-color: #f8f9fa;
      border-radius: 6px;
    }

    /* Table */
    .table-scroll table {
      min-width: 1600px;
      border-collapse: separate;
      border-spacing: 0;
    }

    /* Sticky header */
    .table thead th {
      position: sticky;
      top: 0;
      background: #f8f9fa;
      z-index: 3;
    }

    /* Sticky columns */
    .table th:first-child,
    .table td:first-child {
      position: sticky;
      left: 0;
      background: #fff;
      z-index: 4;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
    }

    .table th:nth-child(2),
    .table td:nth-child(2) {
      position: sticky;
      left: 50px;
      background: #fff;
      z-index: 3;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.03);
    }

    /* Subtle separation */
    .table th {
      font-weight: 600;
    }

    .table td {
      vertical-align: middle;
    }
  </style>

  <div class="card border-0 shadow-sm mb-5 contacts-section">
    <div class="card-body">

      <!-- HEADER + FILTERS -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Contacts</h4>
        <p class="text-muted mb-0">1 total contact. 1 email subscriber.</p>
      </div>

      <div class="d-flex gap-2 mb-3 align-items-center filter-scroll-container">
        <select class="form-select w-auto"><option>Segments</option></select>
        <select class="form-select w-auto"><option>Subscription status</option></select>
        <select class="form-select w-auto"><option>Tags</option></select>
        <select class="form-select w-auto"><option>Signup source</option></select>
        <button class="btn btn-outline-secondary"><i class="bi bi-sliders"></i> Advanced filters</button>
      </div>

      <div class="input-group mb-4" style="max-width: 350px;">
        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control border-start-0" placeholder="Search contacts">
      </div>

      <!-- SCROLLABLE TABLE -->
      <div class="table-scroll">
        <table class="table align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th scope="col"><input type="checkbox"></th>
              <th scope="col">Email Address</th>
              <th scope="col">First Name</th>
              <th scope="col">Last Name</th>
              <th scope="col">Address</th>
              <th scope="col">Phone Number</th>
              <th scope="col">Birthday</th>
              <th scope="col">Company</th>
              <th scope="col">Tags</th>
              <th scope="col">Email Marketing</th>
              <th scope="col">Source</th>
              <th scope="col">Rating</th>
              <th scope="col">Date Added</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td class="text-primary fw-semibold">justinecane.bacuring250811@gmail.com</td>
              <td>Justine Cane</td>
              <td>Bacurin</td>
              <td>Jaycee<br>1151 Torres Bugallon St<br>Barangay 204, Tondo<br>Tondo 1013<br>Philippines</td>
              <td>0925235296</td>
              <td>08-19-05</td>
              <td>Gleent Inc.</td>
              <td>-</td>
              <td><span class="badge bg-success-subtle text-success border">Subscribed</span></td>
              <td>Admin Add</td>
              <td>
                <span class="text-warning">★</span>
                <span class="text-warning">★</span>
                <span class="text-secondary">★</span>
              </td>
              <td>10/14</td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</x-layouts.app>
