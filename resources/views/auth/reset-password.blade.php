<x-layouts.auth title="Reset Password — SendFlow">
  <div class="card shadow-sm" style="width: 100%; max-width: 420px; border: none; border-radius: 12px;">
    <div class="card-body p-4">
      <div class="text-center mb-4">
        <img src="{{ asset('icon.svg') }}" alt="" style="width: 1.8rem; height: 1.8rem;">
        <span style="color: #e94560; font-weight: 700; font-size: 1.5rem;">SendFlow</span>
        <p class="text-muted small mt-1">Choose a new password</p>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger py-2 small">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="mb-3">
          <label for="password" class="form-label small">New Password</label>
          <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Min 8 characters">
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label small">Confirm Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Repeat password">
        </div>

        <button type="submit" class="btn w-100 text-white fw-medium" style="background: #e94560; border: none; padding: 0.6rem; border-radius: 8px;">
          Reset Password
        </button>
      </form>
    </div>
  </div>
</x-layouts.auth>
