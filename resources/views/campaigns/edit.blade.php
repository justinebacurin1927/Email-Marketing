<x-layouts.app>

<div class="px-4 py-4 mt-5">
  <h1 class="h4 fw-bold mb-3">Edit Campaign</h1>

  <form action="{{ route('campaigns.update', $campaign->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="name" class="form-label">Campaign Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $campaign->name) }}" required>
    </div>

    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-select" id="type" name="type" required>
        <option value="regular" {{ $campaign->type == 'regular' ? 'selected' : '' }}>Regular</option>
        <option value="automation" {{ $campaign->type == 'automation' ? 'selected' : '' }}>Automation</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="template_id" class="form-label">Email Template</label>
      <select class="form-select" id="template_id" name="template_id" required>
        <option value="">Select Template</option>
        @foreach($templates as $template)
          <option value="{{ $template->id }}" {{ $campaign->template_id == $template->id ? 'selected' : '' }}>
            {{ $template->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Recipients — Contacts</label>
      <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
        @forelse($contacts as $contact)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact_{{ $contact->id }}"
              {{ $campaign->contacts->contains($contact->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="contact_{{ $contact->id }}">
              {{ $contact->email }} {{ $contact->first_name ? "($contact->first_name $contact->last_name)" : '' }}
            </label>
          </div>
        @empty
          <p class="text-secondary small mb-0">No contacts available.</p>
        @endforelse
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Recipients — Tags</label>
      <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
        @forelse($tags as $tag)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
              {{ $campaign->tags->contains($tag->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="tag_{{ $tag->id }}">
              {{ $tag->name }} <span class="text-secondary">({{ $tag->contacts->count() }} contacts)</span>
            </label>
          </div>
        @empty
          <p class="text-secondary small mb-0">No tags available.</p>
        @endforelse
      </div>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select class="form-select" id="status" name="status" required>
        <option value="draft" {{ $campaign->status == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="scheduled" {{ $campaign->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
        <option value="sent" {{ $campaign->status == 'sent' ? 'selected' : '' }}>Sent</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="send_date" class="form-label">Send Date</label>
      <input type="date" class="form-control" id="send_date" name="send_date" value="{{ old('send_date', $campaign->send_date) }}">
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Update Campaign</button>
      <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>

</x-layouts.app>
