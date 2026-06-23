<x-layouts.app>

<div class="px-4 py-4 mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h4 fw-bold mb-1" style="color: #1a1a2e;">Automations</h1>
      <p class="text-secondary small mb-0">Automated email workflows triggered by events</p>
    </div>
    <a href="{{ route('automations.create') }}" class="btn" style="background-color: #e94560; color: white;">
      + New Automation
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success border-0 alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if($automations->isEmpty())
    <div class="text-center py-5">
      <div class="mb-3" style="font-size: 3rem;">⚡</div>
      <h5 class="fw-bold" style="color: #1a1a2e;">No automations yet</h5>
      <p class="text-secondary small">Create your first automated workflow to send emails on autopilot.</p>
      <a href="{{ route('automations.create') }}" class="btn" style="background-color: #1a1a2e; color: white;">Create Automation</a>
    </div>
  @else
    <div class="row g-4">
      @foreach($automations as $automation)
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <h5 class="fw-bold mb-1" style="color: #1a1a2e;">{{ $automation->name }}</h5>
                  <span class="badge rounded-pill px-3 me-1 {{ $automation->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                    {{ ucfirst($automation->status) }}
                  </span>
                  <span class="badge rounded-pill px-3" style="background-color: #533483; color: white;">
                    {{ str_replace('_', ' ', $automation->trigger_type) }}
                  </span>
                </div>
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">⋯</button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('automations.edit', $automation->id) }}">Edit</a></li>
                    <li>
                      <form action="{{ route('automations.toggle', $automation->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">{{ $automation->status == 'active' ? 'Pause' : 'Activate' }}</button>
                      </form>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <form action="{{ route('automations.destroy', $automation->id) }}" method="POST" onsubmit="return confirm('Delete this automation?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>

              @if($automation->description)
                <p class="text-secondary small mb-3">{{ $automation->description }}</p>
              @endif

              @if($automation->steps->isNotEmpty())
                <div class="mt-3 pt-3 border-top">
                  <small class="text-secondary fw-semibold">Steps ({{ $automation->steps->count() }})</small>
                  <div class="mt-2">
                    @foreach($automation->steps as $step)
                      <div class="d-flex align-items-center gap-2 mb-1 small">
                        <span class="badge bg-light text-dark rounded-circle p-1" style="width: 20px; height: 20px; display: inline-flex; align-items: center; justify-content: center; font-size: 10px;">
                          {{ $loop->iteration }}
                        </span>
                        <span>Wait {{ $step->delay_days }}d →</span>
                        <span class="fw-semibold">{{ str_replace('_', ' ', $step->action_type) }}</span>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>

</x-layouts.app>
