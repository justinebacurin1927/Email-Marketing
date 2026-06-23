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
  $greeting = now()->format('a') == 'am' ? 'Morning' : 'Afternoon';
  $userName = auth()->user()->name ?? 'Admin';
@endphp

<div class="px-4 py-4" style="margin-top: 4rem;">
  <div class="mb-4">
    <h1 class="h3 fw-bold" style="color: #1a1a2e;">Good {{ $greeting }}, {{ $userName }} 👋</h1>
    <p class="text-secondary">Here's what's happening with your campaigns today.</p>
  </div>

  <div class="row g-4 mb-4">
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

  <div class="row g-4 mb-4">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
          <h5 class="fw-bold mb-2" style="color: #1a1a2e;">Campaign Analytics</h5>
          <canvas id="campaignChart" height="120"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body d-flex flex-column">
          <h5 class="fw-bold mb-2" style="color: #1a1a2e;">Campaign Status</h5>
          <div class="flex-grow-1 d-flex align-items-center justify-content-center">
            <div style="max-width: 220px; width: 100%;">
              <canvas id="statusChart"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-5">
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
          <h5 class="fw-bold mb-3" style="color: #1a1a2e;">Quick Actions</h5>
          <div class="row g-3">
            <div class="col-6">
              <a href="/add-contact" class="quick-action-card d-flex flex-column align-items-center justify-content-center p-3 rounded text-decoration-none" style="background: rgba(26, 26, 46, 0.08); transition: all 0.3s; min-height: 100px;">
                <span style="font-size: 1.8rem; transition: transform 0.3s;">➕</span>
                <span class="small mt-2 fw-semibold" style="color: #1a1a2e;">Add Contact</span>
              </a>
            </div>
            <div class="col-6">
              <a href="/import-contacts" class="quick-action-card d-flex flex-column align-items-center justify-content-center p-3 rounded text-decoration-none" style="background: rgba(233, 69, 96, 0.08); transition: all 0.3s; min-height: 100px;">
                <span style="font-size: 1.8rem; transition: transform 0.3s;">📥</span>
                <span class="small mt-2 fw-semibold" style="color: #e94560;">Import</span>
              </a>
            </div>
            <div class="col-6">
              <a href="/campaigns/create" class="quick-action-card d-flex flex-column align-items-center justify-content-center p-3 rounded text-decoration-none" style="background: rgba(83, 52, 131, 0.08); transition: all 0.3s; min-height: 100px;">
                <span style="font-size: 1.8rem; transition: transform 0.3s;">📨</span>
                <span class="small mt-2 fw-semibold" style="color: #533483;">Campaign</span>
              </a>
            </div>
            <div class="col-6">
              <a href="/template-form" class="quick-action-card d-flex flex-column align-items-center justify-content-center p-3 rounded text-decoration-none" style="background: rgba(15, 52, 96, 0.08); transition: all 0.3s; min-height: 100px;">
                <span style="font-size: 1.8rem; transition: transform 0.3s;">📄</span>
                <span class="small mt-2 fw-semibold" style="color: #0f3460;">Template</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0" style="color: #1a1a2e;">Recent Campaigns</h5>
            <a href="/campaigns" class="small text-decoration-none" style="color: #e94560;">View all &rarr;</a>
          </div>
          @if($recentCampaigns->isEmpty())
            <p class="text-secondary small mb-0">No campaigns yet. <a href="{{ route('campaigns.create') }}">Create your first campaign</a></p>
          @else
            <div class="list-group list-group-flush">
              @foreach($recentCampaigns as $c)
                <div class="list-group-item px-0 d-flex justify-content-between align-items-center">
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

  document.querySelectorAll('.quick-action-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-4px)';
      card.style.boxShadow = '0 8px 24px rgba(0,0,0,0.12)';
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
      card.style.boxShadow = 'none';
    });
  });
</script>

<style>
  .quick-action-card { cursor: pointer; }
</style>

</x-layouts.app>
