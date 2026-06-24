<x-layouts.app>

<div class="px-4 py-4 mt-5" style="max-width: 800px;">
  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <h4 class="fw-bold mb-4">Create Campaign</h4>

      <form action="{{ route('campaigns.store') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label fw-semibold">Campaign Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter campaign name" required>
        </div>

        <div class="mb-3">
          <label for="template_id" class="form-label fw-semibold">Email Template</label>
          <select class="form-select" id="template_id" name="template_id" required>
            <option value="">Select Template</option>
            @foreach($templates as $template)
              <option value="{{ $template->id }}">{{ $template->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">Recipients — Contacts</label>
            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto; background: #f8f9fa;">
              @forelse($contacts as $contact)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact_{{ $contact->id }}">
                  <label class="form-check-label" for="contact_{{ $contact->id }}">
                    {{ $contact->email }}
                    @if($contact->first_name)
                      <span class="text-secondary small">({{ $contact->first_name }} {{ $contact->last_name }})</span>
                    @endif
                  </label>
                </div>
              @empty
                <p class="text-secondary small mb-0">No contacts available.</p>
              @endforelse
            </div>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Recipients — Tags</label>
            <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto; background: #f8f9fa;">
              @forelse($tags as $tag)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                  <label class="form-check-label" for="tag_{{ $tag->id }}">
                    {{ $tag->name }}
                    <span class="text-secondary small">({{ $tag->contacts->count() }} contacts)</span>
                  </label>
                </div>
              @empty
                <p class="text-secondary small mb-0">No tags available.</p>
              @endforelse
            </div>
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label for="send_date" class="form-label fw-semibold">Send Date</label>
            <input type="date" class="form-control" id="send_date" name="send_date">
          </div>

          <div class="col-md-6">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select class="form-select" id="status" name="status" required>
              <option value="draft">Draft</option>
              <option value="scheduled">Scheduled</option>
            </select>
          </div>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn d-flex align-items-center gap-1" style="background: #2d6a4f; color: #fff;">
            <i class="bi bi-check-lg"></i> Save Campaign
          </button>
          <a href="{{ route('campaigns.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>

</x-layouts.app>
