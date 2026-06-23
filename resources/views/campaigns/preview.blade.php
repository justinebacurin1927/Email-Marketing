<x-layouts.app>

<div class="px-4 py-4 mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h4 fw-bold mb-1" style="color: #1a1a2e;">Email Preview</h1>
      <p class="text-secondary small mb-0">{{ $campaign->name }}</p>
    </div>
    <div class="d-flex gap-2">
      <form action="{{ route('campaigns.send', $campaign->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn" style="background-color: #e94560; color: white;">Send Now</button>
      </form>
      <a href="{{ route('campaigns.edit', $campaign->id) }}" class="btn btn-outline-secondary">Edit</a>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-8">
      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0">
          <iframe srcdoc="{{ $campaign->template?->body ?? '<p style=\"padding:2rem;color:#999;\">No template body.</p>' }}" style="width:100%;height:500px;border:none;border-radius:12px;"></iframe>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 shadow-sm mb-3" style="border-radius: 12px;">
        <div class="card-body">
          <h6 class="fw-bold mb-2" style="color: #1a1a2e;">Details</h6>
          <table class="table table-sm">
            <tr><td class="text-secondary">Template</td><td>{{ $campaign->template?->name ?? '-' }}</td></tr>
            <tr><td class="text-secondary">Subject</td><td>{{ $campaign->template?->subject ?? $campaign->name }}</td></tr>
            <tr><td class="text-secondary">Status</td><td><span class="badge bg-{{ $campaign->status == 'sent' ? 'success' : ($campaign->status == 'scheduled' ? 'warning text-dark' : 'secondary') }}">{{ ucfirst($campaign->status) }}</span></td></tr>
            <tr><td class="text-secondary">Send Date</td><td>{{ $campaign->send_date ?? 'Immediate' }}</td></tr>
          </table>
        </div>
      </div>

      <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body">
          <h6 class="fw-bold mb-2" style="color: #1a1a2e;">Recipients ({{ $recipients->count() }})</h6>
          @if($recipients->isEmpty())
            <p class="text-secondary small mb-0">No recipients selected.</p>
          @else
            <ul class="list-unstyled mb-0 small">
              @foreach($recipients as $r)
                <li class="py-1 border-bottom">{{ $r->email }}</li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

</x-layouts.app>
