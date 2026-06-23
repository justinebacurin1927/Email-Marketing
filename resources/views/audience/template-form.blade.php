<x-layouts.app>

  <title>{{ isset($template) ? 'Edit' : 'Add' }} Message Template</title>

  <div class="px-4 py-4 mt-5">
    <a href="/message-temp" class="text-decoration-none mb-3 d-inline-block">&larr; Back to templates</a>

    <h1 class="h4 fw-bold mb-3">{{ isset($template) ? 'Edit' : 'Add' }} Message Template</h1>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <form action="{{ isset($template) ? route('templates.update', $template->id) : route('templates.store') }}" method="POST">
          @csrf
          @if(isset($template)) @method('PUT') @endif

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Template name" value="{{ old('name', $template->name ?? '') }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject', $template->subject ?? '') }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Body</label>
            <textarea name="body" class="form-control" rows="10" placeholder="Type your message here..." required>{{ old('body', $template->body ?? '') }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary">{{ isset($template) ? 'Update' : 'Save' }}</button>
          <a href="/message-temp" class="btn btn-outline-secondary ms-2">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</x-layouts.app>
