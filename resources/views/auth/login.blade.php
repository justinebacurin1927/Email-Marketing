<x-layouts.auth title="Login — SendFlow">
  <div class="card shadow-sm" style="width: 100%; max-width: 420px; border: none; border-radius: 12px;">
    <div class="card-body p-4">
      <div class="text-center mb-4">
        <img src="{{ asset('icon.svg') }}" alt="" style="width: 1.8rem; height: 1.8rem;">
        <span style="color: #e94560; font-weight: 700; font-size: 1.5rem;">SendFlow</span>
        <p class="text-muted small mt-1">Sign in to your account</p>
      </div>

      @if (session('error'))
        <div class="alert alert-danger py-2 small">{{ session('error') }}</div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label small">Email</label>
          <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}" required autofocus placeholder="you@example.com">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label small">Password</label>
          <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
            required placeholder="Enter your password">
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
          <div class="form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input" value="1">
            <label for="remember" class="form-check-label small">Remember me</label>
          </div>
          <a href="{{ route('password.request') }}" class="small" style="color: #e94560;">Forgot password?</a>
        </div>

        <button type="submit" class="btn w-100 text-white fw-medium mb-3" style="background: #e94560; border: none; padding: 0.6rem; border-radius: 8px;">
          Sign In
        </button>
      </form>

      <div class="text-center mb-3">
        <span class="text-muted small">or</span>
      </div>

      <form method="POST" action="{{ route('login.guest') }}">
        @csrf
        <button type="submit" class="btn w-100 fw-medium" style="border: 1.5px solid #e94560; color: #e94560; background: transparent; padding: 0.6rem; border-radius: 8px;">
          <i class="bi bi-person-fill me-1"></i> Try Demo Account
        </button>
      </form>

      <div class="text-center mt-3">
        <small class="text-muted">Don't have an account? <a href="{{ route('register') }}" style="color: #e94560;">Create one</a></small>
      </div>
    </div>
  </div>
</x-layouts.auth>
