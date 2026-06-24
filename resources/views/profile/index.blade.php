<x-layouts.app>

<div class="px-4 py-4 mt-5" style="max-width: 600px;">
  <div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
      <h4 class="fw-bold mb-1">Profile</h4>
      <p class="text-secondary small mb-4">Manage your account information</p>

      @if (session('profile_success'))
        <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
          <i class="bi bi-check-circle-fill me-1"></i> {{ session('profile_success') }}
          <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if(auth()->check())
        <form action="{{ route('profile.update') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <button type="submit" class="btn d-flex align-items-center gap-1" style="background: #2d6a4f; color: #fff;">
            <i class="bi bi-check-lg"></i> Save Changes
          </button>
        </form>
      @else
        <p class="text-secondary">No user account found. Run <code>php artisan tinker</code> and create one.</p>
      @endif
    </div>
  </div>

  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <h5 class="fw-bold mb-1">Change Password</h5>
      <p class="text-secondary small mb-4">Update your password</p>

      @if(auth()->check())
        <form action="{{ route('profile.password') }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="current_password" class="form-label fw-semibold">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
            @error('current_password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-semibold">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>

          <button type="submit" class="btn d-flex align-items-center gap-1" style="background: #e94560; color: #fff;">
            <i class="bi bi-key"></i> Update Password
          </button>
        </form>
      @else
        <p class="text-secondary">No user account found.</p>
      @endif
    </div>
  </div>
</div>

</x-layouts.app>
