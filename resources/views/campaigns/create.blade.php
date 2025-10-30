<x-layouts.app>
  <x-topbar />

  <div class="px-4 py-4 mt-5">
    <h1 class="h4 fw-bold mb-3">Create Campaign</h1>

    <form action="{{ route('campaigns.store') }}" method="POST">
      @csrf

      <!-- Campaign Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Campaign Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>

<!-- Email Template -->
<div class="mb-3">
  <label for="template_id" class="form-label">Email Template</label>
  <select class="form-select" id="template_id" name="template_id" required>
      <option value="">Select Template</option>
      @foreach($templates as $template)
          <option value="{{ $template->id }}">{{ $template->name }}</option>
      @endforeach
  </select>
</div>

<!-- Recipient / Contact -->
<div class="mb-3">
  <label for="contact_id" class="form-label">Recipient</label>
  <select class="form-select" id="contact_id" name="contact_id" required>
      <option value="">Select Contact</option>
      @foreach($contacts as $contact)
<option value="{{ $contact->id }}">
  {{ $contact->name ?? $contact->email ?? 'Unnamed Contact' }}
</option>
      @endforeach
  </select>
</div>

      <!-- Send Date -->
      <div class="mb-3">
        <label for="send_date" class="form-label">Send Date</label>
        <input type="date" class="form-control" id="send_date" name="send_date">
      </div>

      <!-- Status -->
      <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
          <option value="draft">Draft</option>
          <option value="scheduled">Scheduled</option>
        </select>
      </div>

      <!-- Form Buttons -->
      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Save Campaign</button>
        <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
    </form>
  </div>
</x-layouts.app>
