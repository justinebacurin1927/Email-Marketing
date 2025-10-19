<x-layouts.app>
  <x-topbar />

  <div class="px-4 py-4 mt-5">
    <!-- HEADER -->
    <header class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h1 class="h4 fw-bold text-dark mb-1">All campaigns</h1>
        <p class="text-secondary small mb-0">Manage and track your email campaigns</p>
      </div>
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-secondary">View analytics</button>
        <button class="btn btn-primary">Create</button>
      </div>
    </header>

    <!-- CARD -->
    <section class="bg-white border rounded p-3 mb-4 shadow-sm">
      <!-- NAV TABS -->
      <ul class="nav nav-tabs mb-3">
        <li class="nav-item">
          <a class="nav-link active" id="list-tab" href="#">List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="calendar-tab" href="#">Calendar</a>
        </li>
      </ul>

      <!-- LIST VIEW -->
      <div id="list-content">
        <div class="mb-3 d-flex align-items-center flex-wrap gap-3">
          <input type="text" class="form-control" placeholder="Search campaigns" style="max-width: 400px;">
          <div class="text-muted small">Sort by: <a href="#" class="text-decoration-none">Date edited</a></div>
        </div>

        <div class="mb-3 d-flex flex-wrap gap-3">
          <div>Type:
            <select class="form-select form-select-sm d-inline w-auto">
              <option>All</option>
              <option>Regular email</option>
              <option>Automation</option>
            </select>
          </div>
          <div>Status:
            <select class="form-select form-select-sm d-inline w-auto">
              <option>All</option>
              <option>Draft</option>
              <option>Sent</option>
            </select>
          </div>
          <div>Folder:
            <select class="form-select form-select-sm d-inline w-auto">
              <option>All</option>
            </select>
          </div>
          <div>Date:
            <select class="form-select form-select-sm d-inline w-auto">
              <option>All</option>
              <option>This week</option>
              <option>This month</option>
            </select>
          </div>
        </div>

        <table class="table align-middle">
          <thead>
            <tr>
              <th><input type="checkbox"></th>
              <th>Name</th>
              <th>Status</th>
              <th>Audience</th>
              <th>Analytics</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="checkbox"></td>
              <td>
                <div class="fw-semibold text-primary">Untitled</div>
                <div class="text-muted small">Regular email</div>
                <div class="text-muted small">Last edited Thu, Oct 16, 03:07 AM by Justine Cane Bacurin</div>
              </td>
              <td><span class="badge bg-light text-dark border">Draft</span></td>
              <td><a href="#" class="text-decoration-none">Jaycee</a></td>
              <td>-</td>
              <td class="text-end">
                <div class="dropdown">
                  <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Edit</button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Edit campaign</a></li>
                    <li><a class="dropdown-item" href="#">Duplicate</a></li>
                    <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                  </ul>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- CALENDAR VIEW -->
      <div id="calendar-content" style="display: none;">
        <div class="mb-3 d-flex flex-wrap gap-3 align-items-center">
          <div>Type:
            <select id="filter-type" class="form-select form-select-sm d-inline w-auto">
              <option value="all">All</option>
              <option value="regular">Regular email</option>
              <option value="automation">Automation</option>
            </select>
          </div>
          <div>Status:
            <select id="filter-status" class="form-select form-select-sm d-inline w-auto">
              <option value="all">All</option>
              <option value="draft">Draft</option>
              <option value="sent">Sent</option>
            </select>
          </div>
          <div>Holiday:
            <select id="filter-holiday" class="form-select form-select-sm d-inline w-auto">
              <option value="none">None</option>
              <option value="us">US Holidays</option>
            </select>
          </div>
          <div class="ms-auto d-flex align-items-center gap-2">
            <label class="small mb-0">Send day optimization</label>
            <div class="form-check form-switch mb-0">
              <input class="form-check-input" type="checkbox" checked>
            </div>
          </div>
        </div>

        <div id="calendar" style="min-height: 600px; width: 100%; background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 0.375rem;"></div>
      </div>
    </section>
  </div>

  <!-- FullCalendar -->
  <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.css" rel="stylesheet"/>
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/main.min.js"></script>
  
  <style>
    /* Ensure calendar container is visible */
    #calendar {
      width: 100%;
      min-height: 600px;
    }
    
    /* Fix potential Bootstrap conflicts */
    .fc {
      font-family: inherit;
    }
    
    .fc-toolbar {
      margin-bottom: 1rem;
    }
    
    /* Ensure calendar events are visible */
    .fc-event {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 2px 4px;
      font-size: 0.85em;
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const listTab = document.getElementById('list-tab');
      const calTab = document.getElementById('calendar-tab');
      const listContent = document.getElementById('list-content');
      const calContent = document.getElementById('calendar-content');
      const calendarEl = document.getElementById('calendar');

      let calendarInitialized = false;
      let calendar;

      // Check if FullCalendar is loaded
      function checkFullCalendar() {
        if (typeof FullCalendar === 'undefined') {
          console.error('FullCalendar library not loaded');
          return false;
        }
        return true;
      }

      // toggle between tabs
      listTab.addEventListener('click', e => {
        e.preventDefault();
        listTab.classList.add('active');
        calTab.classList.remove('active');
        listContent.style.display = 'block';
        calContent.style.display = 'none';
      });

      calTab.addEventListener('click', e => {
        e.preventDefault();
        calTab.classList.add('active');
        listTab.classList.remove('active');
        listContent.style.display = 'none';
        calContent.style.display = 'block';

        console.log('Calendar tab clicked');
        console.log('Calendar element:', calendarEl);
        console.log('FullCalendar available:', typeof FullCalendar);

        // Check if FullCalendar is loaded before proceeding
        if (!checkFullCalendar()) {
          console.error('FullCalendar library not available');
          return;
        }

        // render calendar only once
        if (!calendarInitialized) {
          try {
            console.log('Initializing calendar...');
            calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              height: 600,
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
              },
              events: [
                { title: 'Untitled', start: '2025-10-16', type: 'regular', status: 'draft' },
                { title: 'Campaign A', start: '2025-10-19', type: 'regular', status: 'sent' },
                { title: 'Campaign B', start: '2025-10-20', type: 'automation', status: 'draft' },
                { title: 'Campaign C', start: '2025-10-21', type: 'regular', status: 'sent' },
                { title: 'Campaign D', start: '2025-10-22', type: 'regular', status: 'sent' },
                { title: 'Campaign E', start: '2025-10-23', type: 'automation', status: 'draft' },
                { title: 'Campaign F', start: '2025-10-24', type: 'regular', status: 'sent' },
              ],
              eventDidMount: function(info) {
                info.el.classList.add('border', 'rounded', 'p-1', 'bg-light');
                if (info.event.extendedProps.status === 'draft') {
                  info.el.classList.add('border-warning');
                } else if (info.event.extendedProps.status === 'sent') {
                  info.el.classList.add('border-success');
                }
              }
            });
            console.log('Calendar created, rendering...');
            calendar.render();
            console.log('Calendar rendered successfully');
            calendarInitialized = true;
          } catch (error) {
            console.error('Error initializing calendar:', error);
          }
        } else {
          console.log('Calendar already initialized');
        }
      });

      // filtering logic
      function applyFilters() {
        if (!calendarInitialized) return;

        const type = document.getElementById('filter-type').value;
        const status = document.getElementById('filter-status').value;
        const holiday = document.getElementById('filter-holiday').value;

        const allEvents = [
          { title: 'Untitled', start: '2025-10-16', type: 'regular', status: 'draft' },
          { title: 'Campaign A', start: '2025-10-19', type: 'regular', status: 'sent' },
          { title: 'Campaign B', start: '2025-10-20', type: 'automation', status: 'draft' },
          { title: 'Campaign C', start: '2025-10-21', type: 'regular', status: 'sent' },
          { title: 'Campaign D', start: '2025-10-22', type: 'regular', status: 'sent' },
          { title: 'Campaign E', start: '2025-10-23', type: 'automation', status: 'draft' },
          { title: 'Campaign F', start: '2025-10-24', type: 'regular', status: 'sent' },
        ];

        let filtered = allEvents.filter(e =>
          (type === 'all' || e.type === type) &&
          (status === 'all' || e.status === status)
        );

        calendar.removeAllEvents();
        calendar.addEventSource(filtered);

        if (holiday === 'us') {
          calendar.addEventSource([{ title: 'US Holiday', start: '2025-10-14', color: '#dc3545' }]);
        }
      }

      document.getElementById('filter-type').addEventListener('change', applyFilters);
      document.getElementById('filter-status').addEventListener('change', applyFilters);
      document.getElementById('filter-holiday').addEventListener('change', applyFilters);
    });
  </script>
</x-layouts.app>
