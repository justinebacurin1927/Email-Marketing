<x-layouts.auth title="Forgot Password — SendFlow">
  <div class="card shadow-sm" style="width: 100%; max-width: 420px; border: none; border-radius: 12px;">
    <div class="card-body p-4">
      <div class="text-center mb-4">
        <img src="{{ asset('icon.svg') }}" alt="" style="width: 1.8rem; height: 1.8rem;">
        <span style="color: #e94560; font-weight: 700; font-size: 1.5rem;">SendFlow</span>
        <p class="text-muted small mt-1">Reset your password</p>
      </div>

      @if (session('reset_link'))
        <div class="alert alert-success py-2 small">
          <strong>Reset link generated:</strong><br>
          <a href="{{ session('reset_link') }}" class="text-break">{{ session('reset_link') }}</a>
          <hr class="my-1">
          <span class="text-muted">(Demo mode — link shown instead of emailed)</span>
        </div>
      @endif

      @if ($errors->any())
        <div class="alert alert-danger py-2 small">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label small">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="{{ old('email', session('email')) }}" required placeholder="you@example.com">
        </div>

        <button type="submit" class="btn w-100 text-white fw-medium mb-3" style="background: #e94560; border: none; padding: 0.6rem; border-radius: 8px;">
          Send Reset Link
        </button>
      </form>

      <div class="text-center">
        <small class="text-muted"><a href="{{ route('login') }}" style="color: #e94560;">Back to sign in</a></small>
      </div>
    </div>
  </div>
</x-layouts.auth>
