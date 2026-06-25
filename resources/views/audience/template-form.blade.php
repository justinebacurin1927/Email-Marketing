<x-layouts.app>

@php $isEdit = isset($template); @endphp
<title>{{ $isEdit ? 'Edit' : 'Add' }} Message Template</title>

<div class="px-4 px-xl-5 py-4" style="margin-top: 3.5rem; max-width: 1400px;">
  <a href="{{ route('templates.index') }}" class="d-inline-flex align-items-center gap-1 text-decoration-none mb-3" style="color: #e94560; font-size: 0.85rem;">
    <i class="bi bi-arrow-left"></i> Back to templates
  </a>

  <h1 class="fw-bold mb-1" style="font-size: 1.5rem; color: #1a1a2e;">{{ $isEdit ? 'Edit' : 'Add' }} Message Template</h1>
  <p class="text-secondary mb-4" style="font-size: 0.85rem;">{{ $isEdit ? 'Update your email template.' : 'Create a new email template for your campaigns.' }}</p>

  <hr class="mb-4">

  @if ($errors->any())
    <div class="alert alert-danger py-2 small">
      <i class="bi bi-exclamation-triangle me-1"></i> Please fix the errors below.
    </div>
  @endif

  <form action="{{ $isEdit ? route('templates.update', $template->id) : route('templates.store') }}" method="POST"
    class="bg-white rounded p-4 p-xl-5 shadow-sm" style="border: 1px solid #e9ecef; max-width: 900px;">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Template Details</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">Name your template and set the email subject line.</p>

    <div class="mb-3">
      <label for="name" class="form-label fw-semibold" style="font-size: 0.9rem;">Template Name <span class="text-danger">*</span></label>
      <input type="text" name="name" id="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $template->name ?? '') }}" required placeholder="e.g. Welcome Email"
        style="max-width: 480px;">
      @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-4">
      <label for="subject" class="form-label fw-semibold" style="font-size: 0.9rem;">Subject Line <span class="text-danger">*</span></label>
      <input type="text" name="subject" id="subject"
        class="form-control @error('subject') is-invalid @enderror"
        value="{{ old('subject', $template->subject ?? '') }}" required placeholder="e.g. Welcome to our newsletter!"
        style="max-width: 600px;">
      @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #1a1a2e;">Email Body</h5>
    <p class="text-secondary mb-3" style="font-size: 0.8rem;">Write the content of your email. HTML is supported.</p>

    <div class="mb-4">
      <label for="body" class="form-label fw-semibold" style="font-size: 0.9rem;">Content <span class="text-danger">*</span></label>
      <textarea name="body" id="body"
        class="form-control @error('body') is-invalid @enderror"
        rows="14" required placeholder="Type your email content here...">{{ old('body', $template->body ?? '') }}</textarea>
      @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn d-flex align-items-center gap-1 px-4" style="background: #2d6a4f; color: #fff;">
        <i class="bi bi-check-lg"></i> {{ $isEdit ? 'Update Template' : 'Save Template' }}
      </button>
      <a href="{{ route('templates.index') }}" class="btn btn-outline-secondary px-4">Cancel</a>
    </div>
  </form>
</div>

</x-layouts.app>
