<x-layouts.app>
<div class="container py-5" style="max-width: 500px;">
  <h4 class="fw-bold mb-3">Simulate incoming email</h4>
  <p class="text-secondary small">This sends a fake reply to your inbox so you can test the UI.</p>
  <form method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label small">Sender name</label>
      <input name="name" class="form-control" value="Jane Doe" required>
    </div>
    <div class="mb-3">
      <label class="form-label small">Sender email</label>
      <input name="email" class="form-control" value="jane@example.com" required>
    </div>
    <div class="mb-3">
      <label class="form-label small">Subject</label>
      <input name="subject" class="form-control" value="Re: Your campaign">
    </div>
    <div class="mb-3">
      <label class="form-label small">Body</label>
      <textarea name="body" class="form-control" rows="4" required>Thanks for the email! I have a question about your product.</textarea>
    </div>
    <button class="btn w-100" style="background: #e94560; color: #fff;">Send to inbox</button>
  </form>
  <a href="/audience/inbox" class="btn btn-outline-secondary w-100 mt-2">Go to inbox</a>
</div>
</x-layouts.app>
