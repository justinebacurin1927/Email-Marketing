<x-layouts.app>

<div class="px-4 px-xl-5 py-4" style="margin-top: 3.5rem; max-width: 1400px;">
  <a href="{{ route('campaigns.index') }}" class="d-inline-flex align-items-center gap-1 text-decoration-none mb-3" style="color: #e94560; font-size: 0.85rem;">
    <i class="bi bi-arrow-left"></i> Back to campaigns
  </a>

  <h1 class="fw-bold mb-1" style="font-size: 1.5rem; color: #1a1a2e;">Create Campaign</h1>
  <p class="text-secondary mb-4" style="font-size: 0.85rem;">Set up a new email campaign for your audience.</p>

  <hr class="mb-4">

  @if ($errors->any())
    <div class="alert alert-danger py-2 small">
      <i class="bi bi-exclamation-triangle me-1"></i> Please fix the errors below.
    </div>
  @endif

  <form action="{{ route('campaigns.store') }}" method="POST" class="bg-white rounded p-4 p-xl-5 shadow-sm" style="border: 1px solid #e9ecef;">
    @csrf

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Campaign Info</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">Name your campaign and choose your email template.</p>

    <div class="mb-3">
      <label for="name" class="form-label fw-semibold" style="font-size: 0.9rem;">Campaign Name <span class="text-danger">*</span></label>
      <input type="text" name="name" id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') }}" required placeholder="e.g. March Newsletter"
        style="max-width: 480px;">
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label for="template_id" class="form-label fw-semibold" style="font-size: 0.9rem;">Email Template <span class="text-danger">*</span></label>
      <select name="template_id" id="template_id"
        class="form-select @error('template_id') is-invalid @enderror" required
        style="max-width: 480px;">
        <option value="">Select Template</option>
        @foreach($templates as $template)
          <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>
            {{ $template->name }}
          </option>
        @endforeach
      </select>
      @error('template_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Recipients</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">Choose who will receive this campaign. You can select individual contacts and/or entire tag groups.</p>

    <div class="row g-3 mb-3">
      <div class="col-md-6">
        <label class="form-label fw-semibold" style="font-size: 0.9rem;">Contacts</label>
        <div class="border rounded p-3" style="max-height: 220px; overflow-y: auto; background: #f8f9fb;">
          @forelse($contacts as $contact)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="contact_ids[]" value="{{ $contact->id }}" id="contact_{{ $contact->id }}"
                {{ in_array($contact->id, old('contact_ids', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="contact_{{ $contact->id }}" style="font-size: 0.85rem;">
                {{ $contact->email }}
                @if($contact->first_name)
                  <span class="text-secondary">({{ $contact->first_name }} {{ $contact->last_name }})</span>
                @endif
              </label>
            </div>
          @empty
            <p class="text-secondary small mb-0">No contacts available.</p>
          @endforelse
        </div>
      </div>

      <div class="col-md-6">
        <label class="form-label fw-semibold" style="font-size: 0.9rem;">Tags</label>
        <div class="border rounded p-3" style="max-height: 220px; overflow-y: auto; background: #f8f9fb;">
          @forelse($tags as $tag)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="tag_ids[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}"
                {{ in_array($tag->id, old('tag_ids', [])) ? 'checked' : '' }}>
              <label class="form-check-label" for="tag_{{ $tag->id }}" style="font-size: 0.85rem;">
                {{ $tag->name }}
                <span class="text-secondary">({{ $tag->contacts->count() }} contacts)</span>
              </label>
            </div>
          @empty
            <p class="text-secondary small mb-0">No tags available.</p>
          @endforelse
        </div>
      </div>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Schedule & Status</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">Set the send date or save as draft to send later.</p>

    <div class="row g-3 mb-4">
      <div class="col-md-6">
        <label for="send_date" class="form-label fw-semibold" style="font-size: 0.9rem;">Send Date</label>
        <input type="date" name="send_date" id="send_date"
          class="form-control @error('send_date') is-invalid @enderror"
          value="{{ old('send_date') }}">
        @error('send_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="col-md-6">
        <label for="status" class="form-label fw-semibold" style="font-size: 0.9rem;">Status <span class="text-danger">*</span></label>
        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
          <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
          <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn d-flex align-items-center gap-1 px-4" style="background: #2d6a4f; color: #fff;">
        <i class="bi bi-check-lg"></i> Save Campaign
      </button>
      <a href="{{ route('campaigns.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
    </div>
  </form>
</div>

</x-layouts.app>
