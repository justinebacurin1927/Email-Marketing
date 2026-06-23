<x-layouts.app>

<div class="px-4 py-4" style="margin-top: 4rem;">
  <header class="mb-4 d-flex justify-content-between align-items-center">
    <div>
      <h2 class="fw-bold">Audience Dashboard</h2>
      <p class="text-secondary small mb-0">Overview of your contacts and engagement</p>
    </div>
    <div class="d-flex gap-2">
      <a href="/add-contact" class="btn" style="background-color: #1a1a2e; color: white;">Add Contact</a>
      <a href="/import-contacts" class="btn btn-outline-secondary">Import</a>
    </div>
  </header>

  <div class="row g-4 mb-4">
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <p class="text-secondary small mb-1">Total Contacts</p>
          <h2 class="fw-bold" style="color: #1a1a2e;">{{ $totalContacts }}</h2>
          <a href="/audience" class="small text-decoration-none">View all &rarr;</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <p class="text-secondary small mb-1">Subscribed</p>
          <h2 class="fw-bold" style="color: #1a1a2e;">{{ $totalSubscribers }}</h2>
          <a href="/audience" class="small text-decoration-none">View all &rarr;</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <p class="text-secondary small mb-1">Tags</p>
          <h2 class="fw-bold" style="color: #1a1a2e;">{{ $tags->count() }}</h2>
          <a href="/audience/audience-tags" class="small text-decoration-none">Manage tags &rarr;</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Tags Breakdown</h5>
          @if($tags->isEmpty())
            <p class="text-secondary small">No tags created yet. <a href="/audience/audience-tags">Create your first tag</a></p>
          @else
            @php
              $colors = ['#e94560', '#0f3460', '#1a1a2e', '#533483', '#16213e'];
            @endphp
            @foreach($tags->sortByDesc('contacts_count') as $index => $tag)
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div class="d-flex align-items-center gap-2">
                  <span style="width: 12px; height: 12px; background: {{ $colors[$index % count($colors)] }}; border-radius: 3px; display: inline-block;"></span>
                  <span>{{ $tag->name }}</span>
                </div>
                <span class="fw-bold">{{ $tag->contacts_count }} contacts</span>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Recent Activity</h5>
          <p class="text-secondary small mb-0">
            Contact list is being built. 
            <a href="/import-contacts">Import contacts</a> or 
            <a href="/add-contact">add them manually</a> to get started.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

</x-layouts.app>
