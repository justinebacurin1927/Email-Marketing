<x-layouts.app>

@php
  $totalContacts = \App\Models\Contact::count();
  $totalSubscribers = \App\Models\Contact::where('subscribed', true)->count();
  $totalCampaigns = \App\Models\Campaign::count();
  $totalTemplates = \App\Models\MessageTemplate::count();
  $sentCampaigns = \App\Models\Campaign::where('status', 'sent')->count();
  $draftCampaigns = \App\Models\Campaign::where('status', 'draft')->count();
  $scheduledCampaigns = \App\Models\Campaign::where('status', 'scheduled')->count();
  $recentCampaigns = \App\Models\Campaign::with('contact')->orderBy('created_at', 'desc')->take(5)->get();
  $tags = \App\Models\Tag::withCount('contacts')->get();
  $greeting = now()->format('a') == 'am' ? 'Morning' : 'Afternoon';
  $userName = auth()->user()->name ?? 'Admin';
@endphp

<div class="d-flex flex-column" style="height: calc(100vh - 4rem); overflow: hidden; padding: 1.5rem 2rem; gap: 0.75rem;">

  {{-- Header: Greeting + Quick Actions --}}
  <div class="d-flex justify-content-between align-items-start flex-shrink-0">
    <div>
      <h1 class="h3 fw-bold" style="color: #1a1a2e;">Good {{ $greeting }}, {{ $userName }} 👋</h1>
      <p class="text-secondary mb-0">Here's what's happening with your campaigns today.</p>
    </div>
    <div class="d-flex flex-nowrap gap-2">
      <a href="/add-contact" class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none" style="background: rgba(26, 26, 46, 0.08);">
        <span style="font-size: 1.3rem;">➕</span>
        <span class="fw-semibold" style="color: #1a1a2e; font-size: 0.8rem; white-space: nowrap;">Add Contact</span>
      </a>
      <a href="/import-contacts" class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none" style="background: rgba(233, 69, 96, 0.08);">
        <span style="font-size: 1.3rem;">📥</span>
        <span class="fw-semibold" style="color: #e94560; font-size: 0.8rem; white-space: nowrap;">Import</span>
      </a>
      <a href="/campaigns/create" class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none" style="background: rgba(83, 52, 131, 0.08);">
        <span style="font-size: 1.3rem;">📨</span>
        <span class="fw-semibold" style="color: #533483; font-size: 0.8rem; white-space: nowrap;">Campaign</span>
      </a>
      <a href="/template-form" class="d-flex align-items-center gap-2 px-3 py-2 rounded text-decoration-none" style="background: rgba(15, 52, 96, 0.08);">
        <span style="font-size: 1.3rem;">📄</span>
        <span class="fw-semibold" style="color: #0f3460; font-size: 0.8rem; white-space: nowrap;">Template</span>
      </a>
    </div>
  </div>

  {{-- 4 Stat cards --}}
  <div class="row g-3 flex-shrink-0">
    <div class="col-md-3">
      <div class="card border-0" style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); border-radius: 12px;">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="small mb-1 text-white fw-semibold">Total Contacts</p>
              <h3 class="fw-bold mb-0 text-white">{{ $totalContacts }}</h3>
            </div>
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(255,255,255,0.1);">
              <span style="font-size: 1.3rem;">👥</span>
            </div>
          </div>
          <small class="mt-2 d-block text-white fw-semibold">{{ $totalSubscribers }} subscribed</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0" style="background: linear-gradient(135deg, #e94560 0%, #c23152 100%); border-radius: 12px;">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="small mb-1 text-white fw-semibold">Subscribers</p>
              <h3 class="fw-bold mb-0 text-white">{{ $totalSubscribers }}</h3>
            </div>
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(255,255,255,0.15);">
              <span style="font-size: 1.3rem;">📧</span>
            </div>
          </div>
          <small class="mt-2 d-block text-white fw-semibold">{{ $totalContacts > 0 ? round(($totalSubscribers / $totalContacts) * 100) : 0 }}% subscription rate</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0" style="background: linear-gradient(135deg, #533483 0%, #3b2261 100%); border-radius: 12px;">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="small mb-1 text-white fw-semibold">Campaigns</p>
              <h3 class="fw-bold mb-0 text-white">{{ $totalCampaigns }}</h3>
            </div>
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(255,255,255,0.15);">
              <span style="font-size: 1.3rem;">📨</span>
            </div>
          </div>
          <small class="mt-2 d-block text-white fw-semibold">{{ $sentCampaigns }} sent, {{ $scheduledCampaigns }} scheduled</small>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card border-0" style="background: linear-gradient(135deg, #0f3460 0%, #0a2540 100%); border-radius: 12px;">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="small mb-1 text-white fw-semibold">Templates</p>
              <h3 class="fw-bold mb-0 text-white">{{ $totalTemplates }}</h3>
            </div>
            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background-color: rgba(255,255,255,0.15);">
              <span style="font-size: 1.3rem;">📄</span>
            </div>
          </div>
          <small class="mt-2 d-block text-white fw-semibold">Ready to use in campaigns</small>
        </div>
      </div>
    </div>
  </div>

  {{-- Charts row --}}
  <div class="row g-3 flex-fill" style="min-height: 0;">
    <div class="col-md-6 d-flex flex-column" style="min-height: 0;">
      <div class="card border-0 shadow-sm flex-fill" style="border-radius: 12px; min-height: 0;">
        <div class="card-body d-flex flex-column" style="min-height: 0;">
          <h5 class="fw-bold mb-2 flex-shrink-0" style="color: #1a1a2e;">Campaign Analytics</h5>
          <div class="flex-fill d-flex align-items-center justify-content-center" style="min-height: 0;">
            <canvas id="campaignChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 d-flex flex-column" style="min-height: 0;">
      <div class="card border-0 shadow-sm flex-fill" style="border-radius: 12px; min-height: 0;">
        <div class="card-body d-flex flex-column" style="min-height: 0;">
          <h5 class="fw-bold mb-2 flex-shrink-0" style="color: #1a1a2e;">Campaign Status</h5>
          <div class="flex-fill d-flex align-items-center justify-content-center" style="min-height: 0;">
            <div style="max-width: 220px; width: 100%;">
              <canvas id="statusChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Tags + Recent Campaigns --}}
  <div class="row g-3 flex-shrink-0" style="height: 160px;">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-center flex-shrink-0 mb-2">
            <h5 class="fw-bold mb-0" style="color: #1a1a2e;">Tags Breakdown</h5>
            <a href="{{ route('audience-tags') }}" class="small text-decoration-none fw-semibold" style="color: #e94560;">See more &rarr;</a>
          </div>
          @php $colors = ['#e94560', '#0f3460', '#1a1a2e', '#533483', '#16213e']; @endphp
          @if($tags->isEmpty())
            <p class="text-secondary small mb-0">No tags created yet. <a href="{{ route('audience-tags') }}" style="color: #e94560;">Create your first tag</a></p>
          @else
            <div class="overflow-auto" style="min-height: 0;">
              @foreach($tags->sortByDesc('contacts_count') as $index => $tag)
                <div class="d-flex justify-content-between align-items-center py-1">
                  <div class="d-flex align-items-center gap-2">
                    <span style="width: 12px; height: 12px; background: {{ $colors[$index % count($colors)] }}; border-radius: 3px; display: inline-block;"></span>
                    <span class="fw-semibold" style="color: #1a1a2e; font-size: 0.85rem;">{{ $tag->name }}</span>
                  </div>
                  <span class="fw-bold" style="color: #e94560; font-size: 0.85rem;">{{ $tag->contacts_count }} contacts</span>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
        <div class="card-body d-flex flex-column">
          <div class="d-flex justify-content-between align-items-center flex-shrink-0 mb-2">
            <h5 class="fw-bold mb-0" style="color: #1a1a2e;">Recent Campaigns</h5>
            <a href="/campaigns" class="small text-decoration-none fw-semibold" style="color: #e94560;">See more &rarr;</a>
          </div>
          @if($recentCampaigns->isEmpty())
            <p class="text-secondary small mb-0">No campaigns yet. <a href="{{ route('campaigns.create') }}" style="color: #e94560;">Create your first campaign</a></p>
          @else
            <div class="list-group list-group-flush overflow-auto" style="min-height: 0;">
              @foreach($recentCampaigns as $c)
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center border-0 py-1">
                  <div>
                    <span class="fw-semibold" style="color: #1a1a2e;">{{ $c->name }}</span>
                    <br><small class="text-secondary">{{ $c->contact->email ?? 'No recipient' }}</small>
                  </div>
                  <span class="badge rounded-pill px-3 {{ $c->status == 'sent' ? 'bg-success' : ($c->status == 'scheduled' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                    {{ ucfirst($c->status) }}
                  </span>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    new Chart(document.getElementById('campaignChart'), {
      type: 'bar',
      data: {
        labels: ['Sent', 'Draft', 'Scheduled'],
        datasets: [{
          data: [{{ $sentCampaigns }}, {{ $draftCampaigns }}, {{ $scheduledCampaigns }}],
          backgroundColor: ['#1a1a2e', '#e94560', '#533483'],
          borderRadius: 6,
          barThickness: 40,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: { legend: { display: false } },
        scales: {
          y: { beginAtZero: true, ticks: { stepSize: 1 } },
          x: { grid: { display: false } }
        }
      }
    });

    new Chart(document.getElementById('statusChart'), {
      type: 'doughnut',
      data: {
        labels: ['Sent', 'Draft', 'Scheduled'],
        datasets: [{
          data: [{{ $sentCampaigns }}, {{ $draftCampaigns }}, {{ $scheduledCampaigns }}],
          backgroundColor: ['#1a1a2e', '#e94560', '#533483'],
          borderWidth: 0,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: { position: 'bottom', labels: { usePointStyle: true, padding: 8, boxWidth: 10, font: { size: 12 } } }
        },
        cutout: '75%',
      }
    });
  });
</script>

<style>
  .list-group-item:not(:last-child) { border-bottom: 1px solid rgba(0,0,0,0.05) !important; }
</style>

</x-layouts.app>
