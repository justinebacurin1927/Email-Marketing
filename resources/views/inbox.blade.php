<x-layouts.bp-inbox>
  <x-topbar/>

  <!-- MAIN WRAPPER -->
  <div class="d-flex flex-grow-1" style="margin-left: 16rem; margin-top: 4rem; height: calc(100vh - 4rem);">
    
    <!-- MESSAGE LIST -->
    <div class="border-end bg-white d-flex flex-column" style="width: 380px; overflow-y: auto;">
      <div class="p-3 border-bottom">
        <input type="text" class="form-control" placeholder="Search for a message">
      </div>

      <div class="px-3 pt-2 border-bottom d-flex gap-3 small text-secondary">
        <a href="#" class="text-dark fw-semibold text-decoration-none">To Do</a>
        <a href="#" class="text-secondary text-decoration-none">Done</a>
        <a href="#" class="text-secondary text-decoration-none">Trash</a>
        <a href="#" class="text-secondary text-decoration-none">All</a>
      </div>

      <div class="p-3 flex-grow-1 overflow-auto">
        @for ($i = 1; $i <= 10; $i++)
          <div class="border-bottom py-2">
            <div class="fw-semibold">Customer {{ $i }}</div>
            <div class="small text-secondary">"Thanks for your email..."</div>
          </div>
        @endfor
      </div>
    </div>

    <!-- EMPTY STATE / MESSAGE VIEW -->
    <div class="flex-grow-1 d-flex flex-column justify-content-center align-items-center bg-light">
      <div class="text-center">
        <div style="font-size: 4rem;">📬</div>
        <h5 class="fw-bold mt-3">Manage one-to-one conversations with your audience using Inbox</h5>
        <p class="text-secondary small mx-auto" style="max-width: 420px;">
          Reply to email conversations, respond to Survey feedback, or forward messages from an existing
          address. Learn how to use your Inbox to manage your conversations or give it a spin by messaging yourself.
        </p>
        <button class="btn btn-primary mt-2">Add Sources</button>
      </div>
    </div>
  </div>
</x-layouts.bp-inbox>
