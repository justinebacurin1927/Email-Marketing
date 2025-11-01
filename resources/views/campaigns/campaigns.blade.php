<x-layouts.app>
  <x-topbar />

  <div class="px-4 py-4 mt-5">
    <!-- HEADER -->
<header class="d-flex justify-content-between align-items-center mb-4 sticky-section">
  <div>
    <h1 class="h4 fw-bold text-dark mb-1">All campaigns</h1>
    <p class="text-secondary small mb-0">Manage and track your email campaigns</p>
  </div>
  <div class="d-flex align-items-center gap-2">
    <a href="{{ route('campaigns.index') }}" class="btn btn-outline-secondary">View analytics</a>
    <a href="{{ route('campaigns.create') }}" class="btn btn-primary">Create</a>
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
    <input id="campaign-search" type="text" class="form-control" placeholder="Search campaigns" style="max-width: 400px;">
    <div class="text-muted small">Sort by: 
        <a href="#" class="text-decoration-none sort-link" data-sort="updated" data-order="desc">Date edited</a>
        | <a href="#" class="text-decoration-none sort-link" data-sort="name" data-order="asc">Name</a>
    </div>

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
              <!-- Top checkbox in table header -->
              <th><input type="checkbox" id="select-all"></th>
              <th>Name</th>
              <th>Status</th>
              <th>Audience</th>
              <th>Analytics</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
<tbody>
@foreach($campaigns as $campaign)
<tr id="campaign-row-{{ $campaign->id }}" 
    data-name="{{ strtolower($campaign->name) }}" 
    data-status="{{ $campaign->status }}" 
    data-updated="{{ $campaign->updated_at }}">
    <td><input type="checkbox"></td>
    <td>
        <div class="fw-semibold text-primary">{{ $campaign->name }}</div>
        <div class="text-muted small">{{ ucfirst($campaign->type) ?? 'Regular email' }}</div>
        <div class="text-muted small">Last edited {{ $campaign->updated_at->format('D, M d, h:i A') }} by {{ $campaign->created_by ?? 'Admin' }}</div>
    </td>
<td>
    @if($campaign->status == 'draft')
        <span class="badge bg-light text-dark border">Draft</span>
    @elseif($campaign->status == 'sent')
        <span class="badge bg-success">Sent</span>
    @elseif($campaign->status == 'scheduled')
        <span class="badge bg-warning text-dark border">Scheduled</span>
    @endif
</td>
    <td><a href="#" class="text-decoration-none">{{ $campaign->contact->email ?? '-' }}</a></td>
    <td>{{ $campaign->analytics ?? '-' }}</td>
    <td class="text-end">
        <div class="dropdown">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">Edit</button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('campaigns.view-email', $campaign->id) }}">View Email</a></li>
                <li><a class="dropdown-item" href="{{ route('campaigns.edit', $campaign->id) }}">Edit campaign</a></li>
                <li><a class="dropdown-item duplicate-campaign" href="#" data-id="{{ $campaign->id }}">Duplicate</a></li>
                <li><a class="dropdown-item text-danger delete-campaign" href="#" data-id="{{ $campaign->id }}">Delete</a></li>
            </ul>
        </div>
    </td>
</tr>
@endforeach
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
  .sticky-section {
    position: sticky;
    top: 70px;
    background-color: #ffffff;
    z-index: 100;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
  }
  section.bg-white {
    margin-top: 0;
  }
  #calendar {
    width: 100%;
    min-height: 600px;
  }
  .fc {
    font-family: inherit;
  }
  .fc-toolbar {
    margin-bottom: 1rem;
  }
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

      function checkFullCalendar() {
        if (typeof FullCalendar === 'undefined') {
          console.error('FullCalendar library not loaded');
          return false;
        }
        return true;
      }

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

        if (!checkFullCalendar()) return;

        if (!calendarInitialized) {
          try {
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
            calendar.render();
            calendarInitialized = true;
          } catch (error) {
            console.error('Error initializing calendar:', error);
          }
        }
      });

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

      // --------------------------
      // Delete Function
      // --------------------------
      document.querySelectorAll('.delete-campaign').forEach(btn => {
        btn.addEventListener('click', async e => {
          e.preventDefault();
          const id = btn.dataset.id;
          if (!confirm('Delete this campaign?')) return;

          try {
            const response = await fetch(`/campaigns/${id}`, {
              method: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
              }
            });

            if (response.ok) {
              document.getElementById(`campaign-row-${id}`).remove();
              alert('Campaign deleted successfully.');
            } else {
              alert('Failed to delete campaign.');
            }
          } catch (error) {
            console.error('Error deleting campaign:', error);
            alert('Error deleting campaign.');
          }
        });
      });
    });

    // --------------------------
    // Search Function
    // --------------------------
    document.getElementById('campaign-search').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('#list-content tbody tr').forEach(row => {
            const name = row.dataset.name;
            const status = row.dataset.status;
            if (name.includes(query) || status.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // --------------------------
    // Checkbox Select All
    // --------------------------
    const selectAllCheckbox = document.getElementById('select-all');
    const rowCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

    selectAllCheckbox.addEventListener('change', () => {
      rowCheckboxes.forEach(cb => cb.checked = selectAllCheckbox.checked);
    });

    rowCheckboxes.forEach(cb => {
      cb.addEventListener('change', () => {
        if (!cb.checked) {
          selectAllCheckbox.checked = false;
        } else {
          // If all checkboxes are checked, check "select all"
          const allChecked = Array.from(rowCheckboxes).every(c => c.checked);
          selectAllCheckbox.checked = allChecked;
        }
      });
    });


    // --------------------------
    // Sorting Function
    // --------------------------
    document.querySelectorAll('.sort-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const sortField = this.dataset.sort;
            const sortOrder = this.dataset.order; // 'asc' or 'desc'

            const tbody = document.querySelector('#list-content tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));

            rows.sort((a, b) => {
                let aVal = a.dataset[sortField];
                let bVal = b.dataset[sortField];

                // for dates, convert to timestamp
                if (sortField === 'updated') {
                    aVal = new Date(aVal).getTime();
                    bVal = new Date(bVal).getTime();
                }

                if (aVal < bVal) return sortOrder === 'asc' ? -1 : 1;
                if (aVal > bVal) return sortOrder === 'asc' ? 1 : -1;
                return 0;
            });

            // re-append sorted rows
            rows.forEach(r => tbody.appendChild(r));

            // toggle order for next click
            this.dataset.order = sortOrder === 'asc' ? 'desc' : 'asc';
        });
    });

    // --------------------------
    // Dupicate Function
    // --------------------------

    document.querySelectorAll('.duplicate-campaign').forEach(btn => {
  btn.addEventListener('click', async e => {
    e.preventDefault();
    const id = btn.dataset.id;
    if (!confirm('Duplicate this campaign?')) return;

    try {
      const response = await fetch(`/campaigns/${id}/duplicate`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        }
      });

      const data = await response.json();

      if (response.ok) {
        alert('Campaign duplicated successfully.');
        location.reload();
      } else {
        alert('Failed to duplicate campaign: ' + (data.error ?? 'Unknown error'));
        console.error('Duplicate error:', data);
      }
    } catch (error) {
      console.error('Error duplicating campaign:', error);
      alert('Error duplicating campaign. Check console.');
    }
  });
});


  </script>
</x-layouts.app>
