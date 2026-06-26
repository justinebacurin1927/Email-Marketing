<x-layouts.auth title="Register — SendFlow">
  <div class="card shadow-sm" style="width: 100%; max-width: 420px; border: none; border-radius: 12px;">
    <div class="card-body p-4">
      <div class="text-center mb-4">
        <img src="{{ asset('icon.svg') }}" alt="" style="width: 1.8rem; height: 1.8rem;">
        <span style="color: #e94560; font-weight: 700; font-size: 1.5rem;">SendFlow</span>
        <p class="text-muted small mt-1">Create a new account</p>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger py-2 small">
          <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label small">Name</label>
          <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}" required placeholder="Your name">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="email" class="form-label small">Email</label>
          <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}" required placeholder="you@example.com">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label small">Password</label>
          <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
            required placeholder="Min 8 characters">
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label small">Confirm Password</label>
          <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Repeat password">
        </div>

        <button type="submit" class="btn w-100 text-white fw-medium mb-3" style="background: #e94560; border: none; padding: 0.6rem; border-radius: 8px;">
          Create Account
        </button>
      </form>

      <div class="text-center">
        <small class="text-muted">Already have an account? <a href="{{ route('login') }}" style="color: #e94560;">Sign in</a></small>
      </div>
    </div>
  </div>
</x-layouts.auth>
